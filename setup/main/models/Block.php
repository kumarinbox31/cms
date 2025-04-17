<?php

class Block extends CI_Model{
    public $protected = 'blocks';
    
    function getActiveBlocks($theme_id = null) {
    $theme_condition = empty($theme_id) 
        ? "(theme_id = 0 OR theme_id = " . THEME_ID . ")" 
        : "theme_id = " . (int)$theme_id;

    $sql = "
        SELECT 
            ab_blocks.id AS blockid,
            blockid AS id,
            label,
            CASE 
                WHEN media IS NULL OR media = '' THEN 
                    CONCAT('<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"50\" height=\"50\" viewBox=\"0 0 300 300\">
                        <rect width=\"100%\" height=\"100%\" fill=\"#f0f0f0\"></rect>
                        <text x=\"50%\" y=\"50%\" font-family=\"Arial\" font-size=\"40\" fill=\"red\" text-anchor=\"middle\" alignment-baseline=\"middle\">',
                        label,
                        '</text>
                    </svg>')
                ELSE media
            END AS media,
            attributes,
            content,
            ab_block_category.name AS category 
        FROM 
            ab_blocks
        JOIN 
            ab_block_category ON ab_block_category.id = ab_blocks.category_id
        WHERE 
            ab_blocks.status = '1' 
            AND $theme_condition 
        ORDER BY 
            seq DESC
    ";

    return $this->db->query($sql);
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
    
    function create($data){
        return $this->db->insert('blocks',$data);
    }
}