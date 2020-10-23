<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh mục
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Danh mục</li>
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
                    <form id="frmMain" method="POST" action="/admin/category/action">
                        <div class="box-header addcategory">
                            <h3 class="box-title">&nbsp;</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right">
                                    <a class="btn btn-sm btn-primary " href="<?php echo site_url('/admin/category/add') ?>"><i class="fa fa-plus"></i> Thêm mới</a>
                                    <a id="bulk-delete" class="btn btn-sm btn-danger " data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i> Xóa</a>
                                    <input type="hidden" id="hidAction" name="hidAction" value="" />
                                </div>

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding box_body_category" style="overflow-x:auto;">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
                                    <th>Tên danh mục</th>
                                    <th>Slug</th>
                                    <th style="width: 80px"></th>
                                </tr>
                                <?php if ($data['total'] > 0) {?>
                                    <?php foreach ($data['categories'] as $key => $category) {?>
                                        <tr>
                                            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $category->id ?>" ></td>
                                            <td><?php echo $category->name ?></td>
                                            <td><?php echo $category->slug ?></td>
                                            <td>
                                                <a href="<?php echo site_url() ?>/admin/category/edit/<?php echo $category->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo site_url() ?>/admin/category/delete/<?php echo $category->id; ?>" class="btn btn-xs btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php } else {?>
                                        <tr>
                                            <td colspan="3" class="text-center"><?php echo $this->config->item('no_data') ?></td>
                                        </tr>
                                <?php }?>
                            </table>

                        </div>
                        <div class="box-footer clearfix">
                            <?php echo custom_pagination('/admin/category/index/', $data['total']); ?>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <?php if (is_array(@$pages) && count(@$pages) > 0) {
	?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th >Thumbnail</th>
                                    <th >Page Title</th>
                                    <th >Last Modified</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
foreach (@$pages as $page) {
		$page_id = $page['id'];
		$page_title = $page['title'];
		if ($page['thumbnail']) {
			$src = $controller->getBase64Image($page['thumbnail']);
			$page_thumb = '<img src="' . $src . '" class="img-thumbnail" width="200" height="200" />';
		} else {
			$page_thumb = '';
		}
		$page_modified = $page['updated_time'] ? $page['updated_time'] : $page['created_time'];
		?>
                                    <tr>
                                        <th scope="row"><?php echo $page_id ?></th>
                                        <td><?php echo $page_thumb ?></td>
                                        <td><?php echo $page_title ?></td>
                                        <td><?php echo $page_modified ?></td>
                                        <td>
                                            <a href="<?php echo site_url('page/edit/' . $page_id) ?>" class="btn btn-sm btn-primary" >Edit</a>
                                            <a href="#" data-href="<?php echo site_url('page/delete/' . $page_id) ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger" >Delete</a>
                                        </td>
                                    </tr>
                                    <?php
}
	?>
                            </tbody>
                        </table>
                    </div>
                <?php }?>
            </div>
        </div>
    </section>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
