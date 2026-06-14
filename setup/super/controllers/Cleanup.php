<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cleanup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('CpanelService');
        $this->load->library('HostingSyncService');
        $this->load->database();
        
        // Basic auth check
        if(!isset($_SESSION['super_admin'])) {
            redirect('admin/login');
        }
    }

    private function _render($view, $data = []) {
        $this->load->view('admin/header');
        $this->load->view($view, $data);
        $this->load->view('admin/footer');
    }

    public function index() {
        $this->_render('cleanup/index');
    }

    // --- Sync Endpoints ---
    public function sync_all_domains() {
        $websites = $this->db->get('ab_websites')->result();
        $count = 0;
        foreach($websites as $w) {
            $this->hostingsyncservice->syncWebsiteDomainStatus($w->id);
            $count++;
        }
        $this->session->set_flashdata('success_msg', "Successfully synced $count domains.");
        redirect('admin/cleanup');
    }

    public function sync_all_emails() {
        $websites = $this->db->get('ab_websites')->result();
        $count = 0;
        foreach($websites as $w) {
            $count += $this->hostingsyncservice->syncWebsiteEmails($w->id);
        }
        $this->session->set_flashdata('success_msg', "Successfully synced $count email accounts.");
        redirect('admin/cleanup');
    }

    // --- Cleanup Endpoints ---
    public function find_orphan_domains() {
        $orphans = $this->hostingsyncservice->findOrphanDomains();
        $data['orphans'] = $orphans;
        $this->_render('cleanup/orphans', $data);
    }

    public function delete_orphan_domain() {
        $domain = $this->input->get('domain');
        if ($domain) {
            $res = $this->cpanelservice->deleteAddonDomain($domain, explode('.', $domain)[0]);
            if ($res['status']) {
                $this->db->insert('ab_cleanup_logs', [
                    'type' => 'orphan_domain',
                    'entity' => $domain,
                    'action_taken' => 'Deleted'
                ]);
                $this->session->set_flashdata('success_msg', "Orphan domain $domain deleted.");
            } else {
                $this->session->set_flashdata('error_msg', "Failed to delete: " . $res['error']);
            }
        }
        redirect('admin/cleanup/find_orphan_domains');
    }
}
