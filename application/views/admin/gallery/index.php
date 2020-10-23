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
        <?php if ($this->session->flashdata('msg')) {?>
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                <strong>Success! </strong>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form id="frmMain" method="POST" action="/admin/gallery/action">
                        <div class="box-header">
                            <h3 class="box-title">&nbsp;</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right">
                                    <a class="btn btn-sm btn-primary " href="<?php echo site_url('/admin/gallery/add') ?>"><i class="fa fa-plus"></i> Thêm mới</a>
                                    <a id="bulk-delete" class="btn btn-sm btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i> Xóa</a>
                                    <input type="hidden" id="hidAction" name="hidAction" value="" />
                                </div>

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
                                    <th style="width: 220px">Ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th style="width: 80px"></th>
                                </tr>
                                <?php if ($data['total'] > 0) {
	?>
                                    <?php foreach ($data['gallerys'] as $key => $gallery) {?>
                                        <?php $title = unserialize($gallery->title);?>
                                        <?php
$image = $gallery->images;
		$feature_image = $image[0];
		?>
                                        <tr>
                                            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $gallery->id ?>" ></td>
                                            <td><img class="feature-image" src="<?php echo site_url($feature_image->filepath) ?>" /></td>
                                            <td><?php echo $title['vn'] ?></td>
                                            <td>
                                                <a href="<?php echo site_url() ?>/admin/gallery/edit/<?php echo $gallery->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo site_url() ?>/admin/gallery/delete/<?php echo $gallery->id; ?>" class="btn btn-xs btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php } else {?>
                                    <tr>
                                        <td colspan="5" class="text-center"><?php echo $this->config->item('no_data') ?></td>
                                    </tr>
                                <?php }?>
                            </table>

                        </div>
                        <div class="box-footer clearfix">
                            <?php echo custom_pagination('/admin/gallery/index/', $data['total']); ?>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->