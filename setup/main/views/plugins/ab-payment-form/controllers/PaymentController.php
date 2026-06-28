<?php
namespace AbPaymentForm\Controllers;

use AbPaymentForm\Services\PaymentManager;
use AbPaymentForm\Dto\PaymentRequest;

class PaymentController {
    
    private $paymentManager;

    public function __construct(PaymentManager $paymentManager) {
        $this->paymentManager = $paymentManager;
    }

    public function createOrder() {
        $gateway = $_POST['gateway'] ?? '';
        
        if (empty($gateway)) {
            $this->jsonResponse(false, "Gateway not specified.");
            return;
        }

        // Basic validation
        if (empty($_POST['form_data']) || empty($_POST['form_data']['amount']) || empty($_POST['form_data']['currency'])) {
            $this->jsonResponse(false, "Invalid order data.");
            return;
        }

        $request = new PaymentRequest($_POST['form_data']);
        
        $response = $this->paymentManager->createOrder($gateway, $request);

        if ($response->success) {
            echo json_encode([
                'status' => true,
                'data' => $response->responseData,
                'gateway_order_id' => $response->gatewayOrderId
            ]);
        } else {
            $this->jsonResponse(false, $response->errorMsg ?: "Order creation failed.");
        }
    }

    private function jsonResponse(bool $status, string $message, array $data = []) {
        echo json_encode([
            'status' => $status,
            'msg' => $message,
            'data' => $data
        ]);
        exit;
    }
}
