<?php
class Web extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model(['mail','PageModel','WebsiteData','MenuModel','MenuItemModel']);
    }
    
    function index($uri=''){
        if($post = $this->input->post()){
            // $data = '';
            // foreach($post as $key => $val){
            //     $key = str_replace("_",' ',$key);
            //     $key = ucwords($key);
            //     $data .= "<p><b>$key : </b> $val</p>";
            // }
            // $msg = "<h1>Contact Us Message</h1>
            //             $data
            //         ";
            // $res = $this->mail->send('abhijeetentellus@gmail.com',$msg);
            // echo json_encode(['success'=>$res]);
        }else{
            if($uri != ''){
                $page = $this->PageModel->get(['uri'=>($uri),'admin_id'=>CLIENT_ID,'trash'=>'0'])->row();
                $page_id = $page->id ?? 0;
                $pagename = $page->page_name ?? '';
            }else{
                $page_id = DEFAULTPAGE;
                $pagename = 'Home';
                $uri = 'home';
            }
            define('PAGE_NAME',$pagename);
            $data['uri'] = $uri;
            $data['page_id'] = $page_id;
            $this->load->helper(['page']);
            $this->load->model('WebsiteData');
            $wd = $this->WebsiteData->get(['admin_id'=>CLIENT_ID]);
            if($wd->num_rows()){
                $wd = $wd->row();
                define('LOGO',$wd->logo);
                define('TITLE',$wd->title);
            }
            view($data);
        }
    }
    function ajax(){
        if($post = $this->input->post()){
            $action = @$post['action'];
            if(isset($post['action'])){unset($post['action']);};
            switch($action){
                case 'form-submit':
                    $form_id = $post['form_id'];
                    unset($post['form_id']);
                    if(count($_FILES)){
                        foreach($_FILES as $key => $val){
                            $data = $this->upload($key);
                            if(isset($data['error'])){
                                echo json_encode(['status'=>false,'msg'=>$data['error']]);
                                return false;
                            }
                            $post[$key] = $data['file_name'];
                        }
                    }
                    $this->db->insert('ab_form_data',['form_id'=>$form_id,'data'=>json_encode($post)]);
                    echo json_encode(['status'=>true,'msg'=>'Form submited successfully.']);
                break;
                default:
                    echo json_encode(['status'=>false,'msg'=>'Something went wrong.']);
                break;
            }
        }else{
            echo json_encode(['status'=>false,'msg'=>'Something went wrong.1']);
        }
    }
    
    function customer_login(){
        if($post = $this->input->post()){
            $email = htmlentities($this->input->post('email',true));
            $pass = htmlentities($this->input->post('pass',true));
            $chk = $this->website->get(['_email'=>$email]);
            if($chk->num_rows()){
                $row = $chk->row();
                if($row->_pass == $pass){
                    $cookie_value = time();
                    $_SESSION['customer-session'] = $cookie_value;
                    
                    
                    $cookie_name = 'customer-session';
                    $cookie_expiration = time() + 3600 * 6; // 1 hour
                    $cookie_path = '/';
                    $cookie_domain = 'yourdomain.com'; // Replace with your actual domain
                    $cookie_secure = true; // Set to true if using HTTPS
                    $cookie_httponly = false;
                    
                    setcookie($cookie_name, $cookie_value, $cookie_expiration, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly);

                    $this->website->update(['id'=>$row->id],['last_login_session'=>$cookie_value]);
                    
                    redirect(base_url('admin'));
                }else{
                    $this->session->set_flashdata('error_msg','Entered password wrong.');
                    redirect(base_url('customer-login.html'));
                }
            }else{
                $this->session->set_flashdata('error_msg','Login credential wrong.');
                redirect(base_url('customer-login.html'));
            }
        }else{
            $this->load->view('admin/login');
        }
    }
    function upload($file='file'){
        $get = $this->file_up($file);
        if(!isset($get['error'])){
            $type = isset($get['is_image']) && $get['is_image'] ? 'image' : 'video';
            $data = [
                    'type' => $type,
                    'path' => str_replace(FCPATH,'',$get['full_path']),
                    'name' => $get['raw_name'],
                    'size' => $get['file_size'],
                    'file_type' => $get['file_type'],
                    'extention' => $get['file_ext'],
                    'info' => json_encode($get),
                    'admin_id'=>CLIENT_ID,
                    'height'=> $get['image_height'],
                    'width'=>$get['image_width'],
                ];
            $this->db->insert('media',$data);
            return $get;
        } else {
            return $get;
        }
    }
    
    public function file_up($file) {
        $upload_dir = './public/temp/'.CLIENT_ID.'/';
        if (!is_dir($upload_dir)) {
            // If the directory does not exist, create it with the desired permissions.
            mkdir($upload_dir, 0777, true);
        }
        $config['upload_path']   = $upload_dir;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 0;
        // $config['max_width']     = 1024;
        // $config['max_height']    = 768;
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload($file)) {
            $upload_data = $this->upload->data();
            return $upload_data;
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
    }

    
    function test(){
        $this->load->view('includes/bizland/functions');
        $name = do_action('ab_head');
        var_dump($name);
    }
}