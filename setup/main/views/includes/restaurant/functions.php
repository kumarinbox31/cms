<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    $links = '  <link type="text/css" rel="stylesheet" href="'.theme_path().'css/plugins.css">
        <link type="text/css" rel="stylesheet" href="'.theme_path().'css/style.css">
           
            ';
    echo $links;
}

function registerAfterFooterContent(){
    echo '
                  <script  src="'.theme_path().'js/jquery.min.js"></script>
        <script  src="'.theme_path().'js/plugins.js"></script>
        <script  src="'.theme_path().'js/scripts.js"></script>';
}

function registerBodyClass(){
    echo '';
}
add_shortcode('navbar', function($atts, $content){
    //  [navbar id=1871 type=vertical]
     $id = @$atts['id'];
     $type = @$atts['type'] ?? 'horizontal';
     ob_start();
     include 'navbar/nav1.php';
     include 'navbar/mobile.php';
     
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
