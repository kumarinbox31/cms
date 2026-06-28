<?php
// Unified Webhook Endpoint
require_once __DIR__ . '/../../../../../index.php'; // Boot CodeIgniter or framework

use AbPaymentForm\Services\PaymentManager;
use AbPaymentForm\Services\TransactionService;
use AbPaymentForm\Services\ConfigService;
use AbPaymentForm\Services\PaymentLogger;
use AbPaymentForm\Gateways\Factory\GatewayFactory;
use AbPaymentForm\Dto\WebhookRequest;

$gateway = $_GET['gateway'] ?? '';

if (empty($gateway)) {
    http_response_code(400);
    echo "Gateway not specified.";
    exit;
}

$payload = file_get_contents('php://input');
$headers = getallheaders();

$configService = new ConfigService();
$gatewayFactory = new GatewayFactory($configService);
$transactionService = new TransactionService();
$logger = new PaymentLogger();
$paymentManager = new PaymentManager($gatewayFactory, $transactionService, $logger);

try {
    $request = new WebhookRequest($gateway, $payload, $headers);
    $paymentManager->handleWebhook($gateway, $request);
    http_response_code(200);
    echo "OK";
} catch (\Exception $e) {
    http_response_code(400);
    echo "Webhook error: " . $e->getMessage();
}
