<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->config->item('site_name') ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte/') ?>/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/font-awesome-4.7.0') ?>/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte/') ?>/plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte/') ?>/dist/css/AdminLTE.min.css">
        <!-- AdminLTE public/assets. Choose a skin from the css/public/assets
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte/') ?>/dist/css/public/assets/_all-public/assets.min.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte/') ?>/plugins/iCheck/all.css">


        <link rel="stylesheet" href="<?php echo site_url('public/assets/summernote/summernote.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('public/assets/css/admin-style.css') ?>">
        <!-- jQuery 2.2.0 -->
        <script src="<?php echo site_url('public/assets/adminlte/') ?>/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <script src="<?php echo site_url('public/assets/summernote/summernote.js') ?>"></script>
        <script src="<?php echo site_url('public/assets/bootstrap/js/bootstrap-filestyle.min.js') ?>"></script>
        <script src="<?php echo site_url('public/fileman/js/main.min.js') ?>"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFYsw5-NZjCci9UGZUyF_mWdoLQuC0zxE"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/assets/') ?>/latitude-longitude-picker/css/jquery-gmaps-latlon-picker.css"/>
        <script src="<?php echo site_url('public/assets/') ?>/latitude-longitude-picker/js/jquery-gmaps-latlon-picker.js"></script>
        <script src="<?php echo site_url('public/assets/') ?>/js/jquery.blockUI.js"></script>

        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="<?php echo site_url('public/assets/fancybox') ?>/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/assets/fancybox') ?>/jquery.fancybox.css?v=2.1.5" media="screen" />

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
                <a href="index2.html" class="logo">
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
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- Notifications: style can be found in dropdown.less -->
                            <?php /*<li class="dropdown notifications-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-bell-o"></i>
<span class="label label-warning">10</span>
</a>
<ul class="dropdown-menu">
<li class="header">You have 10 notifications</li>
<li>
<!-- inner menu: contains the actual data -->
<ul class="menu">
<li>
<a href="#">
<i class="fa fa-users text-aqua"></i> 5 new members joined today
</a>
</li>
<li>
<a href="#">
<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
page and may cause design problems
</a>
</li>
<li>
<a href="#">
<i class="fa fa-users text-red"></i> 5 new members joined
</a>
</li>
<li>
<a href="#">
<i class="fa fa-shopping-cart text-green"></i> 25 sales made
</a>
</li>
<li>
<a href="#">
<i class="fa fa-user text-red"></i> You changed your username
</a>
</li>
</ul>
</li>
<li class="footer"><a href="#">View all</a></li>
</ul>
</li>
 */?>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo site_url('public/assets/adminlte/') ?>/dist/img/avatar5.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Quản trị viên</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo site_url('public/assets/adminlte/') ?>/dist/img/avatar5.png" class="img-circle" alt="User Image">

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
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="/admin/login/signout" class="btn btn-default btn-flat">Sign out</a>
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
            <!-- Left side column. contains the logo and sidebar -->
              <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                  <!-- Sidebar user panel -->
                  <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo site_url('skins/adminlte/') ?>/dist/img/avatar5.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                      <p>Quản trị viên</p>
                      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                  </div>
                  <!-- sidebar menu: : style can be found in sidebar.less -->
                  <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php echo active_class($menu, ['dashboard']) ?>">
                      <a href="/admin">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                      </a>

                    </li>

                    <li class="<?php echo active_class($menu, ['project']) ?>">
                      <a href="/admin/project">
                        <i class="fa fa-th"></i> <span>Dự án</span>
                      </a>
                    </li>
                    <li class="<?php echo active_class($menu, ['post']) ?>">
                      <a href="/admin/post">
                        <i class="fa fa-edit"></i> <span>Tin tức</span>
                      </a>
                    </li>
                    <li class="<?php echo active_class($menu, ['introduce']) ?>">
                      <a href="/admin/introduce">
                        <i class="fa fa-folder-open"></i> <span>Giới thiệu</span>
                      </a>
                    </li>
                    <li class="<?php echo active_class($menu, ['tuyendung']) ?>">
                      <a href="/admin/tuyendung">
                        <i class="fa fa-folder-open"></i> <span>Tuyển dụng</span>
                      </a>
                    </li>

                    <li class="<?php echo active_class($menu, ['slide']) ?>">
                      <a href="/admin/slide">
                        <i class="fa fa-film"></i> <span>Slider</span>
                      </a>
                    </li>

                    <li class="<?php echo active_class($menu, ['gallery']) ?>">
                      <a href="/admin/gallery">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i> <span>Thư viện</span>
                      </a>
                    </li>

                    <li class="<?php echo active_class($menu, ['sponsor']) ?>">
                      <a href="/admin/sponsor">
                        <i class="fa fa-handshake-o"></i> <span>Đối tác</span>
                      </a>
                    </li>

                    <li class="<?php echo active_class($menu, ['contact']) ?>">
                      <a href="/admin/contact">
                        <i class="fa fa-info-circle"></i> <span>Thông tin liên hệ</span>
                      </a>
                    </li>

                    <li class="treeview <?php echo active_class($menu, ['setting', 'category']) ?>">
                      <a href="#">
                        <i class="fa fa-cogs"></i> <span>Cấu hình</span>
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="<?php echo active_class($menu, ['setting']) ?>"><a href="/admin/setting"><i class="fa fa-cog"></i> Thiết lập chung</a></li>
                        <li class="<?php echo active_class($menu, ['category']) ?>"><a href="/admin/category"><i class="fa fa-cog"></i> Thể loại tin tức</a></li>
                        <li class="<?php echo active_class($menu, ['projectcategory']) ?>"><a href="/admin/projectcategory"><i class="fa fa-cog"></i> Loại Dự Án</a></li>
                      </ul>
                    </li>
                  </ul>
                </section>
                <!-- /.sidebar -->
              </aside>
              <section></section>
              <footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2017 <a href="#">Fit DNN</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo site_url('skins/adminlte/') ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo site_url('skins/adminlte/') ?>/plugins/select2/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo site_url('skins/adminlte/') ?>/plugins/iCheck/icheck.min.js"></script>
<!-- Confirmation -->
<script src="<?php echo site_url('skins') ?>/bootstrap/js/bootstrap-confirmation.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url('skins/adminlte/') ?>/dist/js/app.min.js"></script>
<script src="<?php echo site_url('skins/js') ?>/custom.js"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        $(document).on('ifChecked', '.checkth, .checkft', function (event) {
            $('.checkth, .checkft').iCheck('check');
            $('.checkitem').each(function () {
                $(this).iCheck('check');
            });
        });
        $(document).on('ifUnchecked', '.checkth, .checkft', function (event) {
            $('.checkth, .checkft').iCheck('uncheck');
            $('.checkitem').each(function () {
                $(this).iCheck('uncheck');
            });
        });
        $(document).on('ifUnchecked', '.checkitem', function (event) {
            $('.checkth, .checkft').attr('checked', false);
            $('.checkth, .checkft').iCheck('update');
        });
    });
</script>
</body>
</html>
