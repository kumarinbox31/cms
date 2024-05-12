<?php
class Admin extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->helper(['page','media','custom']);
        $this->load->model(['block','PageModel','website','MenuModel','MenuItemModel',
        'PluginModel','BlockCategory']);
        checkAdminLogin();
        $this->load->model("MediaModel");
                    
    }
    public function downloadFormData($formId){
        require FCPATH.'/vendor/autoload.php';
        // Load the PhpSpreadsheet library
        $this->load->library('PhpSpreadsheet');
        
        // Load the database library
        $this->load->database();
        
        // Fetch data from the database
        $query = $this->db->get('ab_form_data');
        $data = $query->result_array();
        
        // Create a new PhpSpreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Add headers
        $sheet->setCellValue('A1', 'Data');
        
        // Initialize row counter
        $row = 2;
        
        // Loop through the database results
        foreach ($data as $row_data) {
            // Decode JSON data
            $json_data = json_decode($row_data['data'], true);
            
            // Add data to Excel
            $sheet->setCellValue('A'.$row, json_encode($json_data)); // Adjust this line based on your JSON structure
            
            // Increment row counter
            $row++;
        }
        
        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="form_data.xlsx"');
        header('Cache-Control: max-age=0');
        
        // Write Excel file to PHP output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    function downloadProductQuery($productGalleryId){
        
    }
    function index(){
        $this->load->view('admin/header');
        $this->load->view('admin/home');
        $this->load->view('admin/footer');
    }
    function template($page='index'){
        $this->load->view('admin/header');
        $this->load->view('admin/template/'.$page);
        $this->load->view('admin/footer');
    }
    function viewBlock($id){
        echo '<!DOCTYPE html><html><head><title>Preview</title>';
        beforeHeadContent();
        echo '</head><body>';
        $get = $this->block->getBlock($id);
        if($get->num_rows()){
            $row = $get->row();
            $content = $row->content;
            echo $content;
        }else{
            echo 'Something went wrong.';
        }
        AfterFooterContent();
        echo '</body></html>';
    }
    function content($type='home',$id=0){
        $type = $type.'-content.php';
        $headContent = beforeHeadContent(true);
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
        $headContent = beforeHeadContent(true);
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
        // print_r($data);exit;
        
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
            $this->load->view('admin/header');
            $this->load->view("plugins/$plugin/admin/$page");
            $this->load->view('admin/footer');
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
        redirect('/');
    }
    
    
}