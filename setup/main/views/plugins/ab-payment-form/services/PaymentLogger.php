<?php
namespace AbPaymentForm\Services;

class PaymentLogger {
    
    private $logPath;

    public function __construct() {
        $this->logPath = APPPATH . 'logs/payment_gateway_logs.php';
        // Create the file if it doesn't exist to ensure write access, with a basic die() for security
        if (!file_exists($this->logPath)) {
            file_put_contents($this->logPath, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n");
        }
    }

    public function logRequest(string $gateway, string $requestId, array $payload) {
        $this->writeLog('REQUEST', $gateway, $requestId, $this->sanitizePayload($payload));
    }

    public function logResponse(string $gateway, string $requestId, array $response) {
        $this->writeLog('RESPONSE', $gateway, $requestId, $this->sanitizePayload($response));
    }

    public function logWebhook(string $gateway, string $webhookId, $payload) {
        $this->writeLog('WEBHOOK', $gateway, $webhookId, $this->sanitizePayload($payload));
    }

    public function logException(string $gateway, string $context, \Exception $e) {
        $message = $e->getMessage() . "\n" . $e->getTraceAsString();
        $this->writeLog('EXCEPTION', $gateway, $context, $message);
    }

    private function writeLog(string $type, string $gateway, string $identifier, $data) {
        $timestamp = date('Y-m-d H:i:s');
        $dataStr = is_string($data) ? $data : json_encode($data);
        $logMessage = "[$timestamp] [$type] [$gateway] [$identifier] - $dataStr\n";
        
        file_put_contents($this->logPath, $logMessage, FILE_APPEND);
    }

    private function sanitizePayload($payload) {
        // Redact sensitive information
        $sensitiveKeys = ['secret_key', 'password', 'cvv', 'card_number', 'api_secret'];
        if (is_array($payload)) {
            foreach ($payload as $key => &$value) {
                if (in_array(strtolower($key), $sensitiveKeys)) {
                    $value = '***REDACTED***';
                } elseif (is_array($value)) {
                    $value = $this->sanitizePayload($value);
                }
            }
        }
        return $payload;
    }
}
