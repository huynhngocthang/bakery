<section class="main-content">
    <div class="content-wrapper">
        <div class="container">
            <?php if ($this->cart->total_items() <= 0) {?>
                <div class="text-center">Không có sản phẩm nào trong giỏ hàng.</div>
                <div class="text-center" style="margin: 30px auto;"><a class="btn btn-warning" href="<?php echo site_url(); ?>">Tiếp tục mua hàng</a></div>
            <?php } else {?>
                <form method="post" id="shipping-info-form" action="">
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="row bg-light checkout-shipping-info">
                                <div class="col-md-12"><h4 class="cart-index-heading">Thông tin giao hàng</h4></div>

                                <div class="col-md-12">
                                    <!-- <div class="form-group">
                                            <label >Địa chỉ email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Vui lòng nhập email của bạn" required="">
                                    </div> -->
                                    <div class="form-group">
                                        <label >Tên</label>
                                        <input type="text" name="name" class="form-control" placeholder="Vui lòng nhập họ tên" data-error="Vui lòng nhập họ tên" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label >Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Xin vui lòng điền số điện thoại của bạn" data-error="Xin vui lòng điền số điện thoại của bạn"  required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Địa chỉ nhận hàng</label>
                                        <textarea class="form-control" name="address" rows="3" placeholder="Xin vui lòng nhập địa chỉ nhận hàng" data-error="Xin vui lòng nhập địa chỉ nhận hàng" required=""></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light checkout-shipping-info">
                                <div class="col-md-12"><h4 class="cart-index-heading">Hình thức thanh toán</h4></div>
                                <div class="form-group">
                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <input type="radio" name="payment_method" id="bank" class="payment_method" value="bank" data-error="Xin vui lòng chọn hình thức thanh toán" required=""> <label for="bank">Chuyển khoản ngân hàng </label> <small><em>(miễn phí vận chuyển)</em></small>
                                    </div>
                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <input type="radio" name="payment_method" id="cod" class="payment_method" value="COD" data-error="Xin vui lòng chọn hình thức thanh toán" required=""> <label for="cod">Thanh toán khi nhận hàng</label>
                                    </div>
                                    <div class="col-md-12 help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th></th>
                                                <th width="30%">Gia vị</th>
                                                <th width="10%">Giá</th>
                                                <th width="18%">Số lượng</th>
                                                <th width="15%">Tạm tính</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($this->cart->contents() as $items) {?>
                                                <tr id="<?php echo $items['rowid']; ?>">
                                                    <td><img class="cart-index-img img-thumbnail cart-bakery-img" src="<?php echo $items['image']->path ?>"></td>
                                                    <td><?php echo $items['name'] ?>
                                                        <br />
                                                        <a class="remove-from-cart" data-rowid="<?php echo $items['rowid'] ?>" title="Xóa khỏi giỏ hàng"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                    <td><?php echo $items['giavi'] ?></td>
                                                    <td class="cart-index-price text-right"><?php echo number_format($items['price'], 0, ',', '.'); ?> ₫</td>
                                                    <td class="text-center">
                                                        <span><?php echo $items['qty'] ?></span>
                                                    </td>
                                                    <td class="text-right"><span id="subtotal_<?php echo $items['rowid'] ?>" class="cart-index-price"><?php echo number_format($items['price'] * $items['qty'], 0, ',', '.'); ?> ₫</span></td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="bg-light col-md-12">
                                <h4 class="cart-index-heading">Thông tin đơn hàng</h4>
                                <div class="row cart-index-order-row">
                                    <?php foreach ($this->cart->contents() as $items) {?>
                                    <div class="col-md-8"><?php echo $items['name'] ?> x <?php echo $items['qty'] ?></div>
                                    <div class="col-md-4 text-right"><span id="cart-index-subtotal"><?php echo number_format($items['price'] * $items['qty'], 0, ',', '.'); ?> ₫</span></div>
                                    <?php }?>
                                </div>
                                <!-- <div class="row cart-index-order-row">
                                        <div class="col-md-6">Phí giao hàng </div>
                                        <div class="col-md-6 text-right">Miễn phí</div>
                                </div> -->
                                <div class="row cart-index-order-row">
                                        <!-- <div class="col-md-8"><input type="text" name="discount_code" value="" class="form-control"> </div>
                                        <div class="col-md-4 text-right"><a class="btn btn-info">Áp dụng</a></div> -->
                                    <div class="col-md-12">
                                        <div class="input-group"> <input aria-describedby="basic-addon2" placeholder="Mã giảm giá" name="discount_code" class="form-control"> <a id="basic-addon2" class="input-group-addon btn btn-info">Áp dụng</a> </div>
                                    </div>
                                </div>
                                <div class="row cart-index-order-row">
                                    <div class="col-md-6">Tổng cộng </div>
                                    <div class="col-md-6 text-right">
                                        <span id="cart-index-total" class=" cart-index-price"><?php echo number_format($this->cart->total(), 0, ',', '.'); ?> ₫</span>
                                        <br>
                                        <small>Đã bao gồm VAT (nếu có)</small>
                                    </div>
                                </div>
                                <div class=" cart-index-order-row">
                                    <a class="btn btn-warning place-order"  style="display: block;">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            <?php }?>
        </div>
    </div>
</section>