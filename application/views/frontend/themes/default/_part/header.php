
<section id="header">
<div class="mainHead">
  <div class="inner clearfix">
    <div class="logoHead">
      <a href="<?php echo site_url(); ?>" class="logolink">
        <img src="<?php echo site_url(); ?>public/assets/images/common/logo-head.png" alt="">
      </a>
    </div>
    <div class="collapse navbar-collapse menu">
      <button
      class="btn_toggle sp"
      type="button"
      >
        <span class="dark-blue-text">
          <i class="fa fa-bars fa-1x"></i>
        </span>
      </button>
    <ul class="parent_menu nav   navbar-nav ">
      <li>
        <a href="<?php echo site_url('guide') ?>"
          class="link-menu-head"
        >
          Hướng dẫn
        </a>
      </li>
      <?php echo checkLogin(); ?>
      <?php if ($this->session->userdata('user_info') != null) {
	$user = $this->session->userdata('user_info');
	?>
      <li class="sup_menu">
        <a
        class="dropdown-toggle link-menu-head"
        >
        <?php echo $user['name']; ?>
        <b class="caret"></b>
        </a>
        <ul class="dropdown-menu multi-level">
          <li>
            <a
              href="<?php echo site_url(); ?>profile"
            >
              Trang cá nhân
            </a>
          </li>
          <li>
            <a
              href="<?php echo site_url(); ?>login/signout"
            >
              Đăng xuất
            </a>
          </li>
        </ul>
      </li>
        
      <?php }?>
      <li class="sp">
          <img src="
          <?php echo site_url(); ?>public/assets/images/common/img-slider.png"
          alt="">
      </li>
      <li class="set_share">
        <div class="fb-share-button" data-href="http://bakely.bpotech.com.vn" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fbakely.bpotech.com.vn%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
      </li>

    </ul>
    </div><!--/.nav-collapse -->
    <div class="time">
    <p class="text">Bắt Đầu: 08:00 AM - Kết Thúc: 20:00 PM</p>
    </div>
  </div><!-- .inner -->
</div><!-- .mainMenu -->
</section>
