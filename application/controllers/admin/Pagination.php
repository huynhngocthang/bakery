<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
/**
 *
 */
class Pagination extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->menu = 'pagination';
		$this->page_title = 'Phân trang';
		$this->load->model('admin/pagination_model');
		$this->load->helper(array('file', 'html', 'form', 'path'));
		$this->load->library('form_validation');
	}

	public function index() {
		$data['data'] = $this->pagination_model->getAllPagination();
		$this->_renderAdminLayout('admin/pagination/index', $data);
	}

	// function add() {
	// 	if ($this->input->post('save')) {
	// 		$this->save();
	// 	} else {
	// 		$data['controler'] = $this;
	// 		$this->_renderAdminLayout('admin/pagination/add');
	// 	}
	// }

	public function edit($id) {
		$data['pagination'] = $this->pagination_model->getPaginationById($id);
		$data['controler'] = $this;
		if ($this->input->post('save')) {
			$this->save();
		} else {
			$this->_renderAdminLayout('admin/pagination/edit', $data);
		}
	}

	public function save() {
		$data = $this->input->post();
		$id = $this->input->post('cid');
		if ((int) $id > 0) {
			if ($this->pagination_model->update()) {
				$this->session->set_flashdata('msg', 'Phân trang đã được cập nhật');
				redirect('admin/pagination');
			}
			show_404();
		}
		// } else {
		// 	if ($this->pagination_model->insert()) {
		// 		$this->session->set_flashdata('msg', 'Phân trang mới đã được thêm vào');
		// 		redirect('admin/pagination');
		// 	}
		// 	show_404();
		// }
	}

	public function delete($id) {
		if ((int) $id > 0) {
			$this->db->delete('products', array('id' => $id));
			$this->db->delete('product_images', ['product_id' => $id]);
			$this->session->set_flashdata('msg', 'Phân trang đã được xóa');
			redirect('admin/pagination');
		} else {
			$this->session->set_flashdata('msg', 'không có phân trang để xóa');
			redirect('admin/pagination');
		}
	}

	public function action() {
		$val = $this->input->post('val');
		$action = $this->input->post('hidAction');
		if ($action == 'delete') {
			$in = implode(',', $val);
			$this->db->where("id in ($in)");
			$this->db->delete('pagination');
		}
		redirect('admin/pagination');
	}

}
?>