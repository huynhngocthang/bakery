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
class Page extends MY_Controller {

	// public $menu = 'product';
	// public $page_title = 'Sản phẩm';

	public function __construct() {
		parent::__construct();
		$this->_is_user();
		$this->menu = 'page';
		$this->page_title = 'Hướng dẫn';
		$this->load->model('admin/page_model');
	}

	public function index($slug) {
		$data['page'] = $this->page_model->getPageBySlug($slug);
		$this->page_seo->type = 'website';
		$this->page_seo->meta_url = $this->canonical_url;
		$this->_renderFrontLayout('page/index', $data);
	}

}
