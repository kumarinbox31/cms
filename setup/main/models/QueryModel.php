<?php
class QueryModel extends CI_Model{
    public $table = 'ab_product_query';
    
    function addProductQuery($data){
        return $this->db->insert($this->table,$data);
    }
}