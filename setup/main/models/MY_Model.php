<?

class MY_Model extends CI_Model{
    function add($data){
        return $this->db->insert($this->table,$data);
    }
    function get($wh=[]){
        return $this->db->get_where($this->table,$wh);
    }
    function update($wh,$data){
        return $this->db->where($wh)->update($this->table,$data);
    }
    function  delete($wh){
        return $this->db->where($wh)->delete($this->table);
    }
}