<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Profile extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->_is_admin();
		$this->load->model('admin/users_model');
		$this->page_title = 'Trang cá nhân';
		$this->load->helper(array('form', 'html', 'file', 'path'));
		$this->load->library('form_validation');
	}

	public function index() {

		$email = $this->session->userdata('user_info')['email'];
		$data['data'] = $this->users_model->get_record_by_email($email);
		$this->_renderAdminLayout('admin/profile/index', $data);
	}

	public function insert() {
		# code...
	}

	public function save() {

		$email = $this->input->post('usemail');
		var_dump($email);
		if ($email != null) {
			if ($this->users_model->editUserAdmin($email)) {
				$this->session->set_flashdata('msg', 'Thông tin đã được cập nhật');
				redirect(site_url('admin/Profile'));
			} else {
				$this->session->set_flashdata('msg', 'Thông tin cập nhật thất bại');
				redirect(site_url('admin/Profile'));
			}

		}redirect(site_url('admin/Profile'));

	}

}
?>