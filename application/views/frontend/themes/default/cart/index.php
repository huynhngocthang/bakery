<section class="main-content">
    <div class="content-wrapper">
        <div class="container">
            <?php if ($this->cart->total_items() <= 0) {?>
                <div class="text-center">Không có sản phẩm nào trong giỏ hàng.</div>
                <div class="text-center" style="margin: 30px auto;"><a class="btn btn-warning" href="<?php echo site_url(); ?>">Tiếp tục mua hàng</a></div>
            <?php } else {
	?>
                <div class="row">
                    <div class="col-md-8 bg-light">
                        <h3 class="cart-index-heading">Giỏ hàng</h3>
                        <form action="<?php echo site_url('cart/update') ?>" >
                            <table class="table " border="1" style="border-color: #ccc;">
                                <thead class="hidden-sm hidden-xs">
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th width="20%">Sản phẩm</th>
                                        <th width="30%">Gia vị</th>
                                        <th width="10%">Giá</th>
                                        <th width="10%">Số lượng</th>
                                        <th width="10%">Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->cart->contents() as $items) {?>
                                        <tr id="<?php echo $items['rowid']; ?>"  class="hidden-sm hidden-xs">
                                            <td><img class="cart-index-img img-thumbnail cart-bakery-img" src="<?php echo site_url() . $items['image']->path ?>"></td>
                                            <td><?php echo $items['name'] ?>
                                                <br />
                                                <a class="remove-from-cart" data-rowid="<?php echo $items['rowid'] ?>" title="Xóa khỏi giỏ hàng"><i class="fa fa-trash"></i></a>
                                            </td>
                                            <td>
                                                  <!-- <form class="form-horizontal" action="frontend/cart/addgiavi/<?php echo $items['giavi'] ?>">
                                                      <div class="form-group">
                                                          <div class="col-sm-10">
                                                            <input type="giavi" class="form-control" id="giavi" placeholder="Nhập gia vị" name="giavi">
                                                          </div>
                                                          <button type="submit" class="btn btn-xs btn-primary dropdown-toggle" >
                                                <i class="fa fa-edit"></i></button>
                                                        </div>
                                                  </form> -->
                                                  <div class="input-group">
                                                   <input name="giavi" class="form-control input-sm text-center giavi<?php echo $items['id'] ?> " value="<?php echo $items['giavi'] ?>" />
                                                    <a class="input-group-addon insert-giavi cart-index-update-giavi" data-target="giavi<?php echo $items['id'] ?>" data-rowid="<?php echo $items['rowid'] ?>" ><i class="fa fa-plus"></i></a>
                                                     </div>
                                            </td>
                                            <td class="cart-index-price text-right"><?php echo number_format($items['price'], 0, ',', '.'); ?> ₫</td>
                                            <td>
                                            <?php echo $items['qty'] ?>
                                            </td>
                                            <td class="text-right"><span id="subtotal_<?php echo $items['rowid'] ?>" class="cart-index-price"><?php echo number_format($items['price'] * $items['qty'], 0, ',', '.'); ?> ₫</span></td>
                                        </tr>
                                        <!-- SP -->
                                        <tr class="visible-sm visible-xs">
                                            <td><img class="cart-index-img img-thumbnail" src="<?php echo site_url() . $items['image']->path ?>"></td>
                                            <td>
                                                <?php echo $items['name'] ?> <a class="remove-from-cart" data-rowid="<?php echo $items['rowid'] ?>" title="Xóa khỏi giỏ hàng"><i class="fa fa-trash"></i></a>
                                                <br />
                                                <?php echo number_format($items['price'], 0, ',', '.'); ?> ₫
                                                <br />
                                                <?php echo $items['qty'] ?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-4 ">
                        <div class="bg-light col-md-12">
                            <h3 class="cart-index-heading">Thông tin đơn hàng</h3>
                            <div class="row cart-index-order-row">
                                <div class="col-md-6">Tạm tính (<?php echo $this->cart->total_items() ?> sản phẩm)</div>
                                <div class="col-md-6 text-right"><span id="cart-index-subtotal"><?php echo number_format($this->cart->total(), 0, ',', '.'); ?> ₫</span></div>
                            </div>
                            <!--<div class="row cart-index-order-row">
                                <div class="col-md-6">Phí giao hàng </div>
                                <div class="col-md-6 text-right">Miễn phí</div>
                            </div>-->
                            <div class="row cart-index-order-row">
                                    <!-- <div class="col-md-8"><input type="text" name="discount_code" value="" class="form-control"> </div>
                                    <div class="col-md-4 text-right"><a class="btn btn-info">Áp dụng</a></div> -->
                                <!-- <div class="col-md-12">
                                    <div class="input-group"> <input aria-describedby="basic-addon2" placeholder="" name="discount_code" class="form-control" placeholder="mã khuyễn mãi"> <a id="basic-addon2" class="input-group-addon btn btn-info">Áp dụng</a> </div>
                                </div> -->
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
                                <a class="btn btn-warning " id="btn-payment1" style="display: block;" href="<?php echo site_url('checkout'); ?>" style="display: block;">Tiến hành thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>