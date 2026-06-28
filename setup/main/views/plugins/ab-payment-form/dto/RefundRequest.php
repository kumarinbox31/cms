<?php
namespace AbPaymentForm\Dto;

class RefundRequest {
    public $transactionId; // The internal transaction ID or gateway transaction ID
    public $amount; // Partial refund amount (optional)
    public $reason;

    public function __construct(string $transactionId, $amount = null, string $reason = '') {
        $this->transactionId = $transactionId;
        $this->amount = $amount;
        $this->reason = $reason;
    }
}
