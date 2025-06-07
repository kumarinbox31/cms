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

    public function addVisitorCount($page_id) {
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
        // === NEW CODE FOR PAGE VISIT TRACKING ===
        $page_cookie_name = 'ab-visits-page-' . $page_id;
    
        if (!isset($_COOKIE[$page_cookie_name])) {
            // Set page-specific visit cookie
            setcookie($page_cookie_name, 1, time() + 31556926, '/');
    
            // Update visit count for this specific page
            $this->incrementPageVisitCount($page_id);
        }
    }
    
    public function incrementPageVisitCount($page_id){
        $this->db->where('admin_id', CLIENT_ID)->where('id',$page_id)->set('visit_count', 'visit_count+1', FALSE)->update('pages');
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