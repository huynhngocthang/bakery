<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Đơn hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url('admin/order') ?>">Đơn hàng</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Chi tiết Đơn hàng</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">

                <div class="box-body">
                    <!-- A Real Hero (and a real human being) -->
                    <p>Mã đơn hàng: <?php echo $order->order_code; ?></p><!-- /hero -->
                    <p><strong>Thông tin người đặt hàng:</strong></p>
                    <?php
                    $address = unserialize($order->address);
                    ?>
                    <p>
                    <ul class="list-unstyled">
                        <li>Tên: <?php echo $address['name'] ?></li>
                        <li>Đt: <?php echo $address['phone'] ?></li>
                        <li>Đc: <?php echo $address['address'] ?></li>
                    </ul>
                    </p>
                    <p><strong>Hình thức thanh toán:</strong> <?php echo strtoupper($order->payment_method) ?></p>
                    <table class="table" >
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tạm tính</th>
                        </tr>
                        <?php $total = 0; ?>
                        <?php foreach ($order->items as $item) { ?>
                            <tr>
                                <td>
                                    <img width="80px" class="cart-index-img img-thumbnail" src="<?php echo site_url($item->image); ?>">
                                    <a target="_blank" href="<?php echo getProductUrl($item, $item->category_id) ?>"><?php echo $item->product_name ?></a>
                                </td>
                                <td class="text-right"><?php echo number_format($item->price, 0, ',', '.'); ?> ₫</td>
                                <td class="text-center"><?php echo $item->qty ?></td>
                                <td class="text-right"><?php echo number_format($item->price * $item->qty, 0, ',', '.'); ?> ₫</td>
                            </tr>
                            <?php $total += $item->price * $item->qty; ?>
                        <?php } ?>
                        <tr>
                            <th colspan="3" class="text-right">Tổng cộng:</th>
                            <td class="text-right"><?php echo number_format($total, 0, ',', '.'); ?> ₫</td>
                        </tr>
                    </table>
                    <?php
                    $status = ['pending' => 'Chờ xử lý', 'confirmed' => 'Đã xác nhận', 'completed' => 'Đã hoàn thành', 'cancel' => 'Đã hủy'];
                    ?>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="status">
                            <?php foreach($status as $key => $val) {?>
                            <option <?php echo ($order->status == $key) ? 'selected' : ''?> value="<?php echo $key?>"><?php echo $val?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                    <a href="<?php echo site_url('admin/order') ?>" class="btn btn-default">Đóng</a>
                    <input type="hidden" name="pid" value="<?php echo $order->order_id ?>" />
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
