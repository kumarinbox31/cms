
<?php 
            $content = theContent($page_id);
            if($content != ''){
                echo $content;
            }else{
                include 'home-content.php'; 
            }
       ?>