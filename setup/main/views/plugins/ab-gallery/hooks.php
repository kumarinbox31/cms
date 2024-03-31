<?
add_shortcode('AB-Gallery', function($atts, $content){
    //  [AB-Slider id=1 ]
    $id = intval(@$atts['id']);
    $ci = &get_instance();
    $get = $this->ServiceModel->getServiceById($id)->row();;
    $content = @$get->content;
    
     ob_start();
       ?>
       <main class="gallery-main">
          <div class="gallery-container">
              <?php 
                $get = $this->ServiceModel->getService(['type'=>'ab-gallery-item','parent'=>$id]);
                foreach($get->result() as $row){
                    $image = $row->image == '' ? '' : $row->image;
                     $content = $row->content;
                    echo '<div class="gallery-card">
                          <div class="card-image">
                            <a href="'.$image.'" data-fancybox="gallery" data-caption="Caption Images 1">
                              <img src="'.$image.'" alt="Image Gallery" style="width:100%;">
                            </a>
                          </div>
                        </div>';
                }
           ?>
                
          </div>
        </main>
       <?
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});

add_action('ab_head', function(){
     echo ' 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="'.base_url('public/plugins/ab-gallery/style.css').'">
    ';
});
add_action('ab_footer', function(){
    ?>
    <!-- AB gallery  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <script>
        // Fancybox Configuration
        $('[data-fancybox="gallery"]').fancybox({
          buttons: [
            "slideShow",
            "thumbs",
            "zoom",
            "fullScreen",
            "share",
            "close"
          ],
          loop: false,
          protect: true
        });
        
    </script>
    <!-- AB gallery  -->
    <?
});

