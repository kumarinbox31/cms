<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_basic_seo_report($url) {
    $html = fetch_url_content($url);
    if (!$html) return false;

    // Use DOMDocument to parse HTML
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($html);
    libxml_clear_errors();

    // Check title
    $titleTags = $doc->getElementsByTagName('title');
    $titlePresent = ($titleTags->length > 0) && trim($titleTags->item(0)->textContent) !== '';

    // Check meta description
    $metaDescription = false;
    foreach ($doc->getElementsByTagName('meta') as $meta) {
        if (strtolower($meta->getAttribute('name')) === 'description' && trim($meta->getAttribute('content')) !== '') {
            $metaDescription = true;
            break;
        }
    }

    // Check viewport meta tag
    $viewportSet = false;
    foreach ($doc->getElementsByTagName('meta') as $meta) {
        if (strtolower($meta->getAttribute('name')) === 'viewport') {
            $viewportSet = true;
            break;
        }
    }

    // Check H1 tags
    $h1Tags = $doc->getElementsByTagName('h1');
    $h1Present = $h1Tags->length > 0;

    // Count images missing alt attribute
    $imgs = $doc->getElementsByTagName('img');
    $missingAltCount = 0;
    foreach ($imgs as $img) {
        if (!$img->hasAttribute('alt') || trim($img->getAttribute('alt')) === '') {
            $missingAltCount++;
        }
    }

    // Count links missing descriptive text
    $links = $doc->getElementsByTagName('a');
    $missingLinkTextCount = 0;
    foreach ($links as $link) {
        if (trim($link->textContent) === '') {
            $missingLinkTextCount++;
        }
    }

    // Check for canonical tag
    $canonicalTag = false;
    foreach ($doc->getElementsByTagName('link') as $link) {
        if (strtolower($link->getAttribute('rel')) === 'canonical') {
            $canonicalTag = true;
            break;
        }
    }

    // Check robots.txt existence
    $robotsTxtExists = check_robots_txt($url);
    
    $faviconPresent = false;
    foreach ($doc->getElementsByTagName('link') as $link) {
        $rel = strtolower($link->getAttribute('rel'));
        if ($rel === 'icon' || $rel === 'shortcut icon') {
            $faviconPresent = true;
            break;
        }
    }
    
    $bodyText = strip_tags($doc->saveHTML());
    $wordCount = str_word_count($bodyText);
    
    $strongTags = $doc->getElementsByTagName('strong');
    $emTags = $doc->getElementsByTagName('em');
    $hasEmphasisTags = $strongTags->length > 0 || $emTags->length > 0;
    
    $h1Count = $h1Tags->length;
    $multipleH1 = $h1Count > 1;
    
    $htmlTags = $doc->getElementsByTagName('html');
    $langSet = ($htmlTags->length > 0 && $htmlTags->item(0)->hasAttribute('lang'));
    
    $viewportContent = '';
    foreach ($doc->getElementsByTagName('meta') as $meta) {
        if (strtolower($meta->getAttribute('name')) === 'viewport') {
            $viewportContent = strtolower($meta->getAttribute('content'));
            break;
        }
    }
    $mobileFriendly = strpos($viewportContent, 'width=device-width') !== false;




    return [
        'url' => $url,
        'titlePresent' => $titlePresent,
        'metaDescriptionPresent' => $metaDescription,
        'viewportSet' => $viewportSet,
        'h1Present' => $h1Present,
        'missingAltAttributes' => $missingAltCount,
        'missingLinkText' => $missingLinkTextCount,
        'canonicalTag' => $canonicalTag,
        'robotsTxtExists' => $robotsTxtExists,
        // New items
        'faviconPresent' => $faviconPresent,
        'wordCount' => $wordCount,
        'hasEmphasisTags' => $hasEmphasisTags,
        'multipleH1' => $multipleH1,
        'htmlLangSet' => $langSet,
        'mobileFriendly' => $mobileFriendly,
    ];
}

function fetch_url_content($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; FreeSEOChecker/1.0)');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode != 200) return false;
    return $html;
}

function check_robots_txt($url) {
    $parts = parse_url($url);
    if (!isset($parts['scheme']) || !isset($parts['host'])) return false;

    $robotsUrl = $parts['scheme'] . '://' . $parts['host'] . '/robots.txt';

    $ch = curl_init($robotsUrl);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($httpCode === 200);
}
