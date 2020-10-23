<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chi tiết Khuyến Mãi
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url('admin/sales') ?>">Khuyễn mãi</a></li>
            <li class="active"><a href=""><?php echo $title ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form id="frmMain" method="POST" action="/admin/sales/action_detail">
                        <div class="box-header">
                            <h3 class="box-title">&nbsp;</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right">
                                    <a class="btn btn-sm btn-primary " href="<?php echo site_url('/admin/sales/details_add/') . $id ?>"><i class="fa fa-plus"></i> Thêm mới</a>
                                    <a id="bulk-delete" class="btn btn-sm btn-danger " data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i> Xóa</a>
                                    <input type="hidden" id="hidAction" name="hidAction" value="" />
                                </div>

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
                                    <th style="width: 200px">Tiêu đề</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá Khuyến mãi</th>
                                    <th style="width: 80px"></th>
                                </tr>
                                <?php if ($data['total'] > 0) {?>
                                    <?php foreach ($data['product'] as $key => $product) {?>
                                        <tr>
                                            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $product->id ?>" ></td>
                                            <td><?php echo $title ?></td>
                                            <td><?php echo $product->name ?></td>
                                            <td><del style="color: red;"><?php echo number_format($product->price, 0, ',', '.') ?> đ</del> ->
                                                <?php echo number_format($this->sales_model->SalesProductByID($product->id), 0, ',', '.'); ?> đ</td>
                                            <td>
                                                <a href="<?php echo getsalesUrl1($id, $product->id); ?>" class="btn btn-xs btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i></a>
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
                            <?php echo custom_pagination('/admin/sales/details/$id', $data['total']); ?>
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