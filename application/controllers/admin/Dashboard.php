<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->_is_admin();
		$this->menu = 'dashboard';
		$this->page_title = 'Admin Dashboard';
		$this->load->helper(array('form', 'html', 'file', 'path', 'secure'));
		$this->load->model('admin/users_model');
		$this->load->model('admin/dashboard_model');
		$this->load->library('form_validation');
	}

	public function index() {
		//$this->hits_model->adminView();
		//custom_debug($this->hits_model->getTotalHits());
		//$data['pages'] = $this->pages_model->getPages();

		$data['page_title'] = $this->config->item('site_name') . ' | ' . 'Pages';
		$email = $this->session->userdata('user_info')['email'];
		$data['data'] = $this->users_model->get_record_by_email($email);
		$this->_renderAdminLayout('admin/dashboard', $data);
	}


	public function getalltotalbyyear() {
		$year = $this->input->post('year');
		if(!isset($year)){
			$year = date('Y');
		}

		$data = $this->dashboard_model->getAllTotalProductByYear($year);
		$dataAjax = array();
		for ($i = 1; $i <= 12; $i++) {
			foreach ($data as $key => $value) {
				if ($value->month != null) {
					if ($i == (int) $value->month) {
						$dataAjax[$i] = $value->sum_price;
					}
				}
				if (!isset($dataAjax[$i])) {
					$dataAjax[$i] = 0;
				}
			}
		}

		if ($data != null) {
			die(json_encode(['year' => $year, 'data' => $dataAjax]));
		}
	}
}
