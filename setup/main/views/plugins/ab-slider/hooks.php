<?
add_shortcode('AB-Slider', function($atts, $content){
    //  [AB-Slider id=1 ]
    $id = intval(@$atts['id']);
    $ci = &get_instance();
    $get = $this->ServiceModel->getServiceById($id)->row();
    $content = json_decode($get->content);
     ob_start();
       ?>
       <style>
           .slick-dots{
               bottom:0;
           }
       </style>
       <!-- Slider Container -->
    <div class="slider <?php echo @$content->layout == 'Boxed' ? 'slider-boxed' : '';?>" >
        <?php 
           $get = $this->ServiceModel->getService(['type'=>'ab-slider-item','parent'=>$id]);
            foreach($get->result() as $row){
                // https://via.placeholder.com/600x600
                $image = $row->image == '' ? '' : $row->image;
                $content = $row->content;
        ?>
        <!-- Slide 1 -->
        <div class="slide" style="height:<?php echo @$content->size->height ?? '500px' ?>">
            <?php if($image != ''){?>
            <img src="<?php echo $image; ?>" alt="Slide 1" style="width:<?php echo $content->size->width ?? '100%'; ?>;">
            <?php }if($content != ''){ ?>
             <div class="slider-content" >
                <?php echo $content; ?>
            </div> 
            <?php } ?>
        </div>
        <?php 
            }
        ?>
    </div>
       <?
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});

add_action('ab_footer', 'ab_slider_script');
add_action('ab_head', 'ab_slider_style');

function ab_slider_style(){
    echo ' 
    <!-- AB SLIDER  -->
    <!-- Include Slick CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <!-- Include Slick theme CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <style>
        .slide {
        position: relative;
        text-align: center;
        color: #fff;
    }

    .slider-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /*display: flex;*/
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px; /* Adjust padding as needed */
        box-sizing: border-box;
        <!-- background-color: rgba(0, 0, 0, 0.5); /* Adjust background color and opacity */ -->
    }
    </style>
    <style>
        @media(min-width:640px){
            .slider-boxed{
                margin-left:100px!important;
                margin-right:100px !important;
            }
        }
        .slider{
            margin:0;
            overflow:hidden;
        }
        .slide > img{
            height:100vh !important;
        }
        @media(max-width:840px){
            .slide{
                height:250px!important;
            }
            .slide > img{
                height:250px!important;
            }
        }
        @media(max-width:1000px) and (min-width:840px){
            .slide{
                height:350px!important;
            }
            .slide > img{
                height:350px!important;
            }
        }
    </style>
    <!-- AB SLIDER  -->
    ';
}

function ab_slider_script(){
    ?>
    <!-- AB SLIDER  -->
     <!-- Include Slick JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

    <script>
        // Initialize Slick slider
        $(document).ready(function(){
            $('.slider').slick({
                autoplay: true,
                autoplaySpeed: 3000, // Autoplay speed in milliseconds
                arrows: true,
                dots: true,
                fade: true, // Enables fading animation
                speed: 1000, // Animation speed in milliseconds
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                        }
                    }
                ]
            });
        });
    </script>
    <!-- AB SLIDER  -->
<?
}

