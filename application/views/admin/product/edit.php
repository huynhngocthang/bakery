<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url('admin/product') ?>">Sản phẩm</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật Sản phẩm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Tên Sản phẩm</label>
                        <input type="text" class="form-control" value="<?php echo $product->name ?>" required="" id="name" name="name" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label for="name">Slug</label>
                        <input type="text" class="form-control" value="<?php echo $product->slug ?>" id="slug" name="slug" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">Danh mục</label>
                        <select name="brand_id" class="select2 form-control " required="" >
                            <?php $category = getAllCategories();?>
                            <?php if (count($category) > 0) {
	?>
                                <?php
foreach ($category as $key => $cat) {
		$selected = ($cat->id == $product->cat_id) ? ' selected ' : '';
		echo '<option ' . $selected . ' value="' . $cat->id . '">' . $cat->name . '</option>';
	}
	?>
                    <?php }?>
                        </select>
                    </div>
                    <?php
$image_path = '';
$other_images = '';
foreach ($product->images as $key => $img) {
	if ($img->featured == 'Yes') {
		$image_path = $img->path;
	} else {
		$other_img_url = get_image_url($img->path);
		$other_images .= '<div id="" class="other-img col-sm-4 col-md-2">' .
		'<input type="hidden" name="other_img[]" value="' . $img->path . '" />' .
			'<img id="otherPreview1" class="img-thumbnail" alt="Chưa có ảnh sản phẩm" src="' . $other_img_url . '" style="width: 100%;" />' .
			'<button title="Xóa" class="btn btn-xs btn-danger remove-other-img"><i class="fa fa-times"></i></button>' .
			'</div>';
	}
}
$image_url = get_image_url($image_path);
?>
                    <div class="form-group">
                        <?php echo form_label('Ảnh sản phẩm', 'feature_image'); ?>
                        <input type="text" name="image" class="form-control" id="txtSelectedFile" style="cursor:pointer;" value="<?php echo $image_path ?>" onclick="openCustomRoxy('roxyCustomPanel2', '<?php echo site_url() ?>public/fileman/custom.html?integration=custom&type=files&txtFieldId=txtSelectedFile&preview=thumbPreview&dialog=roxyCustomPanel2')">
                        <div id="roxyCustomPanel2" style="display: none;">
                            <iframe src="" style="width:100%;height:100%" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                    <div class="form-group">
                        <img id="thumbPreview" class="img-thumbnail" alt="<?php echo $product->name ?>" src="<?php echo $image_url ?>" style="width: 200px;height: auto;" />
                    </div>
                    <div class="form-group">
                        <!-- <label for="description">Ảnh khác</label> -->
                        <a class="btn btn-primary " onclick="openCustomRoxy('roxyCustomPanel3', '<?php echo site_url() ?>public/fileman/custom.html?integration=custom&type=files&is_other=1&dialog=roxyCustomPanel3')"><i class="fa fa-plus"></i> Thêm ảnh kích thước 400x400</a>
                        <div id="roxyCustomPanel3" style="display: none;">
                            <iframe src="" style="width:100%;height:100%" frameborder="0">
                            </iframe>
                        </div>

                    </div>
                    <div class="form-group row" id="other-imgs">
                        <?php echo $other_images; ?>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control ckeditor" name="description" id="description"><?php echo $product->description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="text" class="form-control" required="" id="price" name="price" value="<?php echo $product->price ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" class="normal" name="is_active" value="Yes" <?php echo ($product->is_active == 'Yes') ? ' checked ' : ''; ?> /> Sẵn hàng
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/product') ?>" class="btn btn-default">Hủy</a>
                    <input type="hidden" name="pid" value="<?php echo $product->id ?>" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
