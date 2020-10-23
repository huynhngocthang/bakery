<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url('admin/user') ?>">Người dùng</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Người dùng mới</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group has-feedback">
                        <input class="form-control" placeholder="Full name" id="fullname" type="text" name="name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span id="note-fullname" style="color: #c00;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" placeholder="Email" id="email" type="email" name=email>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span id="note-email" style="color: #c00;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" placeholder="Password" id="password" type="password" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span id="note-password" style="color: #c00;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" placeholder="Retype password" id="re-pass" type="password" name="repwd">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span id="note-re-password" style="color: #c00;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" placeholder="Phone" id="phone" type="text" name="phone">
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                        <span id="note-phone" style="color: #c00;"></span>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/user') ?>" class="btn btn-default">Hủy</a>
                    <input type="hidden" name="uid" value="0" />
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
