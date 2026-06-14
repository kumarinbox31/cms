
<!doctype html>
<html class="no-js" lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Super Admin Panel</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?php echo base_url('public/admin/theme/')?>favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/%40fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/c3/c3.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/owl.carousel/dist/assets/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/owl.carousel/dist/assets/owl.theme.default.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>dist/css/theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
        <script src="<?php echo base_url('public/admin/theme/')?>src/js/vendor/modernizr-2.8.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/')?>node_modules/jquery-toast-plugin/dist/jquery.toast.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>

    <body>
        <div class="wrapper">
            <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                            <div class="header-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                                </div>
                            </div>
                            <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                        </div>
                        <div class="top-menu d-flex align-items-center">
                            <a target="_blank" href="<?php echo base_url(); ?>" class="btn btn-success">Visit Website</a>
                            <?/*
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-bell"></i><span class="badge bg-danger">3</span></a>
                                <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
                                    <h4 class="header">Notifications</h4>
                                    <div class="notifications-wrap">
                                        <a href="#" class="media">
                                            <span class="d-flex">
                                                <i class="ik ik-check"></i> 
                                            </span>
                                            <span class="media-body">
                                                <span class="heading-font-family media-heading">Invitation accepted</span> 
                                                <span class="media-content">Your have been Invited ...</span>
                                            </span>
                                        </a>
                                        <a href="#" class="media">
                                            <span class="d-flex">
                                                <img src="img/users/1.jpg" class="rounded-circle" alt="">
                                            </span>
                                            <span class="media-body">
                                                <span class="heading-font-family media-heading">Steve Smith</span> 
                                                <span class="media-content">I slowly updated projects</span>
                                            </span>
                                        </a>
                                        <a href="#" class="media">
                                            <span class="d-flex">
                                                <i class="ik ik-calendar"></i> 
                                            </span>
                                            <span class="media-body">
                                                <span class="heading-font-family media-heading">To Do</span> 
                                                <span class="media-content">Meeting with Nathan on Friday 8 AM ...</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="footer"><a href="javascript:void(0);">See all activity</a></div>
                                </div>
                            </div>
                            <button type="button" class="nav-link ml-10 right-sidebar-toggle"><i class="ik ik-message-square"></i><span class="badge bg-success">3</span></button>
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-plus"></i></a>
                                <div class="dropdown-menu dropdown-menu-right menu-grid" aria-labelledby="menuDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="ik ik-bar-chart-2"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Message"><i class="ik ik-mail"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Accounts"><i class="ik ik-users"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Sales"><i class="ik ik-shopping-cart"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Purchase"><i class="ik ik-briefcase"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Pages"><i class="ik ik-clipboard"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Chats"><i class="ik ik-message-square"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Contacts"><i class="ik ik-map-pin"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Blocks"><i class="ik ik-inbox"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Events"><i class="ik ik-calendar"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Notifications"><i class="ik ik-bell"></i></a>
                                    <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="More"><i class="ik ik-more-horizontal"></i></a>
                                </div>
                            </div>
                            <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button>
                            */?>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="<?php echo base_url('public/admin/theme/')?>img/user.jpg" alt=""></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <!--<a class="dropdown-item" href="pages/profile.html"><i class="ik ik-user dropdown-icon"></i> Profile</a>-->
                                    <!--<a class="dropdown-item" href="#"><i class="ik ik-settings dropdown-icon"></i> Settings</a>-->
                                    <!--<a class="dropdown-item" href="#"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="ik ik-mail dropdown-icon"></i> Inbox</a>-->
                                    <!--<a class="dropdown-item" href="#"><i class="ik ik-navigation dropdown-icon"></i> Message</a>-->
                                    <a class="dropdown-item" href="/admin/logout"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>

            <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="index-2.html">
                            <!--<div class="logo-img">-->
                            <!--   <img src="<?php echo base_url('public/admin/theme/')?>src/img/brand-white.svg" class="header-brand-img" alt="lavalite"> -->
                            <!--</div>-->
                            <span class="text">Super Admin</span>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content">
                        <div class="nav-container">
                            <nav id="main-menu-navigation" class="navigation-main">
                                <div class="nav-lavel">Main</div>
                                <div class="nav-item active">
                                    <a href="/admin"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>
                                <div class="nav-item has-sub">
                                    <a href="#"><i class="ik ik-gitlab"></i><span>Website</span> <span class="badge badge-success">New</span></a>
                                    <div class="submenu-content">
                                        <a href="<?php echo base_url('admin/website/create'); ?>" class="menu-item">Create Website</a>
                                        <a href="<?php echo base_url('admin/website'); ?>" class="menu-item">List Website</a>
                                    </div>
                                </div>
                                
                                <div class="nav-item has-sub">
                                    <a href="#"><i class="ik ik-server"></i><span>Hosting</span></a>
                                    <div class="submenu-content">
                                        <a href="<?= base_url('admin/email') ?>" class="menu-item"><i class="fa fa-envelope text-primary"></i> Email Accounts</a>
                                        <a href="<?= base_url('admin/cleanup') ?>" class="menu-item"><i class="fa fa-broom text-warning"></i> Cleanup Center</a>
                                        <a href="<?= base_url('admin/logs') ?>" class="menu-item"><i class="fa fa-list text-info"></i> System Logs</a>
                                    </div>
                                </div>
                                
                                
                                <!--<div class="nav-item has-sub">-->
                                <!--    <a href="#"><i class="ik ik-package"></i><span>Extra</span></a>-->
                                <!--    <div class="submenu-content">-->
                                <!--        <a href="pages/ui/session-timeout.html" class="menu-item">Session Timeout</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="pages/ui/icons.html"><i class="ik ik-command"></i><span>Icons</span></a>-->
                                <!--</div>-->
                                <!--<div class="nav-lavel">Forms</div>-->
                                <!--<div class="nav-item has-sub">-->
                                <!--    <a href="#"><i class="ik ik-edit"></i><span>Forms</span></a>-->
                                <!--    <div class="submenu-content">-->
                                <!--        <a href="pages/form-components.html" class="menu-item">Components</a>-->
                                <!--        <a href="pages/form-addon.html" class="menu-item">Add-On</a>-->
                                <!--        <a href="pages/form-advance.html" class="menu-item">Advance</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="pages/form-picker.html"><i class="ik ik-terminal"></i><span>Form Picker</span> <span class="badge badge-success">New</span></a>-->
                                <!--</div>-->

                                <!--<div class="nav-lavel">Tables</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="pages/table-bootstrap.html"><i class="ik ik-credit-card"></i><span>Bootstrap Table</span></a>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="pages/table-datatable.html"><i class="ik ik-inbox"></i><span>Data Table</span></a>-->
                                <!--</div>-->

                                <!--<div class="nav-lavel">Charts</div>-->
                                <!--<div class="nav-item has-sub">-->
                                <!--    <a href="#"><i class="ik ik-pie-chart"></i><span>Charts</span> <span class="badge badge-success">New</span></a>-->
                                <!--    <div class="submenu-content">-->
                                <!--        <a href="pages/charts-chartist.html" class="menu-item active">Chartist</a>-->
                                <!--        <a href="pages/charts-flot.html" class="menu-item">Flot</a>-->
                                <!--        <a href="pages/charts-knob.html" class="menu-item">Knob</a>-->
                                <!--        <a href="pages/charts-amcharts.html" class="menu-item">Amcharts</a>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="nav-lavel">Apps</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="pages/calendar.html"><i class="ik ik-calendar"></i><span>Calendar</span></a>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="pages/taskboard.html"><i class="ik ik-server"></i><span>Taskboard</span></a>-->
                                <!--</div>-->

                                <!--<div class="nav-lavel">Pages</div>-->

                                <!--<div class="nav-item has-sub">-->
                                <!--    <a href="#"><i class="ik ik-lock"></i><span>Authentication</span></a>-->
                                <!--    <div class="submenu-content">-->
                                <!--        <a href="pages/login.html" class="menu-item">Login</a>-->
                                <!--        <a href="pages/register.html" class="menu-item">Register</a>-->
                                <!--        <a href="pages/forgot-password.html" class="menu-item">Forgot Password</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="nav-item has-sub">-->
                                <!--    <a href="#"><i class="ik ik-file-text"></i><span>Other</span></a>-->
                                <!--    <div class="submenu-content">-->
                                <!--        <a href="pages/profile.html" class="menu-item">Profile</a>-->
                                <!--        <a href="pages/invoice.html" class="menu-item">Invoice</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="pages/layouts.html"><i class="ik ik-layout"></i><span>Layouts</span><span class="badge badge-success">New</span></a>-->
                                <!--</div>-->
                                <!--<div class="nav-lavel">Other</div>-->
                                <!--<div class="nav-item has-sub">-->
                                <!--    <a href="javascript:void(0)"><i class="ik ik-list"></i><span>Menu Levels</span></a>-->
                                <!--    <div class="submenu-content">-->
                                <!--        <a href="javascript:void(0)" class="menu-item">Menu Level 2.1</a>-->
                                <!--        <div class="nav-item has-sub">-->
                                <!--            <a href="javascript:void(0)" class="menu-item">Menu Level 2.2</a>-->
                                <!--            <div class="submenu-content">-->
                                <!--                <a href="javascript:void(0)" class="menu-item">Menu Level 3.1</a>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--        <a href="javascript:void(0)" class="menu-item">Menu Level 2.3</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>Disabled Menu</span></a>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="javascript:void(0)"><i class="ik ik-award"></i><span>Sample Page</span></a>-->
                                <!--</div>-->
                                <!--<div class="nav-lavel">Support</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="javascript:void(0)"><i class="ik ik-monitor"></i><span>Documentation</span></a>-->
                                <!--</div>-->
                                <!--<div class="nav-item">-->
                                <!--    <a href="javascript:void(0)"><i class="ik ik-help-circle"></i><span>Submit Issue</span></a>-->
                                <!--</div>-->
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="main-content">
                 