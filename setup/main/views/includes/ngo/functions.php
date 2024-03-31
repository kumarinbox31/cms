<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    $links = '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

            ';
    echo $links;
}

function registerAfterFooterContent(){
    echo '
          ';
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
