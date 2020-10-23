<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Trang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url('admin/page') ?>">Trang</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Trang mới</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">

                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" required="" id="title" name="title" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="title">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="">
                    </div>                               
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea class="form-control ckeditor" name="content" id="content"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" class="normal" name="is_active" value="Yes" checked=""> Hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/page') ?>" class="btn btn-default">Hủy</a>
                    <input type="hidden" name="pid" value="0" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
