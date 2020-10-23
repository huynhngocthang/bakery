<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo site_url('public/assets/adminlte/') ?>/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Quản trị viên</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo active_class($menu, ['adduser']) ?>">
          <a href="<?php echo site_url() ?>/admin/user">
            <i class="fa fa-user-plus"></i> <span>Quản lý khách hàng</span>
          </a>
        </li>
        <li class="<?php echo active_class($menu, ['category']) ?>">
          <a href="<?php echo site_url() ?>/admin/category">
            <i class="fa fa-th"></i> <span>Danh mục</span>
          </a>
        </li>
        <li class="<?php echo active_class($menu, ['product']) ?>">
          <a href="<?php echo site_url() ?>/admin/product">
            <i class="fa fa-cutlery"></i> <span>Sản phẩm</span>
          </a>
        </li>

        <li class="<?php echo active_class($menu, ['order']) ?>">
          <a href="<?php echo site_url() ?>/admin/order">
            <i class="fa fa-shopping-cart"></i> <span>Đơn hàng</span>
          </a>
        </li>
        <li class="<?php echo active_class($menu, ['pagination']) ?>">
          <a href="<?php echo site_url() ?>/admin/pagination">
            <i class="fa fa-line-chart"></i> <span>Phân trang</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
