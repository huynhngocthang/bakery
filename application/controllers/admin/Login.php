<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/users_model');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'html', 'file', 'path', 'secure'));
	}

	public function index() {
		if ($this->session->userdata('is_admin')) {
			redirect(site_url('admin/'));
		}
		$data = [];
		if ($this->input->post('email')) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			if ($this->form_validation->run() !== false) {
				$record = $this->users_model->get_record_by_email($email);
				if ($record == null || empty($record)) {
					$data['message'] = 'Email hoặc mật khẩu không tồn tại';
				} else {
					if (password_verify($password, $record['password'])) {
						$this->session->set_userdata('is_admin', true);
						$this->session->unset_userdata('is_user');
						$this->session->set_userdata('user_info', array(
							'email' => $record['email'],
							'name' => $record['name'],
							'id' => $record['id'],
						));
						redirect('/admin');
					} else {
						$data['message'] = 'Sai mật khẩu';
					}
				}
			} else {
				$data['message'] = validation_errors();
			}
		}
		$this->load->view('admin/login', $data);
	}

	public function signout() {
		$this->session->unset_userdata("is_admin");
		$this->session->unset_userdata("user_info");
		redirect("/admin");
	}

}

?>