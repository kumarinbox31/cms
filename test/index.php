<?php 
error_reporting(E_ALL);ini_set('display_errors',1);
define('BASE_URL','http://builder.webfire.in/');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Latest Builder</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>grapes/stylesheets/toastr.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>grapes/stylesheets/grapes.min44a5.css?v0.20.4">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>grapes/stylesheets/grapesjs-preset-webpage.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>grapes/stylesheets/tooltip.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>grapes/stylesheets/demos43a0.css?v3">
    <link href="https://unpkg.com/grapick%400.1.13/dist/grapick.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>grapes/js/toastr.min.js"></script>
    <script src="<?php echo BASE_URL; ?>grapes/js/grapes.min44a5.js?v0.20.4"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage@1.0.2"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-plugin-forms@2.0.5"></script>
    <script src="https://unpkg.com/grapesjs-component-countdown@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-plugin-export@1.0.11"></script>
    <script src="https://unpkg.com/grapesjs-tabs@1.0.6"></script>
    <script src="https://unpkg.com/grapesjs-custom-code@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-touch@0.1.1"></script>
    <script src="https://unpkg.com/grapesjs-parser-postcss@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-tooltip@0.1.7"></script>
    <script src="https://unpkg.com/grapesjs-tui-image-editor@0.1.3"></script>
    <script src="https://unpkg.com/grapesjs-typed@1.0.5"></script>
    <script src="https://unpkg.com/grapesjs-style-bg@2.0.1"></script>
    
    <!--plugins-->
    <!--<script src="<?php echo BASE_URL; ?>grapes/js/grapesjs-swiper-slider.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/grapesjs-plugin-toolbox@1.0.15/dist/grapesjs-plugin-toolbox.min.css">
    <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-toolbox@1.0.15/dist/grapesjs-plugin-toolbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tui-image-editor/3.15.3/tui-image-editor.min.js" integrity="sha512-4lHicwUPQyVVqx9A44RFapN5YupVcznj5XkZ8b1Ui7CzoW5y71NHUeFwBs0KxJ+y4B8C1OU9UqMMZ3URjUJP3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tui-image-editor/3.15.3/tui-image-editor.css" integrity="sha512-rdyMgYMWTZuwr0uV3jGZi/CWt59D+QUNLGjYWzgFin1rU6SfV585NpHh5fXa/ILnB5V1iY0Ey7BADuegwqx6GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="grapes/custom.css">
    
  </head>
  <body>
    <div style="display: none">
      <div class="gjs-logo-cont">
        <h5>Home</h5>
        <div class="gjs-logo-version"></div>
      </div>
    </div>

    <div id="gjs" style="height:0px; overflow:hidden">
  </div>

    <script type="text/javascript" src="grapes/custom.js">
        var savepathurl = <?php echo ('save.php')?>;
    </script>
  </body>
</html>
