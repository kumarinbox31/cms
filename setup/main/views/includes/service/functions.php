<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    ob_start();
    include 'header-script.php';
    $html = ob_get_contents();
	 ob_end_clean();
	 echo $html;
}

function registerAfterFooterContent(){
    ob_start();
    include 'footer-script.php';
    $html = ob_get_contents();
	 ob_end_clean();
	 echo $html;
}

function registerBodyClass(){
    echo 'home page-template-default page page-id-2254 theme-xclean woocommerce-no-js  pbmit-top-menu-total-6 pbmit-sidebar-no elementor-default elementor-kit-5 elementor-page elementor-page-2254';
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
