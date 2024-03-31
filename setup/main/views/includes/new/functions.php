<?php

function registerBeforeHeadContent(){
    $links = 
            '<!-- Google Fonts -->
    		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    
    		<!-- Bootstrap CSS -->
    		<link rel="stylesheet" href="'.theme_path().'css/bootstrap.min.css">
    		<!-- Nice Select CSS -->
    		<link rel="stylesheet" href="'.theme_path().'css/nice-select.css">
    		<!-- Font Awesome CSS -->
            <link rel="stylesheet" href="'.theme_path().'css/font-awesome.min.css">
    		<!-- icofont CSS -->
            <link rel="stylesheet" href="'.theme_path().'css/icofont.css">
    		<!-- Slicknav -->
    		<link rel="stylesheet" href="'.theme_path().'css/slicknav.min.css">
    		<!-- Owl Carousel CSS -->
            <link rel="stylesheet" href="'.theme_path().'css/owl-carousel.css">
    		<!-- Datepicker CSS -->
    		<link rel="stylesheet" href="'.theme_path().'css/datepicker.css">
    		<!-- Animate CSS -->
            <link rel="stylesheet" href="'.theme_path().'css/animate.min.css">
    		<!-- Magnific Popup CSS -->
            <link rel="stylesheet" href="'.theme_path().'css/magnific-popup.css">
    		
    		<!-- Medipro CSS -->
            <link rel="stylesheet" href="'.theme_path().'css/normalize.css">
            <link rel="stylesheet" href="'.theme_path().'style.css">
            <link rel="stylesheet" href="'.theme_path().'css/responsive.css">
            ';
    return $links;
}

function registerAfterFooterContent(){
    return '
        <!-- jquery Min JS -->
        <script src="'.theme_path().'js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="'.theme_path().'js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="'.theme_path().'js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="'.theme_path().'js/easing.js"></script>
		<!-- Color JS -->
		<script src="'.theme_path().'js/colors.js"></script>
		<!-- Popper JS -->
		<script src="'.theme_path().'js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="'.theme_path().'js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="'.theme_path().'js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="'.theme_path().'js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="'.theme_path().'js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="'.theme_path().'js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="'.theme_path().'js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="'.theme_path().'js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="'.theme_path().'js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="'.theme_path().'js/steller.js"></script>
		<!-- Wow JS -->
		<script src="js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="'.theme_path().'js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="'.theme_path().'js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="'.theme_path().'js/main.js"></script>
        ';
}

function registerBodyClass(){
    return [
            'id' => '',
            'class' => '',
        ];
}
