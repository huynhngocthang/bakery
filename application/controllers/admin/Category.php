<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Category extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->_is_admin();
		$this->menu = 'category';
		$this->page_title = 'Danh mục';
		$this->load->helper(array('form', 'html', 'file', 'path'));
		$this->load->library('form_validation');
		$this->load->model('admin/category_model');
	}

	public function index() {
		if ($this->uri->segment(5) === False) {
			$page = 0;
		} else {
			$page = $this->uri->segment(5);
		}
		$data['data'] = $this->category_model->getCategory($page);
		$this->_renderAdminLayout('admin/category/index', $data);
	}

	public function add() {
		if ($this->input->post('save')) {
			$this->save();
		} else {
			$data['controller'] = $this;
			$this->_renderAdminLayout('admin/category/add');
		}
	}

	public function edit($id) {
		$data['category'] = $this->category_model->getCategoryById($id);
		$data['controller'] = $this;
		$data['cid'] = $this->input->post('cid');
		if ($this->input->post('save')) {
			$this->save();
		} else {
			$this->_renderAdminLayout('admin/category/edit', $data);
		}
	}

	public function delete($id) {
		if ((int) $id > 0) {
			$this->category_model->delete($id);
		}
		$this->session->set_flashdata('msg', 'Danh mục đã được xóa');
		redirect('admin/category');
	}

	public function save() {
		$data = $this->input->post();

		$id = $this->input->post('cid');
		if ((int) $id > 0) {
			if ($this->category_model->update()) {
				$this->session->set_flashdata('msg', 'Danh mục đã được cập nhật');
				redirect('admin/Category');
			}
			show_404();
		} else {
			if ($this->category_model->insert()) {
				$this->session->set_flashdata('msg', 'Danh mục mới đã được thêm vào');
				redirect('admin/Category');
			}
			show_404();
		}

	}

	public function action() {
		$val = $this->input->post('val');
		$action = $this->input->post('hidAction');
		if ($action == 'delete') {
			$in = implode(',', $val);
			$this->db->where("id in ($in)");
			$this->db->delete('categories');
		}
		redirect('admin/Category');
	}
}
?>