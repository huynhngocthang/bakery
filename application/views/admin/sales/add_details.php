<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm sản phẩm vào danh sách khuyến mãi
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url('admin/sales') ?>">Khuyễn mãi</a></li>
            <li class="active"><a href="<?php echo site_url('admin/sales/details') ?>"><?php echo $title ?></a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm sản phẩm mới</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">

                <div class="box-body" >
                    <div class="form-group" style="display: none;">
                        <label for="name">Tiêu đề</label>
                        <input type="text" class="form-control" value="<?php echo $sales->title ?>" required="" id="name" name="title" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label for="name">Sản phẩm</label>
                        <select id="category_id" name="product_id[]" class="select2 form-control" multiple="" required=""  >
                            <?php
                            $selected_prod = $sales->product_id;
                            foreach ($product as $value) {

                                echo recursive_option_1($value, $selected_prod);
                            }
                            ?>
                        </select>
                        <script type="text/javascript">
                            <?php
                            $selected_prod = '';
                            foreach ($selected_prod as $key => $prod) {
                                $selected_prod .= '"' . $prod['product_id']->id . '",';
                            }
                            //echo $selected_cat;
                            echo 'var selected_products = [' . substr($selected_prod, 0, -1) . ']';
                            ?>
                        </script>
                    </div>


                    <div class="form-group"  style="display: none;">
                        <label for="name">Loại Khuyễn mãi</label>
                        <div class="radio">
                            <label><input type="radio"
                                <?php echo ($sales->type == 'percent') ? 'checked' : ''; ?>
                                          name="type" value="percent">theo % giá</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio"
                                <?php echo ($sales->type == 'fixed') ? 'checked' : ''; ?>
                                          name="type" value="fixed">Theo đơn vị giá</label>
                        </div>
                    </div>
                    <div class="form-group"  style="display: none;">
                        <label for="name">Số khuyên mãi</label>
                        <input type="text" class="form-control" id="slug" name="discount" placeholder="" value="<?php echo $sales->discount ?>">
                    </div>
                    <div class="form-group "  style="display: none;">
                        <label class="control-label col-sm-2 requiredField" for="date">
                            Ngày Bắt Đầu
                            <span class="asteriskField">*</span>
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group col-sm-6">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="datestart" name="datestart" type="date" min="<?php echo date('Y-m-d') ?>" data-format="Y-m-d" value="<?php
                                $date = date_create($sales->start_date);
                                echo date_format($date, "Y-m-d");
                                ?>">                            <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input class="form-control" data-format="hh:mm:ss" name="timestart" type="time" value="<?php
                                $date = date_create($sales->start_date);
                                echo date_format($date, "H:i:s");
                                ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group "  style="display: none;">
                        <label class="control-label col-sm-2 requiredField" for="date">
                            Ngày Kết thúc
                            <span class="asteriskField">*</span>
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group col-sm-6">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="dateend" name="dateend" type="date"data-format="Y-m-d" value="<?php
                                $date = date_create($sales->end_date);
                                echo date_format($date, "Y-m-d");
                                ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input class="form-control" data-format="hh:mm:ss" id="timeend" name="timeend" type="time" value="<?php
                                $date = date_create($sales->end_date);
                                echo date_format($date, "H:i:s");
                                ?>">
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function () {

                                $('#timeend').click(function () {
                                    var startDate = new Date($('#datestart').val()).getTime();
                                    var endDate = new Date($('#dateend').val()).getTime();
                                    if ($('#dateend').val() == "") {
                                        document.getElementById("checkdate").innerHTML = 'vui lòng nhập thời gian kết thúc';
                                    } else if (startDate > endDate) {

                                        document.getElementById("checkdate").innerHTML = 'thời gian kết thúc không thể nhỏ hơn thời gian bắt đầu';

                                    }
                                });
                            });
                        </script>
                        <div class="form-group" id="checkdate" style="color: red;"></div>

                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" class="normal" name="is_active" value="Yes" <?php echo ($sales->is_active == 'Yes') ? ' checked ' : ''; ?> /> Sẵn hàng
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->


                    <div class="box-footer">
                        <button type="submit" name="save" class="btn btn-primary" value="1">Lưu</button>
                        <a href="<?php echo site_url('admin/sales/details/') . $id; ?>" class="btn btn-default">Hủy</a>
                        <input type="hidden" name="sid" value="<?php echo $sales->id ?>" />
                    </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
