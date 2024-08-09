<?php 
class Editor extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model(['PageModel']);
        $this->load->helper('page');
        checkAdminLogin();
    }
    function upload(){
        
        $uploadDenyExtensions  = ['php'];
        $uploadAllowExtensions = ['ico','jpg','jpeg','png','gif','webp','svg'];
        
        
        define('UPLOAD_FOLDER', FCPATH);
        if (isset($_POST['mediaPath'])) {
        	define('UPLOAD_PATH', $this->sanitizeFileName($_POST['mediaPath']) );
        } else {
        	define('UPLOAD_PATH', DIRECTORY_SEPARATOR);
        }
        
        $fileName  = $this->sanitizeFileName($_FILES['file']['name']);
        if (!$fileName) {
        	$this->showError('Invalid filename!');
        }
        
        $extension = strtolower(substr($fileName, strrpos($fileName, '.') + 1));
        
        //check if extension is on deny list
        if (in_array($extension, $uploadDenyExtensions)) {
        	$this->showError("File type $extension not allowed!");
        }
        
        //comment deny code above and uncomment this code to change to a more restrictive allowed list
        // check if extension is on allow list
        if (!in_array($extension, $uploadAllowExtensions)) {
        	$this->showError("File type $extension not allowed!");
        }
        
        $destination = UPLOAD_FOLDER . UPLOAD_PATH . DIRECTORY_SEPARATOR . $fileName;
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
        
        if (isset($_POST['onlyFilename'])) {
        	echo $fileName;
        } else {
        	echo UPLOAD_PATH . $fileName;
        }
    }
    function showError($error) {
    	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    	die($error);
    }
    
    function sanitizeFileName($file)
    {
    	$disallow = ['.htaccess', 'passwd'];
    	$file = str_replace($disallow, '', $file);
    	
    	//sanitize, remove double dot .. and remove get parameters if any
    	$file = preg_replace('@\?.*$@' , '', preg_replace('@\.{2,}@' , '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
    	
    	return $file;
    }
    
    function sanitizePath($path) {
    	//sanitize, remove double dot .. and remove get parameters if any
    	$path = preg_replace('@/+@' , DIRECTORY_SEPARATOR, preg_replace('@\?.*$@' , '', preg_replace('@\.{2,}@' , '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $path))));
    	return $path;
    }
        
    function scan(){
        //scan media folder for all files to display in media modal
        
        if (isset($_POST['mediaPath']) && ($path = $this->sanitizePath(substr($_POST['mediaPath'], 0, 256)))) {
        	define('UPLOAD_PATH', $path);
        } else {
        	define('UPLOAD_PATH', FCPATH.'public/temp/'.CLIENT_ID);
        }
        // echo UPLOAD_PATH;exit;
        // $scandir = __DIR__ . DIRECTORY_SEPARATOR. UPLOAD_PATH;
        $scandir = UPLOAD_PATH;
        // echo $scandir;exit;
        
        // Run the recursive function
        // This function scans the files folder recursively, and builds a large array
        
        $scan = function ($dir) use ($scandir, &$scan) {
        	$files = [];
        
        	// Is there actually such a folder/file?
        
        	if (file_exists($dir)) {
        		foreach (scandir($dir) as $f) {
        			if (! $f || $f[0] == '.') {
        				continue; // Ignore hidden files
        			}
        
        			if (is_dir($dir . '/' . $f)) {
        				// The path is a folder
        
        				$files[] = [
        					'name'  => $f,
        					'type'  => 'folder',
        					'path'  => str_replace($scandir, '', $dir) . '/' . $f,
        					'items' => $scan($dir . '/' . $f), // Recursively get the contents of the folder
        				];
        			} else {
        				// It is a file
        
        				$files[] = [
        					'name' => $f,
        					'type' => 'file',
        					'path' => str_replace($scandir, '', $dir) . '/' . $f,
        					'size' => filesize($dir . '/' . $f), // Gets the size of this file
        				];
        			}
        		}
        	}
        
        	return $files;
        };
        
        $response = $scan($scandir);
        
        // Output the directory listing as JSON
        
        header('Content-type: application/json');
        
        echo json_encode([
        	'name'  => '',
        	'type'  => 'folder',
        	'path'  => '',
        	'items' => $response,
        ]);
    }
    function index(){
        $this->load->view('admin/editor/index');
    }
    
    function action(){
        $action = @$_GET['action'];
        switch($action){
            case 'delete':
                $file = FCPATH.$_POST['file'];
                if(file_exists($file)){
                    unlink($file);
                    echo 'File Deleted Successfully.';
                }else{
                    echo 'Something went wrong.';
                }
            break;
        }
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