<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thư viện
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Thư viện</li>
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
                                    <label for="title_vn">Tiêu đề</label>
                                    <input type="text" class="form-control" required="" id="title_vn" name="title_vn" placeholder="">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title_en">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <div class="box-body" id="gl-image">
                    <div class="form-group">
                        <?php echo form_label('Ảnh', 'feature_image'); ?>
                        <input type="file" class="form-control filestyle gallery_img" data-target="#thumbPreview" data-buttonName="btn-primary" name="images[]" id="browseimage0" value="" data-buttonBefore="true"> 
                    </div>
                    <div class="form-group">
                        <img id="thumbPreview" class="preview-img" src="" style="width: 200px;height: auto;" />
                    </div>
                </div>
                <div class="box-body" id="more-image"></div>
                <div class="box-body" style="margin-bottom: 20px">
                    <button type="button" id="btnAddImage" class="btn btn-default"><i class="fa fa-plus"></i> Thêm ảnh</button>
                </div>
                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/gallery') ?>" class="btn btn-default">Hủy</a>
                    <input type="hidden" name="pid" value="0" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
