<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct() {
		parent::__construct();
		// $this->_is_user();
		$this->page_title = 'BAKELY';
		$this->load->model('admin/product_model');
		$this->load->model('admin/users_model');
		$this->load->model('admin/order_model');
		$this->load->model('admin/secury_model');
		// $this->load->model('admin/category_model');
	}

	public function index($page = 1) {
		if ($this->input->cookie('remember_me') != null && $this->session->userdata('is_user') == null) {
			redirect('Login');
		}
		$this->canonical_url = site_url();
		$this->page_seo->type = 'website';
		$this->page_seo->meta_url = $this->canonical_url;

		$data = $this->_getProducts($page);

		// var_dump($data['items']);exit();
		$this->_renderFrontLayout('home/index', $data);

	}

	// public function login() {
	// 	// $this->load->view('frontend/themes/default/login');
	// 	$this->load->view('frontend/themes/default/cart/index');
	// }

	// public function verify($code_verify) {
	// 	$code_email = unserialize(base64_decode($code_verify));
	// 	if($this->users_model->verifyEmail($code_email)){

	// 	}
	// }
	public function _getProducts($page) {
//        var_dump($this->category_lineage);
		$item_per_page = 30;
		$result = $this->product_model->getFrontProducts($page, $item_per_page);
		$pagecount = ceil($result['total'] / $item_per_page);
		$page = $page + 1;
		$next = ($page > $pagecount) ? FALSE : $page;
		if ($this->input->is_ajax_request()) {
			$result['isajax'] = TRUE;
			$output = $this->_loadElement('home/list', $result, TRUE);
			die(json_encode(["next" => $next, "products" => $output]));
		}
		$result['isajax'] = FALSE;
		$result['next'] = $next;
		return $result;
	}

	public function profile($value = '') {
		# code...
	}

	public function contact() {
		if ($this->input->post('email') != null) {
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$message = $this->input->post('msg');

			$mail_name = 'BPO Tech Huế';
			$mail_from = 'bakerybpotechhue@gmail.com';
			$mail_to = 'bakerybpotechhue@gmail.com';
			$mail_cc = $email;
			$mail_sub = $name . 'thân gửi.';
			$mail_msg = $message;
			$this->users_model->sendmail($mail_name, $mail_from, $mail_to, $mail_cc, null, $mail_sub, $mail_msg);
			die(json_encode(["msg" => 'Gửi email thành công']));
		} else {
			die(json_encode(["msg" => 'Gửi email thất bại']));
		}

	}
}
