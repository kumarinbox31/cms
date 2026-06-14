<?php 
class Website extends MY_Model{
    protected $table = 'websites';
    
    // permanantly deletation of website
    function delete_website($wid, $deleteDir = true){
        $arr = ['media','form_data','media','menu','menu_items','others','other_content','pages','page_content','plugin_installed','service','website_data'];
        foreach($arr as $tbl){
            $res = $this->db->where(['admin_id'=>$wid])->delete($tbl);
            if(!$res){
                print_r($this->db->error());exit;
            }
        }
        $res = $this->db->where(['id'=>$wid])->delete('websites');
        if(!$res){
            print_r($this->db->error());exit;
        }
        if ($deleteDir) {
            echo $this->deleteFolder(FCPATH.'/public/temp/'.$wid);
        }
    }
    function deleteFolder($folderPath) {
        // Check if the folder exists
        if (!is_dir($folderPath)) {
            return "Folder does not exist";
        }
    
        // Open the folder
        $dirHandle = opendir($folderPath);
    
        // Loop through the folder
        while (($file = readdir($dirHandle)) !== false) {
            if ($file != "." && $file != "..") {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
                // If it's a directory, delete it recursively
                if (is_dir($filePath)) {
                    deleteFolder($filePath);
                } else {
                    // If it's a file, delete it
                    if (!unlink($filePath)) {
                        closedir($dirHandle);
                        return "Failed to delete file: $filePath";
                    }
                }
            }
        }
    
        // Close the directory handle
        closedir($dirHandle);
    
        // Delete the folder itself
        if (!rmdir($folderPath)) {
            return "Failed to delete folder: $folderPath";
        }
    
        return "Folder deleted successfully";
    }
    // permanantly deletation complete
    
    // full website create process
    function create($data,$wid=0){
        $data['theme_id']=3;
        $this->add($data);
        $nwid = $this->db->insert_id(); // $nwid means new website id
        if(!$nwid){
            print_r($this->db->error());exit;
        }
        if($wid){
            $this->copy_website($wid,$nwid);
        }else{
            $this->create_default_page($nwid);
        }
    }
    
    function create_default_page($nwid){
        $this->db->insert('pages',['page_name'=>'Home','uri'=>'home','admin_id'=>$nwid]);
        $pageid = $this->db->insert_id();
        $this->set_page_to_default($pageid,$nwid);
    }
    
    function set_page_to_default($pageid,$nwid){
        $this->update(['id'=>$nwid],['defualt_page'=>$pageid]);
    }
    
    function copy_website($wid,$nwid){
        $this->copy_pages($wid,$nwid);
        // $this->copy_service($wid,$nwid);
        // $this->copy_other($wid,$nwid);
        $this->copy_media($wid,$nwid);
        $this->copy_menu($wid,$nwid);
        $this->copy_plugin($wid,$nwid);
    }
    function copy_plugin($wid,$nwid){
        $get = $this->db->get_where('plugin_installed',['admin_id'=>$wid]);
        foreach($get->result_array() as $row){
            $row['admin_id'] = $nwid;
            unset($row['id']);
            $this->db->insert('plugin_installed',$row);
        }
    }
    function copy_menu($wid,$nwid){
        $get =  $this->db->get_where('menu',['admin_id'=>$wid]);
        foreach($get->result_array() as $row){
            $old_menu_id = $row['id'];
            $row['admin_id']  = $nwid;
            unset($row['id']);
            $this->db->insert('menu',$row);
            $new_menu_id = $this->db->insert_id();
            $items = $this->db->get_where('menu_items',['admin_id'=>$wid,'menu_id'=>$old_menu_id]);
            foreach($items->result_array() as $item){
                $item['admin_id'] = $nwid;
                $item['menu_id'] = $new_menu_id;
                unset($item['id']);
                $this->db->insert('menu_items',$item);
            }
        }
        
    }
    function copy_media($wid,$nwid){
        $get = $this->db->get_where('media',['admin_id'=>$wid]);
        foreach($get->result_array() as $row){
            $row['admin_id'] = $nwid;
            unset($row['id']);
            $this->db->insert('media',$row);
            $sourceDir = FCPATH.'/public/temp/'.$wid;
            $destinationDir = FCPATH.'/public/temp/'.$nwid;
            $this->copyFiles($sourceDir, $destinationDir);
        }
    }
    function copy_other($wid,$nwid){
        $get = $this->db->get_where('others',['admin_id'=>$wid]);
        foreach($get->result_array() as $row){
            $row['admin_id'] = $nwid;
            unset($row['id']);
            $this->db->insert('others',$row);
        }
    }
    function copy_service($wid,$nwid){
        $get = $this->db->get_where('service',['admin_id'=>$wid]);
        foreach($get->result_array() as $s){
            $s['admin_id'] = $nwid;
            unset($s['id']);
            $this->db->insert('service',$s);
        }
    }
    function copy_pages($wid,$nwid){
        $arr = [];
        $pages = $this->db->get_where('pages',['admin_id'=>$wid])->result_array();
        if (!empty($pages)) {
            foreach ($pages as $index => $row) {
                $old_page_id = $row['id'];
                $row['admin_id'] = $nwid;
                unset($row['id']);
                $this->db->insert('pages',$row);
                $arr[$index] = $pageid = $this->db->insert_id();
                $content = $this->db->get_where('page_content',['admin_id'=>$wid,'page_id'=>$old_page_id]);
                if($content->num_rows()){
                    $content = $content->row();
                    $content->admin_id = $nwid;
                    $content->page_id = $pageid;
                    unset($content->id);
                    $this->db->insert('page_content',$content);
                }
                
            }
            
            $otherContents = $this->db->get_where('other_content',['admin_id'=>$wid])->result_array();
            foreach($otherContents as $oc){
                $oc['admin_id'] = $nwid;
                unset($oc['id']);
                $this->db->insert('other_content',$oc);
            }
        }
        
        if(empty($arr)){
            $this->create_default_page($nwid);
        }else{
            $firstid = $arr[0];
            $this->set_page_to_default($firstid,$nwid);
        }
    }
    function copyFiles($source, $destination) {
        // Load CodeIgniter's file helper
        $CI = &get_instance();
        $CI->load->helper('file');
    
        // Check if the source directory exists
        if (!is_dir($source)) {
            return "Source directory does not exist";
        }
    
        // Create the destination directory if it doesn't exist
        if (!is_dir($destination)) {
            if (!mkdir($destination, 0777, true)) {
                return "Failed to create destination directory";
            }
        }
    
        // Get the file list from the source directory
        $files = get_dir_file_info($source);
    
        // Loop through the file list
        foreach ($files as $file) {
            $sourcePath = $source . DIRECTORY_SEPARATOR . $file['name'];
            $destinationPath = $destination . DIRECTORY_SEPARATOR . $file['name'];
    
            // If it's a directory, recursively copy it
            if (isset($file['is_dir']) && $file['is_dir']) {
                $result = copyDirectory($sourcePath, $destinationPath);
                if ($result !== true) {
                    return $result; // Propagate the error message
                }
            } else {
                // If it's a file, copy it
                if (!copy($sourcePath, $destinationPath)) {
                    return "Failed to copy file: $sourcePath";
                }
            }
        }
    
        return true; // Success
    }

    // website create process complete 
    
    
}

?>