<?php
class PluginModel extends MY_Model{
    public $table = 'plugins';
    public $table2 = 'plugin_installed';
    
    function getAllPlugins(){
        return $this->get(['status'=>'1']);
    }
    function pluginInfo($id){
        return $this->get(['id'=>$id]);
    }
    function getAllInstalledPlugins($wh=[]){
        if($wh != [])
            $this->db->where($wh);
        return $this->db->get_where($this->table2,['admin_id'=>CLIENT_ID]);
    }
    function uninstallPlugin($id){
        $upd = [
            'status'=> '0'
        ];
        return $this->db->where(['id'=>$id,'admin_id'=>CLIENT_ID])->update($this->table2,$upd);
    }
    function reinstallPlugin($id){
        $upd = [
            'status'=> '1'
        ];
        return $this->db->where(['id'=>$id,'admin_id'=>CLIENT_ID])->update($this->table2,$upd);
    }
    function installPlugin($id){
        $get = $this->db->get_where($this->table2,['plugin_id'=>$id,'admin_id'=>CLIENT_ID]);
        if($get->num_rows()){
            $row = $get->row();
            if($row->status){
                return ['status'=>2,'msg'=>'plugin already installed'];
            }else{
                $this->ActivateInstalledPlugin($row->id);
                return ['status'=> 3,'msg'=>'Again successfully activated plugin'];
            }
        }else{
            $this->addPlugin($id);
            return ['status'=>0,'msg'=>'Successfully plugin activated.'];
        }
    }
    function addPlugin($id){
        $data = [
            'plugin_id'     => $id,
            'admin_id'      => CLIENT_ID,
            'start_time'    => time(),
            'end_time'      => strtotime('+one year', time()),
            'status'        => '1',
        ];
        return $this->db->insert($this->table2,$data);
    }
    function ActivateInstalledPlugin($id){
        $upd = [
            'status'=> '1'
        ];
        return $this->db->where(['id'=>$id,'admin_id'=>CLIENT_ID])->update($this->table2,$upd);
    }
    function chkInstalledPlugin($id,$flag=false,$wh=[]){
        $get = $this->db->get_where($this->table2,$wh);
        if($get->num_rows()){
            if($flag)
                return $get->row();
        }
        return $get->num_rows();
    }
    function isPluginActiveByPath($path){
        $get = $this->db->get_where($this->table,['path'=>$path]);
    }
    // function loadAllInstalledPluginFiles($name = 'admin/sidebar') {
    //     $installedPlugins = $this->getAllInstalledPlugins(['status' => '1'])->result();
    
    //     foreach ($installedPlugins as $row) {
    //         $pluginInfo = $this->pluginInfo($row->plugin_id)->row();
    
    //         // Build the file path
    //         $filePath = APPPATH . "views/plugins/{$pluginInfo->path}/$name.php";
    
    //         // Check if the file exists
    //         if (file_exists($filePath)) {
    //             // Include the file
    //             include $filePath;
    //         } else {
    //             // Display a message or handle the missing file scenario
    //             echo "File not found: $filePath";
    //             // You might want to consider logging this issue for further investigation
    //         }
    //     }
    // }

    
}