<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class User extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->_is_admin();
		$this->menu = 'adduser';
		$this->page_title = 'Thêm người dùng';
		$this->load->helper(array('file', 'html', 'form', 'path'));
		$this->load->library('form_validation');
		$this->load->model('admin/users_model');
		$this->load->model('admin/pagination_model');

	}

	public function index() {
		if ($this->uri->segment(5) === false) {
			$page = 0;
		} else {
			$page = $this->uri->segment(5);
		}
		$data['data'] = $this->users_model->getUser($page);
		$data['total_page'] = $this->pagination_model->getPaginationByPage('Người dùng')->total;
		$this->_renderAdminLayout('admin/user/index', $data);
	}

	public function add() {
		if ($this->input->post('save')) {
			$this->save();
		} else {
			$data['controler'] = $this;
			$this->_renderAdminLayout('admin/user/add');
		}
	}

	public function edit($id) {
		$data['user'] = $this->users_model->getUserById($id);
		$data['controler'] = $this;
		if ($this->input->post('save')) {
			$this->save();
		} else {
			$this->_renderAdminLayout('admin/user/edit', $data);
		}
	}

	public function save() {
		$data = $this->input->post();
		$uid = $this->input->post('uid');
		if ((int) $uid > 0) {
			if ($this->users_model->editpassword($uid)) {
				$this->session->set_flashdata('msg', 'Người dùng đã được cập nhật');
				redirect('admin/User');
			} else {
				$this->session->set_flashdata('msg', 'Người dùng đã được cập nhật thất bại');
				redirect('admin/User');
			}

		} else {
			if ($this->users_model->insert()) {
				$this->session->set_flashdata('msg', 'Người dùng đã được thêm vào');
				redirect('admin/User');
			}
			$this->session->set_flashdata('msg', 'thêm người dùng bị lỗi , xin thực hiện lại');
			redirect('admin/User');
		}
	}

	public function delete($id = 0) {
		if ((int) $id > 0) {
			$this->db->delete('users', array('id' => $id));
			$this->db->delete('user_address', array('user_id' => $id));
			$this->session->set_flashdata('msg', 'người dùng đã được xóa');
			redirect('admin/User');
		} else {
			$this->session->set_flashdata('msg', 'xóa người dùng thất bại');
			redirect('admin/User');
		}
	}

	public function action() {
		$val = $this->input->post('val');
		$action = $this->input->post('hidAction');
		if ($action == 'delete') {
			$in = implode(',', $val);
			$this->db->where("id in ($in)");
			$this->db->delete('users');
			$this->db->where("user_id in ($in)");
			$this->db->delete('user_address');
		}
		redirect('admin/User');
	}

	public function searchUser() {
		$keyword = $this->input->post('keyword');
		$data['data'] = $this->users_model->searchUser($keyword, 1);
		$response = $this->_loadElementAdmin('admin/user/list', $data, TRUE);
		if ($response != null) {
			die(json_encode(['html' => $response]));
		} else {
			die(json_encode(['html' => 'không có người dùng nào phù hợp!']));
		}
	}

	public function checkEmail() {
		$email = $this->input->post('email');
		if ($this->users_model->get_record_by_email_frontend($email) != null) {
			die(json_encode(['check' => false]));
		} else {
			die(json_encode(['check' => true]));
		}
	}
}
?>