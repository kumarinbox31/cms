<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        
        // Basic auth check
        if(!$this->session->has_userdata('super-admin')) {
            redirect('admin-login');
        }
    }

    private function _render($view, $data = []) {
        $this->load->view('admin/header');
        $this->load->view($view, $data);
        $this->load->view('admin/footer');
    }

    public function index() {
        $type = $this->input->get('type');
        
        if ($type === 'audit') {
            $this->db->select('a.*, w.domain');
            $this->db->from('ab_hosting_audit a');
            $this->db->join('ab_websites w', 'a.website_id = w.id', 'left');
            $this->db->order_by('a.created_at', 'DESC');
            $this->db->limit(500);
            $data['logs'] = $this->db->get()->result();
            $data['view_type'] = 'audit';
        } elseif ($type === 'sync') {
            $this->db->order_by('start_time', 'DESC');
            $this->db->limit(500);
            $data['logs'] = $this->db->get('ab_sync_history')->result();
            $data['view_type'] = 'sync';
        } elseif ($type === 'cleanup') {
            $this->db->order_by('created_at', 'DESC');
            $this->db->limit(500);
            $data['logs'] = $this->db->get('ab_cleanup_logs')->result();
            $data['view_type'] = 'cleanup';
        } else {
            $this->db->order_by('created_at', 'DESC');
            $this->db->limit(500);
            $data['logs'] = $this->db->get('ab_domain_logs')->result();
            $data['view_type'] = 'domain';
        }

        $this->_render('admin/logs/index', $data);
    }
}
