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
        <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-success" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                    <strong>Success! </strong>
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            <?php } ?>
        <div class="box box-primary">            
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
                <?php
                $name = unserialize($name);
                $title = unserialize($title);
                $content = unserialize($content);
                ?>
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
                                    <input type="text" class="form-control" required="" id="name_vn" name="name_vn" value="<?php echo $name['vn'] ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="title_vn">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title_vn" name="title_vn" value="<?php echo $title['vn'] ?>" placeholder="">
                                </div>
                                <div class="box-group" id="accordion">
                                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h4 class="box-title d-block">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="d-block">
                                                    Nội dung
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <?php echo form_error('content_vn', '<span class="error">', '</span>'); ?>
                                                    <?php echo form_textarea(array('id' => 'content_vn', 'name' => 'content_vn', 'class' => 'summernote', 'value' => $content['vn'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name_en">Tên</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" value="<?php echo $name['en'] ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="title_en">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" value="<?php echo $title['en'] ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Tóm tắt</label>
                                    <?php echo form_error('short_desc_en', '<span class="error">', '</span>'); ?>
                                    <textarea name="short_desc_en" class="form-control" rows="3"><?php echo $short_desc['en'] ?></textarea>
                                </div>
                                <div class="box-group" id="accordion2">
                                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h4 class="box-title d-block">
                                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOneEn" class="d-block">
                                                    Nội dung
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOneEn" class="panel-collapse collapse in">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <?php echo form_error('content_en', '<span class="error">', '</span>'); ?>
                                                    <?php echo form_textarea(array('id' => 'content_en', 'name' => 'content_en', 'class' => 'summernote', 'value' => $content['en'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
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
                    <input type="hidden" name="pid" value="<?php echo $id?>" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
