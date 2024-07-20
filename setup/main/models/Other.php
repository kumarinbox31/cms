<?php
class Other extends MY_Model{
    public $table = 'ab_others';
    
    function getVal($type,$val=''){
        $get = $this->get(['type'=>$type,'admin_id'=>CLIENT_ID]);
        return $get->num_rows() ? $get->row()->value : $val;
    }
    
    function addUpdate($type,$val=''){
        $get = $this->get(['type'=>$type,'admin_id'=>CLIENT_ID]);
        if($get->num_rows()){
            return $this->update(['type'=>$type,'admin_id'=>CLIENT_ID],['value'=>$val]);
        }else{
            return $this->add(['type'=>$type,'admin_id'=>CLIENT_ID,'value'=>$val]);
        }
    }
    
}