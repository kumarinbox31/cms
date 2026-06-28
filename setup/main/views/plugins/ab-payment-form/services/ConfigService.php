<?php
namespace AbPaymentForm\Services;

class ConfigService {
    
    public function getGatewayConfig(string $gatewayName): array {
        // Based on the legacy code, the keys are fetched per client ID/admin ID context via getVal() helper
        
        $config = [];
        
        if ($gatewayName === 'stripe') {
            $config['publishable_key'] = getVal('pg-stripe-val1');
            $config['secret_key']      = getVal('pg-stripe-val2');
            $config['webhook_secret']  = getVal('pg-stripe-webhook');
            $config['mode']            = getVal('pg-stripe-mode', 'sandbox');
        } elseif ($gatewayName === 'swipe') {
            $config['api_key']         = getVal('pg-swipe-val1');
            $config['api_secret']      = getVal('pg-swipe-val2');
            $config['webhook_secret']  = getVal('pg-swipe-webhook');
            $config['mode']            = getVal('pg-swipe-mode', 'sandbox');
        } elseif ($gatewayName === 'payu') {
            $config['merchant_key']    = getVal('pg-payumoney-val1');
            $config['salt']            = getVal('pg-payumoney-val2');
            $config['mode']            = getVal('pg-payumoney-mode', 'sandbox');
        } elseif ($gatewayName === 'razorpay') {
            $config['key_id']          = getVal('pg-razorpay-val1');
            $config['key_secret']      = getVal('pg-razorpay-val2');
        }

        return $config;
    }
}
