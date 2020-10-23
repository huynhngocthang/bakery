
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Trang cá nhân
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('/admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('msg')) {?>
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                <strong>Success! </strong>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-md-4 col-sx-12">

                  <!-- Profile Image -->
                  <div class="box box-primary">
                    <div class="box-body box-profile">
                      <img class="profile-user-img img-responsive img-circle" src="<?php echo site_url() ?>/public/assets/adminlte/dist/img/avatar5.png" alt="User profile picture">

                      <h3 class="profile-username text-center"><?php echo $data['name'] ?></h3>

                      <p class="text-muted text-center">BPOTech Company</p>

                      <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                          <b>Địa chỉ</b> <a class="pull-right">61 Tùng Thiện Vương , Huế</a>
                        </li>
                        <li class="list-group-item">
                          <b>Số điện thoại</b> <a class="pull-right">0932436554</a>
                        </li>

                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->

                  <!-- About Me Box -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title ">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                      <p class="text-muted">
                       Trường đại học dân lập Phú Xuân
                      </p>

                      <hr>

                      <strong><i class="fa fa-map-marker margin-r-5"></i> Hobbies</strong>

                      <p class="text-muted">Đọc sách, Chơi game , đi du lịch</p>

                      <hr>

                      <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                      <p>
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">java</span>
                      </p>

                      <hr>

                      <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
            </div>
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Đỗi mật khẩu</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo site_url() ?>admin/Profile/save" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Mật khẩu cũ" type="password" name="oldpwd">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Mật khẩu mới" type="password" name="password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Retype password" type="password" name="repwd">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                            <input type="hidden" name="usemail" value="<?php echo $data['email'] ?>" />
                        </div>
                    </form>
                </div>
                 <!-- /.change pass -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật thông tin</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Họ và tên" type="text" name="name">
                                <span class="glyphicon glyphicon-modal-window form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Số điện thoại" type="text" name="phone">
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div><div class="form-group has-feedback">
                                <input class="form-control" placeholder="Địa chỉ" type="text" name="address">
                                <span class="glyphicon glyphicon-home form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Mật khẩu cũ" type="password" name="oldpwd">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Retype password" type="password" name="repwd">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                            <input type="hidden" name="usid" value="1<?php//echo $user->id ?>" />
                        </div>
                    </form>
                </div>
                <!-- update infomation -->
            </div>
        </div>
    </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper