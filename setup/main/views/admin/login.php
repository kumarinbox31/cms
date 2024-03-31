<!doctype html>
<html class="no-js" lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | ThemeKit - Admin Template</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?php echo base_url('public/admin/theme/'); ?>/favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/'); ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/'); ?>/node_modules/%40fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/'); ?>/node_modules/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/'); ?>/node_modules/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/'); ?>/node_modules/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url('public/admin/theme/'); ?>/dist/css/theme.min.css">
        <script src="<?php echo base_url('public/admin/theme/'); ?>/src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>

        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('<?php echo base_url('public/admin/theme/'); ?>/img/auth/login-bg.jpg')">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <?php 
                        if($msg = $this->session->flashdata('error_msg')){
                            echo '<div  class="alert alert-danger">'.$msg.'</div>';
                        }
                        
                        ?>
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                            <?/*    <a href="/customer-login.html"><img src="<?php echo base_url('public/admin/'); ?>/logo.png" alt="" width="100" height="100"></a>
                            */?>
                            </div>
                            <h3>Sign In to Admin Panel</h3>
                            <p>Happy to see you again!</p>
                            <form action="<?php echo current_url(); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email" required="" >
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="pass" placeholder="Password" required="" >
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="row">
                                    <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                            <span class="custom-control-label">&nbsp;Remember Me</span>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <a href="#">Forgot Password ?</a>
                                    </div>
                                </div>
                                <div class="sign-btn text-center">
                                    <button class="btn btn-theme">Sign In</button>
                                </div>
                            </form>
                            <div class="register">
                                <p>Don't have an account? <a href="#">Create an account</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('public/admin/theme/'); ?>/src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="<?php echo base_url('public/admin/theme/'); ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php echo base_url('public/admin/theme/'); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('public/admin/theme/'); ?>/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="<?php echo base_url('public/admin/theme/'); ?>/node_modules/screenfull/dist/screenfull.js"></script>
        <script src="<?php echo base_url('public/admin/theme/'); ?>/dist/js/theme.js"></script>
    </body>

</html>
