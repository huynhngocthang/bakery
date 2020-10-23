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
                <?php
                $title = unserialize($title);
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
                                    <label for="title_vn">Tiêu đề</label>
                                    <input type="text" class="form-control" required="" id="title_vn" name="title_vn" value="<?php echo $title['vn'] ?>" placeholder="">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title_en">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" value="<?php echo $title['en'] ?>" placeholder="">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <div class="box-body" id="gl-images">
                    <?php foreach ($images as $key => $img) { ?>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 gl-image">
                            <a class="fancybox fancybox-manual" rel="group" href="<?php echo site_url($img->filepath) ?>">
                                <img class="admin-gl-img" src="<?php echo site_url($img->filepath) ?>" />
                            </a>
                            <a data-id="<?php echo $img->id ?>" data-uri="<?php echo $img->filepath?>" class="btn btn-xs btn-danger btn-remove-img" title="Xóa" data-toggle="confirmation" data-placement="left" data-singleton="true" data-on-confirm="removeGalleryImage"><i class="fa fa-trash-o"></i></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="box-body" id="more-image"></div>
                <div class="box-body" style="margin-bottom: 20px">
                    <button type="button" id="btnAddImage" class="btn btn-default"><i class="fa fa-plus"></i> Thêm ảnh</button>
                </div>
                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/gallery') ?>" class="btn btn-default">Hủy</a>
                    <input type="hidden" name="pid" value="<?php echo $id ?>" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $('.fancybox').fancybox({padding: 0});
    });

    function removeGalleryImage() {
        var $img = $(this).closest('.gl-image');
        var $id = $(this).attr('data-id');
        var $uri = $(this).attr('data-uri');
        var data = new FormData();
        data.append("id", $id);
        data.append("uri", $uri);
        $.ajax({
            dataType: 'json',
            data: data,
            type: "POST",
            url: "/admin/gallery/delete_image",
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if(!response.error) {
                    $img.remove();
                }
            }
        });
    }
</script>