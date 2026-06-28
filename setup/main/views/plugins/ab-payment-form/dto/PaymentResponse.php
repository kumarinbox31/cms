<?php
namespace AbPaymentForm\Dto;

class PaymentResponse {
    public $success;
    public $gatewayOrderId;
    public $amount;
    public $currency;
    public $responseData; // Any additional data needed by the frontend JS (e.g. hash, tokens, keys)
    public $errorMsg;

    public function __construct(bool $success, string $gatewayOrderId = null, array $responseData = [], string $errorMsg = null) {
        $this->success = $success;
        $this->gatewayOrderId = $gatewayOrderId;
        $this->responseData = $responseData;
        $this->errorMsg = $errorMsg;
    }
}
