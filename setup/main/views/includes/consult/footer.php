
<?php echo OtherContent('footer','cssdata'); ?>

       <?php 
            $content = OtherContent('footer');
            if($content != ''){
                echo $content;
            }else{
                include 'footer-content.php'; 
            }
       ?>
       <!-- #content -->
         <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
      </div>
      <!-- #page -->
<?php echo AfterFooterContent(); ?>

    </body>
</html>
