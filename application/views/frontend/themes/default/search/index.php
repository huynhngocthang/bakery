<section class="main-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-3 hidden-sm hidden-xs">
                    <div id="cssmenu" class="sidebar">
                        <h3 class="product-list-navigation-heading" id="aaa">Tìm kiếm</h3>
                        <ul class="list-unstyled sidemenu">
                            <?php
$c = new stdClass;
$c->listing = '';
//list brand
$id_brand = $this->input->get('id_brand');
if (isset($id_brand)) {
	$idbrand_array = explode('-', $id_brand);

	$c->listing .= '<li class="nav-menu level1 fly">' . recursive_ul_3($brand_lineage, $idbrand_array) . '</li>';
} else {
	$c->listing .= '<li class="nav-menu level1 fly">' . recursive_ul_3($brand_lineage, null) . '</li>';
}

echo $c->listing;
?>
                            <ul class="list-unstyled fly-menu">
                                <div class="c2uiAC">
                                    <h5 style="color: #000;font-weight: bold;">Giá</h5>
                                    <div class="c1vuTH">
                                        <input class="c30Om7 StartPrice" placeholder="Tối thiểu" type="text" value="">
                                        <div class="c1DHiF">-</div>
                                        <input class="c30Om7 EndPrice" placeholder="Tối đa" type="text" value="">
                                        <button class="btn_searchpr ant-btn c3R9mX ant-btn-primary ant-btn-icon-only"><i class="fa fa-check-circle"></i></button>
                                    </div>
                                </div>
                            </ul>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    <h1 class="product-category-heading">Kết quả tìm kiếm</h1>
                    <div class="toolbar"></div>
                    <div class="products-list">
                        <div class="row fbb products-list-content" id="bind-home-products">
                            <?php load_element($this->theme_path . 'search/list');?>
                        </div>

                    </div>
                    <?php //var_dump($products);?>
                </div>
            </div>
        </div>
    </div>
</section>