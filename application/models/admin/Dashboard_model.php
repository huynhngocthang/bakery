<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */
class Dashboard_model extends CI_Model {

	private $table = 'orders';

	function __construct() {
		parent::__construct();

	}

	public function getAllTotalProductByYear($year = 0) {
		$this->db->select('MONTH(od.order_date) AS month, COUNT(od.order_id) AS total_bill,SUM(dt.price) AS sum_price');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->where('YEAR(od.order_date)', $year);
		$this->db->group_by('MONTH(od.order_date)');
		$query = $this->db->get();
		$orders = $query->result();

		return $orders;
	}

	public function getOrder($page = 0, $total_page) {
		$this->db->select('od.order_id');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->group_by('DATE(od.order_date)');
		$total = $this->db->count_all_results($this->table);
		$limit = ($total > $total_page) ? $total_page : $total;
		$start = ($page < 1) ? 0 : ($page - 1) * $limit;

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'ASC');
		$this->db->select('DATE(od.order_date) AS date, COUNT(od.order_id) AS total_bill,SUM(dt.price) AS sum_price');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->group_by('DATE(od.order_date)');
		$query = $this->db->get();
		$orders = $query->result();
		// debug_sql();
		// exit();
		return ['total' => $total, 'orders' => $orders];
	}

	public function getOrderByMonth($month, $year, $total_page = 30) {
		$page = 0;
		$this->db->select('od.order_id');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->where('MONTH(od.order_date)', $month);
		$this->db->where('YEAR(od.order_date)', $year);
		$this->db->group_by('DATE(od.order_date)');
		$total = $this->db->count_all_results($this->table);
		$limit = ($total > $total_page) ? $total_page : $total;
		$start = ($page < 1) ? 0 : ($page - 1) * $limit;

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'ASC');
		$this->db->select('DATE(od.order_date) AS date, COUNT(od.order_id) AS total_bill,SUM(dt.price) AS sum_price');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->where('MONTH(od.order_date)', $month);
		$this->db->where('YEAR(od.order_date)', $year);
		$this->db->group_by('DATE(od.order_date)');
		$query = $this->db->get();
		$orders = $query->result();

		return ['total' => $total, 'orders' => $orders];
	}
	public function getTotalPaymenByMonth($month, $year) {
		$this->db->select('SUM(dt.price) AS sum_price');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->where('MONTH(od.order_date)', $month);
		$this->db->where('YEAR(od.order_date)', $year);
		$this->db->group_by('MONTH(od.order_date)');
		$query = $this->db->get();
		$orders = $query->row_array();
		return $orders;
	}

	public function getOrderByDay($date, $page, $total_page) {
		$this->db->select('od.order_id');
		$this->db->from($this->table . ' od');
		$this->db->where('DATE(od.order_date)', $date);
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('products p', 'dt.product_id = p.id', 'left');
		$this->db->group_by('od.order_id');
		$total = $this->db->count_all_results($this->table);
		$limit = ($total > $total_page) ? $total_page : $total;
		$start = ((int) $page <= 1) ? 0 : ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->from($this->table . ' od');
		$this->db->where('DATE(od.order_date)', $date);
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->join('products p', 'dt.product_id = p.id', 'left');
		$this->db->join('product_images pi', 'p.id = pi.product_id', 'left');
		$this->db->where('pi.featured', 'Yes');
		$this->db->select('DATE(od.order_date) as date, od.order_id,p.name as product,pi.path as image,dt.price,od.status,u.name as username , u.phone');
		$query = $this->db->get();
		$products = $query->result();
		// debug_sql();
		// exit();
		return ['total' => $total, 'products' => $products];
	}
	public function getOrderByIdUser($id_user) {
		$date = date('Y-m-d');
		$this->db->from($this->table . ' od');
		$this->db->where('u.id', $id_user);
		$this->db->where('DATE(od.order_date)', $date);
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->join('user_address ud', 'ud.user_id = u.id', 'left');
		$this->db->join('products p', 'dt.product_id = p.id', 'left');
		$this->db->join('product_images pi', 'p.id = pi.product_id', 'left');
		$this->db->where('pi.featured', 'Yes');
		$this->db->select('od.order_id,p.name as product,pi.path as image,dt.price,od.status,u.name as username , u.phone,ud.address,od.order_date,od.order_date,dt.giavi');
		$query = $this->db->get();
		$items = $query->row();
		// debug_sql();
		// exit();
		return $items;
	}

	public function checkOrder($id = 0) {
		if ((int) $id > 0) {
			$now = date('Y-m-d');
			$this->db->from('orders od');
			$this->db->where('user_id', $id);
			$this->db->where('DATE(od.order_date)', $now);

			$query = $this->db->get();
			$product = $query->row();
			// debug_sql();
			// exit();
			if ($product != null) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
	public function searchorder($keyword, $page, $total_page) {
		$date = $this->uri->segment(4);
		// var_dump($date);
		// exit();
		$keywords = explode(' ', $keyword);
		$x = 0;
		$this->db->start_cache();
		$this->db->group_start();
		foreach ($keywords as $words) {
			$x++;
			if ($x == 1) {
				$this->db->like('p.name ', $words);
				$this->db->or_like('cat.name ', $words);
				$this->db->or_like('u.name ', $words);
			} else {
				$this->db->or_like('p.name ', $words);
				$this->db->or_like('cat.name ', $words);
				$this->db->or_like('u.name ', $words);
			}
		}
		$this->db->group_end();
		$this->db->stop_cache();
		$this->db->select('od.order_id');
		$this->db->from('orders od');
		$this->db->where('DATE(od.order_date)', $date);
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->join('products p', 'dt.product_id = p.id', 'left');
		$this->db->join('categories cat', 'cat.id = p.category_id', 'left');
		$this->db->group_by('od.order_id');

		$total = $this->db->count_all_results($this->table);
		$limit = ($total > $total_page) ? $total_page : $total;
		$start = ((int) $page <= 1) ? 0 : ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->from($this->table . ' od');
		$this->db->where('DATE(od.order_date)', $date);
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->join('products p', 'dt.product_id = p.id', 'left');
		$this->db->join('categories cat', 'cat.id = p.category_id', 'left');
		$this->db->join('product_images pi', 'p.id = pi.product_id', 'left');
		$this->db->where('pi.featured', 'Yes');
		$this->db->select('DATE(od.order_date) as date, od.order_id,p.name as product,pi.path as image,dt.price,od.status,u.name as username , u.phone');
		$query = $this->db->get();
		$products = $query->result();
		$this->db->flush_cache();

		// debug_sql();exit();
		return ["total" => $total, "products" => $products, "date" => $date, "keyword" => $keyword];
	}
}
?>