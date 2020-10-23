        <!-- HEADER -->
        <table class="head-wrap" bgcolor="#999999" style="min-width: 80%;max-width:100%;">
            <tr>
                <td></td>
                <td class="header container">

                    <div class="content">
                        <table bgcolor="#999999" style="width:100%;">
                            <tr>
                                <td><img width="100px" src="<?php echo site_url('assets/images/avatar01.png') ?>" /></td>
                                <td align="right"><h6 class="collapse">Bakery</h6></td>
                            </tr>
                        </table>
                    </div>

                </td>
                <td></td>
            </tr>
        </table><!-- /HEADER -->


        <!-- BODY -->
        <table class="body-wrap"  style="min-width: 80%;max-width:100%;">
            <tr>
                <td></td>
                <td class="container" bgcolor="#FFFFFF">

                    <div class="content">
                        <table style="width:100%;">
                            <tr>
                                <td>

                                    <h3>Xin chào,</h3>
                                    <p class="lead">Thống kê đơn hàng hằng ngày <a href="http://www.bakery.vn">Bakely.bpotech.com.vn</a></p>

                                    <p><strong>Thông tin đặt hàng:</strong></p>
                                    <p>
                                        Số lượng: <?php echo $data['total'] ?> <br />
                                    Tổng tiền: <?php echo number_format($data['total']*10000, 0, ',', '.') ?> đ<br />

                                    </p>
                                    <!-- Callout Panel -->
                                    <p class="callout">
                                        Dưới đây là thông tin chi tiết về đơn hàng 
                                    </p><!-- /Callout Panel -->

                                    <table class="" border="1" style="border-collapse:collapse;width:100%;border-color: #cccccc;" cellpadding="5" cellspacing="0" >
                                        <tr>
                                      <th style="width: 7%">Số thứ tự</th>
                                      <th>Khách hàng</th>
                                      <th>Sản phẩm</th>
                                      <th>Gia vị</th>
                                      <th>Thanh toán</th>
                                      <th style="width: 80px"></th>
                                    </tr>
                                      <?php if ($data['total'] > 0) {$d = 0;?>

                                          <?php foreach ($data['products'] as $key => $product) {?>
                                              <tr>
                                                  <td><?=$d+1?></td>
                                                  <td><?php echo $product->username ?></td>
                                                  <td><?php echo $product->product ?></td>
                                                  <td><?php echo $product->giavi ?></td>
                                                  <td><?php echo number_format($product->price, 0, ',', '.'); ?> ₫</td>
                                                  <td>
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

                </td>
                <td></td>
            </tr>
        </table><!-- /BODY -->

        <!-- FOOTER -->
        <table class="footer-wrap"  style="min-width: 80%;max-width:100%;">
            <tr>
                <td></td>
                <td class="container">

                    <!-- content -->
                    <div class="content">
                        <table>
                            <tr>
                                <td align="center">

                                </td>
                            </tr>
                        </table>
                    </div><!-- /content -->

                </td>
                <td></td>
            </tr>
        </table><!-- /FOOTER -->