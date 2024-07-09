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
    