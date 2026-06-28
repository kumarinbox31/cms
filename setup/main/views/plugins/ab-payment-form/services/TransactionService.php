<?php
namespace AbPaymentForm\Services;

class TransactionService {
    
    private $db;
    
    public function __construct() {
        $ci = &get_instance();
        $this->db = $ci->db;
    }

    public function createPendingTransaction(array $data) {
        $this->db->insert('ab_payment_data', $data);
        return $this->db->insert_id();
    }

    public function getTransactionByTxnId(string $txnId) {
        return $this->db->where('txn_id', $txnId)->get('ab_payment_data')->row_array();
    }

    public function getTransactionByGatewayOrderId(string $gatewayOrderId) {
        return $this->db->where('gateway_order_id', $gatewayOrderId)->get('ab_payment_data')->row_array();
    }

    public function updateTransactionStatus(string $txnId, string $status, string $gatewayStatus = null, array $additionalData = []) {
        $data = ['status' => $status];
        if ($gatewayStatus) {
            $data['gateway_status'] = $gatewayStatus;
        }
        
        if (!empty($additionalData)) {
            $data = array_merge($data, $additionalData);
        }

        return $this->db->where('txn_id', $txnId)->update('ab_payment_data', $data);
    }

    public function recordWebhookPayload(string $txnId, string $payload) {
        return $this->db->where('txn_id', $txnId)->update('ab_payment_data', [
            'webhook_response' => $payload,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
