<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    ob_start();
    ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shadows+Into%20Light&amp;display=swap" media="all" id="shr-font-shadows-into light">
    <link rel="stylesheet" href="<?php echo theme_path(); ?>theme4/use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="<?php echo theme_path(); ?>theme4/templates/template6/t6-style.css" rel="stylesheet">
    <link href="<?php echo theme_path(); ?>theme4/templates/common/css/star-rating.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo theme_path(); ?>theme4/cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"> 
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shadows+Into%20Light&amp;display=swap" media="all" id="shr-font-shadows-into light">
    <link rel="stylesheet" href="<?php echo theme_path(); ?>theme4/use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="<?php echo theme_path(); ?>theme4/templates/template6/t6-style.css" rel="stylesheet">
    <link href="<?php echo theme_path(); ?>theme4/templates/common/css/star-rating.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo theme_path(); ?>theme4/cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">
    <link rel="manifest" id="manifest-placeholder">
       
       <script>
           function ColorLuminance(hex, lum) {
               // validate hex string
               hex = String(hex).replace(/[^0-9a-f]/gi, '');
               if (hex.length < 6) {
                   hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
               }
               lum = lum || 0;

               // convert to decimal and change luminosity
               var rgb = "#", c, i;
               for (i = 0; i < 3; i++) {
                   c = parseInt(hex.substr(i*2,2), 16);
                   c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                   rgb += ("00"+c).substr(c.length);
               }

               return rgb;
           }
           document.documentElement.style.setProperty('--theme-color', '#F17D3A');
           document.documentElement.style.setProperty('--theme-color-light', '#F17D3A26');
           document.documentElement.style.setProperty('--theme-color-100', '#F17D3A');
           document.documentElement.style.setProperty('--theme-color-75', '#F17D3A90');
           document.documentElement.style.setProperty('--theme-color-50', '#F17D3A80');
           document.documentElement.style.setProperty('--theme-color-25', '#F17D3A70');
       </script>
       
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
          body{ top: 0 !important;}
.goog-te-banner-frame{display:none !important;}
            .goog-logo-link 
               {
               display:none !important;
               } 
            .goog-te-gadget
               {
               color: transparent !important;
               } 
.goog-te-combo{
                   background-color: white;
               color:#000!important;
               border:none;
               color: #3f3f3f;
               padding: 6px 0px!important;
               width: 140px;
               margin:2px 2px 2px 0px!important;
               height:34px;
            }
.goog-te-combo option{color:#333!important}


</style>  


    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}

function registerAfterFooterContent(){
    ob_start();
    ?>
          <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="<?php echo theme_path(); ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- jQuery JS -->
    <script src="<?php echo theme_path(); ?>assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="<?php echo theme_path(); ?>assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?php echo theme_path(); ?>assets/js/vendor/bootstrap.min.js"></script>

    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->

    <script src="<?php echo theme_path(); ?>assets/js/plugins/plugins.min.js"></script>

    <!-- Main JS -->
    <script src="<?php echo theme_path(); ?>assets/js/main.js"></script>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
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
