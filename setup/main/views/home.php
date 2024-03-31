<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo theTitle(); ?></title>
        <!-- Favicon-->
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
       
       
<?php 
    $content = theContent($page_id);
    if($content != ''){
        echo $content;
    }else{
        include 'home-content.php'; 
    }
            
?>
       
    <?php echo OtherContent('footer','cssdata'); ?>

       <?php 
            $content = OtherContent('footer');
            if($content != ''){
                echo $content;
            }else{
                include 'footer-content.php'; 
            }
       ?>
<?php echo AfterFooterContent(); ?>
    </body>
</html>
