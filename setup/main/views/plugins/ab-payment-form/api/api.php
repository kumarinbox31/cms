<?php
// Unified API Endpoint for handling new payment gateway requests via AJAX
define('BASEPATH', true); // Simple mock check if needed
require_once __DIR__ . '/../../../../../index.php'; // Boot CodeIgniter if required or assume it's included

use AbPaymentForm\Controllers\PaymentController;
use AbPaymentForm\Services\PaymentManager;
use AbPaymentForm\Services\TransactionService;
use AbPaymentForm\Services\ConfigService;
use AbPaymentForm\Services\PaymentLogger;
use AbPaymentForm\Gateways\Factory\GatewayFactory;

// Bootstrap modern services
$configService = new ConfigService();
$gatewayFactory = new GatewayFactory($configService);
$transactionService = new TransactionService();
$logger = new PaymentLogger();
$paymentManager = new PaymentManager($gatewayFactory, $transactionService, $logger);
$controller = new PaymentController($paymentManager);

$action = $_GET['action'] ?? $_POST['action'] ?? '';

if ($action === 'create_order') {
    $controller->createOrder();
} else {
    echo json_encode(['status' => false, 'msg' => 'Invalid action']);
}
