
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
