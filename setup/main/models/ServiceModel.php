<?php 
class ServiceModel extends MY_Model{
    public $table = 'service';
    
    function getServiceByType($type)
    {
        return $this->get(['type'=>$type,'admin_id'=>CLIENT_ID]);
    }
    function getServiceById($id)
    {
        return $this->get(['id'=>$id,'admin_id'=>CLIENT_ID]);
    }
    function addService($data){
        $data['admin_id'] = CLIENT_ID;
        return $this->add($data);
    }
    function deleteService($id){
        return $this->delete(['id'=>$id,'admin_id'=>CLIENT_ID]);
    }
    function updateService($id,$data){
        return $this->update(['id'=>$id,'admin_id'=>CLIENT_ID],$data);
    }
    function getService($wh=[]){
        $wh['admin_id'] = CLIENT_ID;
        return $this->get($wh);
    }
}