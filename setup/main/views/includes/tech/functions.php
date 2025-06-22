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
    <style>.modal-backdrop,.is-sticky{display:none;}.menu-style-four{background: #0000004a;
    border-radius: 10px;}</style>
    <style>
    @media(max-width:640px){
    .header-area {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000; /* Adjust as needed */
    background-color: #ffffff; /* Adjust background color as needed */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add shadow for better visibility */
}
       .header-area{
    width:100%;
    max-width:100vw !important;
}
     
    }</style>
    <link rel="stylesheet" href="https://mitech.thememove.com/wp-content/themes/mitech/style.min.css">
    
            ';
    echo $links;
    include 'header-script.php';
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
    <script>
					var mainStyle = document.getElementById( "mitech-style-inline-css");
					if ( mainStyle !== null ) {
						mainStyle.textContent += "#tm-better-custom-menu-68564088591bc .menu{text-align:left}#tm-better-custom-menu-685640885fff3 .menu{text-align:left}#tm-better-custom-menu-6856408865b6e .menu{text-align:left}#tm-better-custom-menu-685640886b763 .menu{text-align:left}#tm-row-6856408889ebd{background-color:#454545;background-image:url( https://mitech.thememove.com/wp-content/uploads/2019/02/mitech-call-to-action-image-global.png);background-repeat:no-repeat;background-position:top 35% right -68px}#tm-row-6856408889ebd{padding-top :84px !important;padding-bottom :84px !important}#tm-heading-685640888b6c0{text-align:left}#tm-heading-685640888b6c0 .heading{line-height:1.4;color:#fff}#tm-button-group-685640888be61{justify-content:flex-end}#tm-button-685640888bfe1{text-align:left}#tm-button-685640888bfe1 .tm-button{min-width:170px;color:#086ad8;border-color:#fff;background:#fff}#tm-button-685640888bfe1 .tm-button:hover{color:#fff;border-color:#086ad8;background:#086ad8}#tm-button-685640888bfe1 .tm-button .button-icon{color:#086ad8}#tm-button-685640888bfe1 .tm-button:hover .button-icon{color:#fff}#tm-button-685640888cc0d{text-align:left}#tm-button-685640888cc0d .tm-button{min-width:170px;color:#fff;border-color:#d2a98e;background:#d2a98e}#tm-button-685640888cc0d .tm-button:hover{color:#fff;border-color:#086ad8;background:#086ad8}#tm-button-685640888cc0d .tm-button .button-icon{color:#fff}#tm-button-685640888cc0d .tm-button:hover .button-icon{color:#fff}#tm-section-685640889018d{padding-top :84px !important;padding-bottom :52px !important}#tm-image-6856408890b4c{text-align:left}#tm-heading-6856408891023{text-align:left}#tm-heading-685640889141d{text-align:left}#tm-heading-685640889180e{text-align:left}#tm-heading-685640889180e .heading{font-weight:700;color:#333}#tm-heading-685640889180e .heading:hover{color:#086ad8}#tm-heading-6856408891b96{text-align:left}#tm-heading-6856408891b96 .heading{color:#086ad8}#tm-heading-6856408891b96 .heading:hover{color:#d2a98e}#tm-list-685640889228a{text-align:left}#tm-list-685640889228a{grid-template-columns:repeat(1,1fr)}#tm-list-6856408894bcb{text-align:left}#tm-list-6856408894bcb{grid-template-columns:repeat(1,1fr)}#tm-list-68564088953f4{text-align:left}#tm-list-68564088953f4{grid-template-columns:repeat(1,1fr)}#tm-button-group-6856408895c92>div{padding:5px}#tm-button-group-6856408895c92{margin:-5px;justify-content:flex-start}#tm-button-6856408895e09{text-align:left}#tm-button-685640889650b{text-align:left}#tm-heading-6856408898359{text-align:left}#tm-heading-6856408898359 .heading{color:#7e7e7e}#tm-social-networks-6856408898a6d{text-align:right}#tm-better-custom-menu-68564088a41d2 .menu{text-align:left}#tm-better-custom-menu-68564088a853f .menu{text-align:left}#tm-better-custom-menu-68564088abf83 .menu{text-align:left}#tm-better-custom-menu-68564088b01f5 .menu{text-align:left}#tm-blog-685640887e32e .modern-grid{grid-template-columns:repeat( 3,1fr);grid-column-gap:30px;grid-row-gap:65px }#tm-heading-685640888b6c0 .heading{font-size:40px }#tm-button-685640888bfe1 .button-icon{font-size:14px }#tm-button-685640888cc0d .button-icon{font-size:14px }#tm-spacer-6856408890f44{height:31px }#tm-spacer-6856408891333{height:10px }#tm-spacer-6856408891739{height:10px }#tm-spacer-6856408891ace{height:10px }#tm-spacer-6856408891e3a{height:50px }#tm-spacer-68564088920a8{height:28px }#tm-spacer-685640889476a{height:50px }#tm-spacer-6856408894a18{height:28px }#tm-spacer-6856408894ff5{height:50px }#tm-spacer-685640889525a{height:28px }#tm-spacer-68564088958ce{height:50px }#tm-spacer-6856408895c20{height:87px }#tm-spacer-68564088967f6{height:50px }#tm-spacer-6856408897c70{height:15px }@media(max-width:1199px){#tm-heading-685640888b6c0 .heading{font-size:34px }#tm-spacer-68564088920a8{height:0 }#tm-spacer-6856408894a18{height:0 }#tm-spacer-685640889525a{height:0 }#tm-spacer-6856408895c20{height:0 }}@media(max-width:992px){#tm-heading-685640888b6c0{text-align:center}#tm-button-group-685640888be61{justify-content:center}}@media(max-width:992px){#tm-blog-685640887e32e .modern-grid{grid-template-columns:repeat( 2,1fr)}#tm-heading-685640888b6c0 .heading{font-size:28px }#tm-spacer-685640888bb65{height:30px }}@media(max-width:767px){#tm-list-685640889228a{grid-template-columns:repeat(1,1fr)}#tm-list-6856408894bcb{grid-template-columns:repeat(1,1fr)}#tm-list-68564088953f4{grid-template-columns:repeat(1,1fr)}#tm-column-685640889806f{-webkit-order:3;-moz-order:3;order:3}#tm-social-networks-6856408898a6d{text-align:left}}@media(max-width:767px){#tm-blog-685640887e32e .modern-grid{grid-template-columns:repeat( 1,1fr)}#tm-spacer-685640889a279{height:30px }}";
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
     include 'navbar/nav1.php';
     include 'navbar/mobile.php';
     
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
