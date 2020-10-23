<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Khuyến mãi
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Khuyến mãi</li>
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
                    <form id="frmMain" method="POST" action="/admin/sales/action">
                        <div class="box-header">
                            <h3 class="box-title">&nbsp;</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right">
                                    <a class="btn btn-sm btn-primary " href="<?php echo site_url('/admin/sales/add') ?>"><i class="fa fa-plus"></i> Thêm mới</a>
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
                                    <th>Tổng sản phẩm</th>
                                    <th>Giá Khuyến mãi</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th style="width: 80px"></th>
                                </tr>
                                <?php if ($data['total'] > 0) {
	?>
                                    <?php foreach ($data['sales'] as $key => $sales) {
		?>
                                        <tr>
                                            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $sales->id ?>" ></td>
                                            <td><a href="/admin/sales/details/<?php echo $sales->id; ?>" class="btn btn-xs btn-primary"><?php echo $sales->title ?></a></td>
                                            <td><?php
$total = $this->sales_model->getTotalProductbySales($sales->id);
		echo $total->total . " sp";
		?></td>
                                            <td><?php
if ($sales->type == 'percent') {
			echo $sales->discount . " %";
		} else {
			echo number_format($sales->discount) . " đ";
		}
		?>
                                            </td>
                                            <td><?php echo $sales->start_date ?></td>
                                            <td><?php echo $sales->end_date ?></td>
                                            <td>
                                                <a href="/admin/sales/edit/<?php echo $sales->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="/admin/sales/delete/<?php echo $sales->id; ?>" class="btn btn-xs btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i></a>
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
                        <?php echo custom_pagination('/admin/sales/index/', $data['total']); ?>
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