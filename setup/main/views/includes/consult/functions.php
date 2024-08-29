<?php
add_action('ab_head', 'registerBeforeHeadContent');
add_action('ab_footer', 'registerAfterFooterContent');
add_action('ab_body_class', 'registerBodyClass');

function registerBeforeHeadContent(){
    echo '
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
            <script>document.documentElement.className = document.documentElement.className + " yes-js js_active js"</script>
      <meta name="robots" content="max-image-preview:large" />
      <link rel="dns-prefetch" href="//fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link rel="alternate" type="application/rss+xml" title="Consultio &raquo; Feed" href="https://demo.casethemes.net/consultio-immigration/feed/" />
      <link rel="alternate" type="application/rss+xml" title="Consultio &raquo; Comments Feed" href="https://demo.casethemes.net/consultio-immigration/comments/feed/" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/4.0.0/font/MaterialIcons-Regular.ttf">
      <script type="text/javascript"> /* <![CDATA[ */
         window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.4.3"}};
         /*! This file is auto-generated */
         !function(i,n){var o,s,e;function c(e){try{var t={supportTests:e,timestamp:(new Date).valueOf()};sessionStorage.setItem(o,JSON.stringify(t))}catch(e){}}function p(e,t,n){e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(t,0,0);var t=new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data),r=(e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(n,0,0),new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data));return t.every(function(e,t){return e===r[t]})}function u(e,t,n){switch(t){case"flag":return n(e,"\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f","\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f")?!1:!n(e,"\ud83c\uddfa\ud83c\uddf3","\ud83c\uddfa\u200b\ud83c\uddf3")&&!n(e,"\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f","\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f");case"emoji":return!n(e,"\ud83e\udef1\ud83c\udffb\u200d\ud83e\udef2\ud83c\udfff","\ud83e\udef1\ud83c\udffb\u200b\ud83e\udef2\ud83c\udfff")}return!1}function f(e,t,n){var r="undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope?new OffscreenCanvas(300,150):i.createElement("canvas"),a=r.getContext("2d",{willReadFrequently:!0}),o=(a.textBaseline="top",a.font="600 32px Arial",{});return e.forEach(function(e){o[e]=t(a,e,n)}),o}function t(e){var t=i.createElement("script");t.src=e,t.defer=!0,i.head.appendChild(t)}"undefined"!=typeof Promise&&(o="wpEmojiSettingsSupports",s=["flag","emoji"],n.supports={everything:!0,everythingExceptFlag:!0},e=new Promise(function(e){i.addEventListener("DOMContentLoaded",e,{once:!0})}),new Promise(function(t){var n=function(){try{var e=JSON.parse(sessionStorage.getItem(o));if("object"==typeof e&&"number"==typeof e.timestamp&&(new Date).valueOf()<e.timestamp+604800&&"object"==typeof e.supportTests)return e.supportTests}catch(e){}return null}();if(!n){if("undefined"!=typeof Worker&&"undefined"!=typeof OffscreenCanvas&&"undefined"!=typeof URL&&URL.createObjectURL&&"undefined"!=typeof Blob)try{var e="postMessage("+f.toString()+"("+[JSON.stringify(s),u.toString(),p.toString()].join(",")+"));",r=new Blob([e],{type:"text/javascript"}),a=new Worker(URL.createObjectURL(r),{name:"wpTestEmojiSupports"});return void(a.onmessage=function(e){c(n=e.data),a.terminate(),t(n)})}catch(e){}c(n=f(s,u,p))}t(n)}).then(function(e){for(var t in e)n.supports[t]=e[t],n.supports.everything=n.supports.everything&&n.supports[t],"flag"!==t&&(n.supports.everythingExceptFlag=n.supports.everythingExceptFlag&&n.supports[t]);n.supports.everythingExceptFlag=n.supports.everythingExceptFlag&&!n.supports.flag,n.DOMReady=!1,n.readyCallback=function(){n.DOMReady=!0}}).then(function(){return e}).then(function(){var e;n.supports.everything||(n.readyCallback(),(e=n.source||{}).concatemoji?t(e.concatemoji):e.wpemoji&&e.twemoji&&(t(e.twemoji),t(e.wpemoji)))}))}((window,document),window._wpemojiSettings);
         /* ]]> */ 
      </script>
      <link rel="stylesheet" id="sbi_styles-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/instagram-feed/css/sbi-styles.min.css?ver=6.2.7" type="text/css" media="all" />
      <style id="wp-emoji-styles-inline-css" type="text/css"> img.wp-smiley, img.emoji {
         display: inline !important;
         border: none !important;
         box-shadow: none !important;
         height: 1em !important;
         width: 1em !important;
         margin: 0 0.07em !important;
         vertical-align: -0.1em !important;
         background: none !important;
         padding: 0 !important;
         } 
      </style>
      <link rel="stylesheet" id="jquery-selectBox-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/yith-woocommerce-wishlist/assets/css/jquery-selectBox.min.css?ver=1.2.0" type="text/css" media="all" />
      <link rel="stylesheet" id="yith-wcwl-font-awesome-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/yith-woocommerce-wishlist/assets/css/yith-wcwl-font-awesome.min.css?ver=4.7.0" type="text/css" media="all" />
      <link rel="stylesheet" id="woocommerce_prettyPhoto_css-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/css/woocommerce_prettyPhoto_css.min.css?ver=3.1.6" type="text/css" media="all" />
      <link rel="stylesheet" id="yith-wcwl-main-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/yith-woocommerce-wishlist/assets/css/yith-wcwl-main.min.css?ver=3.29.0" type="text/css" media="all" />
      <style id="yith-wcwl-main-inline-css" type="text/css"> .yith-wcwl-share li a{color: #FFFFFF;}.yith-wcwl-share li a:hover{color: #FFFFFF;}.yith-wcwl-share a.facebook{background: #39599E; background-color: #39599E;}.yith-wcwl-share a.facebook:hover{background: #595A5A; background-color: #595A5A;}.yith-wcwl-share a.twitter{background: #45AFE2; background-color: #45AFE2;}.yith-wcwl-share a.twitter:hover{background: #595A5A; background-color: #595A5A;}.yith-wcwl-share a.pinterest{background: #AB2E31; background-color: #AB2E31;}.yith-wcwl-share a.pinterest:hover{background: #595A5A; background-color: #595A5A;}.yith-wcwl-share a.email{background: #FBB102; background-color: #FBB102;}.yith-wcwl-share a.email:hover{background: #595A5A; background-color: #595A5A;}.yith-wcwl-share a.whatsapp{background: #00A901; background-color: #00A901;}.yith-wcwl-share a.whatsapp:hover{background: #595A5A; background-color: #595A5A;} </style>
      <style id="classic-theme-styles-inline-css" type="text/css"> /*! This file is auto-generated */
         .wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none} 
      </style>
      <style id="global-styles-inline-css" type="text/css"> body{--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);--wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);--wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);}:where(.is-layout-flex){gap: 0.5em;}:where(.is-layout-grid){gap: 0.5em;}body .is-layout-flow > .alignleft{float: left;margin-inline-start: 0;margin-inline-end: 2em;}body .is-layout-flow > .alignright{float: right;margin-inline-start: 2em;margin-inline-end: 0;}body .is-layout-flow > .aligncenter{margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > .alignleft{float: left;margin-inline-start: 0;margin-inline-end: 2em;}body .is-layout-constrained > .alignright{float: right;margin-inline-start: 2em;margin-inline-end: 0;}body .is-layout-constrained > .aligncenter{margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > :where(:not(.alignleft):not(.alignright):not(.alignfull)){max-width: var(--wp--style--global--content-size);margin-left: auto !important;margin-right: auto !important;}body .is-layout-constrained > .alignwide{max-width: var(--wp--style--global--wide-size);}body .is-layout-flex{display: flex;}body .is-layout-flex{flex-wrap: wrap;align-items: center;}body .is-layout-flex > *{margin: 0;}body .is-layout-grid{display: grid;}body .is-layout-grid > *{margin: 0;}:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
         .wp-block-navigation a:where(:not(.wp-element-button)){color: inherit;}
         :where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}
         :where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}
         .wp-block-pullquote{font-size: 1.5em;line-height: 1.6;} 
      </style>
      <link rel="stylesheet" id="redux-extendify-styles-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/redux-framework/redux-core/assets/css/redux-extendify-styles.min.css?ver=4.4.11" type="text/css" media="all" />
      <link rel="stylesheet" id="ct-main-css-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/case-theme-core/assets/css/ct-main-css.min.css?ver=1.0.0" type="text/css" media="all" />
      <link rel="stylesheet" id="progressbar-lib-css-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/case-theme-core/assets/css/lib/progressbar.min.css?ver=0.7.1" type="text/css" media="all" />
      <link rel="stylesheet" id="oc-css-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/case-theme-core/assets/css/lib/owl.carousel.min.css?ver=2.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="ct-slick-css-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/case-theme-core/assets/css/lib/ct-slick-css.min.css?ver=1.0.0" type="text/css" media="all" />
      <link rel="stylesheet" id="ct-font-awesome-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/case-theme-core/assets/plugin/font-awesome/css/font-awesome.min.css?ver=4.7.0" type="text/css" media="all" />
      <link rel="stylesheet" id="contact-form-7-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/contact-form-7/includes/css/contact-form-7.min.css?ver=5.8.6" type="text/css" media="all" />
      <link rel="stylesheet" id="woocommerce-layout-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.min.css?ver=8.5.2" type="text/css" media="all" />
      <link rel="stylesheet" id="woocommerce-smallscreen-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.min.css?ver=8.5.2" type="text/css" media="only screen and (max-width: 768px)" />
      <link rel="stylesheet" id="woocommerce-general-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/css/woocommerce-general.min.css?ver=8.5.2" type="text/css" media="all" />
      <style id="woocommerce-inline-inline-css" type="text/css"> .woocommerce form .form-row .required { visibility: visible; } </style>
      <link rel="stylesheet" id="yith-quick-view-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/yith-woocommerce-quick-view/assets/css/yith-quick-view.min.css?ver=1.35.0" type="text/css" media="all" />
      <style id="yith-quick-view-inline-css" type="text/css"> #yith-quick-view-modal .yith-wcqv-main{background:#ffffff;}
         #yith-quick-view-close{color:#cdcdcd;}
         #yith-quick-view-close:hover{color:#ff0000;} 
      </style>
      <link rel="stylesheet" id="bootstrap-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/bootstrap.min.css?ver=4.0.0" type="text/css" media="all" />
      <link rel="stylesheet" id="font-awesome-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/font-awesome/css/font-awesome.min.css?ver=4.7.0" type="text/css" media="all" />
      <style id="font-awesome-inline-css" type="text/css"> [data-font="FontAwesome"]:before {font-family: "FontAwesome" !important;content: attr(data-icon) !important;speak: none !important;font-weight: normal !important;font-variant: normal !important;text-transform: none !important;line-height: 1 !important;font-style: normal !important;-webkit-font-smoothing: antialiased !important;-moz-osx-font-smoothing: grayscale !important;} </style>
      <link rel="stylesheet" id="font-awesome-v5-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-awesome5.min.css?ver=5.8.0" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-v2-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon-v2.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-v3-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon-v3.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-v4-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon-v4.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-v5-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon-v5.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-v6-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon-v6.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-v7-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon-v7.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-flaticon-v8-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/font-flaticon-v8.min.css?ver=3.2.1" type="text/css" media="all" />
      <link rel="stylesheet" id="font-material-icon-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/material-design-iconic-font.min.css?ver=2.2.0" type="text/css" media="all" />
      <link rel="stylesheet" id="magnific-popup-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/magnific-popup.min.css?ver=1.0.0" type="text/css" media="all" />
      <link rel="stylesheet" id="animate-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/animate.min.css?ver=1.0.0" type="text/css" media="all" />
      <link rel="stylesheet" id="consultio-theme-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/css/consultio-theme.min.css?ver=3.2.1" type="text/css" media="all" />
      <style id="consultio-theme-inline-css" type="text/css"> :root{--gradient-color-from: #ff0040;--gradient-color-to: #ff0040;--gradient-color-from-rgb: 255,0,64;--gradient-color-to-rgb: 255,0,64;}
         @media screen and (min-width: 1200px) {
         #ct-header-wrap .ct-header-branding a img { max-height: 47px !important; }#ct-header-wrap .ct-header-main.h-fixed .ct-header-branding a img { max-height: 47px !important; }		}
         @media screen and (max-width: 1199px) {
         }
         @media screen and (min-width: 1200px) {
         } 
      </style>
      <link rel="stylesheet" id="consultio-style-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/consultio-style.min.css?ver=6.4.3" type="text/css" media="all" />
      <link rel="stylesheet" id="consultio-google-fonts-css" href="//fonts.googleapis.com/css?family=Roboto%3A300%2C400%2C400i%2C500%2C500i%2C600%2C600i%2C700%2C700i%7CPoppins%3A300%2C400%2C400i%2C500%2C500i%2C600%2C600i%2C700%2C700i%7CPlayfair+Display%3A400%2C400i%2C700%2C700i%2C800%2C900%7CMuli%3A400%7CLato%3A400%7CBarlow%3A400%2C700%7CNunito+Sans%3A400%2C600%2C700%2C900%7CKalam%3A400%7CRubik%3A400%7CInter%3A400%2C500%2C600%2C700&#038;subset=latin%2Clatin-ext&#038;ver=6.4.3" type="text/css" media="all" />
      <link rel="stylesheet" id="meks-flickr-widget-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/meks-simple-flickr-widget/css/meks-flickr-widget.min.css?ver=1.3" type="text/css" media="all" />
      <link rel="stylesheet" id="newsletter-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/newsletter/newsletter.min.css?ver=8.0.9" type="text/css" media="all" />
      <link rel="stylesheet" id="elementor-icons-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.25.0" type="text/css" media="all" />
      <link rel="stylesheet" id="elementor-frontend-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.18.3" type="text/css" media="all" />
      <link rel="stylesheet" id="swiper-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/swiper/css/swiper.min.css?ver=5.3.6" type="text/css" media="all" />
      <link rel="stylesheet" id="elementor-post-4540-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/elementor/css/post-4540.css?ver=1706632732" type="text/css" media="all" />
      <link rel="stylesheet" id="elementor-global-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/elementor/css/global.css?ver=1706632732" type="text/css" media="all" />
      <link rel="stylesheet" id="elementor-post-9-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/elementor/css/post-9.css?ver=1706634146" type="text/css" media="all" />
      <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Nunito%20Sans:200,300,400,600,700,800,900,200italic,300italic,400italic,600italic,700italic,800italic,900italic&#038;display=swap&#038;ver=1706633907" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito%20Sans:200,300,400,600,700,800,900,200italic,300italic,400italic,600italic,700italic,800italic,900italic&#038;display=swap&#038;ver=1706633907" media="print" onload="this.media="all"">
      <noscript>
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito%20Sans:200,300,400,600,700,800,900,200italic,300italic,400italic,600italic,700italic,800italic,900italic&#038;display=swap&#038;ver=1706633907" />
      </noscript>
      <link rel="stylesheet" id="google-fonts-1-css" href="https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CPoppins%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=auto&#038;ver=6.4.3" type="text/css" media="all" />
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/jquery/jquery.min.js?ver=3.7.1" id="jquery-core-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/ct-main-js.min.js?ver=1.0.0" id="ct-main-js-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.7.0-wc.8.5.2" id="jquery-blockui-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" id="wc-add-to-cart-js-extra"> /* <![CDATA[ */
         var wc_add_to_cart_params = {"ajax_url":"\/consultio-immigration\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/consultio-immigration\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"https:\/\/demo.casethemes.net\/consultio-immigration\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
         /* ]]> */ 
      </script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=8.5.2" id="wc-add-to-cart-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4-wc.8.5.2" id="js-cookie-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" id="woocommerce-js-extra"> /* <![CDATA[ */
         var woocommerce_params = {"ajax_url":"\/consultio-immigration\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/consultio-immigration\/?wc-ajax=%%endpoint%%"};
         /* ]]> */ 
      </script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=8.5.2" id="woocommerce-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/ct-inline-css-js.min.js?ver=3.2.1" id="ct-inline-css-js-js"></script>
      <link rel="https://api.w.org/" href="https://demo.casethemes.net/consultio-immigration/wp-json/" />
      <link rel="alternate" type="application/json" href="https://demo.casethemes.net/consultio-immigration/wp-json/wp/v2/pages/9" />
      <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://demo.casethemes.net/consultio-immigration/xmlrpc.php?rsd" />
      <noscript>
         <style>.woocommerce-product-gallery{ opacity: 1 !important; }</style>
      </noscript>
      <script>function setREVStartSize(e){
         //window.requestAnimationFrame(function() {
         window.RSIW = window.RSIW===undefined ? window.innerWidth : window.RSIW;
         window.RSIH = window.RSIH===undefined ? window.innerHeight : window.RSIH;
         try {
         var pw = document.getElementById(e.c).parentNode.offsetWidth,
         newh;
         pw = pw===0 || isNaN(pw) || (e.l=="fullwidth" || e.layout=="fullwidth") ? window.RSIW : pw;
         e.tabw = e.tabw===undefined ? 0 : parseInt(e.tabw);
         e.thumbw = e.thumbw===undefined ? 0 : parseInt(e.thumbw);
         e.tabh = e.tabh===undefined ? 0 : parseInt(e.tabh);
         e.thumbh = e.thumbh===undefined ? 0 : parseInt(e.thumbh);
         e.tabhide = e.tabhide===undefined ? 0 : parseInt(e.tabhide);
         e.thumbhide = e.thumbhide===undefined ? 0 : parseInt(e.thumbhide);
         e.mh = e.mh===undefined || e.mh=="" || e.mh==="auto" ? 0 : parseInt(e.mh,0);
         if(e.layout==="fullscreen" || e.l==="fullscreen")
         newh = Math.max(e.mh,window.RSIH);
         else{
         e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
         for (var i in e.rl) if (e.gw[i]===undefined || e.gw[i]===0) e.gw[i] = e.gw[i-1];
         e.gh = e.el===undefined || e.el==="" || (Array.isArray(e.el) && e.el.length==0)? e.gh : e.el;
         e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
         for (var i in e.rl) if (e.gh[i]===undefined || e.gh[i]===0) e.gh[i] = e.gh[i-1]; 
         var nl = new Array(e.rl.length),
         ix = 0,
         sl;
         e.tabw = e.tabhide>=pw ? 0 : e.tabw;
         e.thumbw = e.thumbhide>=pw ? 0 : e.thumbw;
         e.tabh = e.tabhide>=pw ? 0 : e.tabh;
         e.thumbh = e.thumbhide>=pw ? 0 : e.thumbh;
         for (var i in e.rl) nl[i] = e.rl[i]<window.RSIW ? 0 : e.rl[i];
         sl = nl[0];
         for (var i in nl) if (sl>nl[i] && nl[i]>0) { sl = nl[i]; ix=i;}
         var m = pw>(e.gw[ix]+e.tabw+e.thumbw) ? 1 : (pw-(e.tabw+e.thumbw)) / (e.gw[ix]);
         newh =  (e.gh[ix] * m) + (e.tabh + e.thumbh);
         }
         var el = document.getElementById(e.c);
         if (el!==null && el) el.style.height = newh+"px";
         el = document.getElementById(e.c+"_wrapper");
         if (el!==null && el) {
         el.style.height = newh+"px";
         el.style.display = "block";
         }
         } catch(e){
         console.log("Failure at Presize of Slider:" + e)
         }
         //});
         };
      </script> 
      <style type="text/css" id="wp-custom-css"> .ct-hidden-sidebar section.widget.logo-hidden-sidebar img {
         max-height: 50px;
         } 
      </style>
      <style id="ct_theme_options-dynamic-css" title="dynamic-css" class="redux-options-output">body #pagetitle{background-image:url("https://demo.casethemes.net/consultio-immigration/wp-content/uploads/2020/05/bg-page-title-u.jpg");}body #pagetitle{padding-top:120px;padding-bottom:120px;}a{color:#ff0040;}a:hover{color:#0d2252;}a:active{color:#0d2252;}body{font-family:"Nunito Sans";font-weight:normal;font-style:normal;}</style>
      <style id="ct-page-dynamic-css" data-type="redux-output-css">#content{padding-top:0px;padding-bottom:0px;}</style>
            ';
}
function registerAfterFooterContent(){
    echo '
        <script> window.RS_MODULES = window.RS_MODULES || {};
   window.RS_MODULES.modules = window.RS_MODULES.modules || {};
   window.RS_MODULES.waiting = window.RS_MODULES.waiting || [];
   window.RS_MODULES.defered = true;
   window.RS_MODULES.moduleWaiting = window.RS_MODULES.moduleWaiting || {};
   window.RS_MODULES.type = "compiled"; 
</script> 
<script>
(function() {function maybePrefixUrlField () {
   const value = this.value.trim()
   if (value !== "" && value.indexOf("http") !== 0) {
   this.value = "http://" + value
   }
   }
   const urlFields = document.querySelectorAll(".mc4wp-form input[type="url"]")
   for (let j = 0; j < urlFields.length; j++) {
   urlFields[j].addEventListener("blur", maybePrefixUrlField)
   }
   })();
</script>
<!-- Instagram Feed JS --> 
<script type="text/javascript"> var sbiajaxurl = "https://demo.casethemes.net/consultio-immigration/wp-admin/admin-ajax.php"; </script>
<script type="text/javascript"> jQuery( function($) {
   if ( typeof wc_add_to_cart_params === "undefined" )
   return false;
   $(document.body).on( "added_to_cart", function( event, fragments, cart_hash, $button ) {
   var $pid = $button.data("product_id");
   $.ajax({
   type: "POST",
   url: wc_add_to_cart_params.ajax_url,
   data: {
   "action": "item_added",
   "id"    : $pid
   },
   success: function (response) {
   $(".ct-widget-cart-wrap").addClass("open");
   }
   });
   });
   }); 
</script>
<link href="https://fonts.googleapis.com/css?family=Roboto:400%7CPoppins:700%7CNunito+Sans:400&display=swap" rel="stylesheet" property="stylesheet" media="all" type="text/css" >
<script type="text/javascript"> (function () {
   var c = document.body.className;
   c = c.replace(/woocommerce-no-js/, "woocommerce-js");
   document.body.className = c;
   })(); 
</script> <script> if(typeof revslider_showDoubleJqueryError === "undefined") {function revslider_showDoubleJqueryError(sliderID) {console.log("You have some jquery.js library include that comes after the Slider Revolution files js inclusion.");console.log("To fix this, you can:");console.log("1. Set "Module General Options" -> "Advanced" -> "jQuery & OutPut Filters" -> "Put JS to Body" to on");console.log("2. Find the double jQuery.js inclusion and remove it");return "Double Included jQuery Library";}} </script>
<script type="text/template" id="tmpl-variation-template"><div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div><div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div><div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div> </script> <script type="text/template" id="tmpl-unavailable-variation-template"><p>Sorry, this product is unavailable. Please choose a different combination.</p> </script>
<link rel="stylesheet" id="wc-blocks-style-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks.css?ver=11.8.0-dev" type="text/css" media="all" />
<link rel="stylesheet" id="elementor-post-5137-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/elementor/css/post-5137.css?ver=1706632732" type="text/css" media="all" />
<link rel="stylesheet" id="elementor-post-20-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/elementor/css/post-20.css?ver=1706632732" type="text/css" media="all" />
<link rel="stylesheet" id="photoswipe-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/css/photoswipe/photoswipe.min.css?ver=8.5.2" type="text/css" media="all" />
<link rel="stylesheet" id="photoswipe-default-skin-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/css/photoswipe/default-skin/default-skin.min.css?ver=8.5.2" type="text/css" media="all" />
<link rel="stylesheet" id="google-fonts-2-css" href="https://fonts.googleapis.com/css?family=Rubik%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=auto&#038;ver=6.4.3" type="text/css" media="all" />
<link rel="stylesheet" id="elementor-icons-shared-0-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.3" type="text/css" media="all" />
<link rel="stylesheet" id="elementor-icons-fa-solid-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.3" type="text/css" media="all" />
<link rel="stylesheet" id="elementor-icons-fa-brands-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css?ver=5.15.3" type="text/css" media="all" />
<link rel="stylesheet" id="rs-plugin-settings-css" href="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/revslider/public/assets/css/rs6.css?ver=6.6.20" type="text/css" media="all" />
<style id="rs-plugin-settings-inline-css" type="text/css"> @media screen and (max-width:767px){.revslider-initialised .tp-bullets.case_theme_number{display:none !important}} </style>
<script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.selectBox.min.js?ver=1.2.0" id="jquery-selectBox-js"></script> <script type="text/javascript" src="//demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min.js?ver=3.1.6" id="prettyPhoto-js" data-wp-strategy="defer"></script> <script type="text/javascript" id="jquery-yith-wcwl-js-extra"> /* <![CDATA[ */
   var yith_wcwl_l10n = {"ajax_url":"\/consultio-immigration\/wp-admin\/admin-ajax.php","redirect_to_cart":"no","yith_wcwl_button_position":"add-to-cart","multi_wishlist":"","hide_add_button":"1","enable_ajax_loading":"","ajax_loader_url":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-content\/plugins\/yith-woocommerce-wishlist\/assets\/images\/ajax-loader-alt.svg","remove_from_wishlist_after_add_to_cart":"1","is_wishlist_responsive":"1","time_to_close_prettyphoto":"3000","fragments_index_glue":".","reload_on_found_variation":"1","mobile_media_query":"768","labels":{"cookie_disabled":"We are sorry, but this feature is available only if cookies on your browser are enabled.","added_to_cart_message":"<div class=\"woocommerce-notices-wrapper\"><div class=\"woocommerce-message\" role=\"alert\">Product added to cart successfully<\/div><\/div>"},"actions":{"add_to_wishlist_action":"add_to_wishlist","remove_from_wishlist_action":"remove_from_wishlist","reload_wishlist_and_adding_elem_action":"reload_wishlist_and_adding_elem","load_mobile_action":"load_mobile","delete_item_action":"delete_item","save_title_action":"save_title","save_privacy_action":"save_privacy","load_fragments":"load_fragments"},"nonce":{"add_to_wishlist_nonce":"615191541c","remove_from_wishlist_nonce":"dfe0c5c508","reload_wishlist_and_adding_elem_nonce":"fdc033d116","load_mobile_nonce":"e1e3b6b42a","delete_item_nonce":"e37af5a54e","save_title_nonce":"367b7b8955","save_privacy_nonce":"506d147950","load_fragments_nonce":"53d39a5e1b"},"redirect_after_ask_estimate":"","ask_estimate_redirect_url":"https:\/\/demo.casethemes.net\/consultio-immigration"};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl.min.js?ver=3.29.0" id="jquery-yith-wcwl-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/swv.min.js?ver=5.8.6" id="swv-js"></script> <script type="text/javascript" id="contact-form-7-js-extra"> /* <![CDATA[ */
   var wpcf7 = {"api":{"root":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-json\/","namespace":"contact-form-7\/v1"}};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/contact-form-7.min.js?ver=5.8.6" id="contact-form-7-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/revslider/public/assets/js/rbtools.min.js?ver=6.6.20" defer async id="tp-tools-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/revslider/public/assets/js/rs6.min.js?ver=6.6.20" defer async id="revmin-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/sourcebuster/sourcebuster.min.js?ver=8.5.2" id="sourcebuster-js-js"></script> <script type="text/javascript" id="wc-order-attribution-js-extra"> /* <![CDATA[ */
   var wc_order_attribution = {"params":{"lifetime":1.0000000000000000818030539140313095458623138256371021270751953125e-5,"session":30,"ajaxurl":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-admin\/admin-ajax.php","prefix":"wc_order_attribution_","allowTracking":"yes"}};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/frontend/order-attribution.min.js?ver=8.5.2" id="wc-order-attribution-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/vendor/wp-polyfill-inert.min.js?ver=3.1.2" id="wp-polyfill-inert-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/vendor/regenerator-runtime.min.js?ver=0.14.0" id="regenerator-runtime-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0" id="wp-polyfill-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/vendor/react.min.js?ver=18.2.0" id="react-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/hooks.min.js?ver=c6aec9a8d4e5a5d543a1" id="wp-hooks-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/deprecated.min.js?ver=73ad3591e7bc95f4777a" id="wp-deprecated-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/dom.min.js?ver=49ff2869626fbeaacc23" id="wp-dom-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/vendor/react-dom.min.js?ver=18.2.0" id="react-dom-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/escape-html.min.js?ver=03e27a7b6ae14f7afaa6" id="wp-escape-html-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/element.min.js?ver=ed1c7604880e8b574b40" id="wp-element-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/is-shallow-equal.min.js?ver=20c2b06ecf04afb14fee" id="wp-is-shallow-equal-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/i18n.min.js?ver=7701b0c3857f914212ef" id="wp-i18n-js"></script> <script type="text/javascript" id="wp-i18n-js-after"> /* <![CDATA[ */
   wp.i18n.setLocaleData( { "text direction\u0004ltr": [ "ltr" ] } );
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/keycodes.min.js?ver=3460bd0fac9859d6886c" id="wp-keycodes-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/priority-queue.min.js?ver=422e19e9d48b269c5219" id="wp-priority-queue-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/compose.min.js?ver=3189b344ff39fef940b7" id="wp-compose-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/private-apis.min.js?ver=11cb2ebaa70a9f1f0ab5" id="wp-private-apis-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/redux-routine.min.js?ver=0be1b2a6a79703e28531" id="wp-redux-routine-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/data.min.js?ver=dc5f255634f3da29c8d5" id="wp-data-js"></script> <script type="text/javascript" id="wp-data-js-after"> /* <![CDATA[ */
   ( function() {
    var userId = 0;
    var storageKey = "WP_DATA_USER_" + userId;
    wp.data
    .use( wp.data.plugins.persistence, { storageKey: storageKey } );
   } )();
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/vendor/lodash.min.js?ver=4.17.19" id="lodash-js"></script> <script type="text/javascript" id="lodash-js-after"> /* <![CDATA[ */
   window.lodash = _.noConflict();
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/wc-blocks-registry.min.js?ver=1c879273bd5c193cad0a" id="wc-blocks-registry-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/url.min.js?ver=b4979979018b684be209" id="wp-url-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/api-fetch.min.js?ver=0fa4dabf8bf2c7adf21a" id="wp-api-fetch-js"></script> <script type="text/javascript" id="wp-api-fetch-js-after"> /* <![CDATA[ */
   wp.apiFetch.use( wp.apiFetch.createRootURLMiddleware( "https://demo.casethemes.net/consultio-immigration/wp-json/" ) );
   wp.apiFetch.nonceMiddleware = wp.apiFetch.createNonceMiddleware( "ca364b38ae" );
   wp.apiFetch.use( wp.apiFetch.nonceMiddleware );
   wp.apiFetch.use( wp.apiFetch.mediaUploadMiddleware );
   wp.apiFetch.nonceEndpoint = "https://demo.casethemes.net/consultio-immigration/wp-admin/admin-ajax.php?action=rest-nonce";
   /* ]]> */ 
</script> <script type="text/javascript" id="wc-settings-js-before"> /* <![CDATA[ */
   var wcSettings = wcSettings || JSON.parse( decodeURIComponent( "%7B%22shippingCostRequiresAddress%22%3Afalse%2C%22adminUrl%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fwp-admin%5C%2F%22%2C%22countries%22%3A%7B%22AF%22%3A%22Afghanistan%22%2C%22AX%22%3A%22%5Cu00c5land%20Islands%22%2C%22AL%22%3A%22Albania%22%2C%22DZ%22%3A%22Algeria%22%2C%22AS%22%3A%22American%20Samoa%22%2C%22AD%22%3A%22Andorra%22%2C%22AO%22%3A%22Angola%22%2C%22AI%22%3A%22Anguilla%22%2C%22AQ%22%3A%22Antarctica%22%2C%22AG%22%3A%22Antigua%20and%20Barbuda%22%2C%22AR%22%3A%22Argentina%22%2C%22AM%22%3A%22Armenia%22%2C%22AW%22%3A%22Aruba%22%2C%22AU%22%3A%22Australia%22%2C%22AT%22%3A%22Austria%22%2C%22AZ%22%3A%22Azerbaijan%22%2C%22BS%22%3A%22Bahamas%22%2C%22BH%22%3A%22Bahrain%22%2C%22BD%22%3A%22Bangladesh%22%2C%22BB%22%3A%22Barbados%22%2C%22BY%22%3A%22Belarus%22%2C%22PW%22%3A%22Belau%22%2C%22BE%22%3A%22Belgium%22%2C%22BZ%22%3A%22Belize%22%2C%22BJ%22%3A%22Benin%22%2C%22BM%22%3A%22Bermuda%22%2C%22BT%22%3A%22Bhutan%22%2C%22BO%22%3A%22Bolivia%22%2C%22BQ%22%3A%22Bonaire%2C%20Saint%20Eustatius%20and%20Saba%22%2C%22BA%22%3A%22Bosnia%20and%20Herzegovina%22%2C%22BW%22%3A%22Botswana%22%2C%22BV%22%3A%22Bouvet%20Island%22%2C%22BR%22%3A%22Brazil%22%2C%22IO%22%3A%22British%20Indian%20Ocean%20Territory%22%2C%22BN%22%3A%22Brunei%22%2C%22BG%22%3A%22Bulgaria%22%2C%22BF%22%3A%22Burkina%20Faso%22%2C%22BI%22%3A%22Burundi%22%2C%22KH%22%3A%22Cambodia%22%2C%22CM%22%3A%22Cameroon%22%2C%22CA%22%3A%22Canada%22%2C%22CV%22%3A%22Cape%20Verde%22%2C%22KY%22%3A%22Cayman%20Islands%22%2C%22CF%22%3A%22Central%20African%20Republic%22%2C%22TD%22%3A%22Chad%22%2C%22CL%22%3A%22Chile%22%2C%22CN%22%3A%22China%22%2C%22CX%22%3A%22Christmas%20Island%22%2C%22CC%22%3A%22Cocos%20%28Keeling%29%20Islands%22%2C%22CO%22%3A%22Colombia%22%2C%22KM%22%3A%22Comoros%22%2C%22CG%22%3A%22Congo%20%28Brazzaville%29%22%2C%22CD%22%3A%22Congo%20%28Kinshasa%29%22%2C%22CK%22%3A%22Cook%20Islands%22%2C%22CR%22%3A%22Costa%20Rica%22%2C%22HR%22%3A%22Croatia%22%2C%22CU%22%3A%22Cuba%22%2C%22CW%22%3A%22Cura%26ccedil%3Bao%22%2C%22CY%22%3A%22Cyprus%22%2C%22CZ%22%3A%22Czech%20Republic%22%2C%22DK%22%3A%22Denmark%22%2C%22DJ%22%3A%22Djibouti%22%2C%22DM%22%3A%22Dominica%22%2C%22DO%22%3A%22Dominican%20Republic%22%2C%22EC%22%3A%22Ecuador%22%2C%22EG%22%3A%22Egypt%22%2C%22SV%22%3A%22El%20Salvador%22%2C%22GQ%22%3A%22Equatorial%20Guinea%22%2C%22ER%22%3A%22Eritrea%22%2C%22EE%22%3A%22Estonia%22%2C%22SZ%22%3A%22Eswatini%22%2C%22ET%22%3A%22Ethiopia%22%2C%22FK%22%3A%22Falkland%20Islands%22%2C%22FO%22%3A%22Faroe%20Islands%22%2C%22FJ%22%3A%22Fiji%22%2C%22FI%22%3A%22Finland%22%2C%22FR%22%3A%22France%22%2C%22GF%22%3A%22French%20Guiana%22%2C%22PF%22%3A%22French%20Polynesia%22%2C%22TF%22%3A%22French%20Southern%20Territories%22%2C%22GA%22%3A%22Gabon%22%2C%22GM%22%3A%22Gambia%22%2C%22GE%22%3A%22Georgia%22%2C%22DE%22%3A%22Germany%22%2C%22GH%22%3A%22Ghana%22%2C%22GI%22%3A%22Gibraltar%22%2C%22GR%22%3A%22Greece%22%2C%22GL%22%3A%22Greenland%22%2C%22GD%22%3A%22Grenada%22%2C%22GP%22%3A%22Guadeloupe%22%2C%22GU%22%3A%22Guam%22%2C%22GT%22%3A%22Guatemala%22%2C%22GG%22%3A%22Guernsey%22%2C%22GN%22%3A%22Guinea%22%2C%22GW%22%3A%22Guinea-Bissau%22%2C%22GY%22%3A%22Guyana%22%2C%22HT%22%3A%22Haiti%22%2C%22HM%22%3A%22Heard%20Island%20and%20McDonald%20Islands%22%2C%22HN%22%3A%22Honduras%22%2C%22HK%22%3A%22Hong%20Kong%22%2C%22HU%22%3A%22Hungary%22%2C%22IS%22%3A%22Iceland%22%2C%22IN%22%3A%22India%22%2C%22ID%22%3A%22Indonesia%22%2C%22IR%22%3A%22Iran%22%2C%22IQ%22%3A%22Iraq%22%2C%22IE%22%3A%22Ireland%22%2C%22IM%22%3A%22Isle%20of%20Man%22%2C%22IL%22%3A%22Israel%22%2C%22IT%22%3A%22Italy%22%2C%22CI%22%3A%22Ivory%20Coast%22%2C%22JM%22%3A%22Jamaica%22%2C%22JP%22%3A%22Japan%22%2C%22JE%22%3A%22Jersey%22%2C%22JO%22%3A%22Jordan%22%2C%22KZ%22%3A%22Kazakhstan%22%2C%22KE%22%3A%22Kenya%22%2C%22KI%22%3A%22Kiribati%22%2C%22KW%22%3A%22Kuwait%22%2C%22KG%22%3A%22Kyrgyzstan%22%2C%22LA%22%3A%22Laos%22%2C%22LV%22%3A%22Latvia%22%2C%22LB%22%3A%22Lebanon%22%2C%22LS%22%3A%22Lesotho%22%2C%22LR%22%3A%22Liberia%22%2C%22LY%22%3A%22Libya%22%2C%22LI%22%3A%22Liechtenstein%22%2C%22LT%22%3A%22Lithuania%22%2C%22LU%22%3A%22Luxembourg%22%2C%22MO%22%3A%22Macao%22%2C%22MG%22%3A%22Madagascar%22%2C%22MW%22%3A%22Malawi%22%2C%22MY%22%3A%22Malaysia%22%2C%22MV%22%3A%22Maldives%22%2C%22ML%22%3A%22Mali%22%2C%22MT%22%3A%22Malta%22%2C%22MH%22%3A%22Marshall%20Islands%22%2C%22MQ%22%3A%22Martinique%22%2C%22MR%22%3A%22Mauritania%22%2C%22MU%22%3A%22Mauritius%22%2C%22YT%22%3A%22Mayotte%22%2C%22MX%22%3A%22Mexico%22%2C%22FM%22%3A%22Micronesia%22%2C%22MD%22%3A%22Moldova%22%2C%22MC%22%3A%22Monaco%22%2C%22MN%22%3A%22Mongolia%22%2C%22ME%22%3A%22Montenegro%22%2C%22MS%22%3A%22Montserrat%22%2C%22MA%22%3A%22Morocco%22%2C%22MZ%22%3A%22Mozambique%22%2C%22MM%22%3A%22Myanmar%22%2C%22NA%22%3A%22Namibia%22%2C%22NR%22%3A%22Nauru%22%2C%22NP%22%3A%22Nepal%22%2C%22NL%22%3A%22Netherlands%22%2C%22NC%22%3A%22New%20Caledonia%22%2C%22NZ%22%3A%22New%20Zealand%22%2C%22NI%22%3A%22Nicaragua%22%2C%22NE%22%3A%22Niger%22%2C%22NG%22%3A%22Nigeria%22%2C%22NU%22%3A%22Niue%22%2C%22NF%22%3A%22Norfolk%20Island%22%2C%22KP%22%3A%22North%20Korea%22%2C%22MK%22%3A%22North%20Macedonia%22%2C%22MP%22%3A%22Northern%20Mariana%20Islands%22%2C%22NO%22%3A%22Norway%22%2C%22OM%22%3A%22Oman%22%2C%22PK%22%3A%22Pakistan%22%2C%22PS%22%3A%22Palestinian%20Territory%22%2C%22PA%22%3A%22Panama%22%2C%22PG%22%3A%22Papua%20New%20Guinea%22%2C%22PY%22%3A%22Paraguay%22%2C%22PE%22%3A%22Peru%22%2C%22PH%22%3A%22Philippines%22%2C%22PN%22%3A%22Pitcairn%22%2C%22PL%22%3A%22Poland%22%2C%22PT%22%3A%22Portugal%22%2C%22PR%22%3A%22Puerto%20Rico%22%2C%22QA%22%3A%22Qatar%22%2C%22RE%22%3A%22Reunion%22%2C%22RO%22%3A%22Romania%22%2C%22RU%22%3A%22Russia%22%2C%22RW%22%3A%22Rwanda%22%2C%22ST%22%3A%22S%26atilde%3Bo%20Tom%26eacute%3B%20and%20Pr%26iacute%3Bncipe%22%2C%22BL%22%3A%22Saint%20Barth%26eacute%3Blemy%22%2C%22SH%22%3A%22Saint%20Helena%22%2C%22KN%22%3A%22Saint%20Kitts%20and%20Nevis%22%2C%22LC%22%3A%22Saint%20Lucia%22%2C%22SX%22%3A%22Saint%20Martin%20%28Dutch%20part%29%22%2C%22MF%22%3A%22Saint%20Martin%20%28French%20part%29%22%2C%22PM%22%3A%22Saint%20Pierre%20and%20Miquelon%22%2C%22VC%22%3A%22Saint%20Vincent%20and%20the%20Grenadines%22%2C%22WS%22%3A%22Samoa%22%2C%22SM%22%3A%22San%20Marino%22%2C%22SA%22%3A%22Saudi%20Arabia%22%2C%22SN%22%3A%22Senegal%22%2C%22RS%22%3A%22Serbia%22%2C%22SC%22%3A%22Seychelles%22%2C%22SL%22%3A%22Sierra%20Leone%22%2C%22SG%22%3A%22Singapore%22%2C%22SK%22%3A%22Slovakia%22%2C%22SI%22%3A%22Slovenia%22%2C%22SB%22%3A%22Solomon%20Islands%22%2C%22SO%22%3A%22Somalia%22%2C%22ZA%22%3A%22South%20Africa%22%2C%22GS%22%3A%22South%20Georgia%5C%2FSandwich%20Islands%22%2C%22KR%22%3A%22South%20Korea%22%2C%22SS%22%3A%22South%20Sudan%22%2C%22ES%22%3A%22Spain%22%2C%22LK%22%3A%22Sri%20Lanka%22%2C%22SD%22%3A%22Sudan%22%2C%22SR%22%3A%22Suriname%22%2C%22SJ%22%3A%22Svalbard%20and%20Jan%20Mayen%22%2C%22SE%22%3A%22Sweden%22%2C%22CH%22%3A%22Switzerland%22%2C%22SY%22%3A%22Syria%22%2C%22TW%22%3A%22Taiwan%22%2C%22TJ%22%3A%22Tajikistan%22%2C%22TZ%22%3A%22Tanzania%22%2C%22TH%22%3A%22Thailand%22%2C%22TL%22%3A%22Timor-Leste%22%2C%22TG%22%3A%22Togo%22%2C%22TK%22%3A%22Tokelau%22%2C%22TO%22%3A%22Tonga%22%2C%22TT%22%3A%22Trinidad%20and%20Tobago%22%2C%22TN%22%3A%22Tunisia%22%2C%22TR%22%3A%22Turkey%22%2C%22TM%22%3A%22Turkmenistan%22%2C%22TC%22%3A%22Turks%20and%20Caicos%20Islands%22%2C%22TV%22%3A%22Tuvalu%22%2C%22UG%22%3A%22Uganda%22%2C%22UA%22%3A%22Ukraine%22%2C%22AE%22%3A%22United%20Arab%20Emirates%22%2C%22GB%22%3A%22United%20Kingdom%20%28UK%29%22%2C%22US%22%3A%22United%20States%20%28US%29%22%2C%22UM%22%3A%22United%20States%20%28US%29%20Minor%20Outlying%20Islands%22%2C%22UY%22%3A%22Uruguay%22%2C%22UZ%22%3A%22Uzbekistan%22%2C%22VU%22%3A%22Vanuatu%22%2C%22VA%22%3A%22Vatican%22%2C%22VE%22%3A%22Venezuela%22%2C%22VN%22%3A%22Vietnam%22%2C%22VG%22%3A%22Virgin%20Islands%20%28British%29%22%2C%22VI%22%3A%22Virgin%20Islands%20%28US%29%22%2C%22WF%22%3A%22Wallis%20and%20Futuna%22%2C%22EH%22%3A%22Western%20Sahara%22%2C%22YE%22%3A%22Yemen%22%2C%22ZM%22%3A%22Zambia%22%2C%22ZW%22%3A%22Zimbabwe%22%7D%2C%22currency%22%3A%7B%22code%22%3A%22GBP%22%2C%22precision%22%3A2%2C%22symbol%22%3A%22%5Cu00a3%22%2C%22symbolPosition%22%3A%22left%22%2C%22decimalSeparator%22%3A%22.%22%2C%22thousandSeparator%22%3A%22%2C%22%2C%22priceFormat%22%3A%22%251%24s%252%24s%22%7D%2C%22currentUserId%22%3A0%2C%22currentUserIsAdmin%22%3Afalse%2C%22dateFormat%22%3A%22j%20M%2C%20Y%22%2C%22homeUrl%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2F%22%2C%22locale%22%3A%7B%22siteLocale%22%3A%22en_US%22%2C%22userLocale%22%3A%22en_US%22%2C%22weekdaysShort%22%3A%5B%22Sun%22%2C%22Mon%22%2C%22Tue%22%2C%22Wed%22%2C%22Thu%22%2C%22Fri%22%2C%22Sat%22%5D%7D%2C%22dashboardUrl%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fmy-account%5C%2F%22%2C%22orderStatuses%22%3A%7B%22pending%22%3A%22Pending%20payment%22%2C%22processing%22%3A%22Processing%22%2C%22on-hold%22%3A%22On%20hold%22%2C%22completed%22%3A%22Completed%22%2C%22cancelled%22%3A%22Cancelled%22%2C%22refunded%22%3A%22Refunded%22%2C%22failed%22%3A%22Failed%22%2C%22checkout-draft%22%3A%22Draft%22%7D%2C%22placeholderImgSrc%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fwp-content%5C%2Fuploads%5C%2Fwoocommerce-placeholder.png%22%2C%22productsSettings%22%3A%7B%22cartRedirectAfterAdd%22%3Afalse%7D%2C%22siteTitle%22%3A%22Consultio%22%2C%22storePages%22%3A%7B%22myaccount%22%3A%7B%22id%22%3A751%2C%22title%22%3A%22My%20account%22%2C%22permalink%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fmy-account%5C%2F%22%7D%2C%22shop%22%3A%7B%22id%22%3A748%2C%22title%22%3A%22Shop%22%2C%22permalink%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fshop%5C%2F%22%7D%2C%22cart%22%3A%7B%22id%22%3A749%2C%22title%22%3A%22Cart%22%2C%22permalink%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fcart%5C%2F%22%7D%2C%22checkout%22%3A%7B%22id%22%3A750%2C%22title%22%3A%22Checkout%22%2C%22permalink%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fcheckout%5C%2F%22%7D%2C%22privacy%22%3A%7B%22id%22%3A0%2C%22title%22%3A%22%22%2C%22permalink%22%3Afalse%7D%2C%22terms%22%3A%7B%22id%22%3A0%2C%22title%22%3A%22%22%2C%22permalink%22%3Afalse%7D%7D%2C%22wcAssetUrl%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fwp-content%5C%2Fplugins%5C%2Fwoocommerce%5C%2Fassets%5C%2F%22%2C%22wcVersion%22%3A%228.5.2%22%2C%22wpLoginUrl%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fwp-login.php%22%2C%22wpVersion%22%3A%226.4.3%22%2C%22collectableMethodIds%22%3A%5B%5D%2C%22admin%22%3A%7B%22wccomHelper%22%3A%7B%22isConnected%22%3Afalse%2C%22connectURL%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%5C%2Fwp-admin%5C%2Fadmin.php%3Fpage%3Dwc-addons%26section%3Dhelper%26wc-helper-connect%3D1%26wc-helper-nonce%3Dac8921016b%22%2C%22userEmail%22%3A%22%22%2C%22userAvatar%22%3A%22https%3A%5C%2F%5C%2Fsecure.gravatar.com%5C%2Favatar%5C%2F%3Fs%3D48%26d%3Dmm%26r%3Dg%22%2C%22storeCountry%22%3A%22GB%22%2C%22inAppPurchaseURLParams%22%3A%7B%22wccom-site%22%3A%22https%3A%5C%2F%5C%2Fdemo.casethemes.net%5C%2Fconsultio-immigration%22%2C%22wccom-back%22%3A%22%252Fconsultio-immigration%252F%22%2C%22wccom-woo-version%22%3A%228.5.2%22%2C%22wccom-connect-nonce%22%3A%22ac8921016b%22%7D%7D%2C%22_feature_nonce%22%3A%22955803a3d5%22%2C%22alertCount%22%3A%221%22%2C%22visibleTaskListIds%22%3A%5B%5D%7D%7D" ) );
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/wc-settings.min.js?ver=07c2f0675ddd247d2325" id="wc-settings-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/data-controls.min.js?ver=fe4ccc8a1782ea8e2cb1" id="wp-data-controls-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/html-entities.min.js?ver=36a4a255da7dd2e1bf8e" id="wp-html-entities-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/notices.min.js?ver=38e88f4b627cf873edd0" id="wp-notices-js"></script> <script type="text/javascript" id="wc-blocks-middleware-js-before"> /* <![CDATA[ */
   var wcBlocksMiddlewareConfig = {
   storeApiNonce: "287a1212f0",
   wcStoreApiNonceTimestamp: "1708640267"
   }; 
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/wc-blocks-middleware.min.js?ver=ca04183222edaf8a26be" id="wc-blocks-middleware-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/wc-blocks-data-store.min.js?ver=c96aba0171b12e03b8a6" id="wc-blocks-data-store-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/dom-ready.min.js?ver=392bdd43726760d1f3ca" id="wp-dom-ready-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/a11y.min.js?ver=7032343a947cfccf5608" id="wp-a11y-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/primitives.min.js?ver=6984e6eb5d6157c4fe44" id="wp-primitives-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/dist/warning.min.js?ver=122829a085511691f14d" id="wp-warning-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/wc-blocks-components.min.js?ver=b165bb2bd213326d7f31" id="wc-blocks-components-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/wc-blocks-checkout.min.js?ver=9f469ef17beaf7c51576" id="wc-blocks-checkout-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/frontend/order-attribution-blocks.min.js?ver=8.5.2" id="wc-order-attribution-blocks-js"></script> <script type="text/javascript" id="yith-wcqv-frontend-js-extra"> /* <![CDATA[ */
   var yith_qv = {"ajaxurl":"\/consultio-immigration\/wp-admin\/admin-ajax.php","loader":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-content\/plugins\/yith-woocommerce-quick-view\/assets\/image\/qv-loader.gif","lang":""};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/yith-woocommerce-quick-view/assets/js/frontend.min.js?ver=1.35.0" id="yith-wcqv-frontend-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/bootstrap.min.js?ver=4.0.0" id="bootstrap-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/nice-select.min.js?ver=all" id="nice-select-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/match-height.min.js?ver=1.0.0" id="match-height-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/magnific-popup.min.js?ver=1.0.0" id="magnific-popup-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/progressbar.min.js?ver=1.0.0" id="progressbar-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/wow.min.js?ver=1.0.0" id="wow-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/jquery/ui/core.min.js?ver=1.13.2" id="jquery-ui-core-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/jquery/ui/mouse.min.js?ver=1.13.2" id="jquery-ui-mouse-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/jquery/ui/slider.min.js?ver=1.13.2" id="jquery-ui-slider-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/consultio-main.min.js?ver=3.2.1" id="consultio-main-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/uploads/siteground-optimizer-assets/consultio-woocommerce.min.js?ver=3.2.1" id="consultio-woocommerce-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/libs/gsap.min.js?ver=3.5.0" id="gsap-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/libs/scroll-trigger.js?ver=3.10.5" id="pxl-scroll-trigger-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/libs/split-text.js?ver=3.6.1" id="pxl-splitText-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/elementor/js/ct-elementor.js?ver=3.2.1" id="ct-elementor-js-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/jquery-numerator/jquery-numerator.min.js?ver=0.2.1" id="jquery-numerator-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/elementor/js/ct-counter-widget.js?ver=3.2.1" id="ct-counter-widget-js-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/imagesloaded.min.js?ver=5.0.0" id="imagesloaded-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/case-theme-core/assets/js/lib/isotope.pkgd.min.js?ver=3.0.5" id="isotope-js"></script> <script type="text/javascript" id="ct-post-masonry-widget-js-js-extra"> /* <![CDATA[ */
   var main_data = {"ajax_url":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-admin\/admin-ajax.php"};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/elementor/js/ct-post-masonry-widget.js?ver=3.2.1" id="ct-post-masonry-widget-js-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/elementor/js/ct-post-grid-widget.js?ver=3.2.1" id="ct-post-grid-widget-js-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/case-theme-core/assets/js/lib/slick.min.js?ver=1.8.1" id="jquery-slick-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/elementor/js/ct-post-carousel-widget.js?ver=3.2.1" id="ct-post-carousel-widget-js-js"></script> <script type="text/javascript" id="sbi_scripts-js-extra"> /* <![CDATA[ */
   var sb_instagram_js_options = {"font_method":"svg","resized_url":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-content\/uploads\/sb-instagram-feed-images\/","placeholder":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-content\/plugins\/instagram-feed\/img\/placeholder.png","ajax_url":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-admin\/admin-ajax.php"};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/instagram-feed/js/sbi-scripts.min.js?ver=6.2.7" id="sbi_scripts-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/jquery.cookie.js?ver=1.4.1" id="ct-cookie-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/themes/csuti/assets/js/newsletter-popup.js?ver=all" id="newsletter-popup-js"></script> <script type="text/javascript" defer src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/mailchimp-for-wp/assets/js/forms.js?ver=4.9.11" id="mc4wp-forms-api-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/underscore.min.js?ver=1.13.4" id="underscore-js"></script> <script type="text/javascript" id="wp-util-js-extra"> /* <![CDATA[ */
   var _wpUtilSettings = {"ajax":{"url":"\/consultio-immigration\/wp-admin\/admin-ajax.php"}};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-includes/js/wp-util.min.js?ver=6.4.3" id="wp-util-js"></script> <script type="text/javascript" id="wc-add-to-cart-variation-js-extra"> /* <![CDATA[ */
   var wc_add_to_cart_variation_params = {"wc_ajax_url":"\/consultio-immigration\/?wc-ajax=%%endpoint%%","i18n_no_matching_variations_text":"Sorry, no products matched your selection. Please choose a different combination.","i18n_make_a_selection_text":"Please select some product options before adding this product to your cart.","i18n_unavailable_text":"Sorry, this product is unavailable. Please choose a different combination."};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js?ver=8.5.2" id="wc-add-to-cart-variation-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/zoom/jquery.zoom.min.js?ver=1.7.21-wc.8.5.2" id="zoom-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe.min.js?ver=4.1.1-wc.8.5.2" id="photoswipe-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe-ui-default.min.js?ver=4.1.1-wc.8.5.2" id="photoswipe-ui-default-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" id="wc-single-product-js-extra"> /* <![CDATA[ */
   var wc_single_product_params = {"i18n_required_rating_text":"Please select a rating","review_rating_required":"yes","flexslider":{"rtl":false,"animation":"slide","smoothHeight":true,"directionNav":false,"controlNav":"thumbnails","slideshow":false,"animationSpeed":500,"animationLoop":false,"allowOneSlide":false},"zoom_enabled":"1","zoom_options":[],"photoswipe_enabled":"1","photoswipe_options":{"shareEl":false,"closeOnScroll":false,"history":false,"hideAnimationDuration":0,"showAnimationDuration":0},"flexslider_enabled":"1"};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js?ver=8.5.2" id="wc-single-product-js" defer="defer" data-wp-strategy="defer"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.18.3" id="elementor-webpack-runtime-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.18.3" id="elementor-frontend-modules-js"></script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2" id="elementor-waypoints-js"></script> <script type="text/javascript" id="elementor-frontend-js-before"> /* <![CDATA[ */
   var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselWrapperAriaLabel":"Carousel | Horizontal scrolling: Arrow Left & Right","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},"version":"3.18.3","is_static":false,"experimentalFeatures":{"e_dom_optimization":true,"e_optimized_assets_loading":true,"additional_custom_breakpoints":true,"block_editor_assets_optimize":true,"landing-pages":true,"e_image_loading_optimization":true,"e_global_styleguide":true},"urls":{"assets":"https:\/\/demo.casethemes.net\/consultio-immigration\/wp-content\/plugins\/elementor\/assets\/"},"swiperClass":"swiper-container","settings":{"page":[],"editorPreferences":[]},"kit":{"global_image_lightbox":"yes","active_breakpoints":["viewport_mobile","viewport_tablet"],"lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":9,"title":"Consultio%20%E2%80%93%20Consulting%20Finance%20WordPress%20Theme","excerpt":"","featuredImage":false}};
   /* ]]> */ 
</script> <script type="text/javascript" src="https://demo.casethemes.net/consultio-immigration/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.18.3" id="elementor-frontend-js"></script> <script id="rs-initialisation-scripts"> var	tpj = jQuery;
   var	revapi1;
   if(window.RS_MODULES === undefined) window.RS_MODULES = {};
   if(RS_MODULES.modules === undefined) RS_MODULES.modules = {};
   RS_MODULES.modules["revslider11"] = {once: RS_MODULES.modules["revslider11"]!==undefined ? RS_MODULES.modules["revslider11"].once : undefined, init:function() {
   window.revapi1 = window.revapi1===undefined || window.revapi1===null || window.revapi1.length===0  ? document.getElementById("rev_slider_1_1") : window.revapi1;
   if(window.revapi1 === null || window.revapi1 === undefined || window.revapi1.length==0) { window.revapi1initTry = window.revapi1initTry ===undefined ? 0 : window.revapi1initTry+1; if (window.revapi1initTry<20) requestAnimationFrame(function() {RS_MODULES.modules["revslider11"].init()}); return;}
   window.revapi1 = jQuery(window.revapi1);
   if(window.revapi1.revolution==undefined){ revslider_showDoubleJqueryError("rev_slider_1_1"); return;}
   revapi1.revolutionInit({
   revapi:"revapi1",
   sliderLayout:"fullwidth",
   visibilityLevels:"1240,1024,778,480",
   gridwidth:"1240,1024,778,480",
   gridheight:"710,710,540,480",
   lazyType:"smart",
   spinner:"spinner0",
   perspective:600,
   perspectiveType:"global",
   keepBPHeight:true,
   editorheight:"710,710,540,480",
   responsiveLevels:"1240,1024,778,480",
   progressBar:{disableProgressBar:true},
   navigation: {
   onHoverStop:false,
   bullets: {
   enable:true,
   tmp:"",
   style:"case_theme_number",
   h_align:"right",
   v_align:"center",
   h_offset:35,
   v_offset:0,
   direction:"vertical",
   space:12
   }
   },
   viewPort: {
   global:true,
   globalDist:"-200px",
   enable:false
   },
   fallbacks: {
   allowHTML5AutoPlayOnAndroid:true
   },
   }); 
   }} // End of RevInitScript
   if (window.RS_MODULES.checkMinimal!==undefined) { window.RS_MODULES.checkMinimal();};
</script>
      
        ';
}

function registerBodyClass(){
    return ['home page-template-default page page-id-9 theme-csuti woocommerce-no-js redux-page  site-h22 heading-default-font header-sticky  ct-gradient-same  btn-type-normal  fixed-footer  mobile-header-light  site-404-default elementor-default elementor-kit-4540 elementor-page elementor-page-9'];
}

add_shortcode('navbar', function($atts, $content){
    //  [navbar id=1871 type=vertical]
     $id = @$atts['id'];
     $type = @$atts['type'] ?? 'horizontal';
     ob_start();
     if($type == 'vertical'){
         $arr = [
            'id' => '',
            'class' => '',
            'itemClass'    =>  '',
            'anchorClass'  =>  '',
            'dropdownUlClass'   => '',
            'childItemClass'    => '',
            'childAnchorClass'  => '',
            'childActiveClass'  => '',
            'dropdownLiClass'   => '',
            'dropdownAnchorClass'   => '',
            'extendBefore'      =>  '',
            'extendAfter'       =>  '',
        ];
        $items = $this->MenuModel->items($id)['items'];
        print $this->MenuModel->get_menu($items,$arr);
     }else{
     echo '
      <nav id="navbar" class="navbar">
        ';
        $arr = [
            'id' => '',
            'class' => '',
            'itemClass'    =>  '',
            'anchorClass'  =>  'nav-link scrollto',
            'dropdownUlClass'   => '',
            'childItemClass'    => '',
            'childAnchorClass'  => '',
            'childActiveClass'  => '',
            'dropdownLiClass'   => 'dropdown',
            'dropdownAnchorClass'   => '',
            'extendBefore'      =>  '',
            'extendAfter'       =>  '',
        ];
        $items = $this->MenuModel->items($id)['items'];
        print $this->MenuModel->get_menu($items,$arr);
       echo '<i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
';
}
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
