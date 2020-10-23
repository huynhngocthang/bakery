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
class Profile extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->_is_user();
		$this->page_title = "Trang cá nhân";
		$this->load->model('admin/users_model');
		$this->load->model('admin/order_model');
		$this->load->model('admin/wallet_model') ;
		$this->load->helper(array('form', 'html', 'file', 'path'));
		$this->load->library('form_validation');
		$this->load->library('upload');

	}
	public function index() {
		if ($this->uri->segment(3) != null) {
			$page = $this->uri->segment(3);
		} else {
			$page = 0;
		}
		$id = $this->session->userdata('user_info')['id'];
		$data['data'] = $this->users_model->get_profile_frontend_id($id);
		$data['order'] = $this->order_model->getAllOrderByIdUser($id, $page);
		$data['wallet'] = $this->wallet_model->getAllWallet($id);
		
		$this->_renderFrontLayout('profile/index', $data);
	}

	public function sortby() {
		if ($this->input->post('page') != null) {
			$page = $this->input->post('page');
		} else {
			$page = 0;
		}
		$id = $this->session->userdata('user_info')['id'];
		$data['data'] = $this->users_model->get_profile_frontend_id($id);
		$data['order'] = $this->order_model->getAllOrderByIdUser($id, $page);
		$data['wallet'] = $this->wallet_model->getAllWallet($id);
		$data['page'] = $page ;	
		$response = $this->_loadElement('profile/order_history', $data, TRUE);
		// die(var_dump($response)) ;
		if ($response != null) {
			die(json_encode(['html' => $response , 'page' => $page]));
		} else {
			die(json_encode(['html' => 'Bạn không có bất kỳ sản phẩm nào!']));
		}

	}

	public function changepassword() {

		$id = $this->session->userdata('user_info')['id'];
		// var_dump($id);
		if ($id != null) {
			if ($this->users_model->editUser($id)) {
				$this->session->set_flashdata('msg', 'Thông tin đã được cập nhật');
				redirect(site_url('profile'));
			} else {
				$this->session->set_flashdata('msg', 'Thông tin cập nhật thất bại');
				redirect(site_url('profile'));
			}

		}redirect(site_url('profile'));

	}
	public function update() {

		$id = $this->input->post('usid');
		if ($id != null) {
			if ($this->users_model->editUserInfomation($id)) {
				$this->session->set_flashdata('msg', 'Thông tin đã được cập nhật');
				redirect(site_url('profile'));
			} else {
				$this->session->set_flashdata('msg', 'Thông tin cập nhật thất bại');
				redirect(site_url('profile'));
			}

		}redirect(site_url('profile'));

	}
	public function updateimg() {
		$config['upload_path'] = 'public/uploads/avatar';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = '5000';
		$config['max_width'] = '3000';
		$config['max_height'] = '3000';
		if ($this->input->post("save")) {
			$id = $this->input->post('usid');
			if (!empty($_FILES['picture']['name'])) {

				$config['file_name'] = 'avatar-' . time();

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('picture')) {

					$uploadData = $this->upload->data();
					$data["img"] = 'public/uploads/avatar/' . $uploadData['file_name'];

				} else {
					$this->session->set_flashdata('check_not_img', 'kích thước ảnh quá mức quy đinh, vui lòng chọn ảnh 500x500');
					$data["img"] = 'public/uploads/avatar/avatar6.png';
				}
			} else {
				$this->session->set_flashdata('check_not_img', 'cập nhật ảnh đại diện bị lỗi');
				redirect(site_url('profile'));
			}
			if ($this->users_model->checkProfileByUserID($id) != null) {
				$this->db->update("user_address", $data, array('user_id' => $id));
			} else {
				$data["user_id"] = $id;
				$this->db->insert("user_address", $data);
			}

			redirect(site_url('profile'));
		}
		redirect(site_url('profile'));

		// if ($id != null) {
		// 	if ($this->users_model->editUserInfomation($id)) {
		// 		$this->session->set_flashdata('msg', 'Thông tin đã được cập nhật');
		// 		redirect(site_url('profile'));
		// 	} else {
		// 		$this->session->set_flashdata('msg', 'Thông tin cập nhật thất bại');
		// 		redirect(site_url('profile'));
		// 	}

		// }redirect(site_url('profile'));
	}

}
