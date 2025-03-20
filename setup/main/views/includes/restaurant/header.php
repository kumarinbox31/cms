<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo theTitle(); ?></title>        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?php echo theme_path(); ?>assets/favicon.ico" />
        <?php beforeHeadContent(); ?>
        <?php echo OtherContent('header','cssdata'); ?>
        <?php echo theContent($page_id,'cssdata'); ?>
        <style>
            .modal-backdrop{
                display:none !important;
            }
        </style>
        
    </head>
    <body <?php echo bodyClass(); ?>>
        <!-- lodaer  -->
        <!-- <div class="loader-wrap">
            <div class="loader-item">
                <div class="cd-loader-layer" data-frame="25">
                    <div class="loader-layer"></div>
                </div>
                <span class="loader"><i class="fa-thin fa-gem"></i></span>
            </div>
        </div> -->
           <!-- loader end  -->
        
    <div id="main" style="opacity: 1;">
         
       <?php 
            $content = OtherContent('header');
            if($content != ''){
                echo $content;
            }else{
                include 'header-content.php'; 
            }
       ?>
       
       <div class="header-overlay close_cart-init"></div>
       <!--  header end  -->