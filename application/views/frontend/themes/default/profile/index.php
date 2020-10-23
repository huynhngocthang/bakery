

    <div id="content">
    <div class="inner">
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                      <a href="" class="profile-avatar">

                        <img class="" style="width: 100%;" src="<?php echo site_url() . $data['img'] ?>" alt="User profile picture">
                      </a>
                      <p style="width: 100%;text-align: center;">
                         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateavatar">
                          <i class="fa fa-camera"></i>
                        </button>
                      </p>


                      <h3 class="profile-username text-center"><?php echo $data['name'] ?></h3>

                      <p class="text-muted text-center profile-company">BPOTech Company</p>
                      <p style="text-align: right; padding: 10px 0;">
                        <button type="button" class="btn btn-primary col-sx-12" data-toggle="modal" data-target="#changepassword">
                            Đổi mật khẩu
                          </button>
                          <button type="button" class="btn btn-info col-sx-12" data-toggle="modal" data-target="#updateprofile">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Cập nhật thông tin
                          </button>
                      </p>

                        <ul class="list-group list-group-unbordered">
                        <li class="list-group-item clearfix">
                          <b>Địa chỉ</b> <a class="pull-right"><?php echo $data['address'] ?></a>
                        </li>
                        <li class="list-group-item">
                          <b>Số điện thoại</b> <a class="pull-right"><?php echo $data['phone'] ?></a>
                        </li>

                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->


            </div>
             <div class="col-md-8 offset-md-1 col-sx-12">
              <div class="row">
                <form action="<?php echo site_url('profile/search') ?>" method="get">
                  <div class="form-group col-md-3 col-sx-12">
                    <label for="sel1">Sắp xếp</label>
                    <select class="form-control" id="orderbyinprofile" name='pagination'>
                      <option class="option_sort" value="10">10</option>
                      <option class="option_sort" value="20">20</option>
                      <option class="option_sort" value="30">30</option>
                      <option class="option_sort" value="40">40</option>
                    </select>
                   </div>
                    <div class="form-group col-md-5 col-md-offset-4 col-sx-12">
                      <label for="sel1">Tìm kiếm</label>
                      <input type="date" name="date" id="search-order-profile" class="form-control col-md-7" placeholder="search">
                      <button type="submit" class="btn-search-profile">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                </form>
              </div>
              <div class="wrap-table">
                <table class="table table-striped order_history">
                  <?php load_element($this->theme_path . 'profile/order_history');?>
                </table>
              </div>
              <div class="container">

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">
                  <ul id="pagination-demo" class="pagination-sm"></ul>
                </div>
              </div>
            </div>
            </div>

        </div>
    </section>
<!-- /.content -->
</div>
</div>
</div>
<!-- The Modal -->
  <div class="modal fade" id="changepassword">
    <div class="modal-dialog" style="margin-top: 100px">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title">Đổi mật khẩu</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="box box-primary">

                    <!-- form start -->
                    <form role="form" action="frontend/profile/changepassword" method="POST" enctype="multipart/form-data">
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
                                <input class="form-control" placeholder="Nhập lại mật khẩu mới" type="password" name="repwd">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="usemail" value="<?php echo $data['email'] ?>" />
                            <button type="button" class="modal_btn_profile btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="save" class="save btn btn-primary" value="1">Lưu</button>
                        </div>
                    </form>
                </div>
                 <!-- /.change pass -->
        </div>

        <!-- Modal footer -->
      </div>
    </div>
  </div>
  <!-- The Modal -->
  <div class="modal fade" id="updateprofile">
    <div class="modal-dialog" style="margin-top: 100px">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title">Cập nhật thông tin</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="box box-primary">

                    <!-- form start -->
                    <form role="form" action="frontend/profile/update" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <input class="form-control" placeholder="Họ và tên" id="fullname" type="text" name="name" value="<?php echo $data['name'] ?>">
                                <span class="glyphicon glyphicon-modal-window form-control-feedback"></span>
                                 <span id="note-fullname" style="color: #c00;"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" id="phone" placeholder="Số điện thoại" type="text" name="phone" value="<?php echo $data['phone'] ?>">
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                 <span id="note-phone" style="color: #c00;"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" id="address" placeholder="Địa chỉ" type="text" name="address" value="<?php echo $data['address'] ?>">
                                <span class="glyphicon glyphicon-home form-control-feedback"></span>
                                 <span id="note-address" style="color: #c00;"></span>
                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class=" modal_btn_profile btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="save" class=" save btn btn-primary" value="1">Lưu</button>
                            <input type="hidden" name="usid" value="<?php echo $data['id'] ?>" />
                        </div>
                    </form>
                </div>
        </div>

        <!-- Modal footer -->

      </div>
    </div>
  </div>
  <!-- The Modal -->
  <div class="modal fade" id="updateavatar">
    <div class="modal-dialog" style="margin-top: 100px">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title">Cập nhật ảnh đại diện</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="box box-primary">

                    <form role="form" action="<?php echo site_url('profile/updateimg') ?>" method="POST" enctype="multipart/form-data">
                        <input type="file" name="picture" id="chooseimg">
                        <p class="profile-avatar" style="width: 200px;"><img id="image" height="px200"></p>
                        <div class="box-footer">
                            <button type="button" class=" modal_btn_profile btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="save" class="save btn btn-primary" value="1">Lưu</button>
                            <input type="hidden" name="usid" value="<?php echo $data['id'] ?>" />
                        </div>
                    </form>
                </div>
                <!-- update infomation -->
        </div>

        <!-- Modal footer -->

      </div>
    </div>
  </div>
<script type="text/javascript">
  var file = document.getElementById('chooseimg');
    var img = document.getElementById('image');
        file.addEventListener("change", function() {
        if (this.value) {
          var file = this.files[0];
          var reader = new FileReader();
          reader.onloadend = function () {
            img.src = reader.result;
          };
          reader.readAsDataURL(file);
        }
    });
</script>
