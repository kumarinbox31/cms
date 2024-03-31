<?php 
class Editor extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model(['PageModel']);
    }
    
    function index(){
        $this->load->view('admin/editor/index');
    }
    
    function action(){
        print_r($post);exit;
    }
    
    function edit($type='page',$id=0){
        $this->load->helper('page');
        $get = $this->PageModel->pageContent($id);
        echo beforeHeadContent();
        echo $get['css'];
        // echo '<div id="AjaxHeaderContent">';
        // echo OtherContent('header','content',true);
        // echo '</div>';
        echo '<div id="AjaxHomeContent">';
        echo $get['html'];
        echo '</div>';
        // echo '<div id="AjaxFooterContent">';
        // echo OtherContent('footer','content',true);
        // echo '</div>';
        echo AfterFooterContent();
    }
    
    function save_page_content(){
        if($post = $this->input->post()){
            if(isset($post['html'])){
                $htmldata = htmlEncode($post['html']);
                $pageId = $post['file'];
                $chk = $this->db->get_where('page_content',['page_id'=>$pageId,'admin_id'=>CLIENT_ID]);
                if($chk->num_rows()){
                    $this->db->where(['page_id'=>$pageId,'admin_id'=>CLIENT_ID])->update('page_content',['content'=>$htmldata]);
                }else{
                    $this->db->insert('page_content',['cssdata'=>'','content'=>$htmldata,'page_id'=>$pageId,'admin_id'=>CLIENT_ID]);
                }
                echo 'Saved successfully.';
            }else{
                echo 'Something went wrong';
            }
        }
    }
    function removeExtra($html) {
        $html = $this->extractByTagName('body',$html);
        return $html;
        $arr_search = ['<html>', '</html>', '<head>', '</head>', '<body data-new-gr-c-s-check-loaded="14.1154.0" data-gr-ext-installed>', '</body>', '<body>'];
        $arr_replace = '';
        
        $html = str_replace($arr_search, $arr_replace, $html);
        
        return $html;
    }
    function extractById($target,$htmlContent){
        $dom = new DOMDocument;
        // Load the HTML into the DOMDocument
        $dom->loadHTML($htmlContent);
        
        // Locate the div with the specified ID
        $targetDiv = $dom->getElementById($target);
        
        // Check if the div is found
        if ($targetDiv !== null) {
            // Get the content inside the div
            $divContent = $dom->saveHTML($targetDiv);
        
            // Output the content
            return $divContent;
        } else {
            // Output an error message if the div is not found
            return false;
        }
    }
    function extractByTagName($tag, $htmlContent) {
        // Create a DOMDocument object
        $dom = new DOMDocument;
    
        try {
            // Load the HTML into the DOMDocument
            $dom->loadHTML($htmlContent);
        } catch (Exception $e) {
            // Handle the exception (e.g., log the error)
            return false;
        }
    
        // Get the specified tag element
        $element = $dom->getElementsByTagName($tag)->item(0);
    
        // Check if the tag element is found
        if ($element !== null) {
            // Extract content between opening and closing tags
            $content = '';
            foreach ($element->childNodes as $child) {
                $content .= $dom->saveHTML($child);
            }
    
            // Return the content
            return $content;
        } else {
            // Return false if the tag element is not found
            return false;
        }
    }


}
?>