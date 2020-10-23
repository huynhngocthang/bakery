<tr>
                                    <th style="width: 20px"><input type="checkbox" class="minimal checkth" ></th>
                                    <th style="width: 200px">Ảnh</th>
                                    <th>Tên Sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Giá</th>
                                    <th>Mô tả</th>
                                    <th></th>
                                    <th style="width: 80px"></th>
                                </tr>
                                <?php if ($data['total'] > 0) {?>
                                    <?php foreach ($data['products'] as $key => $product) {?>
                                        <tr>
                                            <td><input type="checkbox" class="minimal checkitem" name="val[]" value="<?php echo $product->id ?>" ></td>
                                            <td><img id="thumbPreview" class="img-thumbnail" alt="Ảnh sản phẩm" src="<?php echo site_url($product->image) ?>" style="width: 160px;" /></td>
                                            <td><?php echo $product->name ?></td>
                                            <td><?php echo $product->category ?></td>
                                            <td><?php echo number_format($product->price, 0, ',', '.'); ?> ₫</td>
                                            <td><?php echo $product->description ?></td>
                                            <td></td>
                                            <td>
                                                <a href="<?php echo site_url() ?>/admin/product/edit/<?php echo $product->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo site_url() ?>/admin/product/delete/<?php echo $product->id; ?>" class="btn btn-xs btn-danger" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php } else {?>
                                    <tr>
                                        <td colspan="3" class="text-center"><?php echo $this->config->item('no_data') ?></td>
                                    </tr>
                                <?php }?>