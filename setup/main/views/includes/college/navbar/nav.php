<!-- Start Navbar Area -->
<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img class="black-logo" src="<?php echo theme_path(); ?>/assets/img/black-logo.png" alt="black-logo">
        </a>
        <a class="navbar-toggler text-decoration-none" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button"
            aria-controls="navbarOffcanvas">
            <span class="burger-menu">
                <span class="top-bar"></span>
                <span class="middle-bar"></span>
                <span class="bottom-bar"></span>
            </span>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link active">
                        Home
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a href="index.html" class="nav-link active">
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

                <li class="nav-item">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                        Pages
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a href="university-overview.html" class="nav-link">
                                University Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                                Blog
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="blog-style-one.html" class="nav-link">
                                        Blog Style One
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="blog-style-two.html" class="nav-link">
                                        Blog Style Two
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
                            <a href="guidance-support.html" class="nav-link">
                                Support & Guidance
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

                <li class="nav-item">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                        Admissions
                    </a>
                    <ul class="dropdown-menu">
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

                <li class="nav-item">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                        Academics
                    </a>
                    <ul class="dropdown-menu">
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

                <li class="nav-item">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                        Health Care
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item ">
                            <a href="fitness-athletics.html" class="nav-link">
                                Fitness & Athletics
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                        Student Life
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item ">
                            <a href="university-life.html" class="nav-link">
                                University Life
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="contact.html" class="nav-link">
                        Contact <span>Us</span>
                    </a>
                </li>
            </ul>
            <div class="others-option">
                <div class="d-flex align-items-center">
                    <div class="option-item">
                        <form class="search-form">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search Programs">
                                <button type="submit"><i class="ri-search-line"></i></button>
                            </div>
                        </form>
                        <button type="button"
                            class="search-btn d-none bg-transparent border-0 lh-1 p-0 position-relative"
                            data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="flaticon-search-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- End Navbar Area -->


<?/*
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
  */ ?>