 <?php 
    $id = intval(@$_GET['id']);
    $ci = &get_instance();
    $get = $this->ServiceModel->getServiceById($id)->row();
 ?>
 <!-- Splide CSS -->
  <link rel="stylesheet" href="https://unpkg.com/@splidejs/splide@3.0.0/dist/css/splide.min.css">
<style>
    #preview > *{
        width:200px;
        height:100px;
    }
</style>
<div id="msg"></div>
<div id="preview"></div>
<div class="btn btn-sm btn-primary media-manager" data-value="#selected-image" data-preview="#preview" data-accept=".jpg,.png" data-multiple="true">
    Select Images
</div>
<a id="save-button" class="btn btn-sm btn-success">Save Images</a>
<input type="hidden" id="selected-image">

<div class="splide">
  <div class="splide__track">
    <ul class="splide__list">
      <?php 
        if($get->image == ''){
            echo '<li class="splide__slide"><img src="https://source.unsplash.com/random/?sig=1"  style="height:500px;width:100%;"/></li>
                  <li class="splide__slide"><img src="https://source.unsplash.com/random/?sig=2" style="height:500px;width:100%;" /></li>
                  <li class="splide__slide"><img src="https://source.unsplash.com/random/?sig=4"  style="height:500px;width:100%;"/></li>';
        }else{
            foreach(explode(',',$get->image) as $img){
                echo '<li class="splide__slide"><img src="'.$img.'"  style="height:500px;width:100%;"/></li>';
            }
        }
      ?>
      <!-- Add more slides as needed -->
    </ul>
  </div>
</div>

<?php 
    add_action('ab-admin-footer',function(){
        $id = intval(@$_GET['id']);
        ?>
  <!-- Splide JS -->
  <script src="https://unpkg.com/@splidejs/splide@3.0.0/dist/js/splide.min.js"></script>
  <script>
      $(document).ready(function(){
        new Splide('.splide', {
          type       : 'fade', // Change type to 'fade', 'loop', etc. for different effects
          perPage    : 1,        // Number of slides to display at once
          autoplay   : true,     // Autoplay slides
          interval   : 2000,     // Autoplay interval in milliseconds
          rewind     : true,     // Rewind to the first slide after the last one
          breakpoints: {
            600: {
              perPage: 1,        // Number of slides to display at 600px screen width
            }
          }
        }).mount();
      });
      $('#save-button').on('click', function() {
            $.ajax({
                url: "<?php echo current_url(); ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    action: "update-service",
                    image: $('#selected-image').val(),
                    id: "<?php echo $id; ?>"
                },
                beforeSend: function(){
                    // You can add loading indicators or other tasks here
                },
                success: function(res){
                    if(res.status){
                        $('#msg').html('<div class="alert alert-success">Slider data saved successfully!</div>');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    } else {
                        $('#msg').html('<div class="alert alert-danger">Failed to save form data or no changes.</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#msg').html('Error: ' + error);
                }
            });
            // Do something with the form data
            console.log(formData);
        });
    </script>

    <?
    });
?>