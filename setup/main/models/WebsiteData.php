<?php 

class WebsiteData extends MY_Model{
    public $table = 'website_data';
    
    public function chkRow(){
        $get = $this->db->get_where($this->table,['admin_id'=>CLIENT_ID]);
        if(!$get->num_rows()){
            $this->db->insert($this->table,['title'=>'Website','admin_id'=>CLIENT_ID]);
        }
        return true;
    }

    public function addVisitorCount() {
        $cookie_name = 'ab-visits';
        $cookie_value = 1; // Assuming getVisitors() returns the visitor count
    
        // Check if the cookie exists
        if(!isset($_COOKIE[$cookie_name])) {
            // Set the cookie
            $cookie_expire = time() + 31556926; // Lifetime of 1 year in seconds
            setcookie($cookie_name, $cookie_value, $cookie_expire, '/');
            
            // Increment count if cookie doesn't exist
            $this->addVisitors();
        } 
    }
    
    public function addVisitors(){
        if($this->chkRow()){          
            $this->db->where('admin_id', CLIENT_ID)->set('visitors_count', 'visitors_count+1', FALSE)->update($this->table);
        }
    }

    public function getVisitors(){
        if($this->chkRow()){
            return $this->db->select('visitors_count')->get_where($this->table,['admin_id'=>CLIENT_ID])->row()->visitors_count;
        }
    }
    
}