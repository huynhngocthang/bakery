<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */
class Users_model extends CI_Model {

	private $table = 'system_users';

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
	}

	public function insert() {
		$phone = $this->input->post('phone');
		$username = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$email_code = $email . time();
		$strsendcode = 'SM' . time();
		$now = date('Y:m:d H:i:s');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
		$this->form_validation->set_rules('repwd', 'Repwd', 'trim|required|matches[password]');
		if ($this->form_validation->run() !== false) {
			if ($this->get_record_by_email_frontend($email) == null) {
				$data = array(
					'name' => $username,
					'email' => $email,
					'phone' => $phone,
					'password' => password_hash($password, PASSWORD_DEFAULT),
					'created_date' => $now,
					'email_code' => md5($email_code),
					'is_active' => 'Yes',
				);
				$this->db->insert('users', $data);
				$user_id = $this->db->insert_id('users');
				$this->db->insert('user_address', array('user_id' => $user_id));
				$this->db->insert('wallet', array('ID_USER' => $user_id));
				$encode_code_email = md5($email_code);
				$sendcode = md5($strsendcode);
				$mail_name = 'Ba Ke Lỳ';
				$mail_from = 'no-reply@bpotech.comm.vn';
				$mail_to = $email;
				$mail_sub = 'Verify Email.';
				$mail_msg = "Chào bạn,<br>Tài khoản của bạn được khởi tạo thành công.
				<br> Tên đăng nhập:" . $email . ".
				<br> Mật khẩu: " . $password . "
				<br>Vui lòng nhấn vào đường dẫn bên dưới để xác nhận tài khoản: <br> \n\n " . site_url() . "verify/" . $encode_code_email . "/" . $sendcode . " \n\n\n<br>Thanks\nAdmin Team.";
				$this->users_model->sendmail($mail_name, $mail_from, $mail_to, null, null, $mail_sub, $mail_msg);

				$this->db->insert('secury_verify', array('id_sendmail' => $sendcode));
				return true;
			}return false;

		} else {
			return false;
		}
	}
	public function sendmail($name, $form, $to, $cc, $bcc, $sub, $msg) {
		// $config = Array(
		// 	'protocol' => 'smtp',
		// 	'smtp_host' => 'ssl://smtp.googlemail.com',
		// 	'smtp_port' => '587',
		// 	'smtp_user' => 'nguyenthanhnha.cnttk12@gmail.com',
		// 	'smtp_pass' => 'anhnha858312',
		// 	'mailtype' => 'html',
		// 	'new_line' => "\r\n",
		// 	'charset' => 'utf-8',
		// 	'wordwrap' => TRUE,
		// );

		$this->load->library('email');
		$this->email->from($form, $name);
		$this->email->to($to);
		if ($cc != null) {
			$this->email->cc($cc);
		}
		if ($bcc != null) {
			$this->email->bcc($bcc);
		}
		$this->email->subject($sub);
		$this->email->message($msg);

		$this->email->send();
		// 	// Generate error
		// 	echo $this->email->print_debugger();
		// } else {
		// 	echo 'Gửi email thành công';
		// }
	}
	public function verifyEmail($email_code) {
		// $safe_string_to_store = base64_encode(serialize('http://bakery/home'));

		// //to unserialize...
		// $array_restored_from_db = unserialize(base64_decode($safe_string_to_store));
		// var_dump($safe_string_to_store);
		if ($this->db->update('users', array('is_active' => 'Yes'), array('email_code' => $email_code))) {
			$query = $this->db->get_where('users', array('email_code' => $email_code));
			return $query->row();
		} else {
			return null;
		}

	}

	public function getUser($page = 0) {
		$total = $this->db->count_all_results('users');
		$limit = ($total > 15) ? 15 : $total;
		$start = ((int) $page < 1) ? 0 : ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->from('users u');
		$this->db->join('user_address ud', 'u.id = ud.user_id', 'left');
		$this->db->select('u.*,ud.address,ud.is_default');
		$query = $this->db->get();
		$user = $query->result();
		return ['total' => $total, 'users' => $user];

	}

	public function getUserById($id = 0) {
		if ((int) $id > 0) {
			$query = $this->db->get_where('users', array('id' => $id));
			return $query->row();
		}
		return null;
	}

	// public function update($arr) {
	// 	$this->name = $arr['name'];
	// 	if (!empty($arr['password'])) {
	// 		$this->password = $arr['password'];
	// 	}
	// 	$this->db->update($this->table, $this, array('email' => $arr['email']));
	// }
	public function editUserAdmin($email) {
		// var_dump($email);
		if ($email != null) {
			$user = $this->get_record_by_email($email);
			$oldpwd = $this->input->post('oldpwd');
			$password = $this->input->post('password');

			$this->form_validation->set_rules('oldpwd', 'Oldpwd', 'trim|required|min_length[8]|max_length[32]');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
			$this->form_validation->set_rules('repwd', 'Repwd', 'trim|required|matches[password]');
			if ($this->form_validation->run() !== false) {

				if (password_verify($oldpwd, $user['password'])) {

					$data = array(
						'password' => password_hash($password, PASSWORD_DEFAULT),
					);
					$this->db->update('system_users', $data, array('email' => $email));
					// debug_sql();
					// exit();
					return true;
				}
			}return false;
		}return false;

	}

	public function editpassword($id = 0) {
		if ((int) $id > 0) {

			$user = $this->getUserById($id);
			$password = $this->input->post('password');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
			$this->form_validation->set_rules('repwd', 'Repwd', 'trim|required|matches[password]');
			if ($this->form_validation->run() !== false) {
				$data = array(
					'password' => password_hash($password, PASSWORD_DEFAULT),
				);
				$this->db->update('users', $data, array('id' => $id));
				return true;
			}return false;
		}return false;

	}

	public function checkProfileByUserID($id = 0) {
		if ($id > 0) {
			$query = $this->db->get_where('user_address', array('user_id' => $id));
			return $query->row();
		} else {
			return null;
		}

	}

	public function editUser($id = 0) {
		if ((int) $id > 0) {

			$user = $this->getUserById($id);
			$oldpwd = $this->input->post('oldpwd');
			$password = $this->input->post('password');
			$this->form_validation->set_rules('oldpwd', 'Oldpwd', 'trim|required|min_length[8]|max_length[32]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
			$this->form_validation->set_rules('repwd', 'Repwd', 'trim|required|matches[password]');
			if ($this->form_validation->run() !== false) {
				if (password_verify($oldpwd, $user->password)) {
					$data = array(
						'password' => password_hash($password, PASSWORD_DEFAULT),
					);
					$this->db->update('users', $data, array('id' => $id));
					return true;
				}
			}return false;
		}return false;

	}
	public function editUserInfomation($id = 0) {

		if ((int) $id > 0) {
			$phone = $this->input->post('phone');
			$username = $this->input->post('name');
			$address = $this->input->post('address');
			$user = $this->getUserById($id);

			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
			if ($this->form_validation->run() !== false) {

				$data = array(
					'name' => $username,
					'phone' => $phone,

				);
				$this->db->update('users', $data, array('id' => $id));

				if ($this->get_profile_frontend_id($id) != null) {
					$this->db->update('user_address', array('address' => $address), array('user_id' => $id));
				} else {
					$data_address = array(
						'address' => $address,
						'user_id' => $id,
					);
					$this->db->insert('user_address', $data_address);
				}

				return true;

			}return false;
		}return false;

	}

	public function get_record_by_email($email) {
		$query = $this->db->get_where($this->table, array('email' => $email));
		return $query->row_array();
	}
	public function get_record_by_email_frontend($email) {
		$query = $this->db->get_where('users', array('email' => $email));
		return $query->row_array();
	}

	public function get_profile_by_id($id) {
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row_array();
	}

	public function get_profile_frontend_id($id) {
		$this->db->select('u.*,ud.address,ud.is_default,ud.img');
		$this->db->from('users u');
		$this->db->join('user_address ud', 'u.id = ud.user_id', 'left');
		$this->db->where('u.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function searchUser($keyword, $page) {
		$keywords = explode(' ', $keyword);
		$x = 0;
		$this->db->start_cache();
		$this->db->group_start();
		foreach ($keywords as $words) {
			$x++;
			if ($x == 1) {
				$this->db->like('u.name ', $words);
			} else {
				$this->db->or_like('u.name ', $words);
			}
		}
		// $this->db->like('p.name ', $spm);
		$this->db->group_end();
		$this->db->stop_cache();
		$this->db->select('u.id');
//        $this->db->like('name ', $searchterm);
		$this->db->from('users u');
		$this->db->join('user_address ud', 'u.id = ud.user_id', 'left');
		$this->db->group_by('u.id');
		$total = $this->db->count_all_results();
//        debug_sql();
		$limit = ($total > 15) ? 15 : $total;
		$start = ($page <= 1) ? 0 : ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->order_by('u.id', 'DESC');
		$this->db->group_by('u.id');
		$this->db->from('users u');
		$this->db->join('user_address ud', 'u.id = ud.user_id', 'left');
		$this->db->select('u.*,ud.address,ud.is_default');
		$query = $this->db->get();
		$users = $query->result();
		$this->db->flush_cache();

		// debug_sql();exit();
		return ["total" => $total, "users" => $users];
	}

}

?>