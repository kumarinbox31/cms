<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    echo '
            <!-- animate css -->
    		<link rel="stylesheet" href="'.theme_path().'css/animate.min.css">
    		<!-- bootstrap css -->
    		<link rel="stylesheet" href="'.theme_path().'css/bootstrap.min.css">
    		<!-- font-awesome -->
    		<link rel="stylesheet" href="'.theme_path().'css/font-awesome.min.css">
    		<!-- google font -->
    		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800" rel="stylesheet" type="text/css">
    
    		<!-- custom css -->
    		<link rel="stylesheet" href="'.theme_path().'css/templatemo-style.css">
            ';
}

function registerAfterFooterContent(){
    echo '
        <script src="'.theme_path().'js/jquery.js"></script>
		<script src="'.theme_path().'js/bootstrap.min.js"></script>
		<script src="'.theme_path().'js/wow.min.js"></script>
	<!--	<script src="'.theme_path().'js/jquery.singlePageNav.min.js"></script> -->
		<script src="'.theme_path().'js/custom.js"></script>
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
     echo '
     <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
					</button>
					<a href="/" class="navbar-brand"><img src="'.LOGO.'" style="width:100px;"></a>
				</div>
				<div class="collapse navbar-collapse">
        ';
        $arr = [
            'id' => '',
            'class' => 'nav navbar-nav navbar-right text-uppercase',
            'itemClass'    =>  '',
            'anchorClass'  =>  '',
            'dropdownUlClass'   => '',
            'childItemClass'    => '',
            'childAnchorClass'  => '',
            'childActiveClass'  => 'current',
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


