<?php
namespace AbPaymentForm\Gateways\Contracts;

use AbPaymentForm\Dto\PaymentRequest;
use AbPaymentForm\Dto\PaymentResponse;
use AbPaymentForm\Dto\WebhookRequest;
use AbPaymentForm\Dto\RefundRequest;

// Core required interface
interface PaymentGatewayInterface {
    public function createOrder(PaymentRequest $request): PaymentResponse;
    public function verifyPayment(WebhookRequest $request): bool;
    public function handleWebhook(WebhookRequest $request): void;
    public function validateConfiguration(): bool;
}

// Optional Capability Interfaces
interface RefundableGatewayInterface {
    public function refundPayment(RefundRequest $request): bool;
}

interface CaptureGatewayInterface {
    public function capturePayment(string $transactionId): bool;
}

interface CancelableGatewayInterface {
    public function cancelPayment(string $transactionId): bool;
}

interface TransactionLookupInterface {
    public function getTransactionStatus(string $transactionId): string;
}
