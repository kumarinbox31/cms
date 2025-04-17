<?php


function htmlEncode($content){
    return htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); // to encode html content
}
function htmlDecode($content){
    return html_entity_decode($content, ENT_QUOTES, 'UTF-8'); // to decode html content
}

function cleanDomain($url) {
    return $url;
    // Parse the URL
    $parsedUrl = parse_url($url);

    // Extract and clean the host part (domain)
    $domain = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';
    
    // Remove "www." if it exists
    $domain = preg_replace('/^www\./i', '', $domain);
    
    // Remove "https://" if it exists
    $domain = preg_replace('/^https?:\/\//i', '', $domain);

    return $domain;
}
function generateJWT($email, $website_id, $secret_key) {
    // Header
    $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);

    // Payload
    $payload = json_encode([
        'email' => $email,
        'website_id' => $website_id,
        'exp' => time() + 3600 // Expires in 1 hour
    ]);

    // Encode to Base64
    $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

    // Generate Signature
    $signature = hash_hmac('sha256', "$base64Header.$base64Payload", $secret_key, true);
    $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    // Combine to create JWT
    return "$base64Header.$base64Payload.$base64Signature";
}
function validateJWT($token, $secret_key) {
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return false;
    }

    list($base64Header, $base64Payload, $base64Signature) = $parts;

    // Verify Signature
    $signature = hash_hmac('sha256', "$base64Header.$base64Payload", $secret_key, true);
    $expectedSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    if (!hash_equals($expectedSignature, $base64Signature)) {
        return false; // Invalid signature
    }

    // Decode and check expiration
    $payload = json_decode(base64_decode($base64Payload), true);
    if (!$payload || $payload['exp'] < time()) {
        return false; // Expired or invalid payload
    }

    return $payload; // Return the valid payload
}