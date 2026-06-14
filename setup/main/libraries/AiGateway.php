<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AiGateway {
    
    protected $api_key;
    protected $model;
    protected $api_url = 'https://openrouter.ai/api/v1/chat/completions';
    
    public function __construct($params = []) {
        $this->api_key = isset($params['api_key']) ? $params['api_key'] : '';
        $this->model = isset($params['model']) ? $params['model'] : 'qwen/qwen-2.5-coder-32b-instruct'; // Default model
    }
    
    /**
     * Set API Key manually if not provided in construct
     */
    public function set_api_key($key) {
        $this->api_key = $key;
    }
    
    /**
     * Set Model manually
     */
    public function set_model($model) {
        $this->model = $model;
    }
    
    /**
     * Generate content based on a prompt, expecting a JSON response
     */
    public function generate_json($system_prompt, $user_prompt) {
        if (empty($this->api_key)) {
            return ['status' => false, 'error' => 'API key is missing.'];
        }
        
        $data = [
            'model' => $this->model,
            'max_tokens' => 4000,
            'response_format' => ['type' => 'json_object'],
            'messages' => [
                ['role' => 'system', 'content' => $system_prompt],
                ['role' => 'user', 'content' => $user_prompt]
            ]
        ];
        
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->api_key,
            'Content-Type: application/json',
            'HTTP-Referer: ' . base_url(), // Required by OpenRouter
            'X-Title: CMS AI Builder Pro'  // Optional but recommended by OpenRouter
        ]);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);
        
        if ($curl_error) {
            return ['status' => false, 'error' => 'cURL Error: ' . $curl_error];
        }
        
        if ($http_code !== 200) {
            return ['status' => false, 'error' => 'HTTP Error ' . $http_code . ': ' . $response];
        }
        
        $result = json_decode($response, true);
        
        if (isset($result['choices'][0]['message']['content'])) {
            $content = $result['choices'][0]['message']['content'];
            
            // Clean markdown wrappers if present
            $clean_content = trim($content);
            if (preg_match('/```(?:json)?(.*?)```/is', $clean_content, $matches)) {
                $clean_content = trim($matches[1]);
            }
            
            // Attempt to parse JSON content
            $json_parsed = json_decode($clean_content, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return ['status' => true, 'data' => $json_parsed, 'raw' => $response];
            } else {
                return ['status' => false, 'error' => 'Failed to parse AI response as JSON.', 'raw' => $content];
            }
        }
        
        return ['status' => false, 'error' => 'Unexpected response format.', 'raw' => $response];
    }
}
