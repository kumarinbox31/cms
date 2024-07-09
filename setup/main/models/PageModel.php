<?php
class PageModel extends MY_Model{
    public $table = 'ab_pages';
    function count(){
        return $this->get(['admin_id'=>CLIENT_ID,'trash'=>'0'])->num_rows();
    }
    function pages(){
        $get = $this->get(['admin_id'=>CLIENT_ID,'trash'=>'0']);
        $pages = [];
        foreach($get->result() as $index => $row){
            $pages[$row->uri]=[
                'name' =>$row->page_name,
                'filename' =>$row->page_name,
                'file' =>$row->id,
                'url' =>base_url('editor/edit/page/').$row->id,
                'title' => $row->page_name,
                'folder' => '',
                'description'=> '',
            ];
        }
        $pages['header'] = [
            'name' =>  'Header',
            'filename' => 'header',
            'file' => 'header',
            'url' => base_url('editor/edit/header'),
            'title' => 'Header',
            'folder' => '',
            'description' => '',
        ];
        $pages['footer'] = [
            'name' =>  'Footer',
            'filename' => 'footer',
            'file' => 'footer',
            'url' => base_url('editor/edit/footer'),
            'title' => 'Footer',
            'folder' => '',
            'description' => '',
        ];
        echo (json_encode($pages));
    }
    function pageContent($pageid){
        $get = $this->db->get_where('ab_page_content',['admin_id'=>CLIENT_ID,'page_id'=>$pageid]);
        if($get->num_rows()){
            $css = '<style>'.htmlDecode(@$get->row()->cssdata).'</style>';
            $html = htmlDecode(@$get->row()->content);
        }else{
            $html = $css = '';
        }
        $html = $html != '' ? $html : $this->load->view('includes/'.THEMEPATH.'/home-content',[],true);
        
        return ['html'=>$html,'css'=>$css];
    }
}