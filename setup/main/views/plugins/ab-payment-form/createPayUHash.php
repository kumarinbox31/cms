<?php
$key  = trim(getVal('pg-payumoney-val1'));
$salt = trim(getVal('pg-payumoney-val2'));

$txnid = uniqid("TXN_");

// IMPORTANT: format amount to 2 decimals
$amount = number_format((float)$_POST['amount'], 2, '.', '');

$productinfo = "Website Payment";
$firstname = !empty($_POST['name']) ? $_POST['name'] : 'Customer';
$email     = !empty($_POST['email']) ? $_POST['email'] : 'customer@yourdomain.com';
$phone       = trim($_POST['mobile']);

// HASH STRING (DO NOT CHANGE ORDER)
$hashString = 
    $key . '|' .
    $txnid . '|' .
    $amount . '|' .
    $productinfo . '|' .
    $firstname . '|' .
    $email . '|||||||||||' .
    $salt;

$hash = strtolower(hash('sha512', $hashString));


/**
 * ✅ INSERT PAYMENT DATA (PENDING)
 */
$this->db->insert('ab_payment_data', [
    'pg_form_id' => $pg_form_id,
    'txn_id'     => $txnid,            // PayU txnid
    'amount'     => $amount,
    'data'       => json_encode($_POST),
    'client_id'  => CLIENT_ID,
    'gateway'    => 'payumoney',
    'status'     => 'pending',
    'created_at' => date('Y-m-d H:i:s')
]);

/**
 * ✅ RESPONSE TO FRONTEND
 */
echo json_encode([
    "status" => true,
    "data" => [
        "key"         => $key,
        "txnid"       => $txnid,
        "amount"      => $amount,
        "productinfo" => $productinfo,
        "firstname"   => $firstname,
        "email"       => $email,
        "phone"       => $phone,
        "hash"        => $hash,
        "surl"        => base_url("/web/plugin/ab-payment-form/successPayuTxn"),
        "furl"        => base_url("/web/plugin/ab-payment-form/failedPayuTxn")
    ]
]);
