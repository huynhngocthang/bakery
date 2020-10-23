<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author TNM Group
 */
class Detail extends MY_Controller {

	// public $menu = 'product';
	// public $page_title = 'Sản phẩm';

	public function __construct() {
		parent::__construct();
		// $this->_is_user();
		$this->menu = 'detail';
		$this->page_title = 'CHI TIẾT';
		$this->load->model('admin/product_model');
		$this->load->model('admin/users_model');
		$this->load->model('admin/category_model');
		$this->load->model('admin/order_model');
		$this->load->model('admin/wallet_model') ;
		$this->load->helper('cookie');
	}

	public function delete() {
		$id = $this->input->post('userid');
		$items = $this->product_model->getProductById($id);
		$user_id = $this->session->userdata('user_info')['id'];
		echo var_dump($id) ;die ;
		$wallets = $this->wallet_model->getAllWallet($user_id) ;
		$time = strtotime('21:00:00');
		$h = (int) date('H', $time);
		$i = (int) date('i', $time);
		$s = (int) date('s', $time);
		$timebefore = strtotime('8:00:00');
		$hb = (int) date('H', $timebefore);
		$ib = (int) date('i', $timebefore);
		$sb = (int) date('s', $timebefore);
		$datetime = new DateTime();
		$timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
		$datetime->setTimezone($timezone);
		$time = $datetime->format('H');
		if ((int) $id > 0) {
			if ((int) $time < $hb) {
				die(json_encode(['html' => 'Bạn không thể hủy hàng trước 9 giờ sáng']));
			} else if ((int) $time >= $h && (int) date('i') > $i && (int) date('s') > $s) {
				die(json_encode(['html' => 'Bạn không thể hủy đơn hàng sau 21 giờ!']));
			} else {
				$this->db->delete('orders', array('order_id' => $id));
				$this->db->delete('order_detail', array('order_id' => $id));
				die(json_encode(['html' => 'Bạn đã hủy đơn hàng thành công.', 'check' => true]));
				$total = '' ;
				foreach($wallets as $value) {
					$total = $value->TOTAL + $items->price ;
				}
				$this->db->update('wallet', array( 'TOTAL' => $total));
			}
		} else {
			show_404();
		}
	}

	public function index($id) {
		$this->_is_user();
		$data['jsherf'] = 'https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js';
		$user = $this->session->userdata('user_info');
		$data['items'] = $this->product_model->getProductById($id);
		$data['allproduct'] = $this->product_model->getProduct(0, 21);
		// $response = $this->_loadElement('bill/bill', $data, TRUE);
		// die(json_encode(['html' => $response]));
		$this->_renderFrontLayout('detail/index', $data);
	}
	public function addgiavi() {
		$giavi = $this->input->post('editgiavi');
		$id = $this->input->post('order_id');
		if ($id > 0) {
			$this->db->update('order_detail', array('giavi' => $giavi), array('order_id' => $id));
			$this->session->set_flashdata('check_not_img', 'thêm gia vị thành công');
			redirect('home');
		} else {
			redirect('home');
		}
	}
	// public function getBillByUser($id_user = 0) {
	// 	if ((int) $id > 0) {
	// 		$this->db->from()
	// 		$query = $this->db->get_where('order_detail', array('order_id' => $id));
	// 		return $query->row_array();
	// 	}
	// 	return null;
	// }

}
