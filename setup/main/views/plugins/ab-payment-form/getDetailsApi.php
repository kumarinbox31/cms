<?php
$pgInputs = '';
// Fetch the form ID securely from GET parameters.
$pgformId = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$pgformId) {
    // Exit or return an error if ID is invalid
    echo json_encode(['status' => false, 'msg' => 'Invalid form ID']);
    return;
}

// Load the CI instance
$ci = &get_instance(); 

// Get service details by ID
$get = $ci->ServiceModel->getServiceById($pgformId)->row();
$data = isset($get->desc) ? $get->desc : '';

if (empty($data)) {
    echo json_encode(['status' => false, 'msg' => 'Payment: details not found.']);
    return;
}

// Decode the JSON object from the retrieved data
$obj = json_decode($data);

// Extract form ID and gateway info (supports both legacy 'pg' and modern format)
$formId = isset($obj->form) ? $obj->form : null;

if (!$formId) {
    echo json_encode(['status' => false, 'msg' => 'Payment: Invalid form data.']);
    return;
}

$pg = null;
if (isset($obj->pg) && !empty($obj->pg)) {
    $pg = $obj->pg;
} elseif (isset($obj->default_gateway) && !empty($obj->default_gateway)) {
    $pg = $obj->default_gateway;
} elseif (isset($obj->allowed_gateways) && is_array($obj->allowed_gateways) && !empty($obj->allowed_gateways)) {
    $pg = $obj->allowed_gateways[0];
} else {
    $pg = 'razorpay';
}

// Payment Gateway processing logic (Example: Razorpay)
switch ($pg) {
    case 'pg-razorpay':
        $key_id = getVal('pg-razorpay-val1');
        $key_secret = getVal('pg-razorpay-val2');
        $pgInputs = "<input type='hidden' name='key_id' value=''>
        <input type='hidden' name='key_id' value=''>
        <input type='hidden' name='key_id' value=''>";
    break;
    // You can add more cases for other payment gateways
}

// Fetch form content based on the form ID
$form = $ci->ServiceModel->getServiceById($formId)->row();

if (empty($form)) {
    echo json_encode(['status' => false, 'msg' => 'Payment: Form not found.']);
    return;
}

$form_content = isset($form->content) ? $form->content : '';

// Prepare the response data
$data = [
    'pg_form_id' => $pgformId,
    'form_content' => $form_content,
    'pg-input' => $pgInputs,
];

// Send the JSON response
echo json_encode(['status' => true, 'msg' => 'Data fetched', 'data' => $data]);
