<?php

class Block extends CI_Model{
    public $protected = 'blocks';
    
    function getActiveBlocks(){
        return $this->db->query("SELECT ab_blocks.id as blockid,blockid as id,label,media,attributes,content,ab_block_category.name as category FROM ab_blocks 
        JOIN ab_block_category ON ab_block_category.id = ab_blocks.category_id
        WHERE ab_blocks.status = '1' and (theme_id = 0 OR theme_id = ".THEME_ID.") ORDER BY seq DESC");
    }
    
    function getBlock($id){
        return $this->db->get_where('ab_blocks',['id'=>$id]);
    }
    
    function getEditorBlocks(){
        $get = $this->getActiveBlocks();
        if($get->num_rows()){
            return json_encode($get->result_array());
        }else{
            return [];
        }
    }
}