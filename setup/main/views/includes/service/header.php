<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo theTitle(); ?></title> <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?php echo theme_path(); ?>assets/favicon.ico" />
    <?php include 'header-script.php'; ?>
    <?php beforeHeadContent(); ?>
    <?php echo OtherContent('header', 'cssdata'); ?>
    <?php echo theContent($page_id, 'cssdata'); ?>
    <style>
        .navbar .navbar-nav .nav-item .nav-link span{
            display:block !important;
        }
    </style>
</head>

<body <?php echo bodyClass(); ?>>
<div id="page" class="site pbmit-parent-header-style-2">
		<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
    <?php
    $content = OtherContent('header');
    if ($content != '') {
        echo $content;
    } else {
        include 'header-content.php';
    }
    ?>
    	<div class="site-content-contain ">
    	    
    	    
			<div class="site-content-wrap">
				<div id="content" class="site-content container">
					<div class="pbmit-header-search-form-wrapper">
						<div class="pbmit-search-close"><svg class="qodef-svg--close qodef-m"
								xmlns="http://www.w3.org/2000/svg" width="28.163" height="28.163"
								viewBox="0 0 26.163 26.163">
								<rect width="36" height="1" transform="translate(0.707) rotate(45)"></rect>
								<rect width="36" height="1" transform="translate(0 25.456) rotate(-45)"></rect>
							</svg></div>
						<form role="search" method="get" class="search-form"
							action="https://xclean-demo.pbminfotech.com/demo1/">
							<label for="search-form-67b356156b416">
								<span class="screen-reader-text">Search for:</span>
							</label>
							<input type="search" id="search-form-67b356156b416" class="search-field"
								placeholder="Search &hellip;" value="" name="s" />
							<button type="submit" class="search-submit " title="Search"><span
									class="screen-reader-text">Search</span></button>
						</form>
					</div>
					<div id="primary" class="content-area ">
					    
						<main id="main" class="site-main pbmit-page-content-wrapper">
							<div id="post-2254" class="post-2254 page type-page status-publish hentry">
								<div class="entry-content">
								    <div data-elementor-type="wp-page" data-elementor-id="2254"
										class="elementor elementor-2254">
