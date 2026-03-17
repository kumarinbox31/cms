<?php
        
class Admin extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->helper(['page','media','custom']);
        $this->load->model(['block','PageModel','website','MenuModel','MenuItemModel',
        'PluginModel','BlockCategory','PlanModel']);
        checkAdminLogin();
        $this->load->model("MediaModel");
        $this->load->library('form_validation');
                    
    }
    
    public function change_password() {
        $this->load->library('form_validation');

    $this->load->view('admin/header');

    if ($post = $this->input->post()) {
        
        // Set form validation rules
        $this->form_validation->set_rules('old_pass', 'Old Password', 'required');
        $this->form_validation->set_rules('new_pass', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('new_confirm_pass', 'Confirmation Password', 'required|matches[new_pass]');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the change password view
            $this->load->view('admin/change-password');
        } else {
            // Fetch the old password from the database securely
            $this->db->where('id', CLIENT_ID);
            $query = $this->db->get('ab_websites');
            $user = $query->row();
            if ($user && $user->_pass === $post['old_pass']) {
                // If old password matches, update to the new password
                $this->db->set('_pass', $post['new_pass']);
                $this->db->where('id', CLIENT_ID);
                $this->db->update('ab_websites');

                // Redirect to the change password page with a success message
                $this->session->set_flashdata('success', 'Password changed successfully.');
                redirect('/admin/change-password');
            } else {
                // If old password does not match, reload the view with an error message
                $this->session->set_flashdata('error', 'Old password is incorrect.');
                $this->load->view('admin/change-password');
            }
        }
    } else {
        // Load the change password view if no form is submitted
        $this->load->view('admin/change-password');
    }

    $this->load->view('admin/footer');
}
    public function downloadFormData($formId,$type='form') {
        // error_reporting(E_ALL);ini_set('display_errors',-1);
    try {
        // Load the database library
        $this->load->database();

        // Fetch data from the database
        if($type == 'form'){
            $query = $this->db->get_where('ab_form_data', ['form_id' => $formId]);
            $data = $query->result_array();
        }else{
            $query = $this->db->get_where('ab_payment_data', ['pg_form_id' => $formId]);
            $data = $query->result_array();
        }

        // Check if data is empty
        if (empty($data)) {
            throw new Exception('No data found for the specified form ID.');
        }

        // Initialize an array to store all unique headers dynamically
        $headers = [];

        // Collect all unique keys from the JSON data to create dynamic headers
        foreach ($data as $row_data) {
            $json_data = json_decode($row_data['data'], true);
            if (is_array($json_data)) {
                $headers = array_unique(array_merge($headers, array_keys($json_data)));
            }
        }
        // Check if headers are generated
        if (empty($headers)) {
            throw new Exception('No headers found in the form data.');
        }
        if($type == 'payment'){
            $headers[] = 'txn_id';
        }
        // Set headers for CSV file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="form_data.csv"');
        header('Cache-Control: max-age=0');

        // Open PHP output stream for writing CSV
        $output = fopen('php://output', 'w');

        // Add dynamic headers to the CSV
        fputcsv($output, $headers);
        
        // Define the base URL dynamically (ensure you use the correct base URL for your project)
        $base_url = base_url('public/temp/'.CLIENT_ID.'/');

        // Loop through the database results and add rows to the CSV
        foreach ($data as $row_data) {
            $json_data = json_decode($row_data['data'], true);
            if($type == 'payment'){
                $json_data['txn_id'] = $row_data['txn_id'];
            }
            $row = [];
            foreach ($headers as $header) {
                // Add the value for each header or an empty string if not present
                $v = isset($json_data[$header]) ? $json_data[$header] : '';
                
                // Check if the value is a file path and ends with a known image or PDF extension
                if (is_string($v) && preg_match('/\.(jpg|jpeg|png|gif|pdf)$/i', $v)) {
                    if (filter_var($v, FILTER_VALIDATE_URL) === false) {
                        $v = $base_url . $v;
                    }
                }

                
                // Add the value (modified or original) to the row
                $row[] = $v;
            }
            fputcsv($output, $row);
        }

        // Close the output stream
        fclose($output);
        exit;
    } catch (Exception $e) {
        // Handle exceptions and display the error message
        echo 'Error: ' . $e->getMessage();
        exit;
    }
}

function downloadProductQuery($productGalleryId){
        
    }
    function index(){
        $this->load->model(['WebsiteData','ServiceModel']);
        $get = $this->db->get_where('websites',['id'=>CLIENT_ID])->row();
        $formCounts = $this->ServiceModel->getServiceByType('ab-form')->num_rows();
        $formDataCounts = $this->db->get_where('ab_form_data',['admin_id'=>CLIENT_ID])->num_rows();
        $totalVisitors = $this->WebsiteData->getVisitors();
        $totalPages = $this->db->get_where('pages',['admin_id'=>CLIENT_ID])->num_rows();
        $totalPlugins = $this->db->get_where('ab_plugin_installed',['admin_id'=>CLIENT_ID])->num_rows();
        $pagesVisitCounts = $this->db->select('id,page_name,uri,visit_count')->where(['admin_id'=>CLIENT_ID,'url' => ''])->order_by('visit_count','desc')->get('pages')->result();
        $totalPagesVisitCount = array_sum(array_column($pagesVisitCounts, 'visit_count'));

        $this->load->view('admin/header');
        $this->load->view('admin/home',[
            'web'=>$get,
            'totalVisitors'=>$totalVisitors,
            'totalPages'=>$totalPages,
            'totalPlugins'=>$totalPlugins,
            'totalForms' => $formCounts,
            'formDataCounts' => $formDataCounts,
            'pagesVisitCounts' => $pagesVisitCounts,
            'totalPagesVisitCount' => $totalPagesVisitCount,
        ]);
        $this->load->view('admin/footer');
    }
    function template($page='index'){
        $theme = isset($_GET['theme_id']) ? $_GET['theme_id'] : 0;
        $this->load->view('admin/header');
        $this->load->view('admin/template/'.$page,['theme_id'=>$theme]);
        $this->load->view('admin/footer');
    }
    function template_delete($id){
        $this->block->delete($id);
        $this->session->set_flashdata('success', 'Deleted successfully');
        redirect('admin/template');
    }
    public function template_save() {
    // Set validation rules
    $this->form_validation->set_rules('theme_id', 'Theme ID', 'required|numeric');
    $this->form_validation->set_rules('category', 'Category', 'required|numeric');
    $this->form_validation->set_rules('label', 'Label', 'required|trim|max_length[100]');
    // $this->form_validation->set_rules('media', 'Media', 'required');
    $this->form_validation->set_rules('content', 'Content', 'required|trim');

    $theme_id = $this->input->post('theme_id', TRUE);

    // Run validation
    if (!$this->form_validation->run()) {
        $this->session->set_flashdata('error', validation_errors());
        return redirect('admin/template?theme_id=' . $theme_id);
    }

    // Sanitize and prepare data
    $label = $this->input->post('label', TRUE);
    $data = [
        'theme_id' => $theme_id,
        'category_id' => $this->input->post('category', TRUE),
        'label' => $label,
        // 'media' => $this->input->post('media'),
        'content' => $this->input->post('content'),
        'created_at' => date('Y-m-d H:i:s'),
        'blockid' => str_replace(array(' '),'',$label)
    ];

    // Save to database
    if ($this->block->create($data)) {
        $this->session->set_flashdata('success', 'Form saved successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to save form');
    }

    return redirect('admin/template?theme_id=' . $theme_id);
}
function viewBlock($id) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    define('PAGE_NAME', '');

    // Ensure THEMEPATH is defined before using it
    $data['page_id'] = DEFAULTPAGE;
    $get = $this->block->getBlock($id);
    if ($get && $get->num_rows() > 0) {
        $row = $get->row();
        $content = $row->content;
    } else {
        $content = '<p>Error: Block not found or an issue occurred.</p>';
    }
    $data['content'] = $content;
    $this->load->view('includes/'.THEMEPATH.'/header',$data);
    $this->load->view('admin/template/view_block');
    $this->load->view('includes/'.THEMEPATH.'/footer');
}


    function content($type='home',$id=0){
        $type = $type.'-content.php';
        $headContent = beforeHeadContent(true,true);
        $headContent .= '<link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" >';
        
        $style = '';
        if(isset($_GET['type'])){
            $pagetype = $_GET['type'];
            if($pagetype == 'page'){
                $page_id = isset($_GET['pageid'])?$_GET['pageid']:DEFAULTPAGE;
                $style = theContent($page_id,'cssdata',true);
            }else{
                $style = OtherContent($pagetype,'cssdata',true);
            }
        }
        
        // grapes editor
        // $data['contentcss'] = $style;
        // $data['beforeend'] = AfterFooterContent(true);
        // $data['headContent'] = $headContent;
        echo $headContent;
        echo $style;
        if(isset($_GET['type'])){
            $pagetype = $_GET['type'];
            if($pagetype == 'page'){
                $page_id = isset($_GET['pageid'])?$_GET['pageid']:DEFAULTPAGE;
                $content = theContent($page_id,'content',true);
            }else{
                $content = OtherContent($pagetype,'content',true);
            }
        }
        
        $content = isset($content) && $content != '' ? $content : $this->load->view('includes/'.THEMEPATH.'/'.$type,[],true);
        echo $content;
        echo AfterFooterContent(true);
    }
    function test(){
        
    }
    function editor($type='home'){
        $uri = isset($_GET['uri']) ? $_GET['uri'] : 'home';
        $type = $type.'-content.php';
        $headContent = beforeHeadContent(true,true);
        $headContent .= '<link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" >';
        
        $style = '';
        if(isset($_GET['type'])){
            $pagetype = $_GET['type'];
            if($pagetype == 'page'){
                $page_id = isset($_GET['pageid'])?$_GET['pageid']:DEFAULTPAGE;
                $style = theContent($page_id,'cssdata',true);
            }else{
                $style = OtherContent($pagetype,'cssdata',true);
            }
        }
        
        // grapes editor
        $data['contentcss'] = $style;
        $data['beforeend'] = AfterFooterContent(true);
        $data['headContent'] = $headContent;
        
        if(isset($_GET['type'])){
            $pagetype = $_GET['type'];
            if($pagetype == 'page'){
                $page_id = isset($_GET['pageid'])?$_GET['pageid']:DEFAULTPAGE;
                $content = theContent($page_id,'content',true,$uri);
            }else{
                $content = OtherContent($pagetype,'content',true);
            }
        }
        $content = $content != '' ? $content : $this->load->view('includes/'.THEMEPATH.'/'.$type,[],true);
        $data['content'] = $content;
        $this->load->view('admin/editor',$data);
    }
    function page($page='index'){
        if($post = $this->input->post()){
            if(isset($post['action']) && $post['action'] == 'update-page-details'){
                unset($post['action']);
                $ins = $this->PageModel->update(['admin_id'=>CLIENT_ID,'id'=>$post['id']],$post);
                if($ins){
                    $this->session->set_flashdata('success_msg','Page Data updated');
                    redirect(current_url());
                }else{
                    $this->session->set_flashdata('error_msg',$this->db->error()['message']);
                    redirect(current_url());
                }
            }else{
                $data = [];
                $data['page_name'] = filter_var($post['page_name'], FILTER_SANITIZE_STRING);
                $data['uri'] = filter_var($post['uri'], FILTER_SANITIZE_STRING);
                if($post['page_type'] == 'custom'){
                    $data['url'] = filter_var($post['url'], FILTER_SANITIZE_STRING);
                    $data['same_domain'] = filter_var($post['same_domain'], FILTER_SANITIZE_STRING);
                    $data['redirect'] = filter_var($post['redirect'], FILTER_SANITIZE_STRING);
                }
                $data['admin_id'] = CLIENT_ID;
                $this->PageModel->add($data);
                echo 1;
            }
        }else{
            if(isset($_GET['action']) && $_GET['action'] == 'trash'){
                $id = @$_GET['id'];
                // $this->PageModel->update(['id'=>$id],['trash'=>'1']);
                $this->PageModel->delete(['id'=>$id]);
                $this->session->flashdata('success_msg','Action performed successfully.');
                redirect(current_url());
            }
            $this->load->view('admin/header');
            $this->load->view('admin/page/'.$page);
            $this->load->view('admin/footer');
        }
    }
    function setting($page='index'){
        $this->load->model('WebsiteData');
        if($post = $this->input->post()){
            $action = '';
            if(isset($post['action'])){
                $action = $post['action'];
                unset($post['action']);
            }
            switch($action){
                default:
                    $get = $this->WebsiteData->get(['admin_id'=>CLIENT_ID]);
                    $post['admin_id'] = CLIENT_ID;
                    if($get->num_rows()){
                        $this->WebsiteData->update(['admin_id'=>CLIENT_ID],$post);
                    }else{
                        $this->WebsiteData->add($post);
                    }
                    $this->session->set_flashdata('success_msg','Saved successfully.');
                    redirect(current_url());
                break;
            }
        }else{
            $data['get'] = $this->WebsiteData->get(['admin_id'=>CLIENT_ID])->row();
            $this->load->view('admin/header',$data);
            $this->load->view('admin/setting/'.$page);
            $this->load->view('admin/footer');
        }
    }
    function menu($page='index',$id=0){
        $data = array();
        if($post = $this->input->post()){
            $action = $post['action'];
            switch($action){
                case 'add-menu':
                    $label = htmlentities($post['label']);
                    $this->MenuModel->add(['label'=>$label,'admin_id'=>CLIENT_ID]);
                    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(current_url());
                break;
                case 'add-menu-item':
                    foreach($post['items'] as $type => $item){
                        foreach($item as $page_id){
                            $this->MenuItemModel->add(['menu_id'=>$id,'type'=>$type,'page_id'=>$page_id,'admin_id'=>CLIENT_ID]);
                        }
                    }
                    $this->session->set_flashdata('success_msg','Added successfully.');
                    redirect(current_url());
                break;
                case 'arrange-menu':
                    $i = 0;
                    if($post['menus'] != ''){
                        foreach(json_decode($post['menus']) as $key => $item){
                            $this->MenuItemModel->update(['id'=>$item->id],['sort'=>$i++,'parent'=>0]);
                            if(isset($item->children)){
                                foreach($item->children as $subKey => $sub){
                                    $this->MenuItemModel->update(['id'=>$sub->id],['sort'=>$i++,'parent'=>$item->id]);
                                }
                            }
                        }
                    }
                    echo json_encode(['status'=>true,'msg'=>'Changed successfully.']);
                break;
            }
        }else{
            if($id){
                $data['query'] = $this->db->order_by('sort','asc')->get_where('ab_menu_items',['admin_id'=>CLIENT_ID, 'menu_id'=>$id]);
            }
            $this->load->view('admin/header',$data);
            $this->load->view('admin/menu/'.$page);
            $this->load->view('admin/footer');
        }
    }
    
    
    function plugins($page='index'){
        $this->load->view('admin/header');
        $this->load->view('admin/plugins/'.$page);
        $this->load->view('admin/footer');
    }
    function install_plugin($id){
        $res = $this->PluginModel->installPlugin(intval($id));
        redirect('admin/plugins');
    }
    function uninstall_plugin($id){
        $this->PluginModel->uninstallPlugin($id);
        $this->session->set_flashdata('success_msg','Disabled successfully.');
        redirect('admin/plugins/installed');
    }
    function reinstall_plugin($id){
        $this->PluginModel->reinstallPlugin($id);
        $this->session->set_flashdata('success_msg','Enabled successfully.');
        redirect('admin/plugins/installed');
    }
    function plugin($plugin){
        if($post = $this->input->post()){
            $action = $post['action'];unset($post['action']);
            switch($action){
                case 'add-update':
                    foreach($post as $key => $val){
                        $this->other->addUpdate($key,$val);
                    }
                    $this->session->set_flashdata('success_msg','Saved successfully.');
                    redirect(current_url());
                break;
                case 'add-service':
                    $data = [];
                    foreach($post as $key => $val){
                        $data[$key] = is_array($val) ? json_encode($val) : $val;
                    }
                    $this->ServiceModel->addService($data);
                    if ($this->input->is_ajax_request()) {
                        echo json_encode(['status'=>true,'msg'=>'Created successfully.']);
                    }else{
                        $this->session->set_flashdata('success_msg','Created successfully.');
                        redirect(current_url());
                    }
                break;
                case 'update-service':
                    $data = [];
                    foreach($post as $key => $val){
                        $data[$key] = is_array($val) ? json_encode($val) : $val;
                    }
                    $this->ServiceModel->updateService($post['id'],$data);
                    if($row = $this->db->affected_rows()){
                        $status = true;
                        $msg = 'Updated successfully.';
                    }else{
                        $status = false;
                        $msg = 'No rows updated.';
                    }
                    if($this->input->is_ajax_request()){
                        echo json_encode(['status'=>$status,'msg'=>$msg]);
                    }else{
                        $this->session->set_flashdata('success_msg',$msg);
                        redirect(current_url());
                    }
                break;
            }
        }else{
            $page = @$_GET['page'] ?? 'index';
            $page = htmlspecialchars($page);
            $flag = @$_GET['flag'] ?? true;
            if($flag){
                $this->load->view('admin/header');
            }
            $this->load->view("plugins/$plugin/admin/$page");
            if($flag){
                $this->load->view('admin/footer');
            }
        }
    }
    function delete_service($id){
        $this->ServiceModel->deleteService($id);
        $this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(back_url());
    }
    function theme($page='index'){
        $this->load->view('admin/header');
        $this->load->view('admin/theme/'.$page);
        $this->load->view('admin/footer');
    }
    function ajax(){
        if($post = $this->input->post()){
            $action = $_POST['action'];
            switch($action){
                case 'delete-signle-media':
                    $res = $this->MediaModel->deleteMedia($post['id']);
                    echo json_encode(['status'=>$res['status'],'msg'=>$res['msg']]);
                break;
                case 'delete-media':
                    $obj = json_decode($post['obj']);
                    foreach($obj as $id){
                        $this->MediaModel->deleteMedia($id);
                    }
                    echo json_encode(['status'=>true,'msg'=>'Deleted successfully.']);
                break;
                case 'setTheme':
                    $this->load->model('Website');
                    $themeid = intval($post['themeid']);
                    $this->Website->update(['id'=>CLIENT_ID],['theme_id'=>$themeid]);
                    echo json_encode(['status'=>true,'msg'=>'Theme Changed successfully.']);
                break;
                case 'setDefault':
                    $this->website->update(['id'=>CLIENT_ID],['defualt_page'=>$post['id']]);
                    echo 1;
                break;
                case 'delete-menu-item':
                    $itemId = $post['itemId'];
                    $ins = $this->MenuItemModel->delete(['id'=>$itemId]);
                    if($ins){
                        echo json_encode(['status'=>true]);
                    }
                break;
            }
        }
    }
    function media($page='list'){
        $get = $this->db->select('extention,id,name as filename, CONCAT("'.base_url().'", path) as path')->order_by('id','desc')->get_where('media', ['admin_id' => CLIENT_ID]);
        $this->load->view('admin/header',['result'=>$get->result()]);
        $this->load->view('admin/media/'.$page);
        $this->load->view('admin/footer');
    }
    
    
    function save(){
        if($post = $this->input->post()){
            $cssdata = htmlEncode($post['cssdata']);
            $htmldata = $post['htmldata'];
            $htmldata = str_replace('<body>','',$htmldata);
            $htmldata = str_replace('</body>','',$htmldata);
            $htmldata = htmlEncode($htmldata);
            $pageId = $post['pageId'];
            $pageType = $post['pageType'];
            if($pageType == 'page'){
                $chk = $this->db->get_where('page_content',['page_id'=>$pageId,'admin_id'=>CLIENT_ID]);
                if($chk->num_rows()){
                    $this->db->where(['page_id'=>$pageId,'admin_id'=>CLIENT_ID])->update('page_content',['cssdata'=>$cssdata,'content'=>$htmldata]);
                }else{
                    $this->db->insert('page_content',['cssdata'=>$cssdata,'content'=>$htmldata,'page_id'=>$pageId,'admin_id'=>CLIENT_ID]);
                }
            }else{
                $chk = $this->db->get_where('other_content',['type'=>$pageType,'admin_id'=>CLIENT_ID]);
                if($chk->num_rows()){
                    $this->db->where(['type'=>$pageType,'admin_id'=>CLIENT_ID])->update('other_content',['cssdata'=>$cssdata,'content'=>$htmldata]);
                }else{
                    $this->db->insert('other_content',['cssdata'=>$cssdata,'content'=>$htmldata,'type'=>$pageType,'admin_id'=>CLIENT_ID]);
                }
            }
        }
        echo 1;
    }
    function delete_file(){
        print_r($post);exit;
    }
    function upload($file='files'){
        $get = $this->file_up($file);
        if(!isset($get['error'])){
            foreach($get as $file){
                $type = isset($file['is_image']) && $file['is_image'] ? 'image' : 'video';
                $data = [
                        'type' => $type,
                        'path' => str_replace(FCPATH,'',$file['full_path']),
                        'name' => $file['raw_name'],
                        'size' => $file['file_size'],
                        'file_type' => $file['file_type'],
                        'extention' => $file['file_ext'],
                        'info' => json_encode($file),
                        'admin_id'=>CLIENT_ID,
                        'height'=> $file['image_height'],
                        'width'=>$file['image_width'],
                    ];
                $this->db->insert('media',$data);
            }
            echo 1;
        }else{
            echo $get['error'];
        }
    }
    function load_media($multiple) {
        $this->db->order_by('id','desc');
        $get = $this->db->select('extention,id,name as filename, CONCAT("/", path) as path')->get_where('media', ['admin_id' => CLIENT_ID]);
        $this->load->view('admin/media/index',['result'=>$get->result(),'multiple'=>$multiple]);
    }

    
    
    public function file_up($file) {
        $upload_dir = './public/temp/'.CLIENT_ID.'/';
        if (!is_dir($upload_dir)) {
            // If the directory does not exist, create it with the desired permissions.
            mkdir($upload_dir, 0777, true);
        }
        
        $upload_data = array(); // Initialize the upload data array
        
        // Loop through each file
        foreach ($_FILES[$file]['name'] as $key => $filename) {
            // Set up configuration for each file
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|pdf|mp4';
            $config['max_size']      = 0;
            // $config['encrypt_name'] = TRUE;
            $config['file_name']     = time(); // Set file name to current timestamp


            // Initialize the upload library with the config
            $this->load->library('upload', $config);
            
            // Set up $_FILES data for each file
            $_FILES['userfile']['name']     = $_FILES[$file]['name'][$key];
            $_FILES['userfile']['type']     = $_FILES[$file]['type'][$key];
            $_FILES['userfile']['tmp_name'] = $_FILES[$file]['tmp_name'][$key];
            $_FILES['userfile']['error']    = $_FILES[$file]['error'][$key];
            $_FILES['userfile']['size']     = $_FILES[$file]['size'][$key];
            
            // Upload the file
            if ($this->upload->do_upload('userfile')) {
                $upload_data[] = $this->upload->data();
            } else {
                // If upload fails, return the error
                $error = array('error' => $this->upload->display_errors());
                return $error;
            }
        }
        
        return $upload_data;
    }


    function logout(){
        unset($_SESSION['customer-session']);
        unset($_SESSION['by_superadmin']);
        redirect('/');
    }
    
    
    public function find_replace(){
        $data = [];
        $data['results'] = [];
        $data['summary'] = [];
    
        $this->load->view('admin/header');
        $this->load->view('admin/find_replace', $data);
        $this->load->view('admin/footer');
    }
    
    /**
     * Preview search results (NO UPDATE)
     * POST:
     *  search_text
     *  in_other (1/0)
     *  in_page  (1/0)
     *  case_sensitive (1/0) optional
     */
    public function find_replace_preview()
    {
        $search = trim($this->input->post('search_text', true));
        $in_other = (int)$this->input->post('in_other');
        $in_page  = (int)$this->input->post('in_page');
        $case_sensitive = (int)$this->input->post('case_sensitive');
    
        $data = [
            'results' => [],
            'summary' => [
                'total_rows' => 0,
                'total_occurrences' => 0,
                'search_text' => $search
            ]
        ];
    
        if ($search === '' || (!$in_other && !$in_page)) {
            $data['error'] = 'Search text required and select at least one table.';
            $this->load->view('admin/header');
            $this->load->view('admin/find_replace', $data);
            $this->load->view('admin/footer');
            return;
        }
    
        // helper: count occurrences
        $count_occ = function($haystack, $needle) use ($case_sensitive) {
            if ($needle === '') return 0;
            if ($case_sensitive) {
                return substr_count($haystack, $needle);
            }
            return substr_count(mb_strtolower($haystack), mb_strtolower($needle));
        };
    
        // helper: snippet (small preview around first match)
        $make_snippet = function($content, $needle) {
            $pos = mb_stripos($content, $needle);
            if ($pos === false) {
                return mb_substr($content, 0, 120);
            }
            $start = max(0, $pos - 60);
            $snippet = mb_substr($content, $start, 160);
            return '...'.$snippet.'...';
        };
    
        // SEARCH IN ab_other_content
        if ($in_other) {
            $rows = $this->db->select('id, content')
                ->from('ab_other_content')
                ->like('content', $search)   // case-insensitive depends on collation
                ->where('admin_id', CLIENT_ID)
                ->get()->result_array();
    
            foreach ($rows as $r) {
                $occ = $count_occ($r['content'], $search);
                $page = $r['type'] == 'header' ? 'Header' : 'Footer';
                if ($occ > 0) {
                    $data['results'][] = [
                        'table' => 'ab_other_content',
                        'page' => $page,
                        'id' => (int)$r['id'],
                        'field' => 'content',
                        'occurrences' => $occ,
                        'snippet' => $make_snippet($r['content'], $search),
                        'hash' => sha1($r['content']),
                    ];
                    $data['summary']['total_rows']++;
                    $data['summary']['total_occurrences'] += $occ;
                }
            }
        }
    
        // SEARCH IN ab_page_content
        if ($in_page) {
            $rows = $this->db->select('id, content,page_id')
                ->from('ab_page_content')
                ->like('content', $search)
                ->where('admin_id', CLIENT_ID)
                ->get()->result_array();
    
            foreach ($rows as $r) {
                $occ = $count_occ($r['content'], $search);
                $page = $this->db->get_where('ab_pages',['id'=>$r['page_id'],'admin_id'=>CLIENT_ID])->row()->page_name;
                if ($occ > 0) {
                    $data['results'][] = [
                        'table' => 'ab_page_content',
                        'page' => $page,
                        'id' => (int)$r['id'],
                        'field' => 'content',
                        'occurrences' => $occ,
                        'snippet' => $make_snippet($r['content'], $search),
                        'hash' => sha1($r['content']),
                    ];
                    $data['summary']['total_rows']++;
                    $data['summary']['total_occurrences'] += $occ;
                }
            }
        }
    
        $this->load->view('admin/header');
        $this->load->view('admin/find_replace', $data);
        $this->load->view('admin/footer');
    }
    
    /**
     * Apply replace after review
     * POST:
     *  search_text
     *  replace_text
     *  mode = selected|all
     *  selected[] = "table|id|hash" (for selected mode)
     *  in_other/in_page (for all mode)
     *  case_sensitive (optional)
     */
    public function find_replace_apply()
    {
        $search  = trim($this->input->post('search_text', true));
        $replace = (string)$this->input->post('replace_text', false); // allow html
        $mode    = $this->input->post('mode', true); // selected or all
        $case_sensitive = (int)$this->input->post('case_sensitive');
    
        if ($search === '') {
            $this->session->set_flashdata('error', 'Search text is required.');
            redirect('admin/find_replace');
            return;
        }
    
        // helper replace
        $do_replace = function($content) use ($search, $replace, $case_sensitive) {
            if ($case_sensitive) return str_replace($search, $replace, $content);
            return str_ireplace($search, $replace, $content);
        };
    
        $updated_rows = 0;
        $updated_occ  = 0;
    
        $this->db->trans_start();
    
        if ($mode === 'selected') {
            $selected = (array)$this->input->post('selected');
    
            foreach ($selected as $packed) {
                // packed format: table|id|hash
                $parts = explode('|', $packed);
                if (count($parts) !== 3) continue;
    
                $table = $parts[0];
                $id    = (int)$parts[1];
                $hash  = $parts[2];
    
                if (!in_array($table, ['ab_other_content','ab_page_content'], true)) continue;
    
                $row = $this->db->select('content')
                    ->from($table)
                    ->where('id', $id)
                    ->where('admin_id', CLIENT_ID)
                    ->get()->row_array();
    
                if (!$row) continue;
    
                // hash safety check (optional)
                if (sha1($row['content']) !== $hash) {
                    continue; // content changed after preview
                }
    
                $before = $row['content'];
                $after  = $do_replace($before);
    
                if ($before !== $after) {
                    // count occurrences replaced (approx)
                    $occ = substr_count(mb_strtolower($before), mb_strtolower($search));
                    $this->db->where('id', $id)->where('admin_id', CLIENT_ID)->update($table, ['content' => $after]);
                    $updated_rows++;
                    $updated_occ += $occ;
                }
            }
    
        } else { 
            // mode = all (based on in_other / in_page)
            $in_other = (int)$this->input->post('in_other');
            $in_page  = (int)$this->input->post('in_page');
    
            $targets = [];
            if ($in_other) $targets[] = 'ab_other_content';
            if ($in_page)  $targets[] = 'ab_page_content';
    
            foreach ($targets as $table) {
                $rows = $this->db->select('id, content')
                    ->from($table)
                    ->like('content', $search)
                    ->where('admin_id', CLIENT_ID)
                    ->get()->result_array();
    
                foreach ($rows as $r) {
                    $before = $r['content'];
                    $after  = $do_replace($before);
    
                    if ($before !== $after) {
                        $occ = substr_count(mb_strtolower($before), mb_strtolower($search));
                        $this->db->where('id', (int)$r['id'])->where('admin_id', CLIENT_ID)->update($table, ['content' => $after]);
                        $updated_rows++;
                        $updated_occ += $occ;
                    }
                }
            }
        }
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', 'Replace failed (DB transaction error).');
        } else {
            $this->session->set_flashdata('success', "Replaced successfully. Rows updated: {$updated_rows}, Total occurrences: {$updated_occ}");
        }
    
        redirect('admin/find_replace');
    }

    
    
    
}