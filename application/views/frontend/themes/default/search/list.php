<?php foreach ($products as $key => $product) {?>
    <div class="col-xs-6 col-sm-6 col-md-3 product-tile-wrapper" itemscope style="">
        <div class="product-tile">
            <a class="" href="<?php echo getProductUrl($product, $product->category_id) ?>" itemprop="url">
                <meta itemprop="brand" content="<?php echo $product->brand ?>" />
                <meta itemprop="productId" content="<?php echo $product->id ?>" />
                <meta itemprop="image" content="<?php echo site_url($product->image); ?>" />
                <div class="product-image-wrapper">
                    <img src="<?php echo site_url($product->image); ?>" class="img-thumbnail" alt="<?php echo $product->name ?>" />
                </div>
                <div class="product-tile-name"><?php echo $product->name ?></div>
                <meta itemprop="productId" content="<?php echo $product->id ?>" />
                <div>
                    <meta content="<?php echo number_format($product->price, 0, ',', '.'); ?> ₫" itemprop="price">
                    <meta content="VND" itemprop="priceCurrency">
                    <meta content="http://schema.org/InStock" itemprop="availability">
                    <div class="product-tile-price">
                        <del style="font-size: 12px;color: #333;"><?php echo number_format($product->price, 0, ',', '.'); ?> ₫</del>
                          <div class="product-tile-price"><?php echo number_format($this->product_model->SalesProductByID($product->id), 0, ',', '.'); ?> ₫</div>
                    </div>
                </div>
            </a>
            <div class="product-tile-buttons text-center">
                <button type="button" data-productid="<?php echo $product->id; ?>" class="btn btn-xs add-to-cart"><i class="fa fa-cart-plus"></i> Thêm vào giỏ</button>
            </div>
        </div>
    </div>
<?php
}?>