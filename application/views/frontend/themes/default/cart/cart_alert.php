<div class="">
	<div class="col-md-8">
		<div class="">
		</div>
		<?php
$featured_image = NULL;

foreach ($product->images as $key => $image) {
	if ($image->featured == 'Yes') {
		$featured_image = $image;
		break;
	}
}
?>
		<div class="row">
			<div class="col-md-4"><img src="<?php echo site_url() . $featured_image->path; ?>"></div>
			<div class="col-md-8">
				<?php foreach ($this->cart->contents() as $items) {?>
				<div class="cart-alert-name"><?php echo $items['name'] ?>
            <a class="remove-from-cart-ajax" data-rowid="<?php echo $items['rowid'] ?>" title="Xóa khỏi giỏ hàng"><i class="fa fa-trash"></i></a>
				</div>
				<div class="input-group">
					<label>Thêm ghi chú</label>
                   <textarea name="giavi" class="form-control input-sm text-center cart-index-update-giavi" data-rowid="<?php echo $items['rowid'] ?>"></textarea>
                </div>
            	<?php }?>
			</div>
		</div>
	</div>
	<div class="col-md-4 cart-alert-cart-info">
		<div class="cart-alert-my-cart">Giỏ hàng của bạn (<?php echo $this->cart->total_items(); ?> sản phẩm) </div>
		<div class="row">
			<div class="col-md-6">Tổng cộng</div>
			<div class="col-md-6 text-right cart-alert-price">
				<?php echo number_format($this->cart->total(), 0, ',', '.'); ?> ₫
				<div>Đã bao gồm VAT (nếu có)</div>

			</div>
		</div>
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-6 text-right " >
				<a class="btn btn-warning" id="btn-payment" style="display: block;" href="<?php echo site_url('checkout') ?>">Thanh toán</a>
			</div>
		</div>
	</div>
</div>
