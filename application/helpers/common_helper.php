<?php

if (!function_exists('custom_debug')) {

	function custom_debug($data) {
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}

}

if (!function_exists('debug_sql')) {
	function debug_sql() {
		$CI = &get_instance();
		echo ($CI->db->last_query());
	}
}

if (!function_exists('getFriendlyUrl')) {
	function getFriendlyUrl($controller, $uri) {
		switch ($controller) {
		case 'product':
			return site_url('frontend/product/index/' . $uri);
			break;

		default:
			return site_url('frontend/' . $uri);
			break;
		}
	}
}

if (!function_exists('getAllCategories')) {

	function getAllCategories() {
		$CI = &get_instance();
		$CI->db->order_by('id', 'ASC');
		$query = $CI->db->get('categories');
		//debug_sql();
		return $query->result();
	}

}

if (!function_exists('getAllProduct')) {

	function getAllProduct() {
		$CI = &get_instance();
		$CI->db->order_by('id', 'DESC');
		$query = $CI->db->get('products');
		//debug_sql();
		return $query->result();
	}

}

if (!function_exists('get_category')) {

	function get_category($category_id = NULL) {
		$CI = &get_instance();
		$query = $CI->db->get_where('categories', ['id' => $category_id]);
		$category = $query->row_object();
		$name = unserialize($category->name);
		return $name;
	}

}

if (!function_exists('getBrandNameById')) {

	function getBrandNameById($id) {
		$CI = &get_instance();
		$CI->db->order_by('id', 'ASC');
		$CI->db->where('id', $id);
		$query = $CI->db->get('brands');
		//debug_sql();
		$brand = $query->row();
		return $brand->name;
	}

}

if (!function_exists('get_setting')) {

	function get_setting($setting_key = NULL, $unserialize = FALSE, $lang = "vn") {
		$CI = &get_instance();
		if ($CI->db->conn_id->ping() === FALSE) {
			sleep(1);
			$CI->db->reconnect();
		}
		$query = $CI->db->get_where("settings", ['setting_key' => $setting_key]);
		$setting = $query->row_object();
		if ($setting) {
			if ($unserialize) {
				$value = unserialize($setting->setting_value);
				return $value[$lang];
			} else {
				return $setting->setting_value;
			}
		} else {
			return NULL;
		}
	}

}

if (!function_exists('get_allsetting')) {

	function get_allsetting($lang = "vn") {
		$CI = &get_instance();
		if ($CI->db->conn_id->ping() === FALSE) {
			sleep(1);
			$CI->db->reconnect();
		}
		$query = $CI->db->get("settings");
		$settings = $query->result();
		if ($settings) {
			return $settings;
		} else {
			return NULL;
		}
	}

}

if (!function_exists('get_setting_by_key')) {

	function get_setting_by_key($setting_key = '', $settings, $unserialize = FALSE, $lang = "vn") {
		foreach ($settings as $key => $val) {
			if ($setting_key == $val->setting_key) {
				if ($unserialize) {
					$value = unserialize($val->setting_value);
					return $value[$lang];
				} else {
					return $val->setting_value;
				}
				break;
			} else {
				continue;
			}
		}
	}

}

if (!function_exists('custom_pagination')) {

	function custom_pagination($uri, $total_row, $per_page = NULL) {
		$CI = &get_instance();
		$CI->load->library('pagination');

		$per_page = $per_page;

		$config['base_url'] = $uri . "/page";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page;
		$config['use_page_numbers'] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config["full_tag_close"] = '</ul>';
		$config["cur_tag_open"] = '<li>';
		$config["cur_tag_close"] = '</li>';
		$config["num_tag_open"] = '<li>';
		$config["num_tag_close"] = '</li>';
		$config["next_tag_open"] = '<li>';
		$config["next_tag_close"] = '</li>';
		$config["prev_tag_open"] = '<li>';
		$config["prev_tag_close"] = '</li>';
		$config["first_tag_open"] = '<li>';
		$config["first_tag_close"] = '</li>';
		$config["last_tag_open"] = '<li>';
		$config["last_tag_close"] = '</li>';
		$config["cur_tag_open"] = '<li class="active"><a>';
		$config["cur_tag_close"] = '</a></li>';
		$config["first_url"] = $uri;
		$config["first_link"] = '<<';
		$config["last_link"] = '>>';

		$CI->pagination->initialize($config);
		return $CI->pagination->create_links();
	}

}

if (!function_exists('active_class')) {

	function active_class($menu = NULL, $array = NULL) {
		if ($menu && in_array($menu, $array)) {
			return 'active';
		}
		return '';
	}

}

if (!function_exists('breadcrumb')) {

	function breadcrumb($controller, $category_id) {
		$CI = &get_instance();
		$breadcrumb = '<ol class="breadcrumb">';

		$breadcrumb .= '<li><a href="' . getFriendlyUrl($coltroller, $uri) . '">' . $category_name . '</a></li>';

		$breadcrumb .= '</ol>';
		return $breadcrumb;
	}

}

function stringInsert($str, $insertstr, $pos) {
	$str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
	return $str;
}

if (!function_exists('get_setting')) {

	function get_setting($key, $lang = FALSE) {
		$CI = &get_instance();

	}

}

if (!function_exists('get_category_by_id')) {

	function get_category_by_id($id, $is_project = FALSE) {
		$CI = &get_instance();
		$table = ($is_project) ? 'project_categories' : 'categories';
		$query = $CI->db->get_where($table, ['id' => $id]);
		$category = $query->row_object();
		return $category;
	}

}

if (!function_exists('get_category_type')) {

	function get_category_type() {
		$category_type = array(
			'foodmenu' => 'Thực đơn',
			'promotion' => 'Ưu đãi',
		);
		return $category_type;
	}

}

if (!function_exists('get_image_url')) {

	function get_image_url($img) {
		if (@getimagesize(base_url($img))) {
			return site_url($img);
		} else {
			return site_url('assets/images/no-image.jpg');
		}

	}

}

// if (!function_exists('recursive_ul')) {
// 	function recursive_ul(&$cat, $current_category) {
// 		$str = sprintf('<a class="nav-link" href="%1$s">%2$s</a>', site_url($cat->slug), $cat->name);
// 		if (count($cat->sub_categories) > 0) {
// 			$str = sprintf('<a class="nav-link" >%2$s</a>', site_url($cat->slug), $cat->name);
// 			$str .= '<ul class="list-unstyled fly-menu">';
// 			foreach ($cat->sub_categories as &$sub_cat) {
// 				$active = $current_category && ($sub_cat->id == $current_category->id || $sub_cat->id == $current_category->parent_id) ? 'active' : '';
// 				$str .= '<li class="' . $active . '">' . recursive_ul($sub_cat, $current_category) . '</li>';
// 			}
// 			return "$str</ul>";
// 		} else {
// 			return "$str";
// 		}

// 	}
// }

// if (!function_exists('recursive')) {
// 	function recursive(&$cat, $current_category, $pro) {
// 		if ($pro != null) {
// 			if (count($cat->sub_categories) > 0) {
// 				if ($cat->sort == $pro) {
// 					$str = sprintf('<a class="nav-link ' . $cat->slug . '" >%2$s</a>', site_url($cat->slug), $cat->name);
// 					$str .= '<ul class="list-unstyled fly-menu">';
// 					foreach ($cat->sub_categories as &$sub_cat) {
// 						$active = $current_category && ($sub_cat->id == $current_category->id || $sub_cat->id == $current_category->parent_id) ? 'active' : '';
// 						$str .= '<li class="' . $active . '">' . recursive($sub_cat, $current_category, null) . '</li>';
// 					}
// 					return "$str</ul>";
// 				}
// 			} else {
// 				$str = "";
// 				return "$str";
// 			}

// 		} else {
// 			$str = sprintf('<a class="nav-link" href="%1$s">%2$s</a>', site_url($cat->slug), $cat->name);
// 			return "$str";

// 		}
// 	}
// }
// if (!function_exists('recursive_ul_2')) {
// 	function recursive_ul_2($brand, $brand_id) {
// //, $current_brand) {
// 		$str = sprintf('<a class="nav-link" >%2$s</a>', site_url('hang'), 'Hãng');
// 		$str .= '<ul class="list-unstyled fly-menu">';
// 		foreach ($brand as $brand1) {
// 			$d = 0;
// 			if ($brand_id != null) {

// 				for ($i = 0; $i < count($brand_id); $i++) {
// 					if ($brand1->id == (int) $brand_id[$i]) {
// 						$str .= '<li class="">' . sprintf('<input type="checkbox" checked class="nav-link find1"  id="find" value="%1$s"> %2$s', $brand1->id, $brand1->name) . '</li>';
// 						$d = $d + 1;
// 					}
// 				}
// 				if ($d == 0) {
// 					$str .= '<li class="">' . sprintf('<input type="checkbox" class="nav-link find1"  id="find" value="%1$s"> %2$s', $brand1->id, $brand1->name) . '</li>';
// 				}
// 			} else {
// 				$str .= '<li class="">' . sprintf('<input type="checkbox" class="nav-link find1"  id="find" value="%1$s"> %2$s', $brand1->id, $brand1->name) . '</li>';
// 			}

// 		}
// 		$str .= '</ul>';
// 		return "$str";

// 		foreach ($brand as $brand1) {

// 		}

// 	}
// }
// if (!function_exists('recursive_ul_3')) {
// 	function recursive_ul_3($brand, $brand_id) {
// //, $current_brand) {
// 		$str = sprintf('<a class="nav-link" >%2$s</a>', site_url('hang'), 'Hãng');
// 		$str .= '<ul class="list-unstyled fly-menu">';
// 		foreach ($brand as $brand1) {
// 			$d = 0;
// 			if ($brand_id != null) {

// 				for ($i = 0; $i < count($brand_id); $i++) {
// 					if ($brand1->id == (int) $brand_id[$i]) {
// 						$str .= '<li class="">' . sprintf('<input type="checkbox" checked class="nav-link find-search to-scroll"  id="find" value="%1$s"> %2$s', $brand1->id, $brand1->name) . '</li>';
// 						$d = $d + 1;
// 					}
// 				}
// 				if ($d == 0) {
// 					$str .= '<li class="">' . sprintf('<input type="checkbox" class="nav-link find-search to-scroll"  id="find" value="%1$s"> %2$s', $brand1->id, $brand1->name) . '</li>';
// 				}
// 			} else {
// 				$str .= '<li class="">' . sprintf('<input type="checkbox" class="nav-link find-search to-scroll"  id="find" value="%1$s"> %2$s', $brand1->id, $brand1->name) . '</li>';
// 			}

// 		}
// 		$str .= '</ul>';
// 		return "$str";

// 		foreach ($brand as $brand1) {

// 		}

// 	}
// }
// if (!function_exists('recursive_ul_price')) {
// 	function recursive_ul_price() {

// 		$str = sprintf('<ul class="list-unstyled fly-menu">');

// 		$str .= '<div class="c2uiAC">';
// 		// $str .= '<form action="" method="get">';
// 		$str .= '<div class="c1vuTH">
// 		<input class="c30Om7 Startprice123" placeholder="Tối thiểu" type="text" value="">';
// 		$str .= '<div class="c1DHiF">-</div>';
// 		$str .= '<input class="c30Om7 Endprice123" placeholder="Tối đa" type="text" value="">';
// 		$str .= '<button class="btn_filterpr ant-btn c3R9mX ant-btn-primary ant-btn-icon-only"><i class="fa fa-chevron-circle-right"></i></button>';
// 		$str .= '</div>';
// 		// $str .= '</form>';
// 		$str .= '</div>';
// 		$str .= '</ul>';
// 		return "$str";
// 	}
// }
// if (!function_exists('recursive_ul_price_sp')) {
// 	function recursive_ul_price_sp() {

// 		$str = sprintf('<ul class="list-unstyled fly-menu">');

// 		$str .= '<div class="c2uiAC">';
// 		// $str .= '<form action="" method="get">';
// 		$str .= '<div class="c1vuTH">
// 		<input class="c30Om7 StartPriceSp" placeholder="Tối thiểu" type="text" value="">';
// 		$str .= '<div class="c1DHiF">-</div>';
// 		$str .= '<input class="c30Om7 EndPriceSp" placeholder="Tối đa" type="text" value="">';
// 		$str .= '<button class="btn_filterpr_sp ant-btn c3R9mX ant-btn-primary ant-btn-icon-only"><i class="fa fa-chevron-circle-right"></i></button>';
// 		$str .= '</div>';
// 		// $str .= '</form>';
// 		$str .= '</div>';
// 		$str .= '</ul>';
// 		return "$str";
// 	}
// }

if (!function_exists('getProductUrl')) {
	function getProductUrl($product, $current_category_id) {
		return site_url($product->slug . "-" . $product->id . "-" . $current_category_id . ".phtml");
	}
}
if (!function_exists('getsalesUrl1')) {
	function getsalesUrl1($id_sales, $id_product) {
		return site_url("admin/sales/delete_details/" . $id_sales . "-" . $id_product);
	}
}

// if (!function_exists('recursive_option')) {
// 	function recursive_option(&$cat, $selecteds) {
// 		if (count($cat->sub_categories) > 0) {
// 			$str = sprintf('<optgroup  label="%1$s">', $cat->name);
// 			foreach ($cat->sub_categories as &$sub_cat) {
// 				$selected = in_array($sub_cat->id, $selecteds) ? 'selected' : '';
// 				$str .= sprintf('<option ' . $selected . ' value="%1$s">%2$s</option>', $sub_cat->id, $sub_cat->name);
// 			}
// 			$str .= '<optgroup>';
// 			return $str;
// 		} else {
// 			$str = sprintf('<option value="%1$s">%2$s</option>', $cat->id, $cat->name);
// 			return $str;
// 		}

// 	}
// }
// if (!function_exists('recursive_option_1')) {
// 	function recursive_option_1(&$product, $selecteds) {
// 		$d = 0;
// 		foreach ($selecteds as $key => $value) {
// 			if ($value->product_id == $product->id) {
// 				$str = sprintf('<option selected value="%1$s">%2$s</option>', $product->id, $product->name);
// 				$d = $d + 1;
// 			}
// 		}
// 		if ($d < 1) {
// 			$str = sprintf('<option value="%1$s">%2$s</option>', $product->id, $product->name);
// 		}
// 		return $str;
// 	}
// 	if (!function_exists('recursive_option_3')) {
// 		function recursive_option_3($product, $selected) {
// 			foreach ($selected as $key => $value) {
// 				if ($value->product_id == $product->id) {
// 					$str = sprintf('<option selected value="%1$s">%2$s</option>', $product->id, $product->name);
// 				}
// 			}
// 			return $str;
// 		}
// 	}
// }

if (!function_exists('load_element')) {
	function load_element($view, $data = [], $html_output = FALSE) {
		$CI = &get_instance();
		$CI->load->view($view, $data, $html_output);
	}
}
if (!function_exists('checkLogin')) {

	function checkLogin() {
		$CI = &get_instance();
		if ($CI->session->userdata('user_info') == null) {
			$str = sprintf('<li class="active">
                          <a href="%1$s" class="link-menu-head">
                            Đăng nhập
                          </a>
                        </li>', site_url('login'));
			return $str;
		}
	}

}

?>