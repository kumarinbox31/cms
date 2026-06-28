<?php
namespace AbPaymentForm\Services;

use AbPaymentForm\Gateways\Factory\GatewayFactory;
use AbPaymentForm\Dto\PaymentRequest;
use AbPaymentForm\Dto\PaymentResponse;
use AbPaymentForm\Dto\WebhookRequest;

class PaymentManager {
    
    private $gatewayFactory;
    private $transactionService;
    private $logger;

    public function __construct(GatewayFactory $gatewayFactory, TransactionService $transactionService, PaymentLogger $logger) {
        $this->gatewayFactory = $gatewayFactory;
        $this->transactionService = $transactionService;
        $this->logger = $logger;
    }

    public function createOrder(string $gatewayName, PaymentRequest $request): PaymentResponse {
        $requestId = uniqid('req_');
        $this->logger->logRequest($gatewayName, $requestId, ['action' => 'createOrder', 'request' => $request]);

        try {
            $gateway = $this->gatewayFactory->create($gatewayName);
            
            // Validate config
            if (!$gateway->validateConfiguration()) {
                throw new \Exception("Gateway configuration is invalid.");
            }

            // Create Pending Transaction in DB
            $txnId = uniqid('TXN_');
            $dbData = [
                'txn_id' => $txnId,
                'pg_form_id' => $request->formId,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'client_id' => defined('CLIENT_ID') ? CLIENT_ID : 0,
                'status' => 'pending',
                'gateway' => $gatewayName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'data' => json_encode($request->formData)
            ];
            $this->transactionService->createPendingTransaction($dbData);

            // Forward to gateway
            $response = $gateway->createOrder($request);
            
            // Update Transaction with gateway order ID if successful
            if ($response->success && $response->gatewayOrderId) {
                $this->transactionService->updateTransactionStatus($txnId, 'pending', null, [
                    'gateway_order_id' => $response->gatewayOrderId
                ]);
            }

            // Append internal TXN ID to response for frontend reference if needed
            $response->responseData['internal_txn_id'] = $txnId;
            
            $this->logger->logResponse($gatewayName, $requestId, (array) $response);
            return $response;

        } catch (\Exception $e) {
            $this->logger->logException($gatewayName, 'createOrder', $e);
            return new PaymentResponse(false, null, [], $e->getMessage());
        }
    }

    public function handleWebhook(string $gatewayName, WebhookRequest $request) {
        $webhookId = uniqid('wh_');
        $this->logger->logWebhook($gatewayName, $webhookId, $request->payload);

        try {
            $gateway = $this->gatewayFactory->create($gatewayName);
            $gateway->handleWebhook($request);
        } catch (\Exception $e) {
            $this->logger->logException($gatewayName, 'handleWebhook', $e);
            throw $e;
        }
    }
}
