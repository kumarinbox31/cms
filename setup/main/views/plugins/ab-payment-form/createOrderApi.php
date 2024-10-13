<?php

// Get POST data from the request
$form_data = $_POST['form_data'];

// Ensure that required parameters are present
if (empty($form_data) || !isset($form_data['amount']) || !isset($form_data['currency'])) {
    echo json_encode(['status' => false, 'msg' => 'Invalid order data.']);
    return;
}

// Define Razorpay API credentials
$keyId = getVal('pg-razorpay-val1'); // Your Razorpay key ID
$keySecret = getVal('pg-razorpay-val2'); // Your Razorpay key secret

// Prepare the order data
$orderData = [
    'amount' => $form_data['amount'], // Amount in smallest currency unit (e.g., 50000 for INR 500)
    'currency' => $form_data['currency'], // Currency code (e.g., 'INR')
    'receipt' => uniqid(), // Optional: Unique receipt ID
    'payment_capture' => 1 // Auto capture payment
];

// Initialize cURL
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $keyId . ":" . $keySecret);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($orderData))
]);

// Execute the cURL request
$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    // Handle cURL error
    echo json_encode(['status' => false, 'msg' => 'cURL Error: ' . $err]);
} else {
    // Parse the response
    $razorpayOrder = json_decode($response, true);
    if (isset($razorpayOrder['id'])) {
        // Return order details
        echo json_encode([
            'status' => true,
            'data' => [
                'id' => $razorpayOrder['id'], // Razorpay order ID
                'amount' => $razorpayOrder['amount'], // Amount in smallest currency unit
                'currency' => $razorpayOrder['currency'], // Currency code
            ]
        ]);
    } else {
        // Handle API response error
        echo json_encode(['status' => false, 'msg' => 'Order creation failed: ' . $razorpayOrder['error']['description']]);
    }
}
