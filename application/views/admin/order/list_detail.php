<tr>
  <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
  <th>Trạng thái</th>
  <th>Trạng thái</th>
  <th>Khách hàng</th>
  <th>Số lượng đặt</th>
  <th>Tổng thanh toán</th>
  <th style="width: 80px"></th>
</tr>
  <?php if ($data['total'] > 0) {?>
      <?php foreach ($data['products'] as $key => $product) {?>
          <tr>
              <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $product->order_id ?>" ></td>
              <td><?php echo $product->product ?></td>
              <td><?php echo $product->giavi ?></td>
              <td><?php echo $product->username ?></td>
              <td>1</td>
              <td><?php echo number_format($product->price, 0, ',', '.'); ?> ₫</td>
              <td>
               <div class="dropdown">
                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-edit"></i>
                </button>
                <div class="dropdown-menu fix-drop">
                  <a href="<?php echo site_url() ?>/admin/order/edit/<?php echo $product->order_id . "/completed"; ?>" class="btn btn-xs btn-primary">Hoàn thành</a>
                  <a href="<?php echo site_url() ?>/admin/order/edit/<?php echo $product->order_id . "/confirmed"; ?>" class="btn btn-xs btn-primary" >đã xác nhận</a>
                  <a href="<?php echo site_url() ?>/admin/order/edit/<?php echo $product->order_id . "/pending"; ?>" class="btn btn-xs btn-primary" >chờ xử lý</a>
                  <a href="<?php echo site_url() ?>/admin/order/edit/<?php echo $product->order_id . "/cancel"; ?>" class="btn btn-xs btn-primary" >Hủy</a>
                  <a href="<?php echo site_url() ?>/admin/order/delete/<?php echo $product->order_id; ?>" class="btn btn-xs btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i></a>
                </div>
              </div>



              </td>
          </tr>
      <?php }?>
  <?php } else {?>
      <tr>
          <td colspan="3" class="text-center"><?php echo $this->config->item('no_data') ?></td>
      </tr>
  <?php }?>
