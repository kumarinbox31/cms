<?php
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

function getTotalSpaceUsed(){
    $dir = dirname(dirname(APPPATH))."/public/temp/".CLIENT_ID.'/';
    $size = getTotalImageSize($dir);
    return formatSizeUnits($size);
}
function getTotalImageSize($directory) {
    $totalSize = 0;
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'webp','pdf'];

    if (is_dir($directory)) {
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $filePath = $directory . DIRECTORY_SEPARATOR . $file;
                
                if (is_file($filePath)) {
                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    if (in_array($extension, $imageExtensions)) {
                        $totalSize += filesize($filePath);
                    }
                } elseif (is_dir($filePath)) {
                    $totalSize += getTotalImageSize($filePath); // Recursively handle subdirectories
                }
            }
        }
    }

    return $totalSize;
}
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}
function getVisitorCounter(){
    $ci = &get_instance();
    $ci->load->model('WebsiteData');
    $cnt = $ci->WebsiteData->getVisitors();
    $digitsArray = str_split((string)$cnt);
    $html = '';
    foreach($digitsArray as $digit){
        $path = base_url().'public/counter/gold/';
        $html .= '<li><img src="'.$path.$digit.'.png" style="width:30px;height:30px;" /></li>';
    }
    return $html;    
}
function checkDefaultPage(){
    $ci = &get_instance();
}
function back_url() {
    $ci = &get_instance();
    $ci->load->library('user_agent');
    // Get the previous URL using the referer()
    $previous_url = $ci->agent->referrer();

    // Check if the previous URL exists
    if (!empty($previous_url)) {
        // Redirect to the previous URL
        redirect($previous_url);
    } else {
        // If there's no previous URL, redirect to a default page
        redirect('/');
    }
}
function theme_path($path=''){
    return base_url("public/theme/".THEMEPATH."/$path");
}
function checkAdminLogin($flag=false){
    $session = isset($_SESSION['customer-session']) ? $_SESSION['customer-session'] : null;
    if($flag == true && $session != CUSTOMER_SESSION){
        return ['status'=>false,'msg'=>'Admin Login Failed.','code'=>11];
    }
    if ($session != CUSTOMER_SESSION) {
        redirect(base_url('customer-login.html'));
    } 
}

function htmlEncode($content){
    return htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); // to encode html content
}
function htmlDecode($content){
    return html_entity_decode($content, ENT_QUOTES, 'UTF-8'); // to decode html content
}


function highKey($key, $flg = false){
    
    $CI = get_instance();
    if($flg)
        return $CI->encryption->decrypt(str_replace('/','A_B',$key));
        
    return str_replace('/','A_B',$CI->encryption->encrypt($key) );
}

// function AB_ENCODE($id,$key=0){
//     return lowKey($id);
// }

// function AB_DECODE($id,$key=0){
//     return lowKey($id,true);
// }
function lowKey($key, $flg = false){
    
    $CI = get_instance();
    $CI->load->library(['encrypt']);
    if($flg)
        return $CI->encrypt->decode(str_replace('/','A_B',$key));
        
    return str_replace('/','A_B',$CI->encrypt->encode($key) );
    
}

function AB_ENCODE($number) {
    // Convert number to string before encoding
    $str = strval($number);
    return base64_encode($str);
}

function AB_DECODE($encoded) {
    // Decode and then convert back to number
    $decoded_str = base64_decode($encoded);
    return intval($decoded_str);
}
function getVal($key,$val=''){
    $ci = &get_instance();
    return $ci->other->getVal($key,$val);
}
function checkPermission($id){
    
}
