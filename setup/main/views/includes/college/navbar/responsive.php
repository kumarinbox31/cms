<!-- Start Responsive Navbar Area -->
<div class="responsive-navbar offcanvas offcanvas-end border-0" data-bs-backdrop="static" tabindex="-1"
    id="navbarOffcanvas">
    <div class="offcanvas-header">
        <a href="/" class="logo d-inline-block">
            <img src="<?php echo LOGO; ?>" alt="logo">
        </a>
        <button type="button" id="close-btn" class="close-btn bg-transparent position-relative lh-1 p-0 border-0"
            data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="ri-close-fill"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <?
        $arr = [
            'id' => '',
            'class' => 'responsive-menu',
            'itemClass' => 'responsive-menu-list without-icon',
            'anchorClass' => 'nav-link',
            'dropdownUlClass' => 'responsive-menu-items',
            'childItemClass' => 'nav-item',
            'childAnchorClass' => 'nav-link',
            'childActiveClass' => 'active',
            'dropdownLiClass' => 'responsive-menu-list',
            'dropdownAnchorClass' => '',
            'extendBefore' => '',
            'extendAfter' => '',
        ];
        $items = $this->MenuModel->items($id)['items'];
        print $this->MenuModel->get_menu($items, $arr);

        ?>
        <?php /*<ul class="responsive-menu">

            <li class="responsive-menu-list active"><a href="javascript:void(0);">Home</a>
                <ul class="responsive-menu-items">
                    <li class="nav-item">
                        <a href="index.html" class="nav-link">
                            Home Demo - One
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index-2.html" class="nav-link">
                            Home Demo - Two
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index-3.html" class="nav-link">
                            Home Demo - Three
                        </a>
                    </li>
                </ul>
            </li>

            <li class="responsive-menu-list"><a href="javascript:void(0);">Pages</a>
                <ul class="responsive-menu-items">
                    <li class="nav-item">
                        <a href="university-overview.html" class="nav-link">
                            University Overview
                        </a>
                    </li>
                    <li class="responsive-menu-list"><a href="javascript:void(0);">Blog</a>
                        <ul class="responsive-menu-items">
                            <li class="nav-item">
                                <a href="blog-style-one.html" class="nav-link">
                                    Blog & News 01
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="blog-style-two.html" class="nav-link">
                                    Blog & News 02
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="blog-details.html" class="nav-link">
                                    Blog Details
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="register.html" class="nav-link">
                            Register Now
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="login.html" class="nav-link">
                            Log In Now
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="application.html" class="nav-link">
                            Application Form
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="faculty.html" class="nav-link">
                            Faculty
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="privacy-policy.html" class="nav-link">
                            Privacy Policy
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="terms-conditions.html" class="nav-link">
                            Terms & Conditions
                        </a>
                    </li>
                </ul>
            </li>

            <li class="responsive-menu-list"><a href="javascript:void(0);">Admissions</a>
                <ul class="responsive-menu-items">
                    <li class="nav-item">
                        <a href="apply.html" class="nav-link">
                            How To Apply
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="tuition-fees.html" class="nav-link">
                            Tuition & Fees
                        </a>
                    </li>
                </ul>
            </li>

            <li class="responsive-menu-list"><a href="javascript:void(0);">Academics</a>
                <ul class="responsive-menu-items">
                    <li class="nav-item ">
                        <a href="programs.html" class="nav-link">
                            All Programs
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="program-details.html" class="nav-link">
                            Program Details
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="events.html" class="nav-link">
                            All Events
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="event-details.html" class="nav-link">
                            Event Details
                        </a>
                    </li>
                </ul>
            </li>

            <li class="responsive-menu-list"><a href="javascript:void(0);">Health Care</a>
                <ul class="responsive-menu-items">
                    <li class="nav-item ">
                        <a href="fitness-athletics.html" class="nav-link">
                            Fitness & Athletics
                        </a>
                    </li>
                </ul>
            </li>

            <li class="responsive-menu-list"><a href="javascript:void(0);">Student Life</a>
                <ul class="responsive-menu-items">
                    <li class="nav-item ">
                        <a href="university-life.html" class="nav-link">
                            University Life
                        </a>
                    </li>
                </ul>
            </li>

            <li class="responsive-menu-list without-icon">
                <a href="contact.html" class="nav-link">
                    Contact <span>Us</span>
                </a>
            </li>
        </ul>

        <div class="others-option d-md-flex align-items-center">
            <div class="option-item">
                <form class="search-form">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Search Programs">
                        <button type="submit"><i class="ri-search-line"></i></button>
                    </div>
                </form>
            </div>
        </div> */?>

    </div>
</div>
<!-- End Responsive Navbar Area -->

<script>
    $('.navbar-toggler').click(function () {
        $('#navbarOffcanvas').addClass('show');
    });

    $('#close-btn').click(function() {
        $('#navbarOffcanvas').removeClass('show');
    });
</script>
