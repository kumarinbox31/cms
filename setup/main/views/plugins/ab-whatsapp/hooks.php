<?
add_shortcode('AB-TEST-PLUGIN', function ($atts, $content) {
  //  [AB-TEST-PLUGIN ]
  ob_start();
  echo '<img src="https://icons8.com/preloaders/preloaders/1486/Hourglass.gif"></img> AB-TESTING PLUGIN SHORTCODE USED';
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
});
if (getVal('ab-whatsapp-plugin') == 'enable') {
  add_action('ab_footer', 'whatsapp_icon_footer');
  add_action('ab_head', 'custom_css');
}

$popup_type = getVal('ab-popup-type','all_pages');
// if (getVal('ab-popup-content') != '' && DEFAULTPAGE == CURRENT_PAGE_ID) {
if ($popup_type != '') {
  // Log a message to the error log for debugging
  error_log('Condition met: ab-popup-content is not empty and DEFAULTPAGE equals CURRENT_PAGE_ID.');
  if ($popup_type == 'default_page' && DEFAULTPAGE == CURRENT_PAGE_ID) {
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
  echo '
        <a href="https://wa.me//+91' . getVal('ab-whatsapp-number') . '" class="whatsapp-icon">
        <svg viewBox="0 0 32 32" class="whatsapp-ico"><path d=" M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z" fill-rule="evenodd"></path></svg>
        </a>
        <a href="tel:+91' . getVal('ab-calling-number') . '" class="calling-icon">
           <!-- <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48">
            <path fill="#0f0" d="M13,42h22c3.866,0,7-3.134,7-7V13c0-3.866-3.134-7-7-7H13c-3.866,0-7,3.134-7,7v22	C6,38.866,9.134,42,13,42z"></path><path fill="#fff" d="M35.45,31.041l-4.612-3.051c-0.563-0.341-1.267-0.347-1.836-0.017c0,0,0,0-1.978,1.153	c-0.265,0.154-0.52,0.183-0.726,0.145c-0.262-0.048-0.442-0.191-0.454-0.201c-1.087-0.797-2.357-1.852-3.711-3.205	c-1.353-1.353-2.408-2.623-3.205-3.711c-0.009-0.013-0.153-0.193-0.201-0.454c-0.037-0.206-0.009-0.46,0.145-0.726	c1.153-1.978,1.153-1.978,1.153-1.978c0.331-0.569,0.324-1.274-0.017-1.836l-3.051-4.612c-0.378-0.571-1.151-0.722-1.714-0.332	c0,0-1.445,0.989-1.922,1.325c-0.764,0.538-1.01,1.356-1.011,2.496c-0.002,1.604,1.38,6.629,7.201,12.45l0,0l0,0l0,0l0,0	c5.822,5.822,10.846,7.203,12.45,7.201c1.14-0.001,1.958-0.248,2.496-1.011c0.336-0.477,1.325-1.922,1.325-1.922	C36.172,32.192,36.022,31.419,35.45,31.041z"></path>
            </svg> -->
            <img src="' . base_url('public/admin/call.png') . '" width="50" height="50">
        </a>
        ' . getVal('ab-tawk-to-script') . '
    ';
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