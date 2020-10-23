<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thiết lập chung
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Thiết lập chung</li>
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
        <!-- form start -->
        <form class="form-horizontal" role="form" action="/admin/setting/save" method="POST" enctype="multipart/form-data">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body ">
                    <div class="form-group">
                        <label for="hotline" class="col-sm-2 control-label">Logo</label>
                        <div class="col-sm-10">
                            <a class="btn btn-primary" onclick="openCustomRoxy('roxyCustomPanel2','<?php echo site_url()?>fileman/custom.html?integration=custom&type=files&txtFieldId=txtSelectedFile&preview=thumbPreview&dialog=roxyCustomPanel2')"><i class="fa fa-folder"></i> Upload Logo</a>
                            <input type="hidden" name="logo" class="form-control" id="txtSelectedFile" style="cursor:pointer;" value="<?php echo $settings->logo?>">
                            <div id="roxyCustomPanel2" style="display: none;">
                                <iframe src="" style="width:100%;height:100%" frameborder="0">
                                </iframe>
                            </div>
                            <div class="">                                    
                                    <img id="thumbPreview" class="img-thumbnail" alt="Logo" src="<?php echo get_image_url($settings->logo);?>" style="width: 200px;height: auto;" />
                                </div>
                        </div>

                    </div>
                    
                </div>
            </div>
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <?php $seo = json_decode($settings->seo);?>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">SEO Title</label>
                        <div class="col-sm-10">
                            <div class="">
                                <?php echo form_error('title', '<em class="error">', '</em>'); ?> 
                                <input type="text" class="form-control" id="seo_title" name="seo_title" value="<?php echo $seo->title ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keyword" class="col-sm-2 control-label">Từ khóa</label>
                        <div class="col-sm-10">
                            <div class="">
                                <?php echo form_error('keyword', '<em class="error">', '</em>'); ?> 
                                <input type="text" class="form-control" id="keyword" name="keyword" value="<?php echo $seo->keyword ?>">
                                
                                <em>Mỗi từ khóa cách nhau bởi dấu phẩy [,]</em>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-10">
                            <div class="">
                                <?php echo form_error('seo_description', '<em class="error">', '</em>'); ?> 
                                <textarea class="form-control" id="seo_description" name="seo_description" ><?php echo $seo->description; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="hotline" class="col-sm-2 control-label">Hotline</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hotline" name="hotline" value="<?php echo $settings->hotline ?>">
                        </div>
                    </div>
                    <?php 
                    $contact_info = json_decode($settings->contact_info);
                    $social_link = json_decode($settings->social_link);
                    ?>
                    <div class="form-group">
                        <label for="support_email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="support_email" name="support_email" value="<?php echo $contact_info->support_email; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="col-sm-2 control-label">Facebook</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $social_link->facebook; ?>">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="google_plus" class="col-sm-2 control-label">Google+</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="google_plus" name="google_plus" value="<?php echo $google_plus ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="youtube" class="col-sm-2 control-label">Youtube</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="youtube" name="youtube" value="<?php echo $youtube ?>">
                        </div>
                    </div> -->
                </div>

                

            </div>
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="hotline" class="col-sm-2 control-label">Thông tin liên hệ</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="description"><?php echo $contact_info->description;?></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                        <a href="<?php echo site_url('admin/setting') ?>" class="btn btn-default">Hủy</a>
                        <input type="hidden" name="pid" value="0" />
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
