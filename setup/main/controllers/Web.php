<?php
class Web extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model(['mail','PageModel','WebsiteData','MenuModel','MenuItemModel','GalleryModel','FileServiceModel']);
    }
    function manifest(){
        header("Content-Type:manifest/json");
        $this->load->view('web/manifest');
    }
   public function form_submit($form_id) {
       error_reporting(E_ALL);ini_set('display_errors',1);
    // Get JSON payload if the request is JSON
    $postData = json_decode(file_get_contents('php://input'), true);
    
    // Get form-data if available
    $formPostData = $this->input->post();

    // Use either JSON data or form data, whichever is available
    $post = !empty($formPostData) ? $formPostData : (!empty($postData['data']) ? $postData['data'] : null);
    $post = $postData;
    
    // If no data is found, return an error
    if (!$post) {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => false, 'msg' => 'Invalid request. No data received.']);
        exit;
    }

    // Handle normal file uploads (if present)
    if (!empty($_FILES)) {
        foreach ($_FILES as $key => $val) {
            $data = $this->upload($key, false);
            if (!isset($data['error'])) {
                $post[$key] = $data['file_name']; // Store file name in post data
            } else {
                $post[$key] = ''; // If upload fails, store an empty string
            }
        }
    }

    // Handle base64 file uploads for multiple fields
    foreach ($post as $fieldKey => $fieldValue) {
        if (is_array($fieldValue)) {
            foreach ($fieldValue as $index => $fileData) {
                if (isset($fileData['storage']) && $fileData['storage'] === 'base64' && !empty($fileData['url'])) {
                    $savedFile = $this->saveBase64File($fileData);
                    if (!isset($savedFile['error'])) {
                        $post[$fieldKey] = $savedFile['file_name'];
                        // $post[$fieldKey][$index]['saved_file_name'] = $savedFile['file_name']; // Store file name
                        // $post[$fieldKey][$index]['saved_path'] = $savedFile['file_path']; // Store file path
                    } else {
                        $post[$fieldKey] = '';
                        // $post[$fieldKey][$index]['error'] = $savedFile['error']; // Store error if saving failed
                    }
                }
            }
        }
    }
    // print_r($post);exit;
    // Insert data into the database
    $ins = $this->db->insert('ab_form_data', [
        'form_id' => $form_id,
        'data' => json_encode($post), // Store data as JSON
        'admin_id' => CLIENT_ID
    ]);

    // Return appropriate response
    if ($ins) {
        http_response_code(200); // Success
        echo json_encode(['status' => true, 'msg' => 'Form submitted successfully.','data'=>$post]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['status' => false, 'msg' => $this->db->error()['message']]);
    }
    exit;
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
            define('CURRENT_PAGE_ID',$page_id);
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
            $this->WebsiteData->addVisitorCount();
            view($data);
        }
    }
   function ajax() {
    if ($post = $this->input->post()) {
        $action = @$post['action'];
        if (isset($post['action'])) {
            unset($post['action']);
        }

        switch ($action) {
            case 'form-submit':
                $form_id = $post['form_id'];
                unset($post['form_id']);

                if (count($_FILES)) {
                    foreach ($_FILES as $key => $val) {
                        $data = $this->upload($key, false);
                        if (!isset($data['error'])) {
                            $post[$key] = $data['file_name'];
                        } else {
                            $post[$key] = '';
                        }
                    }
                }

                $ins = $this->db->insert('ab_form_data', [
                    'form_id' => $form_id,
                    'data' => json_encode($post),
                    'admin_id' => CLIENT_ID
                ]);

                if ($ins) {
                    http_response_code(200); // Success
                    echo json_encode(['status' => true, 'msg' => 'Form submitted successfully.']);
                } else {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['status' => false, 'msg' => $this->db->error()['message']]);
                    exit;
                }
                break;

            default:
                http_response_code(400); // Bad Request
                echo json_encode(['status' => false, 'msg' => 'Something went wrong.']);
                break;
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => false, 'msg' => 'Invalid request.']);
    }

    if (!$this->is_ajax_submit()) {
        echo '<script>
            alert("Process complete..");
            window.location.href = document.referrer ? document.referrer : "/";
        </script>';
    }
}

    
    function is_ajax_submit(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
            return false;
        }else{
            return true;
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
                    $cookie_domain = $row->domain; // Replace with your actual domain
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
    
    public function direct_login() {
        $token = $this->input->get('_token', true);
    
        if (!$token) {
            $this->session->set_flashdata('error_msg', 'Invalid or missing token.');
            redirect(base_url('customer-login.html'));
            return;
        }
    
        // Decode the token (Ensure error handling)
        // $decoded_data = json_decode(base64_decode($token), true);
        // if (!$decoded_data || empty($decoded_data['email']) || empty($decoded_data['website_id']) || empty($decoded_data['exp'])) {
        //     $this->session->set_flashdata('error_msg', 'Invalid token data.');
        //     redirect(base_url('customer-login.html'));
        //     return;
        // }
        $decoded_data = validateJWT($token,'Abhijeet#12!00');
        
        // Check Token Expiry
        if ($decoded_data['exp'] < time()) {
            $this->session->set_flashdata('error_msg', 'Token expired.');
            redirect(base_url('customer-login.html'));
            return;
        }
    
        $email = htmlentities($decoded_data['email']);
        $website_id = intval($decoded_data['website_id']);
    
        // Fetch user data based on email and website_id
        $chk = $this->website->get(['_email' => $email, 'id' => $website_id]);
    
        if ($chk->num_rows()) {
            $row = $chk->row();
    
            // Generate a session
            $cookie_value = time();
            $_SESSION['customer-session'] = $cookie_value;
            $_SESSION['by_superadmin'] = true;
    
            // Set secure cookie
            setcookie('customer-session', $cookie_value, time() + 3600 * 6, '/', $row->domain, true, false);
    
            $this->website->update(['id' => $row->id], ['last_login_session' => $cookie_value]);
    
            // Redirect to admin/dashboard
            redirect(base_url('admin'));
        } else {
            $this->session->set_flashdata('error_msg', 'Invalid login credentials.');
            redirect(base_url('customer-login.html'));
        }
    }

    private function saveBase64File($fileData) {
    $uploadPath = FCPATH . 'public/temp/'.CLIENT_ID.'/'; // Change this to your desired upload directory

    // Ensure the directory exists
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // Extract base64 data
    $base64String = $fileData['url'];
    $originalName = $fileData['name'];

    // Generate unique filename
    $uniqueName = uniqid() . '-' . preg_replace('/[^A-Za-z0-9_.-]/', '', $originalName); // Sanitize filename

    // Get file extension from MIME type
    if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
        $fileExtension = $matches[1];
        $base64String = preg_replace('/^data:image\/\w+;base64,/', '', $base64String);
        $fileName = $uniqueName . '.' . $fileExtension;
    } else {
        return ['error' => 'Invalid base64 format'];
    }

    $filePath = $uploadPath . $fileName;

    // Decode and save the file
    $decodedData = base64_decode($base64String);
    if ($decodedData === false) {
        return ['error' => 'Base64 decoding failed'];
    }

    if (file_put_contents($filePath, $decodedData)) {
        // Save file info in database
        $data = [
            'type' => 'image',
            'path' => str_replace(FCPATH, '', $filePath),
            'name' => pathinfo($fileName, PATHINFO_FILENAME),
            'size' => strlen($decodedData) / 1024, // Convert bytes to KB
            'file_type' => $fileData['type'],
            'extention' => ".$fileExtension",
            'info' => json_encode($fileData),
            'admin_id' => CLIENT_ID
        ];
        $this->db->insert('media', $data);

        return ['file_name' => $fileName, 'file_path' => $filePath];
    } else {
        return ['error' => 'Failed to save base64 file'];
    }
}

    function upload($file='file',$flag=true){
        $get = $this->file_up($file);
        if(!isset($get['error'])){
            if($flag){
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
            }
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
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|pdf';
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

    function plugin($plugin,$page='index'){
        $page = htmlspecialchars($page);
        $this->load->view("plugins/$plugin/$page");
    }
}