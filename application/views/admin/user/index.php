<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Người dùng</li>
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
                    <form id="frmMain" method="POST" action="<? echo site_url()?>admin/user/action">
                        <div class="box-header">
                            <h3 class="box-title">&nbsp;</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right">
                                    <a class="btn btn-sm btn-primary " href="<?php echo site_url('/admin/user/add') ?>"><i class="fa fa-plus"></i> Thêm mới</a>
                                    <a id="bulk-delete" class=" bulk-delete btn btn-sm btn-danger " data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i> Xóa</a>
                                    <input type="hidden" id="hidAction" name="hidAction" value="" />
                                </div>

                            </div>
                        </div>
                        <div class="form-group form_search_user">
                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Search</font></font></label>

                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-search-plus"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="content-input" style="">
                                <button class="btn-search product1" id="btn-search-product" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>

                            <!-- /.input group -->
                          </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding" style="overflow-x:auto;">
                            <table class="table table-bordered table-hover list-user">
                                <?php load_element('/admin/user/list');?>
                            </table>

                        </div>
                        <div class="box-footer clearfix">
                            <?php echo custom_pagination(site_url() . '/admin/user/index/', $data['total'], $total_page); ?>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
