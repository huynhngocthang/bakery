<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <div class="content">
        <div class="row">
                <div class="col-md-4  col-sm-12">
                  <div class="info-box">

                    <span class="info-box-icon bg-aqua">
                                    <i class="ion ion-pizza"></i>
                                </span>
                    <div class="info-box-content">
                      <a href="<?php echo base_url('admin/product') ?>" class="info-box-text">Tổng Số Lượng Sản Phẩm</a>
                      <span class="info-box-number">18</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-4  col-sm-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                      <a href="<?php echo base_url('admin') ?>" class="info-box-text">Tổng Doanh Thu</a>
                      <span class="info-box-number">760  <small>đ</small></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4  col-sm-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                      <a href="<?php echo base_url('admin/user') ?>" class="info-box-text">Tổng Số Người Dùng</a>
                      <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>
                    <div>

                    </div>
                    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12" style="overflow-x: auto;">
                  <p class="text-center">
                    <!-- <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong> -->
                  </p>
                  <select class="chosen_year" name="chosen_year">
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                  </select>
                  <button type="button" id="totalbyyear" >ok</button>
                    <div id="jqChart" class="chart_form"  >
                    </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </div>


    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
