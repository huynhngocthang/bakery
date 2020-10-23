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
 * @author FitDNN
 */
class Cart extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->_is_user();
		$this->menu = 'cart';
		$this->load->model('admin/product_model');
		$this->load->model('admin/order_model');
		$this->load->model('admin/wallet_model') ;
		$this->load->helper('form');
		$this->page_title = "Giỏ hàng";
	}

	public function index() {
		$data = [];
		$this->_renderFrontLayout('cart/index', $data);
	}

	public function update() {
		$rowid = $this->input->post('rowid');
		$qty = $this->input->post('qty');
		$data = array(
			'rowid' => $rowid,
			'qty' => $qty,
		);
		// die(json_encode($this->cart->contents()));
		//$this->cart->update($data);
		if (!$this->cart->update($data)) {
			die(json_encode(['error' => 'Có lỗi xảy ra']));
		} else {
			if ($qty > 0) {
				$cart = $this->cart->contents();
				$current_item = $cart[$rowid];
				$item_subtotal = number_format($current_item['subtotal'], 0, ',', '.') . " ₫";
			} else {
				$item_subtotal = 0;
			}
			$total = number_format($this->cart->total(), 0, ',', '.') . " ₫";
				die(json_encode(['html' => 'Quý khách hủy thành công', 'qty' => $this->cart->total_items(), 'subtotal' => $item_subtotal, 'total' => $total, 'check' => true]));
			}
	}

	public function checkout() {
		// var_dump($this->session->userdata('user_info')['id']);die;
		$this->page_title = "Thanh toán";
		$timeafter = strtotime('23:30:00');	
		$ha = (int) date('H', $timeafter);
		$ia = (int) date('i', $timeafter);
		$sa = (int) date('s', $timeafter);
		$timebefore = strtotime('8:00:00');
		$hb = (int) date('H', $timebefore);
		$ib = (int) date('i', $timebefore);
		$sb = (int) date('s', $timebefore);
		// date_default_timezone_set('Hanoi, Việt Nam');
		$date = date('Y-m-d');
		$weekday = date('l', strtotime($date));	
		$datetime = new DateTime();
		$timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
		$datetime->setTimezone($timezone);
		$time = $datetime->format('H');
		// die(var_dump($time)) ;
		if ($this->session->userdata('user_info') != null) {
			$user = $this->session->userdata('user_info');
			$user['id'] = $this->session->userdata('user_info')['id'];
		} else {
			$user['id'] = 0;
		}
		$product_id = $this->input->post('product_id');
		if ($this->session->userdata('is_admin') == null && $this->session->userdata('is_user') == null) {
			redirect('login');

		} else if ($weekday === 'Saturday') {
			if ((int) $time < $hb) {
				$this->session->set_flashdata('check_not_img', 'Trước 8 giờ sáng quý khách không thể đặt sản phẩm');
				redirect('home');
			} else {
				$this->_payment();
			}
		} else if ($weekday === 'Sunday') {
			if ((int) $time >= $ha && (int) date('i') > $ia && (int) date('s') > $sa) {
				$this->session->set_flashdata('check_not_img', 'Sau 21 giờ chiều quý khách không thể đặt sản phẩm');
				redirect('home');
			} else if ($this->order_model->checkOrderBySunday($user['id'])) {
				$this->session->set_flashdata('check_not_img', 'Bạn đã đặt hàng, không thể đặt thêm');
				redirect('home');
			} else {
				$this->_payment();
			}
		} else if ((int) $time < $hb) {
			$this->session->set_flashdata('check_not_img', 'Trước 8 giờ sáng quý khách không thể đặt sản phẩm');
			redirect('home');
		} else if ((int) $time >= $ha && (int) date('i') > $ia && (int) date('s') > $sa) {
			$this->session->set_flashdata('check_not_img', 'Sau 21 giờ chiều quý khách không thể đặt sản phẩm');
			redirect('home');
		} else if ($this->order_model->checkOrder($user['id'])) {
			$this->session->set_flashdata('check_not_img', 'Bạn đã đặt hàng, không thể đặt thêm');
			redirect('home');
			// s  
		} else {
			if ($this->session->userdata('check_click') == null) {
				$this->session->set_userdata('check_click', true);
				$this->_payment();
			}else{
				$this->session->unset_userdata('check_click');
				redirect('home');
			}

		}

	}
	public function _payment() {

		$id = $this->input->post('odid');
		$giavi = $this->input->post('giavi');
		$order = [];
		$id_user = $this->session->userdata('user_info')['id'];
		$order['user_id'] = $id_user;
		$order['order_date'] = date('Y-m-d H:i:s');
		$order['payment_method'] = 'cod';
		$order['status'] = 'pending';
		$order['order_code'] = 'GB' . time();
		$order_error_msg = CREATE_ORDER_ERROR_MSG;
		if (!$this->order_model->checkOrder($order['user_id'])) {
			if (!$this->db->insert('orders', $order)) {
				show_error($order_error_msg, 500, ERROR_HEADING);
				die();
			} ;
			$order_id = $this->db->insert_id();
			$order_details = [];
			$items = $this->product_model->getProductById($id);
			$wallets = $this->wallet_model->getAllWallet($id_user) ;
			$order_item = array('order_id' => $order_id,
				'product_id' => $items->id,
				'qty' => 1,
				'price' => $items->price,
				'giavi' => $giavi,
			);		
			$order_details[] = $order_item;
			$total = '' ;
			foreach($wallets as $value) {
				$total = $value->TOTAL - $items->price ;
			}
			$this->db->update('wallet', array('TOTAL' => $total));

			if (!$this->db->insert_batch('order_detail', $order_details)) {
				$this->db->delete('orders', ['id' => $order_id]);
				$this->session->unset_userdata('check_click');
				show_error($order_error_msg, 500, ERROR_HEADING);
				die();
			}
			redirect(site_url('thankyou'));		
		}
		redirect(site_url('thankyou'));
	}

	public function _createOrder() {
		$order = [];
		$order['user_id'] = $this->session->userdata('user_info')['id'];
		$order['order_date'] = date('Y-m-d H:i:s');
		$order['payment_method'] = 'cod';
		$order['status'] = 'pending';
		$order['order_code'] = 'GB' . time();
		$order_error_msg = CREATE_ORDER_ERROR_MSG;
		if (!$this->order_model->checkOrder($order['user_id'])) {
			if (!$this->db->insert('orders', $order)) {
				show_error($order_error_msg, 500, ERROR_HEADING);
				die();
			}
			$order_id = $this->db->insert_id();
			$order_details = [];
			foreach ($this->cart->contents() as $items) {
				$order_item = array('order_id' => $order_id,
					'product_id' => $items['id'],
					'qty' => $items['qty'],
					'price' => $items['price'],
					'giavi' => $items['giavi'],
				);
				$order_details[] = $order_item;
			}

			if (!$this->db->insert_batch('order_detail', $order_details)) {
				$this->db->delete('orders', ['id' => $order_id]);
				show_error($order_error_msg, 500, ERROR_HEADING);
				die();
			}
			$this->db->select('u.*,ud.address');
			$this->db->from('users u');
			$this->db->join('user_address ud', 'ud.user_id = u.id', 'left');
			$this->db->where(array('u.id' => $this->session->userdata('user_info')['id']));

			$query = $this->db->get();
			$user = $query->row();
			$address = array('name' => $user->name, 'phone' => $user->phone, 'address' => $user->address);
			$shipping = array('order_id' => $order_id, 'address' => serialize($address));
			if (!$this->db->insert('shipping', $shipping)) {
				$this->db->delete('orders', ['id' => $order_id]);
				$this->db->delete('order_detail', ['order_id' => $order_id]);
				show_error($order_error_msg, 500, ERROR_HEADING);
				die();
			}

			//Send notification email for admin
			// $data = array('order' => $order, 'cart' => $this->cart->contents(), 'address' => $address);
			// $message = $this->load->view('email_template/order_notification', $data, TRUE);
			//        die($message);
			// $this->_sendOrderEmail($message, $order['order_code']);
			$this->cart->destroy();
			redirect(site_url('thankyou'));
		}
		redirect(site_url('thankyou'));
	}

	public function _sendOrderEmail($message = '', $order_code) {
		$this->load->library('email');
		$this->email->from('bakerybpotechhue@gmail.com', 'bakeryBPO');
		$this->email->to('hodacquyenpx@gmail.com');
		$this->email->subject('Thông báo đơn hàng ' . $order_code);

		$this->email->message($message);

		$this->email->send();
	}

	public function addgiavi() {
		$rowid = $this->input->post('rowid');
		$giavi = $this->input->post('giavi');
		$data = array(
			'rowid' => $rowid,
			'giavi' => $giavi,
		);
		// if ($this->session->userdata('order')) {
		// 	$arr = $this->session->userdata('order')[$rowid];
		// 	$arr .= $giavi . ",";
		// 	$data_subproduct = array(
		// 		$rowid => $arr,                
		// 	);
		// } else {
		// 	$data_subproduct = array(
		// 		$rowid => $giavi,
		// 	);
		// }
		// $this->session->set_userdata('order');
		if (!$this->cart->update($data)) {
			die(json_encode(['error' => 'Có lỗi xảy ra']));
		} else {
			die(json_encode(['giavi' => $giavi]));
		}

	}
}
