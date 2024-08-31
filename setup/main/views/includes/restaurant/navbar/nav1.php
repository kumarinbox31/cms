<?php /*
<div class="header-area header-area--absolute">
        <div class="preview-header-inner header-sticky">
            <div class="container-fluid container-fluid--cp-150">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header position-relative">
                            <!-- brand logo -->
                            <div class="header__logo">
                                <a href="/">
                                    <img src="<?php echo LOGO; ?>" aria-label="No Image" width="160" height="48" class="img-fluid light-logo" alt="">
                                    <img src="<?php echo LOGO; ?>" aria-label="Logo" width="160" height="48" class="img-fluid dark-logo" alt="">
                                </a>
                            </div>
                            <!-- navigation menu -->
                            <div class="header__navigation menu-style-four preview-menu d-none d-xl-block">
                                <nav class="navigation-menu navigation-menu--onepage navigation-menu-right">
                                    <?
                                    $arr = [
                                            'id' => '',
                                            'class' => '',
                                            'itemClass'    =>  '',
                                            'anchorClass'  =>  '',
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
                                    
                                </nav>
                            </div>
                            <!-- header actions -->
                            <div class="header__actions--preview">
                                <div class="header__actions">
                                    <!-- mobile menu -->
                                    <div id="mobile-menu-trigger" onclick="mobileMenuTrigger()" class="mobile-navigation-icon d-block d-xl-none"><i></i></div>
                                    <!-- hidden icons menu -->
                                    <div class="hidden-icons-menu d-block d-md-none" id="hidden-icon-trigger">
                                        <a href="javascript:void(0)">
                                            <i class="far fa-ellipsis-h-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 */?>   
<!--  header  -->
<header class="main-header">
                <div class="container">
                    <!--  header-top -->
                    <!-- <div class="header-top  fl-wrap">
                        <div class="header-top_contacts"><a href="#"><span>Call:</span> +489756412322</a><a href="#"><span>Find us:</span> USA 27TH Brooklyn NY</a></div>
                        <div class="header-social">
                            <ul>
                                <li><a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa-brands fa-tiktok"></i></a></li>
                            </ul>
                        </div>
                        <div class="booking-reviews">
                            <div class="br-counter">
                                <div class="ribbon"></div>
                                <span>4.9</span>
                            </div>
                            <a href="#" target="_blank" class="br_link">
                                <div class="star-rating" data-starrating="5"> </div>
                                <p>Our ratings on Booking.com</p>
                            </a>
                        </div>
                        <div class="lang-wrap"><a href="#" class="act-lang">En</a><span>/</span><a href="#">Fr</a></div>
                    </div> -->
                    <!--  header-top end  -->
                    <div class="nav-holder-wrap init-fix-header  fl-wrap">
                        <a href="/" class="logo-holder"><img src="<?php echo LOGO; ?>" alt=""></a>
                        <!--  navigation -->
                        <div class="nav-holder main-menu">
                            <nav>
                            <?
                                    $arr = [
                                            'id' => '',
                                            'class' => '',
                                            'itemClass'    =>  '',
                                            'anchorClass'  =>  '',
                                            'dropdownUlClass'   => 'submenu',
                                            'childItemClass'    => '',
                                            'childAnchorClass'  => '',
                                            'childActiveClass'  => 'active',
                                            'dropdownLiClass'   => '',
                                            'dropdownAnchorClass'   => '',
                                            'extendBefore'      =>  '',
                                            'extendAfter'       =>  '',
                                        ];
                                        $items = $this->MenuModel->items($id)['items'];
                                        print $this->MenuModel->get_menu($items,$arr);
                                        
                                    ?>
                                    
                                <!-- <ul>
                                    <li>
                                        <a href="#" class="act-link">Home <i class="fas fa-caret-down"></i></a>
                                        <ul>
                                            <li><a href="index.html">Style 1</a></li>
                                            <li><a href="index2.html">Style 2</a></li>
                                            <li><a href="index3.html">Style 3</a></li>
                                            <li><a href="onepage.html">One Page</a></li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About</a></li>
                                    <li>
                                        <a href="#">Rooms<i class="fas fa-caret-down"></i></a>
                                        <ul>
                                            <li><a href="rooms.html">Rooms 1</a></li>
                                            <li><a href="rooms2.html">Rooms 2</a></li>
                                            <li><a href="rooms3.html">Rooms 3</a></li>
                                            <li><a href="rooms4.html">Rooms 4</a></li>
                                            <li><a href="room-single.html">Room single</a></li>
                                            <li><a href="room-single2.html">Room single 2</a></li>
                                            <li><a href="room-single3.html">Room single 3</a></li>
                                        </ul>
                                     </li>
                                    <li><a href="restaurant.html">Restaurant</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="blog.html">News</a></li>
                                </ul> -->
                            </nav>
                        </div>
                        <!-- nav-button-wrap-->
                        <div class="nav-button-wrap">
                            <div class="nav-button">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <!-- nav-button-wrap end-->
                        <?/*<!-- navigation  end -->  		
                        <div class="serach-header-btn_wrap">							
                            <a href="rooms.html" class="serach-header-btn"><i class="fa-light fa-magnifying-glass"></i> <span>Serach a Room</span></a>
                        </div>
                        <div class="show-cart sc_btn   htact"><i class="fa-light fa-basket-shopping-simple"></i><span class="show-cart_count">2</span><span class="header-tooltip">Your Wishlist</span></div>
                        <div class="show-share-btn showshare htact"><i class="fa-light fa-share-nodes"></i><span class="header-tooltip">Share</span></div>
                        					
                        <!-- share-wrapper -->
                        <div class="share-wrapper isShare">
                            <div class="share-container fl-wrap"></div>
                        </div>
                        <!-- share-wrapper-end -->					
                        <!--wish-list-wrap-->
                        <div class="wish-list-wrap novis_cart">
                            <div class="wish-list-close close_cart-init clwl_btn"><i class="fa-regular fa-xmark"></i></div>
                            <div class="wish-list-title">Your Wishlist </div>
                            <div class="wish-list-container">
                                <!--wish-list-item-->
                                <div class="wish-list-item fl-wrap">
                                    <div class="wish-list-img"><a href="room-single.html"><img src="images/room/thumbnail/1.jpg" alt=""></a>  
                                    </div>
                                    <div class="wish-list-descr">
                                        <h4><a href="room-single.html">Garden Family Room</a></h4>
                                        <div class="wish-list-price">$129/Night</div>
                                        <a  href="room-single.html" class="wshil_link">Book Now</a>
                                        <div class="clear-wishlist"><i class="fa-regular fa-trash-can"></i></div>
                                    </div>
                                </div>
                                <!--wish-list-item end-->
                                <!--wish-list-item-->
                                <div class="wish-list-item fl-wrap">
                                    <div class="wish-list-img"><a href="room-single.html"><img src="images/room/thumbnail/2.jpg" alt=""></a>  
                                    </div>
                                    <div class="wish-list-descr">
                                        <h4><a href="room-single.html">Premium Panorama Room</a></h4>
                                        <div class="wish-list-price"> $230/Night</div>
                                        <a  href="room-single.html" class="wshil_link">Book Now</a>
                                        <div class="clear-wishlist"><i class="fa-regular fa-trash-can"></i></div>
                                    </div>
                                </div>
                                <!--wish-list-item end-->
                            </div>
                            <div class="wish-list-wrap-btns">
                                <a href="#" class="wl_btn">Clear wishlist</a>
                            </div>
                        </div>
                        <!--wish-list-wrap-->
                        */?>
                    </div>
                </div>
            </header>
           