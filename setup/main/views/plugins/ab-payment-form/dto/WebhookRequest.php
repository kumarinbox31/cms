<?php
namespace AbPaymentForm\Dto;

class WebhookRequest {
    public $gateway;
    public $payload; // Raw JSON payload or parsed array
    public $headers; // Request headers (useful for signature validation)

    public function __construct(string $gateway, $payload, array $headers = []) {
        $this->gateway = $gateway;
        $this->payload = $payload;
        $this->headers = $headers;
    }
}
