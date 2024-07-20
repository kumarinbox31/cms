<?php 
class FileService extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        if(in_array($this->uri->segment('3'),['addService','deleteService','addServiceItem','deleteServiceItem'])){
            // echo json_encode(checkAdminLogin(true));
        }
        $this->load->model(['FileServiceModel']);
    }
    public function getAllService(){
        $data = $this->FileServiceModel->getAllService()->result();
        echo json_encode(['status'=>1,'msg'=>'All File Services Fetched','code'=>14,'data'=>$data]);
    }
    public function addService() {
        if ($post = $this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('form_id', 'Form Id', 'required|numeric');
            $this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('is_download', 'Download', 'required|in_list[1,0]'); // Added missing semicolon
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => 'Validation Failed.', 'code' => 12, 'data' => validation_errors()]);
                return;
            }
            $data = [
                'form_id' => $this->input->post('form_id'),
                'title' => $this->input->post('title'),
                'is_download' => $this->input->post('is_download'),
            ];
            $res = $this->FileServiceModel->addService($data);
            if ($res) {
                echo json_encode(['status' => 1, 'msg' => 'Service Added Successfully.', 'data' => $data, 'code' => 14]); // Changed 'Gallery' to 'Service'
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Database Error', 'code' => 13, 'data' => $this->db->error()]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => 'Only Post Method Allowed', 'code' => 15]);
        }
    }
    public function deleteService(){
        if($post = $this->input->post()){
            $id = $this->input->post('id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'Id', 'required|numeric');
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => 'Validation Failed.', 'code' => 12, 'data' => validation_errors()]);
                return;
            }
            $this->FileServiceModel->deleteService($id);
            echo json_encode(['status' => 1, 'msg' => 'Service Deleted with their items Successfully.', 'data' => [], 'code' => 14]);
        }else{
            echo json_encode(['status' => 0, 'msg' => 'Only Post Method Allowed', 'code' => 15]);
        }
    }
    
    // service items
    public function getServiceItemByFormData(){
        if($post = $this->input->post()){
            $form_data = $this->input->post('form_data');
            if($form_data != ''){
                $data = $this->FileServiceModel->getServiceItemByFormData($form_data);
                if($data->num_rows()){
                    echo json_encode(['status'=>1,'code'=>1,'msg'=>'data found','data'=>$data->row()]);
                }else{
                    echo json_encode(['status'=>0,'code'=>0,'msg'=>'data not found','data'=>[]]);
                }
            }else{
                echo json_encode(['status'=>0,'code'=>0,'msg'=>'form_data is required','data'=>[]]);
            }
        }else{
            echo json_encode(['status'=>0,'code'=>-1,'msg'=>'only post method allowed.','data'=>[]]);
        }
    }
    public function getAllServiceItem($id){
        $data = $this->FileServiceModel->getServiceItemsByServiceId($id)->result();
        echo json_encode(['status'=>1,'msg'=>'All File Service Items Fetched','code'=>14,'data'=>$data]);
    }
    public function is_exists($value) {
        if ($this->FileServiceModel->check_service_exists($value)) { 
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function addServiceItem() {
        if ($post = $this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('form_data', 'Form Data', 'required');
            $this->form_validation->set_rules('file', 'File', 'required');
            $this->form_validation->set_rules('file_download_id', 'Service Id', 'required|callback_is_exists');
    
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => validation_errors(), 'code' => 12, 'data' => validation_errors()]);
                return;
            }
    
            $data = [
                'form_data'         => ($this->input->post('form_data')),
                'file'              => $this->input->post('file'),
                'file_download_id'  => $this->input->post('file_download_id')
            ];
            $res = $this->FileServiceModel->addServiceItem($data);
    
            if ($res) {
                echo json_encode(['status' => 1, 'msg' => 'Service Item Added Successfully.', 'data' => $data, 'code' => 14]);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Database Error', 'code' => 13, 'data' => $this->db->error()]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => 'Only Post Method Allowed', 'code' => 15]);
        }
    }
    public function getServiceItemDetails($id){
        $data = $this->FileServiceModel->getServiceItemById($id)->result();
        // var_dump(json_decode(json_decode($data[0]->form_data,true),true)['Name*']);exit;
        echo json_encode(['status'=>1,'msg'=>'File Service Item Details Fetched','code'=>14,'data'=>$data]);
    }
    public function deleteServiceItem(){
        if($post = $this->input->post()){
            $id = $this->input->post('id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'Id', 'required|numeric');
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 0, 'msg' => 'Validation Failed.', 'code' => 12, 'data' => validation_errors()]);
                return;
            }
            $this->FileServiceModel->deleteServiceItem($id);
            echo json_encode(['status' => 1, 'msg' => 'Service Item Deleted Successfully.', 'data' => [], 'code' => 14]);
        }else{
            echo json_encode(['status' => 0, 'msg' => 'Only Post Method Allowed', 'code' => 15]);
        }
    }

    
    
}