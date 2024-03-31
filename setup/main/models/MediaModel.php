<?php
class MediaModel extends MY_Model{
    
    public $table = 'media';
    
    function deleteMedia($id){
        $get = $this->get(['id'=>$id,'admin_id'=>CLIENT_ID]);
        if($get->num_rows()){
            $row = $get->row();
            $path = $row->path;
            $file = FCPATH."/$path";
            if(file_exists($file)){
                unlink($file);
            }else{
                return ['status'=>false,'msg'=>'File not found in direcotry.'];
            }
            $res = $this->delete(['id'=>$id,'admin_id'=>CLIENT_ID]);
            if($res){
                return ['status'=>true,'msg'=>'Record deleted successfully.'];
            }else{
                return ['status'=>false,'msg'=>$this->db->error()['message']];
            }
        }else{
            return ['status'=>false,'msg'=>'Record not found.'];
        }
    }
}