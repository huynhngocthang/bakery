<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Phân trang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url('admin/pagination') ?>">Phân trang</a></li>
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
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Tên Trang: </label>
                                    <span><?php echo $pagination->page ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Kích thước trang</label>
                                    <input type="text" class="form-control" required="" id="name" name="total" value="<?php echo $pagination->total ?>" placeholder="0">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>


                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/pagination') ?>" class="btn btn-default">Hủy</a>
                    <input type="hidden" name="cid" value="<?php echo $pagination->id ?>" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
