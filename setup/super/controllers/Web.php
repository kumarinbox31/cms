<?php
class Web extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('auth','AdminModel');
    }
    
    public function backup()
{
    // Enable error reporting for debugging (remove in production)
    error_reporting(E_ALL); 
    ini_set('display_errors', 1);

    // Secret key for validation
    $secretKey = "ajjasd1823!$@98902";

    // Check for the correct secret key
    if ($this->input->get('secret_key') == $secretKey) {
        // Load necessary helpers and libraries
        $this->load->helper(['file', 'download']);
        $this->load->library('email');
        $this->load->dbutil(); // For default DB backup

        // Backup the default database
        $backup1 = $this->dbutil->backup([
            'format' => 'zip',
            'filename' => 'main_db_backup.sql'
        ]);

        // Prepare backup filename
        $filename1 = 'main_db_backup_' . date('Y-m-d_H-i-s') . '.zip';

        // Save the backup to the server
        $backupPath = FCPATH . 'backups/' . $filename1;
        write_file($backupPath, $backup1);

        // Set up email configuration (adjust these settings based on your SMTP server)
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $_ENV['SMTP_HOST']; // e.g., smtp.gmail.com
        $config['smtp_port'] = 587;
        $config['smtp_user'] = $_ENV['SMTP_USER'];  // Your email address
        $config['smtp_pass'] = $_ENV['SMTP_PASS']; // Your email password
        $config['mailtype']  = 'html';
        $config['charset']   = 'utf-8';
        $config['newline']   = "\r\n";
        
        // Initialize the email library with configuration
        $this->email->initialize($config);

        // Set email details
        $this->email->from('backup@webfire.site', 'Database Backup');
        $this->email->to('kumarinbox31@gmail.com');  // Receiver's email
        $this->email->subject('Database Backup - ' . date('Y-m-d H:i:s'));
        $this->email->message('Attached is your latest database backup.');

        // Attach the backup file
        $this->email->attach($backupPath);

        // Send the email
        if ($this->email->send()) {
            echo "✅ Backup completed and emailed successfully.";
        } else {
            echo "❌ Failed to send the email. Error: " . $this->email->print_debugger(['headers']);
        }

    } else {
        // Show error if the secret key is incorrect
        show_error('Invalid Key Provided');
    }
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
                $_SESSION['RID'] = $row->id;
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