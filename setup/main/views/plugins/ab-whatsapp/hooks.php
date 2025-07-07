<?php
add_shortcode('AGREE-POPUP', function ($atts, $content) {
  //  [AGREE-POPUP ]
//   $CI = &get_instance();
    // if(defined('CLIENT_ID') && CLIENT_ID == 185 && $CI->uri->segment(1) == ''){
    ob_start();
  ?>
  <style>
    .bg-deep-blue {
    --tw-bg-opacity: 1;
    background-color: rgb(2 21 75 / var(--tw-bg-opacity));
}.bg-gold {
    --tw-bg-opacity: 1;
    background-color: rgb(207 147 85 / var(--tw-bg-opacity));
}
</style>
<script src="https://cdn.tailwindcss.com"></script>
<div id="disclaimerModal" class="fixed inset-0 w-screen backdrop-blur-sm bg-zinc-900/50 z-50 flex items-center justify-center px-4 py-8 sm:py-4" >
  <div class="bg-white text-black rounded-xl shadow-lg max-w-lg w-full">
    
    <!-- Header -->
    <div class="bg-deep-blue text-white p-6 rounded-t-xl text-center">
      <h3 class="text-lg font-semibold leading-none tracking-tight text-white">Disclaimer</h3>
    </div>
    
    <!-- Body -->
    <div class="p-5 text-sm md:text-base">
      <p>
        The contents of this website are for information purposes only and may not be construed as advertisement or solicitation in any manner whatsoever.
        By clicking the Enter tab, you have deemed to have requested the information of your own accord and volition and by no means, The Case Law has invited you
        to visit the website for any purposes. The information provided under this website is solely available at your request for information purposes only.
        It should not be interpreted as soliciting or advertisement.
      </p>
    </div>

    <!-- Buttons -->
    <div class="p-6 pt-0 flex flex-col sm:flex-row justify-center sm:space-x-4 space-y-3 sm:space-y-0">
      <button id="agreeBtn" class=" hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded-md transition w-full sm:w-auto bg-gold">
        Yes, I Agree
      </button>
      <button onclick="window.location.href='https://google.com'" class="bg-white border border-gray-300 hover:bg-gray-100 text-black font-medium px-4 py-2 rounded-md transition w-full sm:w-auto">
        Disagree
      </button>
    </div>

  </div>
</div>

<script>
  const COOKIE_NAME = "dsn_disclaimer_accepted";

  function setCookie(name, value, days) {
    const expires = new Date(Date.now() + days*24*60*60*1000).toUTCString();
    document.cookie = `${name}=${value}; expires=${expires}; path=/`;
  }

  function getCookie(name) {
    return document.cookie.split('; ').find(row => row.startsWith(name + '='))?.split('=')[1];
  }

  function generateUniqueID() {
    return 'dsn-' + Math.random().toString(36).substring(2, 15);
  }

  document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("disclaimerModal");

//   if (getCookie(COOKIE_NAME)) {
//     modal.style.display = "none";
//   } else {
//     modal.style.display = "flex"; // Correct way to show the modal
//   }

  document.getElementById("agreeBtn").addEventListener("click", () => {
    const uniqueID = generateUniqueID();
    setCookie(COOKIE_NAME, uniqueID, 30); // Cookie valid for 30 days
    // modal.style.display = "none";
    modal.remove();
  });
});

</script>

  <?php
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
//   }
});
$CI = &get_instance();
if(defined('CLIENT_ID') && CLIENT_ID == 185 && $CI->uri->segment(1) == '' && false){
    
?>
<style>
    .bg-deep-blue {
    --tw-bg-opacity: 1;
    background-color: rgb(2 21 75 / var(--tw-bg-opacity));
}.bg-gold {
    --tw-bg-opacity: 1;
    background-color: rgb(207 147 85 / var(--tw-bg-opacity));
}
</style>
<script src="https://cdn.tailwindcss.com"></script>
<div id="disclaimerModal" class="fixed inset-0 w-screen backdrop-blur-sm bg-zinc-900/50 z-50 flex items-center justify-center px-4 py-8 sm:py-4" >
  <div class="bg-white text-black rounded-xl shadow-lg max-w-lg w-full">
    
    <!-- Header -->
    <div class="bg-deep-blue text-white p-6 rounded-t-xl text-center">
      <h3 class="text-lg font-semibold leading-none tracking-tight text-white">Disclaimer</h3>
    </div>
    
    <!-- Body -->
    <div class="p-5 text-sm md:text-base">
      <p>
        The contents of this website are for information purposes only and may not be construed as advertisement or solicitation in any manner whatsoever.
        By clicking the Enter tab, you have deemed to have requested the information of your own accord and volition and by no means, The Case Law has invited you
        to visit the website for any purposes. The information provided under this website is solely available at your request for information purposes only.
        It should not be interpreted as soliciting or advertisement.
      </p>
    </div>

    <!-- Buttons -->
    <div class="p-6 pt-0 flex flex-col sm:flex-row justify-center sm:space-x-4 space-y-3 sm:space-y-0">
      <button id="agreeBtn" class=" hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded-md transition w-full sm:w-auto bg-gold">
        Yes, I Agree
      </button>
      <button onclick="window.location.href='https://google.com'" class="bg-white border border-gray-300 hover:bg-gray-100 text-black font-medium px-4 py-2 rounded-md transition w-full sm:w-auto">
        Disagree
      </button>
    </div>

  </div>
</div>

<script>
  const COOKIE_NAME = "dsn_disclaimer_accepted";

  function setCookie(name, value, days) {
    const expires = new Date(Date.now() + days*24*60*60*1000).toUTCString();
    document.cookie = `${name}=${value}; expires=${expires}; path=/`;
  }

  function getCookie(name) {
    return document.cookie.split('; ').find(row => row.startsWith(name + '='))?.split('=')[1];
  }

  function generateUniqueID() {
    return 'dsn-' + Math.random().toString(36).substring(2, 15);
  }

  document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("disclaimerModal");

//   if (getCookie(COOKIE_NAME)) {
//     modal.style.display = "none";
//   } else {
//     modal.style.display = "flex"; // Correct way to show the modal
//   }

  document.getElementById("agreeBtn").addEventListener("click", () => {
    const uniqueID = generateUniqueID();
    setCookie(COOKIE_NAME, uniqueID, 30); // Cookie valid for 30 days
    modal.style.display = "none";
  });
});

</script>
<?php
}
add_shortcode('GOOGLE-TRANSLATE', function ($atts, $content) {
    add_action('ab_footer','footer_gtranslate');
  //  [AB-TEST-PLUGIN ]
  ob_start();
  echo '<div id="google_translate_element"></div>';
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
});
function footer_gtranslate(){
    echo '<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: "en"}, "google_translate_element");
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
';
}
if (getVal('ab-whatsapp-plugin') == 'enable' && defined('IS_WEB')) {
  add_action('ab_footer', 'whatsapp_icon_footer');
  add_action('ab_head', 'custom_css');
}

$popup_type = getVal('ab-popup-type');
// if (getVal('ab-popup-content') != '' && DEFAULTPAGE == CURRENT_PAGE_ID) {
if ($popup_type != '') {
  // Log a message to the error log for debugging
  error_log('Condition met: ab-popup-content is not empty and DEFAULTPAGE equals CURRENT_PAGE_ID.');
  if ($popup_type == 'default_page' && defined('CURRENT_PAGE_ID') && DEFAULTPAGE == CURRENT_PAGE_ID) {
    add_action('ab_footer', 'popupScript');
    add_action('ab_head', 'popupCss');
  } elseif ($popup_type == 'all_pages') {
    add_action('ab_footer', 'popupScript');
    add_action('ab_head', 'popupCss');
  }
} else {
  // Log a message if the condition is not met
  error_log('Condition not met: Either ab-popup-content is empty or DEFAULTPAGE does not equal CURRENT_PAGE_ID.');
}

function whatsapp_icon_footer()
{
    if(!empty(getVal('ab-whatsapp-number'))){
  echo '
        <a href="https://wa.me//+' . getVal('ab-whatsapp-number') . '" class="whatsapp-icon">
        <svg viewBox="0 0 32 32" class="whatsapp-ico"><path d=" M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z" fill-rule="evenodd"></path></svg>
        </a>';
    }
    if(!empty(getVal('ab-calling-number'))){
     echo '<a href="tel:+' . getVal('ab-calling-number') . '" class="calling-icon">
                <img src="' . base_url('public/admin/call.png') . '" width="50" height="50">
            </a>
            ' . getVal('ab-tawk-to-script') . '
        ';
    }
}
function custom_css()
{

  echo '<style>
    .whatsapp-icon{
        fill: white;
        width: 50px;
        height: 50px;
        padding: 3px;
        background-color: #4dc247;
        border-radius: 50%;
        box-shadow: 2px 2px 6px rgba(0,0,0,0.4);
        /* box-shadow: 2px 2px 11px rgba(0,0,0,0.7); */
        position: fixed;
        bottom: 20px;
        right : 20px;
        z-index: 10;
    }
    
    .whatsapp-icon:hover{
        box-shadow: 2px 2px 11px rgba(0,0,0,0.7);
    }
    .whatsapp-icon {
                position: fixed;
                bottom: 5px;
                right: 5px;
            }
            .calling-icon{
                position:fixed;
                bottom:5px;
                left:5px;
                z-index:10;
            }
            
            
        </style>';
  if (getVal('ab-tawk-to-script') != '') {
    echo '<style>
        .whatsapp-icon{
            bottom: 70px;
    left: 5px;
        }
        </style>';
  }
}
function popupScript()
{
  echo '<div id="ab-popup1" class="ab-overlay">
        	<div class="ab-popup">
        		<a class="close" href="#" onclick=\'AbHidePopup("ab-popup1")\'>&times;</a>
        		<div class="content">
        			' . str_replace('table table-bordered table-striped datatable', '', do_shortcode(getVal('ab-popup-content'))) . '
        		</div>
        	</div>
        </div>
        <script>
            function AbShowPopup(divId){
                var divElement = document.getElementById(divId);
                if (divElement) {
                    divElement.style.visibility = "visible";
                    divElement.style.opacity = "1";
                } else {
                    console.error("POPUP DIV " + divId + " not found.");
                }
            }
            function AbHidePopup(divId){
                var divElement = document.getElementById(divId);
                if (divElement) {
                    divElement.style.visibility = "hidden";
                    divElement.style.opacity = "0";
                } else {
                    console.error("POPUP DIV " + divId + " not found.");
                }
            }
            AbShowPopup("ab-popup1");
        </script>';
}
function popupCss()
{
  echo '
    <style>
     .ab-overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
  z-index:99999;
}
.ab-overlay:target {
  visibility: visible;
  opacity: 1;
}

.ab-popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
  max-height: 80vh; /* Adjust as needed */
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

.ab-popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.ab-popup .close {
  position: absolute;
  top: -12px;
    right: 12px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.ab-popup .close:hover {
  color: #06D85F;
}
.ab-popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .ab-popup{
    width: 70%;
  }
}</style>';
}
?>