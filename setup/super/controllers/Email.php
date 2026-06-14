<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('CpanelService');
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
        $data['emails'] = $this->db->get('ab_email_accounts')->result();
        $this->_render('admin/email/index', $data);
    }

    public function create() {
        if ($post = $this->input->post()) {
            $website_id = intval($post['website_id']);
            $email_prefix = strtolower(trim($post['email_prefix']));
            $password = $post['password'];
            $quota = intval($post['quota']); // 0 for unlimited

            $website = $this->db->get_where('ab_websites', ['id' => $website_id])->row();
            if (!$website) {
                $this->session->set_flashdata('error_msg', 'Website not found.');
                redirect('admin/email/create');
                return;
            }

            $full_email = $email_prefix . '@' . $website->domain;

            $res = $this->cpanelservice->createEmail($full_email, $password, $quota);

            if ($res['status']) {
                $this->db->insert('ab_email_accounts', [
                    'website_id' => $website_id,
                    'domain' => $website->domain,
                    'email_address' => $full_email,
                    'quota' => $quota == 0 ? 'unlimited' : $quota,
                    'status' => 'Active',
                    'last_sync' => date('Y-m-d H:i:s')
                ]);
                $this->session->set_flashdata('success_msg', 'Email created successfully.');
                redirect('admin/email');
            } else {
                $this->session->set_flashdata('error_msg', 'Failed to create email: ' . $res['error']);
                redirect('admin/email/create');
            }
        } else {
            $data['websites'] = $this->db->get('ab_websites')->result();
            $this->_render('admin/email/create', $data);
        }
    }

    public function edit() {
        $id = intval($this->input->get('id'));
        $email = $this->db->get_where('ab_email_accounts', ['id' => $id])->row();
        if (!$email) redirect('admin/email');

        if ($post = $this->input->post()) {
            $action = $post['action'];
            
            if ($action === 'change_password') {
                $res = $this->cpanelservice->updateEmailPassword($email->email_address, $post['password']);
                if ($res['status']) {
                    $this->session->set_flashdata('success_msg', 'Password updated successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Failed: ' . $res['error']);
                }
            } elseif ($action === 'change_quota') {
                $quota = intval($post['quota']);
                $res = $this->cpanelservice->updateEmailQuota($email->email_address, $quota);
                if ($res['status']) {
                    $this->db->where('id', $id)->update('ab_email_accounts', ['quota' => $quota == 0 ? 'unlimited' : $quota]);
                    $this->session->set_flashdata('success_msg', 'Quota updated successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Failed: ' . $res['error']);
                }
            }
            redirect('admin/email/edit?id='.$id);
        } else {
            $data['email'] = $email;
            $this->_render('admin/email/edit', $data);
        }
    }

    public function toggle_status() {
        $id = intval($this->input->get('id'));
        $email = $this->db->get_where('ab_email_accounts', ['id' => $id])->row();
        if (!$email) redirect('admin/email');

        $newStatus = ($email->status === 'Active') ? 'Suspended' : 'Active';
        
        if ($newStatus === 'Suspended') {
            $res = $this->cpanelservice->suspendEmail($email->email_address);
        } else {
            $res = $this->cpanelservice->unsuspendEmail($email->email_address);
        }

        if ($res['status']) {
            $this->db->where('id', $id)->update('ab_email_accounts', ['status' => $newStatus]);
            $this->session->set_flashdata('success_msg', "Email {$newStatus} successfully.");
        } else {
            $this->session->set_flashdata('error_msg', 'Failed: ' . $res['error']);
        }
        redirect('admin/email');
    }

    public function delete() {
        $id = intval($this->input->get('id'));
        $email = $this->db->get_where('ab_email_accounts', ['id' => $id])->row();
        if ($email) {
            $res = $this->cpanelservice->deleteEmail($email->email_address);
            if ($res['status']) {
                $this->db->where('id', $id)->delete('ab_email_accounts');
                $this->session->set_flashdata('success_msg', 'Email deleted successfully.');
            } else {
                $this->session->set_flashdata('error_msg', 'Failed to delete from cPanel: ' . $res['error']);
            }
        }
        redirect('admin/email');
    }
}
