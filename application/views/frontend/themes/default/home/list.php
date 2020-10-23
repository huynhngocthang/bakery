<?php foreach ($products as $key => $product) {
	?>
    <div class="boxItem" itemscope style="<?php echo ($isajax) ? 'display:none' : '' ?>">
        <a class="wrap-box"  style="text-decoration-line: none;">
            <p class="boxImage">
        			<img class="Image" src="<?php echo site_url($product->image); ?>">
            </p>
            <div class="boxContent">
                <h3 class="title-box"><?php echo $product->name ?></h3>
                <p style="color: #f92a2a;" class="price-box"><?php echo number_format($product->price, 0, ',', '.'); ?> ₫</p>
            </div>
        </a>    
            <?php if ($this->session->userdata('user_info') != null) {?>


            <div class=" titleBox_div">
                <div class="hovered">
                     <a class="hoverJS btn-cart btn btn-warning" href="<?php echo site_url('detail/') . $product->id; ?>"><i class="fa fa-shopping-basket"></i> Đặt Hàng
                    </a>
                </div>
            </div>
        <?php }?>
        </a>
    </div>
<?php }?> 
