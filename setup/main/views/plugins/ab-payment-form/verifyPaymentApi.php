<?php

$response = $this->input->post();

// Ensure that required parameters are present
if (empty($response) || !isset($response['razorpay_payment_id']) || !isset($response['razorpay_order_id']) || !isset($response['razorpay_signature'])) {
    echo json_encode(['status' => false, 'msg' => 'Invalid payment verification data.']);
    return;
}

// Define Razorpay API credentials
$keyId = getVal('pg-razorpay-val1'); // Your Razorpay key ID
$keySecret = getVal('pg-razorpay-val2'); // Your Razorpay key secret

// Prepare data for verification
$razorpayPaymentId = $response['razorpay_payment_id'];
$razorpayOrderId = $response['razorpay_order_id'];
$razorpaySignature = $response['razorpay_signature'];

// Generate the expected signature
$generatedSignature = hash_hmac('sha256', $razorpayOrderId . '|' . $razorpayPaymentId, $keySecret);

// Verify the signature
if ($generatedSignature === $razorpaySignature) {
    $this->db->where('txn_id',$razorpayOrderId)->update('ab_payment_data',['status'=>'success']);
    // Payment is verified
    echo json_encode(['status' => true, 'msg' => 'Payment verified successfully.']);
    // Here you can handle post-verification tasks (like updating the database, sending notifications, etc.)
} else {
    $this->db->where('txn_id',$razorpayOrderId)->update('ab_payment_data',['status'=>'failed']);
    // Payment verification failed
    echo json_encode(['status' => false, 'msg' => 'Payment verification failed.']);
}