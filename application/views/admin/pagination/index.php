<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Phân trang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Phân trang</li>
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
                    <form id="frmMain" method="POST" action="<?php echo site_url() ?>/admin/pagination/action">
                        <div class="box-header">
                            <h3 class="box-title">&nbsp;</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right">
                                    <input type="hidden" id="hidAction" name="hidAction" value="" />
                                </div>

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
                                    <th>Tên Trang</th>
                                    <th>Kích thước trang</th>
                                    <th style="width: 80px"></th>
                                </tr>
                                <?php if ($data['total'] > 0) {?>
                                    <?php foreach ($data['paginations'] as $key => $pagination) {?>
                                        <tr>
                                            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $pagination->id ?>" ></td>
                                            <td><?php echo $pagination->page ?></td>
                                            <td><?php echo $pagination->total ?></td>
                                            <td>
                                                <a href="<?php echo site_url() ?>/admin/pagination/edit/<?php echo $pagination->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>

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
                       <!--  <div class="box-footer clearfix">
                            <?php// echo custom_pagination('/admin/pagination/index/', $data['total']); ?>
                        </div> -->
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