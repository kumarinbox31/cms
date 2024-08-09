<?php 
class Gallery extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        if(in_array($this->uri->segment('2'),['add','update','delete'])){
            echo json_encode(checkAdminLogin(true));
            die();
        }
        $this->load->model(['GalleryModel','QueryModel']);
    }
    
    function add() {
        if($post = $this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('type', 'Type', 'required|in_list[Product Gallery,Video Gallery,Image Gallery]');
            $this->form_validation->set_rules('title', 'Title', 'required');
        
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => 'Validation Failed.', 'code' => 12, 'data' => validation_errors()]);
                return;
            }
            
            $res = $this->GalleryModel->addGallery($post);
            if($res){
                echo json_encode(['status'=>1,'msg'=>'Gallery Added Successfully.','data'=>$post,'code'=>14]);
            }else{
                echo json_encode(['status'=>0,'msg'=> 'Database Error','code'=>13,'data'=>$this->db->error()]);
            }
        }else{
            echo json_encode(['status'=>0,'msg'=>'Only Post Method Allowed','code'=>15]);
        }
        
    }
    function update() {
        if($post = $this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('id', 'Id', 'required');
        
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => 'Validation Failed.', 'code' => 12, 'data' => validation_errors()]);
                return;
            }
            
            $data = [];
            foreach($post as $key => $val){
                $data[$key] = is_array($val) ? json_encode($val) : $val;
            }
            $res = $this->GalleryModel->updateGallery(['id'=>$post['id']],$data);
            if($res){
                echo json_encode(['status'=>1,'msg'=>'Gallery Update Successfully.','data'=>$post,'code'=>14]);
            }else{
                echo json_encode(['status'=>0,'msg'=> 'Database Error','code'=>13,'data'=>$this->db->error()]);
            }
        }else{
            echo json_encode(['status'=>0,'msg'=>'Only Post Method Allowed','code'=>15]);
        }
        
    }
    public function deleteGallery(int $id){
        $this->GalleryModel->deleteGallery($id);
        echo json_encode(['status'=>1,'msg'=>'Deleted successfully.','code'=>14,'data'=>null]);
    }
    public function getAll(){
        $data = $this->GalleryModel->getGallery(['type'=>htmlspecialchars(@$_GET['type']),'admin_id'=>CLIENT_ID])->result();
        echo json_encode(['status'=>1,'msg'=>'All Gallery Fetched','code'=>14,'data'=>$data]);
    }
    public function getAllItems(){
        $data = $this->GalleryModel->getGalleyItems(['gallery_id'=>intval(@$_GET['galleryid']),'admin_id'=>CLIENT_ID])->result();
        echo json_encode(['status'=>1,'msg'=>'All Gallery Items Fetched','code'=>14,'data'=>$data]);
    }
    public function addItem(){
        if($post = $this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('gallery_id', 'Gallery Id', 'required');
            $this->form_validation->set_rules('file', 'File', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => 'Validation Failed.', 'code' => 12, 'data' => validation_errors()]);
                return;
            }
            $data = [
                'gallery_id'    =>  $post['gallery_id'],
                'title'         =>  $post['title'],
                'desc'          =>  $post['desc'] ?? '',
                'file'          =>  $post['file'],
                'link'          =>  $post['link'] ?? '',
                'btn'           =>  $post['btn'] ?? '',
            ];
            $res = $this->GalleryModel->addGalleryItem($data);
            if($res){
                echo json_encode(['status'=>1,'msg'=>'Gallery Item Added Successfully.','data'=>$data,'code'=>14]);
            }else{
                echo json_encode(['status'=>0,'msg'=> 'Database Error','code'=>13,'data'=>$this->db->error()]);
            }
        }else{
            echo json_encode(['status'=>0,'msg'=>'Only Post Method Allowed','code'=>15]);
        }
    }
    public function deleteItem(int $id){
        $res = $this->GalleryModel->deleteItem(['id'=>$id]);
        if($res){
            echo json_encode(['status'=>1,'msg'=>'Gallery Item Deleted Successfully.','data'=>NULL,'code'=>14]);
        }else{
            echo json_encode(['status'=>0,'msg'=> 'Database Error','code'=>13,'data'=>$this->db->error()]);
        }
    }
    public function sendQuery() {
        if ($post = $this->input->post()) {
            $post['admin_id'] = CLIENT_ID;
            // Sanitize and validate $post data here before passing it to the model
            $res = $this->QueryModel->addProductQuery($post);
            if ($res) {
                echo json_encode(['status' => 1, 'msg' => 'Query Sent Successfully.', 'data' => null, 'code' => 14]);
            } else {
                // Provide a detailed error message
                echo json_encode(['status' => 0, 'msg' => 'Database Error: Failed to add product query.', 'code' => 13, 'data' => $this->db->error()]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => 'Only POST method allowed.', 'data' => null, 'code' => 15,'success'=>true]);
        }
    }
    public function allQuery(int $id){
        $res = $this->QueryModel->getProductQuery(['productid'=>$id]);
        if($res->num_rows()){
            
        }else{
            echo json_encode(['status' => 0, 'msg' => 'No Data Fetched.', 'code' => 13, 'data' => null,'success' => true]);
        }
    }

}