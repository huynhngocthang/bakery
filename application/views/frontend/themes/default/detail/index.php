<div id="content">
	<div class="inner">
	 <div class="single_product">

	  	<?php if ($items != null) {
	?>
	  		<?php
$featured_image = NULL;

	foreach ($items->images as $key => $image) {
		if ($image->featured == 'Yes') {
			$featured_image = $image;
			break;
		}
	}
	?>
			<div class="container">
				<div class="row">
					<!-- Images -->
	        <img class="sp images_detail"  src="<?php echo site_url() . $featured_image->path; ?>" class="small-preview">
					<!-- <div class="col-lg-2 order-lg-1 order-2">
					</div> -->

					<!-- Selected Image -->	
					<div class="col-lg-6 order-lg-2 order-1">
	          <div id="my-gallery" class="vanilla-zoom">
	              <div class="sidebar">
	                  <img style="display:none;" src="<?php echo site_url() . $featured_image->path; ?>" class="small-preview">
	              </div>
	              <div class="zoomed-image"></div>
	          </div>

					</div>

					<!-- Description -->
					<div class="col-lg-6 order-3">
						<div class="product_description">
							<div class="product_category"><?php echo $items->category ?></div>
							<div class="product_name"><?php echo $items->name ?></div>
							<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
							<div class="product_text">
	              				<p><?php echo $items->description ?></p>
	            			</div>
							<div class="order_info d-flex flex-row">
								<form action="<?php echo site_url('checkout') ?>" method="post">
									<div class="clearfix" style="z-index: 1000;">
	                  <label for="">Gia Vị</label><br />
	                  <textarea class="add_giavi_detail" name="giavi"></textarea>
									</div>

									<div class="product_price"><?php echo number_format($items->price, 0, ',', '.'); ?> VND</div>
									<input type="text" name="odid" hidden="hidden" value="<?php echo $items->id ?>">
									<div class="button_container">
										<button type="submit" class="btn btn-warning" id="btn-payme" style="display: block;">Thanh toán</button>
									</div>

								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
			<?php }?>
		</div>
		</div>
	<?php if ($this->session->userdata('user_info') != null) {?>
            <div class="cart-content">
              <a href="javascript:" class="text-cart"  id="view_bill">
                  <i class="fa fa-calendar-check-o"></i>
              </a>
            </div>
        <?php }?>

        <div class="inner">
        <h1 class="titlePage">Hôm nay</h1>
        <div class="mainContent">
            <?php load_element($this->theme_path . 'detail/list');?>
        </div>
        </div><!-- .inner -->
</div>
