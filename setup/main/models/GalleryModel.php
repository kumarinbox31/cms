<?php
class GalleryModel extends MY_Model{
    
    public $table = 'gallery';
    public $table2 = 'gallery_item';
    
    public function getGallery($wh){
        return $this->db->get_where($this->table,$wh);
    }
    public function addGallery($data){
        $data['admin_id'] = CLIENT_ID;
        return $this->db->insert($this->table,$data);
    }
    
    public function updateGallery($wh,$data){
        return $this->db->where($wh)->update($this->table,$data);
    }
    
    public function deleteGallery($galleryid){
        $this->deleteGalleryItems($galleryid);
        return $this->db->where('id',$galleryid)->delete($this->table);
    }
    public function getGalleyItems($wh){
        return $this->db->get_where($this->table2,$wh);
    }
    public function addGalleryItem($data){
        $data['admin_id'] = CLIENT_ID;
        return $this->db->insert($this->table2,$data);
    }
    public function deleteGalleryItems($galleryId){
        return $this->db->where(['gallery_id'=>$galleryId])->delete($this->table2);
    }
    public function deleteItem($wh){
        $wh['admin_id'] = CLIENT_ID;
        return $this->db->where($wh)->delete($this->table2);
    }
}