<?php

class BlockCategory extends CI_Model{
    public $table = 'ab_block_category';
    function getActiveBlockCategories(){
        return $this->db->get_where($this->table,['status'=>1]);
    }
}