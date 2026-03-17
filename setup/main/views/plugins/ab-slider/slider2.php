<?php
add_shortcode('AB-Slider', function($atts, $content){
    $id = intval(@$atts['id']);
    $ci = &get_instance();
    $get = $this->ServiceModel->getServiceById($id)->row();
    $content_data = empty($get->content) ? [] : json_decode($get->content);
    
    ob_start();
?>
<div class="main-slider-container">
    <div class="slider-init <?php echo @$content_data->layout == 'Boxed' ? 'slider-boxed' : ''; ?>">
    <?php 
    $get = $this->ServiceModel->getService(['type'=>'ab-slider-item','parent'=>$id]);
    foreach($get->result() as $row){
        $image = $row->image ?? '';
        $content = $row->content;
    ?>
        <div class="slide-item">
            <?php if($image){ ?>
                <div class="slide-bg-image" style="background-image: url('<?php echo $image; ?>');"></div>
            <?php } ?>

            <div class="slide-overlay"></div>
            
            <div class="slide-inner-content">
                <div class="container">
                    <div class="content-box">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>
<?php
     $html = ob_get_contents();
     ob_end_clean();
     return $html;
});

add_action('ab_footer', 'ab_slider_script');
add_action('ab_head', 'ab_slider_style');

function ab_slider_style(){
echo '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<style>
/* Base Setup */
.main-slider-container {
    position: relative;
    width: 100%;
    background: #000;
    overflow: hidden;
}

.slider-init {
    margin-bottom: 0 !important;
}

.slide-item {
    position: relative;
    height: 600px;
    display: flex !important;
    align-items: center;
    outline: none;
    overflow: hidden;
}

.slide-bg-image {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    transition: transform 8s ease;
    z-index: 1;
}

.slick-active .slide-bg-image {
    transform: scale(1.1);
}

.slide-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 2;
}

.slide-inner-content {
    position: relative;
    z-index: 3;
    width: 100%;
    padding: 0 10%;
}

.content-box {
    max-width: 650px;
    color: #ffffff;
}

/* Dots Styling */
.slider-init .slick-dots {
    position: absolute;
    bottom: 25px;
    width: 100%;
    padding: 0;
    list-style: none;
    text-align: center;
    z-index: 5;
}

.slider-init .slick-dots li {
    display: inline-block;
    margin: 0 5px;
}

.slider-init .slick-dots li button {
    font-size: 0;
    width: 12px;
    height: 12px;
    cursor: pointer;
    border: 0;
    background: rgba(255,255,255,0.4);
    border-radius: 50%;
    padding: 0;
}

.slider-init .slick-dots li.slick-active button {
    background: #2e7d32;
    transform: scale(1.2);
}

/* Navigation Arrows - REMOVING TEXT */
.slider-init .slick-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 50px;
    height: 50px;
    background: rgba(0,0,0,0.5) !important;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 0; /* Hides any default text */
    color: transparent;
    display: flex !important;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.slider-init .slick-arrow:hover {
    background: #2e7d32 !important;
}

.slider-init .slick-prev { left: 20px; }
.slider-init .slick-next { right: 20px; }

/* Arrow Icons */
.slider-init .slick-prev:after {
    content: "←";
    font-size: 24px;
    color: #fff;
}

.slider-init .slick-next:after {
    content: "→";
    font-size: 24px;
    color: #fff;
}

@media (max-width: 768px) {
    .slide-item { height: 400px; }
    .slider-init .slick-arrow { width: 40px; height: 40px; }
}
</style>
';
}

function ab_slider_script(){
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script>
jQuery(document).ready(function($){
    var $slider = $('.slider-init');

    $slider.slick({
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 800,
        fade: true,
        dots: true,
        arrows: true,
        infinite: true,
        prevArrow: '<button type="button" class="slick-prev"></button>',
        nextArrow: '<button type="button" class="slick-next"></button>'
    });

    $slider.on('beforeChange', function(e, slick, currentSlide, nextSlide) {
        $('.content-box').removeClass('animate__animated animate__fadeInUp');
    });

    $slider.on('afterChange', function(e, slick, currentSlide) {
        $('.slick-active .content-box').addClass('animate__animated animate__fadeInUp');
    });
});
</script>
<?php
}