<?php
class Web extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('auth','AdminModel');
    }
    
    function index(){
        // print_r($GLOBALS);exit;

        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Status: 503 Service Temporarily Unavailable');
        header('Retry-After: 300');//300 seconds
    }
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function admin_login(){
        if($post = $this->input->post()){
            $user = $this->input->post('email',true);
            $pass = $this->input->post('pass',true);
            $enc_pass = md5($pass);
            $get = $this->AdminModel->get(['_user'=>$user,'_pass'=>$enc_pass,'status'=>1]);
            if($get->num_rows()){
                $row = $get->row();
                $_SESSION['super-admin'] = true;
                redirect('admin');
            }else{
                $this->session->set_flashdata('error_msg','Authentication failed.');
                redirect(current_url());
            }
        }else{
            $this->load->view('admin/login');
        }
    }
    
}