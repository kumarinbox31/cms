<?php
namespace AbPaymentForm\Services;

class ConfigService {
    
    public function getGatewayConfig(string $gatewayName): array {
        $config = [];
        
        if ($gatewayName === 'stripe') {
            $config['publishable_key'] = getVal('pg-stripe-public-key');
            $config['secret_key']      = getVal('pg-stripe-secret-key');
            $config['webhook_secret']  = getVal('pg-stripe-webhook');
            $config['mode']            = getVal('pg-stripe-environment', 'sandbox');
        } elseif ($gatewayName === 'swipe') {
            $config['api_key']         = getVal('pg-swipe-api-key');
            $config['api_secret']      = getVal('pg-swipe-secret');
            $config['webhook_secret']  = getVal('pg-swipe-webhook');
            $config['mode']            = getVal('pg-swipe-environment', 'sandbox');
        } elseif ($gatewayName === 'payu') {
            $config['merchant_key']    = getVal('pg-payu-key');
            $config['salt']            = getVal('pg-payu-salt');
            $config['mode']            = getVal('pg-payu-environment', 'sandbox');
        } elseif ($gatewayName === 'razorpay') {
            $config['key_id']          = getVal('pg-razorpay-val1');
            $config['key_secret']      = getVal('pg-razorpay-val2');
        }

        return $config;
    }

    public function validateGatewayConfiguration(string $gatewayName): array {
        $config = $this->getGatewayConfig($gatewayName);
        $errors = [];
        
        switch ($gatewayName) {
            case 'stripe':
                if (empty(getVal('pg-stripe-enabled'))) $errors[] = "Stripe is not enabled.";
                if (empty($config['publishable_key'])) $errors[] = "Stripe Publishable Key is missing.";
                if (empty($config['secret_key'])) $errors[] = "Stripe Secret Key is missing.";
                break;
            case 'swipe':
                if (empty(getVal('pg-swipe-enabled'))) $errors[] = "Swipe is not enabled.";
                if (empty($config['api_key'])) $errors[] = "Swipe Merchant ID is missing.";
                if (empty($config['api_secret'])) $errors[] = "Swipe Secret Key is missing.";
                break;
            case 'payu':
                if (empty(getVal('pg-payu-enabled'))) $errors[] = "PayU is not enabled.";
                if (empty($config['merchant_key'])) $errors[] = "PayU Merchant Key is missing.";
                if (empty($config['salt'])) $errors[] = "PayU Salt is missing.";
                break;
            case 'razorpay':
                if (empty($config['key_id'])) $errors[] = "Razorpay Key ID is missing.";
                if (empty($config['key_secret'])) $errors[] = "Razorpay Secret Key is missing.";
                break;
        }

        return [
            'valid' => count($errors) === 0,
            'errors' => $errors
        ];
    }
}
