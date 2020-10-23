<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bakery BPOHue | Verify</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/adminlte') ?>/dist/css/AdminLTE.min.css">


        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets') ?>/js/plugins/iCheck/skins/square/blue.css">

        <!-- Common style -->
        <link rel="stylesheet" href="<?php echo site_url('public/assets/css') ?>/common.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page front-login">
        <div class="login-box wrap-login">
            <div class="login-logo">
                <img src="<?php echo site_url('public/assets/images/common/img-slider.png') ?>" style="width: 150px;">
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
               <?php if (isset($msg)) {?>
                    <div class="alert alert-warning alert-dismissible">
                        <h4><?php echo $msg; ?></h4>
                    </div>
                <?php }?>
                <?php if ($this->session->flashdata('login') != null) {?>

                    <div class="alert alert-success alert-dismissible" >
                        <h4><?php echo $this->session->flashdata('login'); ?></h4>
                    </div>
                <?php }?>
                <?php if ($user != null) {?>
                    Tài khoản của bạn là</br>
                        <span class="">Email: <?php echo $user->email ?></span>
                        <span><a href="<?php echo site_url() ?>/password/resetpassword/<?php echo $this->session->userdata('verifyemail') ?>">Đỗi lại mật khẩu</a></span>
                <?php }?>
            </div>

            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.0 -->
        <script
        src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- iCheck -->
        <script src="<?php echo site_url('public/assets') ?>/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
