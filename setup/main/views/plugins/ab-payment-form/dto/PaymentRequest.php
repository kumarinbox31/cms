<?php
namespace AbPaymentForm\Dto;

class PaymentRequest {
    public $formId;
    public $amount;
    public $currency;
    public $customerName;
    public $customerEmail;
    public $customerPhone;
    public $formData; // Raw JSON or array of the submitted form

    public function __construct(array $data) {
        $this->formId = $data['form_id'] ?? null;
        $this->amount = $data['amount'] ?? 0;
        $this->currency = $data['currency'] ?? 'INR';
        $this->customerName = $data['name'] ?? 'Customer';
        $this->customerEmail = $data['email'] ?? 'customer@example.com';
        $this->customerPhone = $data['phone'] ?? $data['mobile'] ?? '';
        $this->formData = $data;
    }
}
