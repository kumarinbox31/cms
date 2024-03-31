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
        
    </head>
    <body <?php echo bodyClass(); ?>>
        
       <?php 
            $content = OtherContent('header');
            if($content != ''){
                echo $content;
            }else{
                include 'header-content.php'; 
            }
       ?>