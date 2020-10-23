<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Verify extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/users_model');
		$this->load->model('admin/secury_model');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'html', 'file', 'path', 'secure'));
	}

	public function index($email_code = null, $send_code = null) {
		if ($email_code != null && $send_code != null) {
			if ($this->secury_model->getVerifyEmail($send_code) != null) {
				if ($this->secury_model->getVerifyEmail($send_code)->email_code == null) {
					if ($this->users_model->verifyEmail($email_code) != null) {
						$this->db->update('secury_verify', array('email_code' => $email_code), array('id_sendmail' => $send_code));
						$user = $this->users_model->verifyEmail($email_code);
						$data['user'] = $user;
						$data['msg'] = 'Xác thực email hoàn thành .<br> Bạn nên thay đổi mật khẩu.';
						$user = $this->users_model->verifyEmail($email_code);
						$this->session->set_userdata('verifyemail', $user->email_code);
						$this->load->view('frontend/verify/verifyemail', $data);
					} else {
						$data['user'] = $this->users_model->verifyEmail($email_code);
						$data['msg'] = '<h4>Xác thực email thất bại</h4><br><p>vui lòng kiểm tra lại email</p>';

						$this->load->view('frontend/verify/verifyemail', $data);
					}
				} else {
					$data['msg'] = '<h4>Bạn đã xác thực email!</h4>';
					$data['user'] = null;
					$this->load->view('frontend/verify/verifyemail', $data);
				}

			} else {
				$data['user'] = null;
				$this->load->view('frontend/verify/verifyemail', $data);
			}

		} else {
			$data['user'] = null;
			$this->load->view('frontend/verify/verifyemail', $data);
		}

	}

	public function resetpassword($email_code = null) {
		if ($email_code != null) {
			if ($this->input->post('submit') != null) {
				$data['url_1'] = 'password';
				$data['url_2'] = 'resetpassword';
				$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				$this->db->update('users', array('password' => $password), array('email_code' => $email_code));
				$data['msg'] = 'Đỗi mật khẩu thành công';
				$this->session->set_flashdata('login', 'Đỗi mật khẩu thành công <br><a href="login">Đăng nhập</a>');
				redirect('verify');
			} else {

				$data['email_code'] = $email_code;
				$data['url_1'] = 'password';
				$data['url_2'] = 'resetpassword';
				$this->load->view('frontend/verify/resetpassword', $data);
			}
		} else {
			$data['user'] = null;
			$this->load->view('frontend/verify/verifyemail');
		}

	}
	public function sendmailforgot() {
		if ($this->input->post('submit') != null) {
			$email = $this->input->post('email');
			$email_code = $this->users_model->get_record_by_email_frontend($email)['email_code'];
			if ($email_code != null) {
				$encode_code_email = $email_code;
				$strsendcode = 'GM' . time();
				$sendcode = md5($strsendcode);
				$this->db->insert('secury_verify', array('id_sendmail' => $sendcode));
				$mail_name = 'Ba Ke Lỳ';
				$mail_from = 'no-reply@bpotech.comm.vn';
				$mail_to = $email;
				$mail_sub = 'Forgot Password.';
				$mail_msg = "Dear,\nVui lòng nhấp chuột vào đường dẫn trên để lấy lại mật khẩu của bạn: \n\n " . site_url() . "sendmailforgot/forgotpwd/" . $encode_code_email . "/" . $sendcode . " \n\n\nThanks\nAdmin Team.";
				$this->users_model->sendmail($mail_name, $mail_from, $mail_to, null, null, $mail_sub, $mail_msg);
				$this->session->set_flashdata('forgot', 'gửi email thành công, kiểm tra email của bạn');
				redirect('Login');
			}
			$this->session->set_flashdata('forgot', 'Email không tồn tại');
			redirect('Login');

		}
		$this->load->view('frontend/verify/forgotpassword');
	}
	public function forgotpwd($email_code = null, $send_code = null) {
		if ($email_code != null && $send_code != null) {
			if ($this->secury_model->getVerifyEmail($send_code) != null) {
				if ($this->secury_model->getVerifyEmail($send_code)->email_code == null) {
					if ($this->input->post('submit') != null) {
						$this->db->update('secury_verify', array('email_code' => $email_code), array('id_sendmail' => $send_code));
						$data['url_1'] = 'sendmailforgot';
						$data['url_2'] = 'forgotpwd';
						$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
						$this->db->update('users', array('password' => $password), array('email_code' => $email_code));
						$data['msg'] = 'Đỗi mật khẩu thành công';
						$this->session->set_flashdata('login', 'Đỗi mật khẩu thành công <br><a href="login">Đăng nhập</a>');
						redirect('verify');
					} else {
						$data['url_1'] = 'sendmailforgot';
						$data['url_2'] = 'forgotpwd';
						$data['email_code'] = $email_code;
						$data['send_code'] = $send_code;
						$this->load->view('frontend/verify/resetpassword', $data);
					}
					// show_404();
				}
			} else {
				show_404();
			}

			// show_404();
		} else {
			// show_404();
		}
	}
}
?>