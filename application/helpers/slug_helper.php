<?php

/**
 *
 * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
 *
 * @access    public
 * @param    string
 * @return    string
 */
if (!function_exists('create_slug')) {

	function create_slug($string) {
		$string = trim($string);
		$search = array(
			'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
			'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
			'#(ì|í|ị|ỉ|ĩ)#',
			'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
			'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
			'#(ỳ|ý|ỵ|ỷ|ỹ)#',
			'#(đ)#',
			'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
			'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
			'#(Ì|Í|Ị|Ỉ|Ĩ)#',
			'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
			'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
			'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
			'#(Đ)#',
			"/[^a-zA-Z0-9\-\_]/",
		);
		$replace = array(
			'a',
			'e',
			'i',
			'o',
			'u',
			'y',
			'd',
			'A',
			'E',
			'I',
			'O',
			'U',
			'Y',
			'D',
			'-',
		);
		$string = preg_replace($search, $replace, $string);
		$string = preg_replace('/(-)+/', '-', $string);
		$string = strtolower($string);
		return $string;
	}

}

if (!function_exists('createUniqueSlug')) {
	function createUniqueSlug($slug, $table, $field_name, $id = 0) {
		$CI = &get_instance();
		if ($id > 0) {
			$where = ' AND id != ' . $id;
		}
		$sql = "SELECT $field_name FROM categories WHERE ($field_name = '" . $slug . "' OR $field_name REGEXP '" . $slug . "-[0-9]*') ORDER BY LENGTH($field_name) DESC, $field_name DESC LIMIT 1";
		$query = $CI->db->query($sql);
		$row = $query->row();
		// custom_debug($row);die();
		if ($row) {
			$max = str_replace([$slug . "-", $slug], "", $row->slug);
			$max = $max + 1;
			$slug = $slug . "-" . $max;
		}
		return $slug;
	}
}
if (!function_exists('createUniqueSlug1')) {
	function createUniqueSlug1($slug, $table, $field_name, $id = 0) {
		$CI = &get_instance();
		if ($id > 0) {
			$where = ' AND id != ' . $id;
		}
		$sql = "SELECT $field_name FROM products WHERE ($field_name = '" . $slug . "' OR $field_name REGEXP '" . $slug . "-[0-9]*') $where ORDER BY LENGTH($field_name) DESC, $field_name DESC LIMIT 1";
		$query = $CI->db->query($sql);
		$row = $query->row();
		// custom_debug($row);die();
		if ($row) {
			$max = str_replace([$slug . "-", $slug], "", $row->slug);
			$max = $max + 1;
			$slug = $slug . "-" . $max;
		}
		return $slug;
	}
}