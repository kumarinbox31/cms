<?php echo OtherContent('footer','cssdata'); ?>

       <?php 
            $content = OtherContent('footer');
            if($content != ''){
                echo $content;
            }else{
                include 'footer-content.php'; 
            }
       ?>

       <!-- Back to Top -->
       <button type="button" id="back-to-top">
            <i class="ri-arrow-up-double-fill"></i>
        </button>
        <!-- End Back to Top -->
<?php 
    echo AfterFooterContent(); 
?>
    </body>
</html>
