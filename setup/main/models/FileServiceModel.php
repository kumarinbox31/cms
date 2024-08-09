<?php
class FileServiceModel extends MY_Model{
    
    private $table = 'ab_file_download';
    private $table1 = 'ab_file_download_item';
    private $foreign_key = 'file_download_id';
    
    // services functions
    public function addService($data){
        $data['admin_id'] = CLIENT_ID;
        return $this->db->insert($this->table,$data);
    }
    public function getAllService(){
        return $this->db->where(['admin_id'=>CLIENT_ID])->get($this->table);
    }
    
    public function getServiceById($id){
        return $this->db->where(['id'=>$id,'admin_id'=>CLIENT_ID])->get($this->table);
    }
    public function deleteService($id){
        $this->db->where($this->foreign_key,$id)->delete($this->table1);
        $this->db->where('id',$id)->delete($this->table);
        return TRUE;
    }
    public function updateService($wh,$data){
        $wh['admin_id'] = CLIENT_ID;
        return $this->db->where($wh)->update($this->table,$data);
    }
    public function check_service_exists($id){
        $get = $this->getServiceById($id);
        if($get->num_rows()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    // service item functions
    public function addServiceItem($data){
        return $this->db->insert($this->table1,$data);
    }
    public function getServiceItemsByServiceId($serviceId){
        return $this->db->where($this->foreign_key,$serviceId)->get($this->table1);
    }
    public function getServiceItemById($id){
        return $this->db->get_where($this->table1,['id'=>$id]);
    }
    public function getServiceItemByFormData($data){
        return $this->db->get_where($this->table1,['form_data'=>$data]);
    }
    public function deleteServiceItem($id){
        return $this->db->where(['id'=>$id])->delete($this->table1);
    }
    public function updateServiceItem($wh,$data){
        return $this->db->where($wh)->update($this->table1,$data);
    }
    
}