<?php

function assets(){
    $res = '';
    $ci = &get_instance();
    $get = $ci->db->select('type,CONCAT("' . base_url() . '", path) as src,height,width,name')->get_where('media',['is_deleted'=>'0','admin_id'=>CLIENT_ID,'type'=>'image']);
    if($get->num_rows()){
        foreach($get->result() as $row){
            $height = $row->height??0;
            $width = $row->width??0;
            $res .= "{type:'$row->type',src:'$row->src',height:$height,width:$width,name:'$row->name'},";
        }
    }
    $res = rtrim($res,',');
    return $res;
}