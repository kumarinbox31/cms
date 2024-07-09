<div class="mobile-menu-overlay " id="mobile-menu-overlay">
        <div class="mobile-menu-overlay__inner">
            <div class="mobile-menu-overlay__header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-8">
                            <!-- logo -->
                            <div class="logo">
                                <a href="/">
                                    <img src="<?php echo LOGO; ?>" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-4">
                            <!-- mobile menu content -->
                            <div class="mobile-menu-content text-end">
                                <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-overlay__body">
                <nav class="offcanvas-navigation">
                    <?php 
                        
                        $arr = [
                            'id' => '',
                            'class' => '',
                            'itemClass'    =>  '',
                            'anchorClass'  =>  '',
                            'dropdownUlClass'   => 'sub-menu',
                            'childItemClass'    => '',
                            'childAnchorClass'  => '',
                            'childActiveClass'  => 'active',
                            'dropdownLiClass'   => 'has-children',
                            'dropdownAnchorClass'   => '',
                            'extendBefore'      =>  '',
                            'extendAfter'       =>  '',
                        ];
                        $items = $this->MenuModel->items($id)['items'];
                        print $this->MenuModel->get_menu($items,$arr);
                    
                    ?>
                    
                </nav>
            </div>
        </div>
    </div>
<script>
function mobileMenuTrigger() {
    var mobileMenu = document.getElementById('mobile-menu-overlay');
    mobileMenu.classList.add('active');
}
$(document).ready(function() {
    $('.mobile-navigation-icon').click(function() {
        $('#mobile-menu-overlay').addClass('active');
    });
});
</script>
    