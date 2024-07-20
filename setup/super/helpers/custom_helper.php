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