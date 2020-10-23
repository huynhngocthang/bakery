<thead>
                    <tr>
                      <th class="title-table-order" colspan="3" style="font-size: 23px;
color: green;padding: 20px;">Lịch sử đặt hàng</th>
 <th class="title-table-order" colspan="3" style="font-size: 23px;
color: green;padding: 20px;">Ví tiền : <label style="color: #1877f2;"><?php echo number_format($wallet['wallets']->TOTAL, 0, ',','.') ; ?><span style="text-decoration-line : underline ; margin-left: 5px ;">đ</span></label></th>
                    </tr>
                    <tr>
                      <th>Số thứ tự</th>
                      <th>Thời gian</th>
                      <th>Sản phẩm</th>
                      <th width="20%">Ghi chú</th>  
                      <th>Giá cả</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $d=($page -1)*10;foreach ($order['orders'] as $key => $value) { 
	?>                      
                      <tr>
                        <td><?php $d = (int) $d + 1; echo $d?></td>
                        <td><?php echo $value->order_date ?></td>
                        <td><?php echo $value->product ?></td>
                        <td><?php echo $value->giavi ?></td>
                        <td><?php echo number_format($value->price, 0, ',', '.'); ?> ₫</td>
                      </tr>
                      <?php }?>
                  </tbody>