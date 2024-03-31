<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Slick Slider with Content and Animation </title>
    <!-- Include Slick CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <!-- Include Slick theme CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<style>
    /* Slider Content Styling */
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
        /*align-items: center;*/
        padding: 20px; /* Adjust padding as needed */
        box-sizing: border-box;
        background-color: rgba(0, 0, 0, 0.5); /* Adjust background color and opacity */
    }

    .slider-content h2,
    .slider-content p {
        margin: 0;
    }

    /* Slide Images */
    .slide img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    /* Slide Headings */
    .slide h2 {
        font-size: 2rem;
    }

    /* Slide Paragraphs */
    .slide p {
        font-size: 1.2rem;
    }
</style>
</head>
<body>

    <!-- Slider Container -->
    <div class="slider">
        <?php 
           $get = $this->ServiceModel->getService(['type'=>'ab-slider-item','parent'=>intval(@$_GET['id'])]);
            foreach($get->result() as $row){
                $image = $row->image == '' ? 'https://via.placeholder.com/600x600' : $row->image;
                $content = $row->content;
        ?>
        <!-- Slide 1 -->
        <div class="slide">
            <img src="<?php echo $image; ?>" alt="Slide 1" style="width:100%;height:500px">
             <?php if($content != ''){ ?>
             <div class="slider-content" style="text-align:left;">
                <?php echo $content; ?>
            </div> 
            <?php } ?>
        </div>
        <?php 
            }
        ?>
    </div>
<?php 
    add_action('ab-admin-footer',function(){
        $id = intval(@$_GET['id']);
        ?>
 
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
<?php }); ?>
</body>
</html>
