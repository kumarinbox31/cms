<?php
namespace AbPaymentForm\Gateways\Swipe;

use AbPaymentForm\Gateways\Contracts\PaymentGatewayInterface;
use AbPaymentForm\Dto\PaymentRequest;
use AbPaymentForm\Dto\PaymentResponse;
use AbPaymentForm\Dto\WebhookRequest;

class SwipeGateway implements PaymentGatewayInterface {
    
    private $config;

    public function __construct(array $config) {
        $this->config = $config;
    }

    public function validateConfiguration(): bool {
        return !empty($this->config['api_key']) && !empty($this->config['api_secret']);
    }

    public function createOrder(PaymentRequest $request): PaymentResponse {
        $url = 'https://api.swipehq.com/createTransaction.php'; // Example endpoint based on standard Swipe documentation
        
        $amount = (float) $request->amount; 
        
        $successUrl = base_url('/web/plugin/ab-payment-form/success?gateway=swipe');
        $cancelUrl = base_url('/web/plugin/ab-payment-form/cancel');

        $data = [
            'api_key' => $this->config['api_key'],
            'merchant_id' => $this->config['api_key'], // Sometimes same in older gateways
            'td_item' => 'Payment for Order',
            'td_amount' => $amount,
            'td_currency' => strtoupper($request->currency),
            'td_email' => $request->customerEmail,
            'td_user_data' => $request->formId,
            'return_url' => $successUrl,
            'cancel_url' => $cancelUrl,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            throw new \Exception('Swipe cURL Error: ' . $err);
        }

        // Swipe typically returns a JSON with a redirect URL or transaction identifier
        $result = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300 && isset($result['data']['transaction_id']) && isset($result['data']['payment_url'])) {
            return new PaymentResponse(
                true, 
                $result['data']['transaction_id'], 
                ['payment_url' => $result['data']['payment_url']], 
                null
            );
        } else {
            $errorMsg = $result['message'] ?? 'Swipe Order Creation Failed';
            return new PaymentResponse(false, null, [], $errorMsg);
        }
    }

    public function verifyPayment(WebhookRequest $request): bool {
        return true; 
    }

    public function handleWebhook(WebhookRequest $request): void {
        $payload = $request->payload;
        $webhookSecret = $this->config['webhook_secret'] ?? '';

        // Verification mechanism would depend on Swipe's actual webhook signature logic
        // For now, parse JSON
        $event = json_decode($payload, true);
        
        if (empty($event['transaction_id'])) {
            throw new \Exception("Invalid Swipe Webhook payload.");
        }

        $transactionService = new \AbPaymentForm\Services\TransactionService();
        $gatewayOrderId = $event['transaction_id'];
        $txn = $transactionService->getTransactionByGatewayOrderId($gatewayOrderId);
        
        if ($txn && $txn['status'] === 'pending') {
            if ($event['status'] === 'success' || $event['status'] === 'completed') {
                $transactionService->updateTransactionStatus($txn['txn_id'], 'success', 'CAPTURED', [
                    'gateway_payment_id' => $event['payment_id'] ?? '',
                    'webhook_response' => $payload
                ]);
            } elseif ($event['status'] === 'failed' || $event['status'] === 'declined') {
                $transactionService->updateTransactionStatus($txn['txn_id'], 'failed', 'FAILED', [
                    'webhook_response' => $payload
                ]);
            }
        }
    }
}
