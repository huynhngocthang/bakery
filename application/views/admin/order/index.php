<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Đơn hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Đơn hàng</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('msg')) {?>
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                <strong>Success! </strong>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                  <div class="form_total">
                    <p class="total">Tổng Tiền:</p>
                    <label class="total-price"><?php echo number_format($total_price['sum_price'], 0, ',', '.'); ?></label> đ
                  </div>
                    <div class="form-group">
                        <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Date:</font></font></label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="month" class="form-control pull-right" id="datepicker" style="">
                           <button class="btn-search product1 btnFilterDate" id="btn-search-order" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                        </div>

                        <!-- /.input group -->
                      </div>
                      <div class="form-group">
                        <form action="<?php echo site_url('export/excel') ?>" method="post">
                            <input type="text" class="form-control pull-right" id="datepicker" style="" placeholder="tháng" name="month">
                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="năm" style="" name="year">
                            <input type="submit" name="export">
                        </form>
                        </div>
                    <fo rm id="frmMain" method="POST" action="<?php echo site_url() ?>admin/order/action"  >
                        <div class="box-header add_order">
                            <h3 class="box-title">&nbsp;</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right">
                                    <a id="bulk-delete" class="btn btn-sm btn-danger " data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i> Xóa</a>
                                    <input type="hidden" id="hidAction" name="hidAction" value="" />
                                </div>

                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body no-padding" style="overflow-x:auto;">
                            <table class="table table-bordered table_order table-hover list-order">
                                <?php load_element('/admin/order/list');?>
                            </table>

                        </div>
                        <div class="box-footer clearfix" style="text-align:end">
                        <ul id="pagination-order" class="pagination-sm"></ul>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
