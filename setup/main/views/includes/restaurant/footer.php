
<?php echo OtherContent('footer','cssdata'); ?>

<div class="height-emulator"></div>

       <?php 
            $content = OtherContent('footer');
            if($content != ''){
                echo $content;
            }else{
                include 'footer-content.php'; 
            }
       ?>
       </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->   

<?php 
    echo AfterFooterContent(); 
?>
    </body>
</html>
