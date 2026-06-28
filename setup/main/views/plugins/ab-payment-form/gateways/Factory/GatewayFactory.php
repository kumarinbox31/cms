<?php
namespace AbPaymentForm\Gateways\Factory;

use AbPaymentForm\Services\ConfigService;
use AbPaymentForm\Gateways\Contracts\PaymentGatewayInterface;
use AbPaymentForm\Gateways\Stripe\StripeGateway;
use AbPaymentForm\Gateways\Swipe\SwipeGateway;
use AbPaymentForm\Gateways\PayU\PayUGateway;

class GatewayFactory {
    
    private $configService;

    public function __construct(ConfigService $configService) {
        $this->configService = $configService;
    }

    public function create(string $gatewayName): PaymentGatewayInterface {
        $config = $this->configService->getGatewayConfig($gatewayName);

        switch (strtolower($gatewayName)) {
            case 'stripe':
                return new StripeGateway($config);
            case 'swipe':
                return new SwipeGateway($config);
            case 'payu':
                return new PayUGateway($config);
            default:
                throw new \Exception("Gateway '{$gatewayName}' is not supported by the modern Payment Engine.");
        }
    }
}
