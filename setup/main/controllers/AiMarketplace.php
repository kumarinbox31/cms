<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AiMarketplace extends CI_Controller {

    public function __construct() {
        parent::__construct();
        checkAdminLogin();
        $this->load->database();
    }

    /**
     * Marketplace Library View
     */
    public function index() {
        $category = $this->input->get('category');
        
        $this->db->order_by('id', 'desc');
        if (!empty($category)) {
            $this->db->where('category', $category);
        }
        $data['components'] = $this->db->get('ab_ai_components')->result();
        
        // Fetch unique categories for filtering
        $data['categories'] = $this->db->select('category')->distinct()->get('ab_ai_components')->result();

        $this->load->view('admin/header', $data);
        $this->load->view('plugins/ai_builder/marketplace', $data);
        $this->load->view('admin/footer');
    }

    /**
     * View source code of a component
     */
    public function view_source($id) {
        $component = $this->db->get_where('ab_ai_components', ['id' => $id])->row();
        if ($component) {
            echo json_encode(['status' => true, 'html' => $component->html, 'css' => $component->css]);
        } else {
            echo json_encode(['status' => false, 'error' => 'Component not found.']);
        }
    }
}
