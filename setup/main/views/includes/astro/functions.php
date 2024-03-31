<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    $links = '
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.html" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://unpkg.com/aos%403.0.0-beta.6/dist/aos.css" /> -->
    <link rel="stylesheet" href="'.theme_path().'css/style.css">
';
    echo $links;
}

function registerAfterFooterContent(){
    echo '
          <style>
            @keyframes pulsate {
                0% {
                    transform: scale(0.9, 0.9);
                    opacity: 1;
                }

                50% {
                    transform: scale(1.2, 1.2);
                    opacity: 1;
                }

                100% {
                    transform: scale(0.9, 0.9);
                    opacity: 1;
                }
            }

            @keyframes callb {
                0% {
                    transform: scale(0.9);
                }

                20% {
                    transform: scale(1);
                }

                40% {
                    transform: scale(1.1);
                }

                60% {
                    transform: scale(1.2);
                }

                80% {
                    transform: scale(1.3);
                }

                100% {
                    transform: scale(1.4);
                }
            }

            @keyframes calla {
                0% {
                    box-shadow: 0px 0px 0px 4px rgba(162, 162, 162, 0.8);
                }

                20% {
                    box-shadow: 0px 0px 0px 6px rgba(162, 162, 162, 0.6);
                }

                40% {
                    box-shadow: 0px 0px 0px 8px rgba(162, 162, 162, 0.4);
                }

                60% {
                    box-shadow: 0px 0px 0px 10px rgba(162, 162, 162, 0.2);
                }

                80% {
                    box-shadow: 0px 0px 0px 12px rgba(162, 162, 162, 0.1);
                }

                100% {
                    box-shadow: 0px 0px 0px 14px rgba(162, 162, 162, 0);
                }
            }

            .call {
                position: fixed;
                z-index: 999999;
                left: 10px;
  bottom: 10px;
                display: inline;
                font-size: 30px;
                text-align: center;
                height: 60px;
                width: 60px;
                border-radius: 1px solid #000;
                animation-name: calla;
                animation-duration: 0.8s;
                animation-iteration-count: infinite;
                background: #df0505;
                line-height: 60px;
                border-radius: 50%;
            }

            .whatsapp {
                position: fixed;
                z-index: 999999;
                right: 10px;
                bottom: 10px;
                display: inline;
                font-size: 30px;
                text-align: center;
                height: 60px;
                width: 60px;
                border-radius: 1px solid #000;
                animation-name: calla;
                animation-duration: 0.8s;
                animation-iteration-count: infinite;
                background: #03A437;
                line-height: 60px;
                border-radius: 50%;
            }
        </style>
     <script src="https://unpkg.com/aos%403.0.0-beta.6/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        ';
}

function registerBodyClass(){
    echo '';
}
