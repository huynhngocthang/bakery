<?php
if ($items == null) {
	echo '<h3 class="text-report">Bạn chưa đặt sản phẩm nào trong hệ thống</h3>';
} else {?>
<div class="row default_row">
<div class="col-md-12">
    <div class="row">
      <div class="col-md-4"><img src="<?php echo site_url() . $items->image; ?>"></div>
      <div class="col-md-8">

          <div class="item1 row">
            <b class="col-md-4">Họ và tên </b>
            <span class="col-md-8"><?php echo $items->username ?></span>
          </div>
          <hr>
          <div class="item row">
            <b class="col-md-4">Số điện thoại </b>
            <span class="col-md-8"><?php echo $items->phone ?></span>
          </div>
          <hr>
          <div class="item row">
            <b class="col-md-4">Địa chỉ </b>
            <span class="col-md-8"><?php echo $items->address ?></span>
          </div>
          <hr>
          <div class="item row">
            <b class="col-md-4">Sản phẩm </b>
            <span class="col-md-8"><?php echo $items->product ?></span>
          </div>
          <hr>
          <div class="item row">
            <b class="col-md-4">Ngày đặt </b>
            <span class="col-md-8"><?php echo $items->order_date ?></span>
          </div>
          <hr>
          <div class="item row">
            <b class="col-md-4">Gia vị </b>
            <span class="col-md-8 giavi"><?php echo $items->giavi ?></span>
            <div class="wrap-giavi">
              <form action="<?php echo site_url('bill/addgiavi') ?>" method="post">
                <textarea name="editgiavi" class="textarea_giavi"><?php echo $items->giavi ?></textarea>
                <input type="text" name="order_id" hidden="hidden" value="<?php echo $items->order_id ?>">
                <input type="text" name="od_id" hidden="hidden"   value="<?php echo $items->product_id ?>">
                <button type="submit" class="btn_save_giavi" name="button">Lưu</button>
              </form>
            </div>

						<button type="button"  class="icon_edit_giavi" name="button"><i class="fa fa-edit"></i></button>
          </div>
          <hr>
          <div class="item row">
            <b class="col-md-4">Giá thành </b>
            <span class="col-md-8"><?php echo number_format($items->price, 0, ',', '.'); ?> ₫</span>
          </div>
   </div>
 </div>
</div>
<div class="col-md-12 cart-alert-cart-info">

  <div class="row" style="margin-top: 10px;">
    <div class="col-md-12 offset-md-8 text-right ">
      <button class="btn btn-danger" id="detele_bill" href="" data-userid="<?php echo $items->order_id ?>" data-pid="<?php echo $items->product_id ?>">Hủy đơn hàng</button>
    </div>
  </div>
</div>
</div>
<?php }?>
