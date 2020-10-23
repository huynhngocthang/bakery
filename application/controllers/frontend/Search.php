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
 * @author TNM Group
 */
class Search extends MY_Controller {

	// public $menu = 'product';
	// public $page_title = 'Sản phẩm';

	public function __construct() {
		parent::__construct();
		$this->_is_user();
		$this->menu = 'search';
		$this->page_title = 'Tìm kiếm sản phẩm';
		$this->load->model('admin/product_model');
		$this->load->model('admin/category_model');
	}

	public function index() {
		$spm = $this->input->get('spm');
		$id_brand = $this->input->get('id_brand');
		$Sprice = $this->input->get('Startprice');
		$Eprice = $this->input->get('Endprice');
		$data = $this->product_model->searchProducts($spm, 1, $id_brand, $Sprice, $Eprice);

		$this->page_seo->type = 'website';
		$this->page_seo->meta_url = $this->canonical_url;
		$this->_renderFrontLayout('search/index', $data);
	}

	public function filtertobrandsearch() {
		$spm = $this->input->post('spm');
		$id_brand = $this->input->post('id');
		$Sprice = $this->input->post('Sprice');
		$Eprice = $this->input->post('Eprice');
		$dataAll = $this->product_model->searchProducts($spm, 1, $id_brand, $Sprice, $Eprice);
		$response = $this->_loadElement('search/list', $dataAll, TRUE);
		if ($response != null) {
			die(json_encode(['html' => $response]));
		} else {
			die(json_encode(['html' => 'Không có sản phẩm nào phù hợp!']));
		}
	}

}
