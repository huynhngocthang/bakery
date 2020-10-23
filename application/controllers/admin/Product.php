<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Product extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->_is_admin();
		$this->load->model('admin/product_model');
		$this->load->model('admin/pagination_model');
		$this->menu = 'product';
		$this->page_title = 'Sản phẩm';
		$this->load->helper(array('file', 'html', 'form', 'path'));
		$this->load->library('form_validation');

	}

	public function index() {
		if ($this->uri->segment(5) === false) {
			$page = 0;
		} else {
			$page = $this->uri->segment(5);
		}
		$data['total_page'] = $this->pagination_model->getPaginationByPage('Sản phẩm')->total;
		$data['data'] = $this->product_model->getProduct($page, $data['total_page']);

		$this->_renderAdminLayout('admin/product/index', $data);
	}

	function add() {
		$data['ckeditor'] = site_url('public/assets/ckeditor/ckeditor.js');
		$data['ckeditorloader'] = site_url('public/assets/js/ckeditor-loader.js');
		if ($this->input->post('save')) {
			$this->save();
		} else {
			$data['controler'] = $this;
			$this->_renderAdminLayout('admin/product/add', $data);
		}
	}

	public function edit($id) {
		$data['ckeditor'] = site_url('public/assets/ckeditor/ckeditor.js');
		$data['ckeditorloader'] = site_url('public/assets/js/ckeditor-loader.js');
		$data['product'] = $this->product_model->getProductById($id);
		$data['controler'] = $this;
		if ($this->input->post('save')) {
			$this->save();
		} else {
			$this->_renderAdminLayout('admin/product/edit', $data);
		}
	}

	public function save() {
		$data = $this->input->post();
		$id = $this->input->post('pid');
		if ((int) $id > 0) {
			if ($this->product_model->update()) {
				$this->session->set_flashdata('msg', 'Sản phẩm đã được cập nhật');
				redirect('admin/Product');
			}
			show_404();
		} else {
			if ($this->product_model->insert()) {
				$this->session->set_flashdata('msg', 'Sản phẩm mới đã được thêm vào');
				redirect('admin/Product');
			}
			show_404();
		}
	}

	public function delete($id) {
		if ((int) $id > 0) {
			$this->db->delete('products', array('id' => $id));
			$this->db->delete('product_images', ['product_id' => $id]);
			$this->session->set_flashdata('msg', 'Sản phẩm đã được xóa');
			redirect('admin/Product');
		} else {
			$this->session->set_flashdata('msg', 'không có sản phẩm để xóa');
			redirect('admin/Product');
		}
	}

	public function action() {
		$val = $this->input->post('val');
		$action = $this->input->post('hidAction');
		if ($action == 'delete') {
			$in = implode(',', $val);
			$this->db->where("id in ($in)");
			$this->db->delete('products');
			$this->db->where("product_id in ($in)");
			$this->db->delete('product_images');
		}
		redirect('admin/Product');
	}

	public function searchproduct() {
		// var_dump($this->uri->segment(4));
		// exit();
		if ($this->uri->segment(4) === null) {

			if ($this->uri->segment(5) === null) {
				$page = 0;
			} else {
				$page = $this->uri->segment(5);
			}
			$keyword = $this->input->post('keyword');

		} else {
			if ($this->uri->segment(6) === null) {
				$page = 0;
			} else {
				$page = $this->uri->segment(6);
			}
			$keyword = $this->uri->segment(4);

		}
		$data['total_page'] = $this->pagination_model->getPaginationByPage('Tìm kiếm sản phẩm')->total;
		$data['data'] = $this->product_model->searchproduct($keyword, $page, $data['total_page']);

		$this->_renderAdminLayout('admin/product/search', $data);
	}
}
?>