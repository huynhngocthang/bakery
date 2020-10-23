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
class Thankyou extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->_is_user();
		$this->page_title = "Thank you";
	}
	public function index() {
		$data = [];
		$this->_renderFrontLayout('cart/thankyou', $data);
	}
}
