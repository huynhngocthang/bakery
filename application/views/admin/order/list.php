<tr>
    <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
    <th>Thời gian</th>
    <th>Thứ ngày</th>
    <th>Số lượng đặt</th>
    <th>Tổng Tiền</th>
    <th></th>
    <th style="width: 80px"></th>
</tr>
<?php if ($data['total'] > 0) {?>
    <?php foreach ($data['orders'] as $key => $order) {?>
        <tr>
            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $order->date ?>" ></td>
            <td><?php echo $order->date ?></td>
            <td><?php echo $order->dayname ?></td>
            <td><?php echo $order->total_bill ?></td>
            <td><?php echo $order->sum_price ?></td>
            <td></td>
            <td>
                <a href="<?php echo site_url() ?>/admin/order/detail/<?php echo $order->date; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
            </td>
        </tr>
    <?php }?>
<?php } else {?>
        <tr>
            <td colspan="3" class="text-center"><?php echo $this->config->item('no_data') ?></td>
        </tr>
<?php }?>