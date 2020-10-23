
    <div class="slider">
        <ul class="bxslider">
            <li>
                    <img src="<?php echo base_url(); ?>public/assets/bxslider/images/bread-1.jpg" alt="" />

                </li>
                <li>
                    <img src="<?php echo base_url() ; ?>public/assets/bxslider/images/bread-2.jpg" alt="" />

                </li>
                <li>
                    <img src="<?php echo base_url() ; ?>public/assets/bxslider/images/bread-3.jpg" alt="" />

                </li>

                <li>
                    <img src="<?php echo base_url() ; ?>public/assets/bxslider/images/bread-1.jpg" alt="" />

                </li>
                <li>
                    <img src="<?php echo base_url() ; ?>public/assets/bxslider/images/bread-2.jpg" alt="" />

                </li>   
        </ul>
        <p class="imgSlider">
          <img src="<?php echo base_url(); ?>public/assets/images/common/img-slider.png" alt="">
        </p>
    </div>
`
    <div class="dish-list">
        <div class="inner">
            <div class="dish">
                <img class="dish-img" src="<?php echo base_url(); ?>public/assets/images/common/bread-list-1.jpg" alt="">
            </div>
            <div class="dish">
                <img class="dish-img" src="<?php echo base_url(); ?>public/assets/images/common/bread-list-2.jpg" alt="">
            </div>
            <div class="dish">
                <img class="dish-img" src="<?php echo base_url(); ?>public/assets/images/common/bread-list-3.jpg" alt="">
            </div>
            <div class="dish">
                <img class="dish-img" src="<?php echo base_url(); ?>public/assets/images/common/bread-list-4.jpg" alt="">
            </div>
        </div>
    </div>
   <div id="content">
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
            <?php load_element($this->theme_path . 'home/list');?>
        </div>
        </div><!-- .inner -->
    </div>
