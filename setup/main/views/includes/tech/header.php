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
    <?php beforeHeadContent(); ?>
    <?php echo OtherContent('header', 'cssdata'); ?>
    <?php echo theContent($page_id, 'cssdata'); ?>
    <style>
        /* @media (max-width: 640px) and (min-width: 480px) {
            .site-wrapper-reveal {
                margin-top: 2rem !important;
            }
        }
        */
        /* @media (max-width: 680px) {
            .main-content {
                margin-top: 3rem !important;
            }
        }  */
    </style>
    <script>
        // Function to adjust the margin-top based on the header height
function adjustMarginTop() {
    const headerArea = document.querySelector('.header-area--absolute');
    const mainContent = document.querySelector('.main-content');

    if (headerArea && mainContent) {
        const headerHeight = headerArea.offsetHeight;

        // Check the screen width and apply the margin-top within the media query condition
        if (window.innerWidth <= 680) {
            mainContent.style.marginTop = headerHeight + 'px';
        } else {
            mainContent.style.marginTop = '0'; // Reset to default or a fallback value
        }
    }
}

// Call the function on page load
window.addEventListener('DOMContentLoaded', adjustMarginTop);

// Call the function on window resize
window.addEventListener('resize', adjustMarginTop);

    </script>
</head>

<body <?php echo bodyClass(); ?>>

    <?php
    $content = OtherContent('header');
    if ($content != '') {
        echo $content;
    } else {
        include 'header-content.php';
    }
    ?>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
    const mainWrapper = document.getElementById("main-wrapper");
    if (!mainWrapper) {
      console.log("No element with id='main-wrapper' found.");
      return;
    } else {
      console.log("Found #main-wrapper:", mainWrapper);
    }

    const allIcons = document.querySelectorAll(".calling-icon, .whatsapp-icon");

    if (allIcons.length === 0) {
      console.log("No .calling-icon or .whatsapp-icon elements found.");
    }

    allIcons.forEach(icon => {
      console.log("Checking icon:", icon);

      // Check if the icon appears *before* the mainWrapper
      if (icon.compareDocumentPosition(mainWrapper) & Node.DOCUMENT_POSITION_FOLLOWING) {
        console.log("Icon is before #main-wrapper. Hiding it.");
        icon.style.display = "none";
      } else {
        console.log("Icon is not before #main-wrapper. Leaving it visible.");
      }
    });
  });
</script>

<div class="main-content">