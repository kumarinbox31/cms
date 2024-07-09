<?php 
class Editor extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model(['PageModel']);
        $this->load->helper('page');
        checkAdminLogin();
    }
    
    function index(){
        $this->load->view('admin/editor/index');
    }
    
    function action(){
        print_r($_POST);exit('HI');
    }
    
    function edit($type='page',$id=0){
        echo beforeHeadContent();
        if($type == 'header'){
            echo '<style>';
            echo OtherContent('header','cssdata',true);
            echo '</style>';
            echo OtherContent('header','content',true);
        }elseif($type == 'page'){
            $get = $this->PageModel->pageContent($id);
            echo $get['css'];
            echo $get['html'];
        }elseif($type == 'footer'){
            echo '<style>';
            echo OtherContent('footer','cssdata',true);
            echo '</style>';
            echo OtherContent('footer','content',true);
        }
        echo AfterFooterContent();
    }
    
  function save_page_content(){
    if($post = $this->input->post()){
        if(isset($post['html'])){
            $htmldata = $post['html'];
            $pattern = '#<body[^>]*>(.*?)</body>#is';
            if (preg_match($pattern, $htmldata, $matches)) {
                $bodyContent = $matches[1];
                $html = preg_replace(['#<script[^>]*>.*?</script>#is', '#<link[^>]*>#is'], '', $bodyContent);

            } else {
                die('No match found for the body tag.');
            }

            // Match the content within the <style id="vvvebjs-styles"></style> tag
            $pattern = '#<style id="vvvebjs-styles"[^>]*>(.*?)</style>#is';
            $styleContent = '';
            if (preg_match($pattern, $htmldata, $matches)) {
                $styleContent = '<style id="vvvebjs-styles">' . $matches[1] . '</style>';
            }

            // Combine the style content with the cleaned body content
            $full_html = $styleContent . $html;
            $full_html = htmlEncode($full_html);

            // Save the combined content into the database
            $pageId = $post['file'];
            if($pageId == 'header' || $pageId == 'footer'){
                $chk = $this->db->get_where('other_content',['type'=>$pageId,'admin_id'=>CLIENT_ID]);
                if($chk->num_rows()){
                    $this->db->where(['type'=>$pageId,'admin_id'=>CLIENT_ID])->update('other_content',['content'=>$full_html]);
                }else{
                    $this->db->insert('other_content',['content'=>$full_html,'type'=>$pageId,'admin_id'=>CLIENT_ID]);
                }
            }else{
                $chk = $this->db->get_where('page_content', ['page_id' => $pageId, 'admin_id' => CLIENT_ID]);
                if ($chk->num_rows()) {
                    $this->db->where(['page_id' => $pageId, 'admin_id' => CLIENT_ID])->update('page_content', ['content' => $full_html]);
                } else {
                    $this->db->insert('page_content', ['cssdata' => '', 'content' => $full_html, 'page_id' => $pageId, 'admin_id' => CLIENT_ID]);
                }
            }
            echo 'Saved successfully.';
        } else {
            echo 'Something went wrong';
        }
    }
}

// function removeExtra($html) {
    //     $html = $this->extractByTagName('body',$html);
    //     return $html;
    //     $arr_search = ['<html>', '</html>', '<head>', '</head>', '<body data-new-gr-c-s-check-loaded="14.1154.0" data-gr-ext-installed>', '</body>', '<body>'];
    //     $arr_replace = '';
        
    //     $html = str_replace($arr_search, $arr_replace, $html);
        
    //     return $html;
    // }
    // function extractById($target,$htmlContent){
    //     $dom = new DOMDocument;
    //     // Load the HTML into the DOMDocument
    //     $dom->loadHTML($htmlContent);
        
    //     // Locate the div with the specified ID
    //     $targetDiv = $dom->getElementById($target);
        
    //     // Check if the div is found
    //     if ($targetDiv !== null) {
    //         // Get the content inside the div
    //         $divContent = $dom->saveHTML($targetDiv);
        
    //         // Output the content
    //         return $divContent;
    //     } else {
    //         // Output an error message if the div is not found
    //         return false;
    //     }
    // }
    // function extractByTagName($tag, $htmlContent) {
    //     // Create a DOMDocument object
    //     $dom = new DOMDocument;
    
    //     try {
    //         // Load the HTML into the DOMDocument
    //         $dom->loadHTML($htmlContent);
    //     } catch (Exception $e) {
    //         // Handle the exception (e.g., log the error)
    //         return false;
    //     }
    
    //     // Get the specified tag element
    //     $element = $dom->getElementsByTagName($tag)->item(0);
    
    //     // Check if the tag element is found
    //     if ($element !== null) {
    //         // Extract content between opening and closing tags
    //         $content = '';
    //         foreach ($element->childNodes as $child) {
    //             $content .= $dom->saveHTML($child);
    //         }
    
    //         // Return the content
    //         return $content;
    //     } else {
    //         // Return false if the tag element is not found
    //         return false;
    //     }
    // }


}
?>