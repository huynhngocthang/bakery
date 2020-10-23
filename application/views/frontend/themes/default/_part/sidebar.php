<div class="a21"></div>
<div id="cssmenu" class="sidebar">
    <h3 class="product-list-navigation-heading" id="aaa">Danh mục</h3>
    <ul class="list-unstyled sidemenu">
        <?php
$c = new stdClass;
$c->listing = '';
//list category
$slug = $this->uri->segment(1);
$pro = $this->category_model->getCategoryBySlug($slug);
foreach ($category_lineage as &$c->category) {
	if ($c->category->parent_id == 0) {
		$c->listing .= '<li class="nav-menu level1 fly">' . recursive($c->category, $current_category, $pro->parent_id) . '</li>';
	}
}
//array id_brand_checked
$id_brand = $this->input->get('id_brand');
if (isset($id_brand)) {
	$idbrand_array = explode('-', $id_brand);
	$c->listing .= '<li class="nav-menu level1 fly">' . recursive_ul_2($brand_lineage, $idbrand_array) . '</li>';
} else {
	$c->listing .= '<li class="nav-menu level1 fly">' . recursive_ul_2($brand_lineage, null) . '</li>';
}
//list brand
//list price
$c->listing .= '<li class="nav-menu level1 fly">
        <a class="nav-link" >Giá cả</a>
        ' . recursive_ul_price() . '</li>';
echo $c->listing;
?>
    </ul>
</div>
