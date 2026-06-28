<?php
namespace AbPaymentForm\Gateways\Stripe;

use AbPaymentForm\Gateways\Contracts\PaymentGatewayInterface;
use AbPaymentForm\Gateways\Contracts\RefundableGatewayInterface;
use AbPaymentForm\Dto\PaymentRequest;
use AbPaymentForm\Dto\PaymentResponse;
use AbPaymentForm\Dto\WebhookRequest;
use AbPaymentForm\Dto\RefundRequest;

class StripeGateway implements PaymentGatewayInterface, RefundableGatewayInterface {
    
    private $config;

    public function __construct(array $config) {
        $this->config = $config;
    }

    public function validateConfiguration(): bool {
        return !empty($this->config['secret_key']) && !empty($this->config['publishable_key']);
    }

    public function createOrder(PaymentRequest $request): PaymentResponse {
        $url = 'https://api.stripe.com/v1/checkout/sessions';
        
        // Stripe expects amount in smallest currency unit (cents/paise)
        $amount = (int) ($request->amount * 100); 
        
        // Use a generic success/cancel URL, can be modified via hooks/frontend
        $successUrl = base_url('/web/plugin/ab-payment-form/success?session_id={CHECKOUT_SESSION_ID}');
        $cancelUrl = base_url('/web/plugin/ab-payment-form/cancel');

        $data = http_build_query([
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [
                0 => [
                    'price_data' => [
                        'currency' => strtolower($request->currency),
                        'product_data' => [
                            'name' => 'Payment for Order'
                        ],
                        'unit_amount' => $amount
                    ],
                    'quantity' => 1
                ]
            ],
            'customer_email' => $request->customerEmail
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->config['secret_key'],
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            throw new \Exception('Stripe cURL Error: ' . $err);
        }

        $result = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300 && isset($result['id'])) {
            return new PaymentResponse(
                true, 
                $result['id'], 
                ['session_id' => $result['id'], 'url' => $result['url'], 'publishable_key' => $this->config['publishable_key']], 
                null
            );
        } else {
            $errorMsg = $result['error']['message'] ?? 'Stripe Order Creation Failed';
            return new PaymentResponse(false, null, [], $errorMsg);
        }
    }

    public function verifyPayment(WebhookRequest $request): bool {
        // Validation occurs in handleWebhook based on signature
        return true; 
    }

    public function handleWebhook(WebhookRequest $request): void {
        $signature = $request->headers['Stripe-Signature'] ?? '';
        $payload = $request->payload;
        $webhookSecret = $this->config['webhook_secret'] ?? '';

        // Simplistic signature verification (a proper robust implementation should parse timestamps and hashes)
        if (empty($signature) || empty($webhookSecret)) {
            throw new \Exception("Stripe Webhook Error: Missing signature or webhook secret");
        }

        // Ideally, we compute HMAC here. For this boilerplate without stripe-php, 
        // we'll parse the event JSON directly and assume it's validated or use a basic check.
        // The robust way is to split the signature by ',' get 't' and 'v1', hash with secret.
        $this->verifySignature($payload, $signature, $webhookSecret);

        $event = json_decode($payload, true);
        
        $ci = &get_instance();
        $transactionService = new \AbPaymentForm\Services\TransactionService();

        if ($event['type'] === 'checkout.session.completed') {
            $session = $event['data']['object'];
            $gatewayOrderId = $session['id'];
            $paymentIntentId = $session['payment_intent'];
            
            $txn = $transactionService->getTransactionByGatewayOrderId($gatewayOrderId);
            if ($txn && $txn['status'] === 'pending') {
                $transactionService->updateTransactionStatus($txn['txn_id'], 'success', 'CAPTURED', [
                    'gateway_payment_id' => $paymentIntentId,
                    'webhook_response' => json_encode($event)
                ]);
            }
        } elseif ($event['type'] === 'checkout.session.expired') {
            $session = $event['data']['object'];
            $gatewayOrderId = $session['id'];
            
            $txn = $transactionService->getTransactionByGatewayOrderId($gatewayOrderId);
            if ($txn && $txn['status'] === 'pending') {
                $transactionService->updateTransactionStatus($txn['txn_id'], 'failed', 'EXPIRED', [
                    'webhook_response' => json_encode($event)
                ]);
            }
        }
    }

    public function refundPayment(RefundRequest $request): bool {
        // Implement refund via POST /v1/refunds using the $request->transactionId (which is the gateway_payment_id)
        return false; // Not fully implemented in this phase
    }

    private function verifySignature($payload, $headerSignature, $secret) {
        $parts = explode(',', $headerSignature);
        $timestamp = '';
        $signatures = [];
        
        foreach ($parts as $part) {
            list($key, $value) = explode('=', trim($part), 2);
            if ($key === 't') {
                $timestamp = $value;
            } elseif ($key === 'v1') {
                $signatures[] = $value;
            }
        }
        
        if (empty($timestamp) || empty($signatures)) {
             throw new \Exception("Invalid Stripe signature format.");
        }
        
        $signedPayload = $timestamp . '.' . $payload;
        $expectedSignature = hash_hmac('sha256', $signedPayload, $secret);
        
        if (!in_array($expectedSignature, $signatures)) {
             throw new \Exception("Stripe Signature Verification Failed.");
        }
    }
}
