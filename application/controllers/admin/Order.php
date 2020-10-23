<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Order extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->_is_admin();
		$this->load->model('admin/order_model');
		$this->load->model('admin/pagination_model');
		$this->menu = 'order';
		$this->page_title = 'Đơn đặt hàng';
		$this->load->helper(array('form', 'html', 'file', 'path'));
		$this->load->library('form_validation');
	}

	public function index() {
		if ($this->uri->segment(5) != null) {
			$page = $this->uri->segment(5);
		} else {
			$page = 0;
		}
		$data['total_price'] = $this->order_model->getTotalPaymenByMonth();
		$data['total_page'] = $this->pagination_model->getPaginationByPage('Đơn hàng')->total;
		$data['data'] = $this->order_model->getOrder($page, $data['total_page']);
		// die(var_dump($data['data'])) ;
		$response =	$this->_renderAdminLayout('admin/order/index', $data ,true	);
		// die(var_dump($data)) ;
		// die(var_dump($response)) ;
	}

	public function sorbyOrder() { 
		if ($this->input->post('page') != null) {
			$page = $this->input->post('page');
		} else {
			$page = 0;
		}

		$data['total_price'] = $this->order_model->getTotalPaymenByMonth();
		$data['total_page'] = $this->pagination_model->getPaginationByPage('Đơn hàng')->total;
		$data['data'] = $this->order_model->getOrder($page, $data['total_page']);

		$response =	$this->_loadElementAdmin('admin/order/list', $data ,true );

		if ($response != null) {
			die(json_encode(['html' => $response , 'page' => $page]));
		} else {
			die(json_encode(['html' => 'Bạn không có bất kỳ sản phẩm nào!']));
		}
	}

	public function edit($order_id = 0, $status = NULL) {
		if ((int) $order_id > 0) {
			$this->db->update('orders', array('status' => $status), array('order_id' => $order_id));
			redirect('admin/Order');
		}
		redirect('admin/Order');
	}

	public function delete($order_id = 0) {
		if ((int) $order_id > 0) {
			$this->db->delete('orders', array('order_id' => $order_id));
			$this->db->delete('order_detail', array('order_id' => $order_id));
			redirect('admin/Order');
		}
		redirect('admin/Order');
	}
	public function getOrderByid($id = 0) {
		if ((int) $id > 0) {
			$query = $this->db->get_where('order_detail', array('order_id' => $id));
			return $query->row_array();
		}
		return null;
	}
	public function getOrderbyMonth() {
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$totalprice = $this->order_model->getTotalPaymenByMonth($month, $year)['sum_price'];
		$data['data'] = $this->order_model->getOrderByMonth($month, $year);
		$response = $this->_loadElementAdmin('admin/order/list', $data, TRUE);
		if ($response != null) {
			die(json_encode(['html' => $response, 'totalprice' => $totalprice]));
		} else {
			die(json_encode(['html' => 'không có sản phẩm']));
		}

	}

	public function detail($date) {
		if ($this->uri->segment(6) === False) {
			$page = 0;
		} else {
			$page = $this->uri->segment(6);
		}
		$data['total_page'] = $this->pagination_model->getPaginationByPage('Đơn hàng theo ngày')->total;
		$data['data'] = $this->order_model->getOrderByDay($date, $page, $data['total_page']);

		$this->_renderAdminLayout('admin/order/detail', $data);
	}

	public function searchOrder() {
		if ($this->uri->segment(5) === null) {

			if ($this->uri->segment(6) === null) {
				$page = 0;
			} else {
				$page = $this->uri->segment(6);
			}
			$keyword = $this->input->post('keyword');

		} else {
			if ($this->uri->segment(7) === null) {
				$page = 0;
			} else {
				$page = $this->uri->segment(7);
			}
			$keyword = $this->uri->segment(5);

		}
		$data['total_page'] = $this->pagination_model->getPaginationByPage('Tìm kiếm đơn hàng theo ngày')->total;
		$data['data'] = $this->order_model->searchorder($keyword, $page, $data['total_page']);
		$this->_renderAdminLayout('admin/order/search', $data);
	}
}
?>