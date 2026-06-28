<?php
namespace AbPaymentForm\Gateways\PayU;

use AbPaymentForm\Gateways\Contracts\PaymentGatewayInterface;
use AbPaymentForm\Dto\PaymentRequest;
use AbPaymentForm\Dto\PaymentResponse;
use AbPaymentForm\Dto\WebhookRequest;

class PayUGateway implements PaymentGatewayInterface {
    
    private $config;

    public function __construct(array $config) {
        $this->config = $config;
    }

    public function validateConfiguration(): bool {
        return !empty($this->config['merchant_key']) && !empty($this->config['salt']);
    }

    public function createOrder(PaymentRequest $request): PaymentResponse {
        $amount = number_format($request->amount, 2, '.', ''); 
        
        $successUrl = base_url('/web/plugin/ab-payment-form/api/webhook.php?gateway=payu'); // PayU POSTs to success/failure URL
        $failureUrl = base_url('/web/plugin/ab-payment-form/api/webhook.php?gateway=payu');
        
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $productinfo = 'Order';
        $firstname = $request->customerName;
        $email = $request->customerEmail;
        $phone = $request->customerPhone;
        
        // Hash Sequence: key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT
        $hashSequence = $this->config['merchant_key'] . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $this->config['salt'];
        
        $hash = strtolower(hash('sha512', $hashSequence));

        $data = [
            'key' => $this->config['merchant_key'],
            'txnid' => $txnid,
            'amount' => $amount,
            'productinfo' => $productinfo,
            'firstname' => $firstname,
            'email' => $email,
            'phone' => $phone,
            'surl' => $successUrl,
            'furl' => $failureUrl,
            'hash' => $hash,
            'service_provider' => 'payu_paisa',
            'action_url' => $this->config['mode'] === 'production' ? 'https://secure.payu.in/_payment' : 'https://test.payu.in/_payment'
        ];

        return new PaymentResponse(true, $txnid, $data, null);
    }

    public function verifyPayment(WebhookRequest $request): bool {
        return true; 
    }

    public function handleWebhook(WebhookRequest $request): void {
        // PayU sends form-urlencoded data to the webhook (surl/furl)
        // Ensure payload is parsed if it's raw
        parse_str($request->payload, $postData);
        
        if (empty($postData)) {
            $postData = $_POST; // Fallback if PHP already parsed it
        }

        if (empty($postData['txnid'])) {
            throw new \Exception("Invalid PayU Webhook payload.");
        }

        // Verify Hash
        $status = $postData['status'];
        $firstname = $postData['firstname'];
        $amount = $postData['amount'];
        $txnid = $postData['txnid'];
        $posted_hash = $postData['hash'];
        $key = $postData['key'];
        $productinfo = $postData['productinfo'];
        $email = $postData['email'];
        $salt = $this->config['salt'];

        $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        $hash = hash("sha512", $retHashSeq);

        if ($hash !== $posted_hash) {
            throw new \Exception("PayU Signature Verification Failed.");
        }

        $transactionService = new \AbPaymentForm\Services\TransactionService();
        $txn = $transactionService->getTransactionByGatewayOrderId($txnid);
        
        if ($txn && $txn['status'] === 'pending') {
            if ($status === 'success') {
                $transactionService->updateTransactionStatus($txn['txn_id'], 'success', 'CAPTURED', [
                    'gateway_payment_id' => $postData['mihpayid'] ?? '',
                    'webhook_response' => json_encode($postData)
                ]);
                
                // Redirect user back to UI since PayU acts via browser redirection
                header("Location: " . base_url('/web/plugin/ab-payment-form/success?gateway=payu&txn=' . $txn['txn_id']));
                exit;
            } else {
                $transactionService->updateTransactionStatus($txn['txn_id'], 'failed', 'FAILED', [
                    'webhook_response' => json_encode($postData)
                ]);
                header("Location: " . base_url('/web/plugin/ab-payment-form/cancel?gateway=payu'));
                exit;
            }
        } else {
            // Already processed
            if ($status === 'success') {
                header("Location: " . base_url('/web/plugin/ab-payment-form/success?gateway=payu&txn=' . $txnid));
            } else {
                header("Location: " . base_url('/web/plugin/ab-payment-form/cancel?gateway=payu'));
            }
            exit;
        }
    }
}
