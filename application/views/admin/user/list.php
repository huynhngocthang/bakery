<tr>
    <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
    <th>Họ và tên</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Địa chỉ</th>
    <th>Ngày khởi tạo</th>
    <th></th>
</tr>
<?php if ($data['total'] > 0) {?>
    <?php foreach ($data['users'] as $key => $user) {?>
        <tr>
            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $user->id ?>" ></td>
            <td><?php echo $user->name ?></td>
            <td><?php echo $user->email ?></td>
            <td><?php echo $user->phone ?></td>
            <td><?php echo $user->address ?></td>
            <td><?php echo $user->created_date ?></td>
            <td>
                <a href="<?php echo site_url() ?>/admin/user/edit/<?php echo $user->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                <a href="<?php echo site_url() ?>/admin/user/delete/<?php echo $user->id; ?>" class="btn btn-xs btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
    <?php }?>
<?php } else {?>
        <tr>
            <td colspan="3" class="text-center"><?php echo $this->config->item('no_data') ?></td>
        </tr>
<?php }?>
