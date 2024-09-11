<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    $links = '
       <link rel="stylesheet" href="'.theme_path().'assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="'.theme_path().'assets/css/swiper-bundle.min.css">
        <link rel="stylesheet" href="'.theme_path().'assets/css/scrollCue.css">
        <link rel="stylesheet" href="'.theme_path().'assets/css/remixicon.css">
        <link rel="stylesheet" href="'.theme_path().'assets/css/flaticon.css">
        <link rel="stylesheet" href="'.theme_path().'assets/css/style.css">
        <link rel="stylesheet" href="'.theme_path().'assets/css/responsive.css">
            ';
    echo $links;
}

function registerAfterFooterContent(){
    echo '
          <script src="'.theme_path().'assets/js/swiper-bundle.min.js"></script>
        <script src="'.theme_path().'assets/js/fslightbox.js"></script>
        <script src="'.theme_path().'assets/js/scrollCue.min.js"></script>
        <script src="'.theme_path().'assets/js/custom.js"></script>
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
     include 'navbar/nav.php';
     include 'navbar/responsive.php';
     
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
