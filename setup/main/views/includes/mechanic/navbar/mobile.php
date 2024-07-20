
    
    
    


<div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox elementor-popup-modal"
    id="elementor-popup-modal-174915" aria-modal="true" role="document" tabindex="0" style="display:none;">
    <div class="dialog-widget-content dialog-lightbox-widget-content animated"><a role="button" tabindex="0"
            aria-label="Close" href="#" class="dialog-close-button dialog-lightbox-close-button"><svg
                class="e-font-icon-svg e-eicon-close eicon-close">
                <use xlink:href="#eicon-close"></use>
            </svg></a>
        <div class="dialog-header dialog-lightbox-header"></div>
        <div class="dialog-message dialog-lightbox-message">
            <div data-elementor-type="popup" data-elementor-id="174915"
                class="elementor elementor-174915 elementor-location-popup"
                data-elementor-settings="{&quot;entrance_animation&quot;:&quot;none&quot;,&quot;exit_animation&quot;:&quot;none&quot;,&quot;entrance_animation_duration&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;prevent_scroll&quot;:&quot;yes&quot;,&quot;a11y_navigation&quot;:&quot;yes&quot;,&quot;timing&quot;:[]}"
                data-elementor-post-type="elementor_library" style="display: block;">
                <div class="elementor-element elementor-element-30d7295 e-flex e-con-boxed e-con e-parent"
                    data-id="30d7295" data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-1ed92f7 elementor-widget elementor-widget-image"
                            data-id="1ed92f7" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <a href="index.html">
                                    <img data-lazyloaded="1"
                                        src="<?php echo LOGO; ?>"
                                        loading="lazy" width="231" height="120"
                                        data-src="<?php echo LOGO; ?>"
                                        class="attachment-full size-full wp-image-52341 entered litespeed-loaded"
                                        alt="apna mechanic logo"
                                        data-sizes="(max-width: 231px) 100vw, 231px" data-ll-status="loaded"
                                        sizes="(max-width: 231px) 100vw, 231px"
                                        >
                                </a>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-3a0bedd elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                            data-id="3a0bedd" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-84e8632 e-flex e-con-boxed e-con e-parent"
                    data-id="84e8632" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-3ba0142 elementor-widget elementor-widget-heading"
                            data-id="3ba0142" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">Welcome to <?php echo TITLE; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-eb30533 e-flex e-con-boxed e-con e-parent"
                    data-id="eb30533" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-ab9bd0c elementor-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                            data-id="ab9bd0c" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                
                            <?
                                    $arr = [
                                            'id' => '',
                                            'class' => 'elementor-icon-list-items',
                                            'itemClass'    =>  'elementor-icon-list-item',
                                            'anchorClass'  =>  'elementor-icon-list-text',
                                            'dropdownUlClass'   => 'submenu',
                                            'childItemClass'    => '',
                                            'childAnchorClass'  => '',
                                            'childActiveClass'  => 'active',
                                            'dropdownLiClass'   => 'has-children has-children--multilevel-submenu',
                                            'dropdownAnchorClass'   => '',
                                            'extendBefore'      =>  '',
                                            'extendAfter'       =>  '',
                                        ];
                                        $items = $this->MenuModel->items($id)['items'];
                                        print $this->MenuModel->get_menu($items,$arr);
                                        
                                    ?>
                                    

                            <!-- <ul class="elementor-icon-list-items">
                                    <li class="elementor-icon-list-item">
                                        <a href="index.html"><span class="elementor-icon-list-icon">
                                                <i aria-hidden="true" class="rhicon rhi-home"></i> </span>
                                            <span class="elementor-icon-list-text">Home</span>
                                        </a>
                                    </li>
                                    <li class="elementor-icon-list-item">
                                        <a href="about/index.html"><span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-far-user"
                                                    viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">About</span>
                                        </a>
                                    </li>
                                    <li class="elementor-icon-list-item">
                                        <a href="services/index.html"><span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-hand-holding-heart"
                                                    viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M275.3 250.5c7 7.4 18.4 7.4 25.5 0l108.9-114.2c31.6-33.2 29.8-88.2-5.6-118.8-30.8-26.7-76.7-21.9-104.9 7.7L288 36.9l-11.1-11.6C248.7-4.4 202.8-9.2 172 17.5c-35.3 30.6-37.2 85.6-5.6 118.8l108.9 114.2zm290 77.6c-11.8-10.7-30.2-10-42.6 0L430.3 402c-11.3 9.1-25.4 14-40 14H272c-8.8 0-16-7.2-16-16s7.2-16 16-16h78.3c15.9 0 30.7-10.9 33.3-26.6 3.3-20-12.1-37.4-31.6-37.4H192c-27 0-53.1 9.3-74.1 26.3L71.4 384H16c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h356.8c14.5 0 28.6-4.9 40-14L564 377c15.2-12.1 16.4-35.3 1.3-48.9z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">Services</span>
                                        </a>
                                    </li>
                                    <li class="elementor-icon-list-item">
                                        <a href="blog/index.html"><span class="elementor-icon-list-icon">
                                                <i aria-hidden="true" class="rhicon rhi-newspaper"></i> </span>
                                            <span class="elementor-icon-list-text">Blog</span>
                                        </a>
                                    </li>
                                    <li class="elementor-icon-list-item">
                                        <a href="franchise/index.html"><span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-store-alt"
                                                    viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M320 384H128V224H64v256c0 17.7 14.3 32 32 32h256c17.7 0 32-14.3 32-32V224h-64v160zm314.6-241.8l-85.3-128c-6-8.9-16-14.2-26.7-14.2H117.4c-10.7 0-20.7 5.3-26.6 14.2l-85.3 128c-14.2 21.3 1 49.8 26.6 49.8H608c25.5 0 40.7-28.5 26.6-49.8zM512 496c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V224h-64v272z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">Own a Franchise</span>
                                        </a>
                                    </li>
                                    <li class="elementor-icon-list-item">
                                        <a href="register-workshop/index.html"><span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-far-handshake"
                                                    viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M519.2 127.9l-47.6-47.6A56.252 56.252 0 0 0 432 64H205.2c-14.8 0-29.1 5.9-39.6 16.3L118 127.9H0v255.7h64c17.6 0 31.8-14.2 31.9-31.7h9.1l84.6 76.4c30.9 25.1 73.8 25.7 105.6 3.8 12.5 10.8 26 15.9 41.1 15.9 18.2 0 35.3-7.4 48.8-24 22.1 8.7 48.2 2.6 64-16.8l26.2-32.3c5.6-6.9 9.1-14.8 10.9-23h57.9c.1 17.5 14.4 31.7 31.9 31.7h64V127.9H519.2zM48 351.6c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16c0 8.9-7.2 16-16 16zm390-6.9l-26.1 32.2c-2.8 3.4-7.8 4-11.3 1.2l-23.9-19.4-30 36.5c-6 7.3-15 4.8-18 2.4l-36.8-31.5-15.6 19.2c-13.9 17.1-39.2 19.7-55.3 6.6l-97.3-88H96V175.8h41.9l61.7-61.6c2-.8 3.7-1.5 5.7-2.3H262l-38.7 35.5c-29.4 26.9-31.1 72.3-4.4 101.3 14.8 16.2 61.2 41.2 101.5 4.4l8.2-7.5 108.2 87.8c3.4 2.8 3.9 7.9 1.2 11.3zm106-40.8h-69.2c-2.3-2.8-4.9-5.4-7.7-7.7l-102.7-83.4 12.5-11.4c6.5-6 7-16.1 1-22.6L367 167.1c-6-6.5-16.1-6.9-22.6-1l-55.2 50.6c-9.5 8.7-25.7 9.4-34.6 0-9.3-9.9-8.5-25.1 1.2-33.9l65.6-60.1c7.4-6.8 17-10.5 27-10.5l83.7-.2c2.1 0 4.1.8 5.5 2.3l61.7 61.6H544v128zm48 47.7c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16c0 8.9-7.2 16-16 16z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">Register Your Workshop</span>
                                        </a>
                                    </li>
                                    <li class="elementor-icon-list-item">
                                        <a href="corporate/index.html"><span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-building"
                                                    viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">Apna Mechanic For Business</span>
                                        </a>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="elementor-element elementor-element-831a2e8 e-flex e-con-boxed e-con e-parent"
                    data-id="831a2e8" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-dcfae07 e-con-full e-flex e-con e-child"
                            data-id="dcfae07" data-element_type="container">
                            <div class="elementor-element elementor-element-3e0518a elementor-align-justify elementor-widget elementor-widget-button"
                                data-id="3e0518a" data-element_type="widget" data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm"
                                            href="https://book.apnamechanic.com/">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-icon elementor-align-icon-">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-motorcycle"
                                                        viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M512.9 192c-14.9-.1-29.1 2.3-42.4 6.9L437.6 144H520c13.3 0 24-10.7 24-24V88c0-13.3-10.7-24-24-24h-45.3c-6.8 0-13.3 2.9-17.8 7.9l-37.5 41.7-22.8-38C392.2 68.4 384.4 64 376 64h-80c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h66.4l19.2 32H227.9c-17.7-23.1-44.9-40-99.9-40H72.5C59 104 47.7 115 48 128.5c.2 13 10.9 23.5 24 23.5h56c24.5 0 38.7 10.9 47.8 24.8l-11.3 20.5c-13-3.9-26.9-5.7-41.3-5.2C55.9 194.5 1.6 249.6 0 317c-1.6 72.1 56.3 131 128 131 59.6 0 109.7-40.8 124-96h84.2c13.7 0 24.6-11.4 24-25.1-2.1-47.1 17.5-93.7 56.2-125l12.5 20.8c-27.6 23.7-45.1 58.9-44.8 98.2.5 69.6 57.2 126.5 126.8 127.1 71.6.7 129.8-57.5 129.2-129.1-.7-69.6-57.6-126.4-127.2-126.9zM128 400c-44.1 0-80-35.9-80-80s35.9-80 80-80c4.2 0 8.4.3 12.5 1L99 316.4c-8.8 16 2.8 35.6 21 35.6h81.3c-12.4 28.2-40.6 48-73.3 48zm463.9-75.6c-2.2 40.6-35 73.4-75.5 75.5-46.1 2.5-84.4-34.3-84.4-79.9 0-21.4 8.4-40.8 22.1-55.1l49.4 82.4c4.5 7.6 14.4 10 22 5.5l13.7-8.2c7.6-4.5 10-14.4 5.5-22l-48.6-80.9c5.2-1.1 10.5-1.6 15.9-1.6 45.6-.1 82.3 38.2 79.9 84.3z">
                                                        </path>
                                                    </svg> </span>
                                                <span class="elementor-button-text">BOOK BIKE SERVICE</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-d4c4541 e-con-full e-flex e-con e-child"
                            data-id="d4c4541" data-element_type="container">
                            <div class="elementor-element elementor-element-72707b6 elementor-align-justify elementor-widget elementor-widget-button"
                                data-id="72707b6" data-element_type="widget" data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm"
                                            href="cars/index.html">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-icon elementor-align-icon-">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-car"
                                                        viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M499.99 176h-59.87l-16.64-41.6C406.38 91.63 365.57 64 319.5 64h-127c-46.06 0-86.88 27.63-103.99 70.4L71.87 176H12.01C4.2 176-1.53 183.34.37 190.91l6 24C7.7 220.25 12.5 224 18.01 224h20.07C24.65 235.73 16 252.78 16 272v48c0 16.12 6.16 30.67 16 41.93V416c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32v-32h256v32c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32v-54.07c9.84-11.25 16-25.8 16-41.93v-48c0-19.22-8.65-36.27-22.07-48H494c5.51 0 10.31-3.75 11.64-9.09l6-24c1.89-7.57-3.84-14.91-11.65-14.91zm-352.06-17.83c7.29-18.22 24.94-30.17 44.57-30.17h127c19.63 0 37.28 11.95 44.57 30.17L384 208H128l19.93-49.83zM96 319.8c-19.2 0-32-12.76-32-31.9S76.8 256 96 256s48 28.71 48 47.85-28.8 15.95-48 15.95zm320 0c-19.2 0-48 3.19-48-15.95S396.8 256 416 256s32 12.76 32 31.9-12.8 31.9-32 31.9z">
                                                        </path>
                                                    </svg> </span>
                                                <span class="elementor-button-text">BOOK CAR SERVICE</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="elementor-element elementor-element-3b3e6be e-flex e-con-boxed e-con e-parent"
                    data-id="3b3e6be" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-a8ed909 elementor-widget elementor-widget-heading"
                            data-id="a8ed909" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">Are you a Mechanic?</h2>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-ec5fbb9 elementor-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                            data-id="ec5fbb9" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                <ul class="elementor-icon-list-items">
                                    <li class="elementor-icon-list-item">
                                        <a href="partners/index.html"><span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-user-cog"
                                                    viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M610.5 373.3c2.6-14.1 2.6-28.5 0-42.6l25.8-14.9c3-1.7 4.3-5.2 3.3-8.5-6.7-21.6-18.2-41.2-33.2-57.4-2.3-2.5-6-3.1-9-1.4l-25.8 14.9c-10.9-9.3-23.4-16.5-36.9-21.3v-29.8c0-3.4-2.4-6.4-5.7-7.1-22.3-5-45-4.8-66.2 0-3.3.7-5.7 3.7-5.7 7.1v29.8c-13.5 4.8-26 12-36.9 21.3l-25.8-14.9c-2.9-1.7-6.7-1.1-9 1.4-15 16.2-26.5 35.8-33.2 57.4-1 3.3.4 6.8 3.3 8.5l25.8 14.9c-2.6 14.1-2.6 28.5 0 42.6l-25.8 14.9c-3 1.7-4.3 5.2-3.3 8.5 6.7 21.6 18.2 41.1 33.2 57.4 2.3 2.5 6 3.1 9 1.4l25.8-14.9c10.9 9.3 23.4 16.5 36.9 21.3v29.8c0 3.4 2.4 6.4 5.7 7.1 22.3 5 45 4.8 66.2 0 3.3-.7 5.7-3.7 5.7-7.1v-29.8c13.5-4.8 26-12 36.9-21.3l25.8 14.9c2.9 1.7 6.7 1.1 9-1.4 15-16.2 26.5-35.8 33.2-57.4 1-3.3-.4-6.8-3.3-8.5l-25.8-14.9zM496 400.5c-26.8 0-48.5-21.8-48.5-48.5s21.8-48.5 48.5-48.5 48.5 21.8 48.5 48.5-21.7 48.5-48.5 48.5zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm201.2 226.5c-2.3-1.2-4.6-2.6-6.8-3.9l-7.9 4.6c-6 3.4-12.8 5.3-19.6 5.3-10.9 0-21.4-4.6-28.9-12.6-18.3-19.8-32.3-43.9-40.2-69.6-5.5-17.7 1.9-36.4 17.9-45.7l7.9-4.6c-.1-2.6-.1-5.2 0-7.8l-7.9-4.6c-16-9.2-23.4-28-17.9-45.7.9-2.9 2.2-5.8 3.2-8.7-3.8-.3-7.5-1.2-11.4-1.2h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c10.1 0 19.5-3.2 27.2-8.5-1.2-3.8-2-7.7-2-11.8v-9.2z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">Join our mechanic partner network
                                                today
                                                !</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="elementor-element elementor-element-5dbd9b2 e-flex e-con-boxed e-con e-parent"
                    data-id="5dbd9b2" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-7e2f0c7 elementor-widget elementor-widget-heading"
                            data-id="7e2f0c7" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">Join us for latest news and
                                    discount
                                    offers</h2>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-252cfa0 elementor-icon-list--layout-inline elementor-align-left elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                            data-id="252cfa0" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                <ul class="elementor-icon-list-items elementor-inline-items">
                                    <li class="elementor-icon-list-item elementor-inline-item">
                                        <a href="https://whatsapp.com/channel/0029VaUsQgL0AgWDhTJUCk0E"><span
                                                class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fab-whatsapp"
                                                    viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">Whatsapp Channel</span>
                                        </a>
                                    </li>
                                    <li class="elementor-icon-list-item elementor-inline-item">
                                        <a href="https://t.me/apnamechanic"><span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fab-telegram"
                                                    viewBox="0 0 496 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm121.8 169.9l-40.7 191.8c-3 13.6-11.1 16.9-22.4 10.5l-62-45.7-29.9 28.8c-3.3 3.3-6.1 6.1-12.5 6.1l4.4-63.1 114.9-103.8c5-4.4-1.1-6.9-7.7-2.5l-142 89.4-61.2-19.1c-13.3-4.2-13.6-13.3 2.8-19.7l239.1-92.2c11.1-4 20.8 2.7 17.2 19.5z">
                                                    </path>
                                                </svg> </span>
                                            <span class="elementor-icon-list-text">Telegram Group</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="elementor-element elementor-element-2fac4a9 e-flex e-con-boxed e-con e-parent"
                    data-id="2fac4a9" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-e8a5918 elementor-widget elementor-widget-text-editor"
                            data-id="e8a5918" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <p>© Copyright <?php echo date('Y'); ?>. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dialog-buttons-wrapper dialog-lightbox-buttons-wrapper"></div>
    </div>
</div>