<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->model('admin/users_model');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'html', 'file', 'path', 'secure'));
	}

	public function index() {
		if ($this->session->userdata('is_admin')) {
			redirect(site_url('admin/'));
		} else if ($this->session->userdata('is_user')) {
			redirect(site_url('/home'));
		}

		$data = [];
		if ($this->input->cookie('remember_me') != null) {

			$content_cookie = $this->input->cookie('remember_me');
			$sql = $this->db->get_where('users',array('token_remember'=>$content_cookie));
			if($sql->row()!=null){
				
				$record = $sql->row();
				
				$this->session->set_userdata('is_user', true);
				$this->session->set_userdata('user_info', array(
					'email' => $record->email,
					'name' => $record->name,
					'id' => $record->id,
				));
				redirect('/home');
			}else{
				delete_cookie ('remember_me');
				redirect('login');
			}
		}else if ($this->input->post('email') != null) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			if ($this->form_validation->run() !== false) {
				$record = $this->users_model->get_record_by_email_frontend($email);
				if ($record == null || empty($record)) {
					$data['message'] = 'Email hoặc mật khẩu không tồn tại';
				} else {
					if (password_verify($password, $record['password'])) {
						if ($record['is_active'] == 'Yes') {
							$this->session->set_userdata('is_user', true);
							$this->session->set_userdata('user_info', array(
								'email' => $record['email'],
								'name' => $record['name'],
								'id' => $record['id'],
							));

							$token_remember = rand().time();
							$hash_token = password_hash($token_remember,PASSWORD_DEFAULT);
							$this->db->update('users',array('token_remember'=>$hash_token),array('id'=>$record['id']));
							$cookie = array(
								'name' => 'remember_me',
								'value' => $hash_token,
								'expire' => '3000000',
							);
							$this->input->set_cookie($cookie);
							

							redirect('/home');
						}
						$data['message'] = 'Tài khoản chưa xác thực email';
					} else {
						$data['message'] = 'Sai mật khẩu';
					}
				}
			} else {
				$data['message'] = validation_errors();
			}
		}
		$this->load->view('frontend/user_login', $data);
	}

	public function signout() {
		if ($this->session->userdata("is_admin") != null) {
			$this->session->unset_userdata("is_admin");
		}

		$this->session->unset_userdata("is_user");
		$this->session->unset_userdata("user_info");
		delete_cookie('remember_me');
		// delete_cookie('remember_me');
		redirect("login");
	}

}

?>