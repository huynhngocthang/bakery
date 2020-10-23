<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */
class Order_model extends CI_Model {

	private $table = 'orders';

	function __construct() {
		parent::__construct();

	}

	public function getAllOrder($order_by = 'order_date', $order_description = 'ASC') {

		$this->db->order_by($order_by, $order_description);
		$this->db->select('DATE(od.order_date) AS date,DAYNAME(od.order_date) AS dayname, COUNT(od.order_id) AS total_bill,SUM(dt.price) AS sum_price');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->group_by('DATE(od.order_date)');
		$query = $this->db->get();
		return $query->result();
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
		$this->db->order_by('id', 'DESC');
		$this->db->select('DATE(od.order_date) AS date,DAYNAME(od.order_date) AS dayname, COUNT(od.order_id) AS total_bill,SUM(dt.price) AS sum_price');
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
		$this->db->select('DATE(od.order_date) AS date, DAYNAME(od.order_date) AS dayname,COUNT(od.order_id) AS total_bill,SUM(dt.price) AS sum_price');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		$this->db->where('MONTH(od.order_date)', $month);
		$this->db->where('YEAR(od.order_date)', $year);
		$this->db->group_by('DATE(od.order_date)');
		$query = $this->db->get();
		$orders = $query->result();

		return ['total' => $total, 'orders' => $orders];
	}

	public function getTotalPaymenByMonth($month = null, $year = null) {
		if ($month == null && $year == null) {
			$year = date('Y');
		}  
		$this->db->select('SUM(dt.price) AS sum_price');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');

		$this->db->from($this->table . ' od');
		if ($month != null) {
			$this->db->where('MONTH(od.order_date)', $month);
		}
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
		$this->db->select('DATE(od.order_date) as date,DAYNAME(od.order_date) AS dayname, od.order_id,p.name as product,pi.path as image,dt.price,od.status,u.name as username , u.phone,dt.giavi');
		$query = $this->db->get();
		$products = $query->result();
		// debug_sql();
		// exit();
		return ['total' => $total, 'products' => $products];
	}
	public function getOrderByIdUser($id_user) {
		$date = date('Y-m-d');
		$weekday = date('l', strtotime($date));
		$this->db->from($this->table . ' od');
		$this->db->where('u.id', $id_user);
		$this->db->group_start();
		$this->db->where('DATE(od.order_date)', $date);
		if ($weekday === 'Sunday') {
			$yesterday = date('Y-m-d H:i:s', strtotime('yesterday'));
			$this->db->or_where('DATE(od.order_date)', $yesterday);
		}
		$this->db->group_end();
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->join('user_address ud', 'ud.user_id = u.id', 'left');
		$this->db->join('products p', 'dt.product_id = p.id', 'left');
		$this->db->join('product_images pi', 'p.id = pi.product_id', 'left');
		$this->db->where('pi.featured', 'Yes');
		$this->db->select('od.order_id,p.name as product,p.id as product_id ,pi.path as image,dt.price,od.status,u.name as username , u.phone,ud.address,od.order_date,od.order_date,dt.giavi');
		$query = $this->db->get();
		$items = $query->row();
		// debug_sql();
		// exit();
		return $items;
	}
	public function getAllOrderByIdUser($id_user, $page = 0) {

		if ($this->input->get('pagination') != null) {
			$total_page = $this->input->get('pagination');
		} else if ($this->input->post('pagination') != null) {
			$total_page = $this->input->post('pagination');
		} else {
			$total_page = 10;
		}

		$this->db->select('od.order_id');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		if ($this->input->get('date') != null) {
			$date = $this->input->get('date');
			$this->db->where('DATE(od.order_date)', $date);
		} else if ($this->input->post('date') != null) {
			$date = $this->input->post('date');
			$this->db->where('DATE(od.order_date)', $date);
		}

		$this->db->where('u.id', $id_user);
		$this->db->from($this->table . ' od');
		$this->db->group_by('DATE(od.order_date)');
		$total = $this->db->count_all_results($this->table);
		$limit = ($total > $total_page) ? $total_page : $total;
		$start = ($page < 1) ? 0 : ($page - 1) * $limit;

		$this->db->limit($limit, $start);
		$this->db->order_by('od.order_id', 'DESC');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('products p', 'dt.product_id = p.id', 'left');
		$this->db->where('u.id', $id_user);
		if ($this->input->get('date') != null) {
			$date = $this->input->get('date');
			$this->db->where('DATE(od.order_date)', $date);
		} else if ($this->input->post('date') != null) {
			$date = $this->input->post('date');
			$this->db->where('DATE(od.order_date)', $date);
		}
		$this->db->select('od.order_id,p.name as product,dt.price,u.name as username, u.phone,od.order_date,od.order_date,dt.giavi');

		$this->db->from($this->table . ' od');
		$query = $this->db->get();
		$orders = $query->result();
		// debug_sql();
		// exit();
		return ['total' => $total, 'orders' => $orders];
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

	public function checkOrderBySunday($id = 0) {
		if ((int) $id > 0) {
			$now = date('Y-m-d');
			$yesterday = date('Y-m-d H:i:s', strtotime('yesterday'));
			$satday = (int) date('d') - 1;
			$this->db->from('orders od');
			$this->db->where('user_id', $id);
			$this->db->group_start();
			$this->db->where('DATE(od.order_date)', $now);
			$this->db->or_where('DATE(od.order_date)', $yesterday);
			$this->db->group_end();
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
	public function getTotalPaymenByAllUser() {
		if ($this->input->post('month') != null) {
			$month = $this->input->post('month');
		} else {
			$month = date('m');
		}
		if ($this->input->post('year') != null) {
			$year = $this->input->post('year');
		} else {
			$year = date('Y');
		}

		$this->db->from('orders od');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->where('MONTH(od.order_date)', $month);
		$this->db->where('YEAR(od.order_date)', $year);
		$this->db->select('sum(dt.price) as totalPrice');
		$query = $this->db->get();
		$payment = $query->row();
		/** lấy date và tổng tiền*/
		$this->db->from('orders od');
		$this->db->join('order_detail dt', 'od.order_id = dt.order_id', 'left');
		$this->db->join('users u', 'od.user_id = u.id', 'left');
		$this->db->group_by('u.id');
		$this->db->where('MONTH(od.order_date)', $month);
		$this->db->where('YEAR(od.order_date)', $year);
		$this->db->select('MONTH(od.order_date),YEAR(od.order_date), u.name as username, sum(dt.price) as totalPayment,count(u.id) as total');
		$query = $this->db->get();
		$orders = $query->result();
		return ['orders' => $orders, 'payment' => $payment];
	}
}
?>
