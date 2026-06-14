<?php
class AiModel extends CI_Model {
    
    /**
     * Get a setting by key
     */
    public function get_setting($key, $admin_id = null) {
        $query = $this->db->get_where('ab_settings', ['setting_key' => $key]);
        if ($query->num_rows() > 0) {
            return $query->row()->setting_value;
        }
        return null;
    }

    /**
     * Save or update a setting
     */
    public function save_setting($key, $value, $admin_id) {
        $chk = $this->db->get_where('ab_settings', ['setting_key' => $key]);
        if ($chk->num_rows()) {
            $this->db->where(['setting_key' => $key])->update('ab_settings', ['setting_value' => $value, 'admin_id' => $admin_id]);
        } else {
            $this->db->insert('ab_settings', ['setting_key' => $key, 'setting_value' => $value, 'admin_id' => $admin_id]);
        }
    }

    /**
     * Log a prompt and response to history
     */
    public function log_history($admin_id, $prompt, $response_json) {
        $this->db->insert('ab_ai_prompts_history', [
            'admin_id' => $admin_id,
            'prompt' => $prompt,
            'response_json' => $response_json,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get all design tokens for a website
     */
    public function get_tokens($website_id) {
        return $this->db->get_where('ab_ai_design_tokens', ['website_id' => $website_id])->result();
    }

    /**
     * Save a design token
     */
    public function save_token($key, $value, $website_id) {
        $chk = $this->db->get_where('ab_ai_design_tokens', ['token_key' => $key, 'website_id' => $website_id]);
        if ($chk->num_rows()) {
            $this->db->where(['token_key' => $key, 'website_id' => $website_id])->update('ab_ai_design_tokens', ['token_value' => $value]);
        } else {
            $this->db->insert('ab_ai_design_tokens', ['token_key' => $key, 'token_value' => $value, 'website_id' => $website_id]);
        }
    }

    /**
     * Delete a design token
     */
    public function delete_token($id, $website_id) {
        $this->db->where(['id' => $id, 'website_id' => $website_id])->delete('ab_ai_design_tokens');
    }
}
