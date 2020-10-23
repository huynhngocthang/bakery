
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bakery | <?php echo $this->page_title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/bootstrap/css/bootstrap.min.css" media="screen">
        <!-- Font Awesome -->
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/font-awesome.min.css" media="screen">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/js/') ?>plugins/select2/select2.min.css">
        <!-- common -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/css/') ?>common.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte') ?>/dist/css/AdminLTE.min.css">
        <!-- AdminLTE public/assets. Choose a skin from the css/public/assets
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte/') ?>/dist/css/skins/_all-skins.min.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/js/') ?>plugins/iCheck/skins/all.css">
        <!-- Latest compiled and minified CSS -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css"> -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>public/assets/js/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>public/assets/js/plugins/colorpicker/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>public/assets/js/plugins/timepicker/bootstrap-timepicker.min.css">
        <link rel="stylesheet" href="<?php echo site_url('public/assets/css/admin-style.css') ?>">

        <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/assets/fancybox') ?>/jquery.fancybox.css?v=2.1.5" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/') ?>assets/css/jquery.jqChart.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/') ?>assets/css/style.css" />



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo site_url('admin'); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="<?php echo site_url() ?>admin/profile" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo site_url('public/assets/adminlte/') ?>dist/img/avatar5.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Quản trị viên</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo site_url('public/assets/adminlte/') ?>dist/img/avatar5.png" class="img-circle" alt="User Image">

                                        <p>
                                            Quản trị viên
                                            <!--<small>Member since Nov. 2012</small>-->
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
<!--                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Friends</a>
                                            </div>
                                        </div>-->
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo site_url() ?>/admin/profile" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url() ?>/admin/login/signout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>

                            </li>
                            <li class="dropdown ">
                                <a href="<?php echo site_url() ?>" target="_blank">
                                    <i class="fa fa-home"></i>
                                    <span class="hidden-xs">Trang chủ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
