<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    $links = '
            <!-- slider stylesheet -->
              <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
            
              <!-- bootstrap core css -->
              <link rel="stylesheet" type="text/css" href="'.theme_path().'css/bootstrap.css" />
            
              <!-- fonts style -->
              <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet" />
            
              <!-- Custom styles for this template -->
              <link href="'.theme_path().'css/style.css" rel="stylesheet" />
              <!-- responsive style -->
              <link href="'.theme_path().'css/responsive.css" rel="stylesheet" />
            ';
    echo $links;
}

function registerAfterFooterContent(){
    echo '
          <script type="text/javascript" src="'.theme_path().'js/jquery-3.4.1.min.js"></script>
          <script type="text/javascript" src="'.theme_path().'js/bootstrap.js"></script>
        
          <script>
            // This example adds a marker to indicate the position of Bondi Beach in Sydney,
            // Australia.
            function initMap() {
              var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 11,
                center: {
                  lat: 40.645037,
                  lng: -73.880224
                }
              });
        
              var image = "images/maps-and-flags.png";
              var beachMarker = new google.maps.Marker({
                position: {
                  lat: 40.645037,
                  lng: -73.880224
                },
                map: map,
                icon: image
              });
            }
          </script>
          <!-- google map js -->
        
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap">
          </script>
          <!-- end google map js -->
        
          <script>
            function openNav() {
              document.getElementById("myNav").style.width = "100%";
            }
        
            function closeNav() {
              document.getElementById("myNav").style.width = "0%";
            }
          </script>
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
     echo '
     <nav class="navbar navbar-expand-lg custom_nav-container " role="navigation">
        <a class="navbar-brand" href="index.html">
            <img src="'.theme_path().'images/logo.png" alt="">
            <span>
              Brighton
            </span>
          </a>
			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
				<div class="class="navbar-collapse collapse" id="navbarSupportedContent" >
				<div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
        ';
        $arr = [
            'id' => '',
            'class' => 'navbar-nav ',
            'itemClass'    =>  'nav-item ',
            'anchorClass'  =>  'nav-link',
            'dropdownUlClass'   => '',
            'childItemClass'    => '',
            'childAnchorClass'  => '',
            'childActiveClass'  => 'active',
            'dropdownLiClass'   => 'dropdown',
            'dropdownAnchorClass'   => '',
            'extendBefore'      =>  '<nav id="navbar" '.($type == 'horizontal' ? 'class="navbar"' : '').'>',
            'extendAfter'       =>  '</nav>',
        ];
        $items = $this->MenuModel->items($id)['items'];
        print $this->MenuModel->get_menu($items,$arr);
       echo '</div>
			</div>
		</nav>';
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
