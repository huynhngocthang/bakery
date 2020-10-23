<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Giới thiệu
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Giới thiệu</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><img title="Tiếng Việt" alt="Tiếng Việt" src="<?php echo site_url() ?>/skins/images/Vietnam.png" /></a></li>
                        <li><a href="#tab_2" data-toggle="tab"><img title="Tiếng Anh" alt="Tiếng Anh" src="<?php echo site_url() ?>/skins/images/United-States.png" /></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name_vn">Tên</label>
                                    <input type="text" class="form-control" required="" id="name_vn" name="name_vn" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="title_vn">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title_vn" name="title_vn" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <?php echo form_error('content_vn', '<span class="error">', '</span>'); ?>
                                    <?php echo form_textarea(array('id' => 'content_vn', 'name' => 'content_vn', 'class' => 'summernote')); ?>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name_en">Tên</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="title_en">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <?php echo form_error('content_en', '<span class="error">', '</span>'); ?>
                                    <?php echo form_textarea(array('id' => 'content_en', 'name' => 'content_en', 'class' => 'summernote')); ?>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>


                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/setting') ?>" class="btn btn-default">Hủy</a>
                    <input type="hidden" name="pid" value="0" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
