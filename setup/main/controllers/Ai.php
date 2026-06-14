<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai extends CI_Controller {
    public $AiModel;
    public $PluginModel;
    public $MenuModel;
    public $PageModel;
    public $aigateway;
    public $templategenerator;
    public $thememapper;

    public function __construct() {
        parent::__construct();
        // Ensure only admin can access this controller if it's for settings
        // Assuming checkAdminLogin() is a global helper in this CMS
        checkAdminLogin();
        $this->load->model(['AiModel', 'PluginModel', 'MenuModel', 'PageModel']);
    }

    /**
     * AI Settings Page
     */
    public function settings() {
        if ($post = $this->input->post()) {
            // Update settings
            foreach (['ai_provider', 'ai_model', 'ai_api_key', 'image_api_key'] as $key) {
                if (isset($post[$key])) {
                    $this->AiModel->save_setting($key, $post[$key], CLIENT_ID);
                }
            }
            $this->session->set_flashdata('success_msg', 'AI Settings saved successfully.');
            redirect('Ai/settings');
        } else {
            $data['settings'] = [
                'ai_provider' => $this->AiModel->get_setting('ai_provider', CLIENT_ID),
                'ai_model' => $this->AiModel->get_setting('ai_model', CLIENT_ID),
                'ai_api_key' => $this->AiModel->get_setting('ai_api_key', CLIENT_ID),
                'image_api_key' => $this->AiModel->get_setting('image_api_key', CLIENT_ID),
            ];

            $this->load->view('admin/header', $data);
            $this->load->view('plugins/ai_builder/settings', $data);
            $this->load->view('admin/footer');
        }
    }

    /**
     * Handle AI Prompt generation
     */
    public function generate() {
        $this->load->library('AiGateway');

        $prompt = $this->input->post('prompt', true);
        if (empty($prompt)) {
            echo json_encode(['status' => false, 'error' => 'Prompt is required.']);
            return;
        }

        // Fetch settings
        $api_key = $this->AiModel->get_setting('ai_api_key', CLIENT_ID);
        $model = $this->AiModel->get_setting('ai_model', CLIENT_ID);

        if (empty($api_key)) {
            echo json_encode(['status' => false, 'error' => 'AI API Key is missing in settings.']);
            return;
        }

        $this->aigateway->set_api_key($api_key);
        if (!empty($model)) {
            $this->aigateway->set_model($model);
        }

        $system_prompt = "You are a website building assistant. Return only a valid JSON response containing a 'sections' array. Each section should have a 'type' (e.g. hero, pricing, faq) and relevant data fields like 'title', 'subtitle', and an 'image_keyword' for stock photos (e.g. 'office', 'nature', 'team').";

        $response = $this->aigateway->generate_json($system_prompt, $prompt);

        // Log history
        $this->AiModel->log_history(CLIENT_ID, $prompt, isset($response['raw']) ? $response['raw'] : json_encode($response));

        if ($response['status'] && isset($response['data']['sections'])) {
            $this->load->library('TemplateGenerator');
            
            // Convert JSON sections to HTML/CSS
            $templateData = $this->templategenerator->generate_page($response['data']['sections']);
            
            if ($templateData['status']) {
                $this->load->library('ThemeMapper');
                $css_with_theme = $this->thememapper->apply_theme($templateData['css'], CLIENT_ID);

                $response['html'] = $templateData['html'];
                $response['css'] = $css_with_theme;
            }
        }

        echo json_encode($response);
    }

    /**
     * Design Tokens Management
     */
    public function design_tokens() {
        $data['tokens'] = $this->AiModel->get_tokens(CLIENT_ID);
        
        $this->load->view('admin/header', $data);
        $this->load->view('plugins/ai_builder/design_tokens', $data);
        $this->load->view('admin/footer');
    }

    public function save_token() {
        if ($post = $this->input->post()) {
            $this->AiModel->save_token($post['token_key'], $post['token_value'], CLIENT_ID);
            $this->session->set_flashdata('success_msg', 'Token saved successfully.');
        }
        redirect('Ai/design_tokens');
    }

    public function delete_token() {
        if ($id = $this->input->post('id')) {
            $this->AiModel->delete_token($id, CLIENT_ID);
            $this->session->set_flashdata('success_msg', 'Token deleted successfully.');
        }
        redirect('Ai/design_tokens');
    }

    /**
     * AI Builder Pro Editor Mode
     */
    public function editor($type = 'page', $id = 0) {
        $data['page_type'] = $type;
        $data['page_id'] = $id;

        $this->load->view('admin/header', $data);
        $this->load->view('plugins/ai_builder/editor', $data);
        $this->load->view('admin/footer');
    }
}
