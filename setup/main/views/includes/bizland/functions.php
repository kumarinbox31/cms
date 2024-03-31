<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    echo '
            <!-- Google Fonts -->
              <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

              <!-- Vendor CSS Files -->
              <link href="'.theme_path().'assets/vendor/aos/aos.css" rel="stylesheet">
              <link href="'.theme_path().'assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
              <link href="'.theme_path().'assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
              <link href="'.theme_path().'assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
              <link href="'.theme_path().'assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
              <link href="'.theme_path().'assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
            
              <!-- Template Main CSS File -->
              <link href="'.theme_path().'assets/css/style.css" rel="stylesheet">
            ';
}
function registerAfterFooterContent(){
    echo '
        <!-- Vendor JS Files -->
          <script src="'.theme_path().'assets/vendor/purecounter/purecounter_vanilla.js"></script>
          <script src="'.theme_path().'assets/vendor/aos/aos.js"></script>
          <script src="'.theme_path().'assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="'.theme_path().'assets/vendor/glightbox/js/glightbox.min.js"></script>
          <script src="'.theme_path().'assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
          <script src="'.theme_path().'assets/vendor/swiper/swiper-bundle.min.js"></script>
          <script src="'.theme_path().'assets/vendor/waypoints/noframework.waypoints.js"></script>
          <script src="'.theme_path().'assets/vendor/php-email-form/validate.js"></script>
        
          <!-- Template Main JS File -->
          <script src="'.theme_path().'assets/js/main.js"></script>
        ';
}

function registerBodyClass(){
    return [];
}

add_shortcode('navbar', function($atts, $content){
    //  [navbar id=1871 type=vertical]
     $id = @$atts['id'];
     $type = @$atts['type'] ?? 'horizontal';
     ob_start();
     if($type == 'vertical'){
         $arr = [
            'id' => '',
            'class' => '',
            'itemClass'    =>  '',
            'anchorClass'  =>  '',
            'dropdownUlClass'   => '',
            'childItemClass'    => '',
            'childAnchorClass'  => '',
            'childActiveClass'  => '',
            'dropdownLiClass'   => '',
            'dropdownAnchorClass'   => '',
            'extendBefore'      =>  '',
            'extendAfter'       =>  '',
        ];
        $items = $this->MenuModel->items($id)['items'];
        print $this->MenuModel->get_menu($items,$arr);
     }else{
     echo '
      <nav id="navbar" class="navbar">
        ';
        $arr = [
            'id' => '',
            'class' => '',
            'itemClass'    =>  '',
            'anchorClass'  =>  'nav-link scrollto',
            'dropdownUlClass'   => '',
            'childItemClass'    => '',
            'childAnchorClass'  => '',
            'childActiveClass'  => '',
            'dropdownLiClass'   => 'dropdown',
            'dropdownAnchorClass'   => '',
            'extendBefore'      =>  '',
            'extendAfter'       =>  '',
        ];
        $items = $this->MenuModel->items($id)['items'];
        print $this->MenuModel->get_menu($items,$arr);
       echo '<i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
';
}
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
