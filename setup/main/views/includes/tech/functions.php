<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    $links = '
            <!-- Font Family CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->

    <link rel="stylesheet" href="'.theme_path().'assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="'.theme_path().'assets/css/plugins/plugins.min.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="'.theme_path().'assets/css/style.css">
            ';
    echo $links;
}

function registerAfterFooterContent(){
    echo '
          <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="'.theme_path().'assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- jQuery JS -->
    <script src="'.theme_path().'assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="'.theme_path().'assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="'.theme_path().'assets/js/vendor/bootstrap.min.js"></script>

    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->

    <script src="'.theme_path().'assets/js/plugins/plugins.min.js"></script>

    <!-- Main JS -->
    <script src="'.theme_path().'assets/js/main.js"></script>
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
