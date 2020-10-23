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
class Product extends MY_Controller {

	// public $menu = 'product';
	// public $page_title = 'Sản phẩm';

	public function __construct() {
		parent::__construct();
		// $this->_is_user();
		$this->menu = 'product';
		$this->page_title = '';
		$this->load->model('admin/product_model');
		$this->load->model('admin/category_model');
		$this->load->model('admin/order_model');
		$this->load->helper('cookie');
	}

	public function index($slug, $page = 0) {

		$current_category = $this->category_model->getCategoryBySlug($slug);
		if (!$current_category) {
			show_404();
		}
		$this->canonical_url = site_url($current_category->slug);
		$this->page_title = $current_category->name;
		$this->page_description = $this->createPageDescription($current_category->name);
		$this->page_seo->title = $current_category->name;
		$this->page_seo->description = $this->createPageDescription($current_category->name);
		$this->page_seo->type = 'product';
		$this->page_seo->meta_url = $this->canonical_url;

		$data = $this->product_model->getProductByCategory($current_category->id, $page, null, null, null);
		$data['breadcrumbs'] = $this->_breadcrumbs($current_category->id);
		$this->current_category = $current_category;
		$this->_renderFrontLayout('product/index', $data, TRUE);
	}

	public function detail($slug, $product_id, $category_id) {
		$product_reseen = '';

		if (get_cookie('reseen') != null) {
			$product_reseen .= $product_id . ',' . get_cookie('reseen');
			// $cookie = array(
			// 	'name' => 'reseen',
			// 	'value' => $product_reseen,
			// 	(int) 'expire' => time() + 86500,
			// );
			set_cookie('reseen', $product_reseen, '86500');
		} else {
			// $product_reseen = array_push($product_reseen, $product_id);
			set_cookie('reseen', $product_id, '86500');
		}
		if ($product_id > 0) {
			$products = array();
			$product = $this->product_model->getProductById($product_id);
			$products = $this->product_model->getProductsRelative($product->brand_id, $category_id, $product->id);
			$product_array = $this->product_model->getProductsReSeen(get_cookie('reseen'));
			if ($product != null) {
				// custom_debug($product);die();
				$this->carabiner->css('smoothproducts/css/smoothproducts.css');
				$this->carabiner->js('smoothproducts/js/smoothproducts.min.js');
				$this->carabiner->js('js/product-page.js');
				// $referrer = $_SERVER['HTTP_REFERER'];
				//echo $referrer;
				// $parts = parse_url($referrer);
				// $path = $parts['path'];
				$current_category = $this->category_model->getCategoryById($category_id);
				$this->current_category = $current_category;

				$featured_image = $other_images = NULL;

				foreach ($product->images as $key => $image) {
					if ($image->featured == 'Yes') {
						$featured_image = $image;
					} else {
						$other_images[] = $image;
					}
				}
				// var_dump($product->images);die();
				$category_ids = [];
				foreach ($product->category_id as $key => $value) {
					$category_ids[] = $value->category_id;
				}
				$this->canonical_url = ($category_id == max($category_ids)) ? NULL : getProductUrl($product, $this->category_lineage[max($category_ids)]->id);

				$this->page_title = $product->name;
				$this->page_description = $this->createPageDescription($product->name);
				$this->page_seo->title = $product->name;
				$this->page_seo->description = 'product';
				$this->page_seo->meta_url = $this->canonical_url;
				$this->page_seo->meta_img = site_url($featured_image->path);
				$data['breadcrumbs'] = $this->_breadcrumbs($current_category->id);
				$data['featured_image'] = $featured_image;
				$data['other_images'] = $other_images;
				$data['product'] = $product;
				if ($products != null) {
					$data['products'] = $products;
				}
				if ($product_array != null) {
					$data['product_array'] = $product_array;
				}
				// var_dump($data);
				// exit();
				$this->_renderFrontLayout('product/detail', $data, TRUE);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function addtocart() {
		$timeafter = strtotime('20:00:00');
		$ha = (int) date('H', $timeafter);
		$ia = (int) date('i', $timeafter);
		$sa = (int) date('s', $timeafter);
		$timebefore = strtotime('8:00:00');
		$hb = (int) date('H', $timebefore);
		$ib = (int) date('i', $timebefore);                                                                  
		$sb = (int) date('s', $timebefore);
		$date = date('Y-m-d');
		$weekday = date('l', strtotime($date));
		if ($this->session->userdata('user_info') != null) {
			$user = $this->session->userdata('user_info');
			$user['id'] = $this->session->userdata('user_info')['id'];
		} else {
			$user['id'] = 0;
		}
		$product_id = $this->input->post('product_id');
		if ($this->session->userdata('is_admin') == null && $this->session->userdata('is_user') == null) {
			die(json_encode(['html' => 'Quý khách vui lòng đăng nhập để đặt hàng', 'qty' => 0]));
		} else if ($weekday === 'Saturday') {
			$this->addtocartbysatday($product_id);
		} else if ($weekday === 'Sunday') {
			$this->addtocartbysunday($product_id);
		}
		//sau 17 khong duoc dat my
		else if ((int) date('H') < $hb) {
			die(json_encode(['html' => 'Trước 8 giờ sáng quý khách không thể đặt sản phẩm', 'qty' => 0]));
		} else if ((int) date('H') >= $ha && (int) date('i') > $ia && (int) date('s') > $sa) {
			die(json_encode(['html' => 'Sau 20 giờ chiều quý khách không thể đặt sản phẩm', 'qty' => 0]));
		} else if ($this->order_model->checkOrder($user['id'])) {
			die(json_encode(['html' => 'Bạn đã đặt hàng, không thể đặt thêm', 'qty' => 0]));
		} else if ($product_id > 0) {
			$product = $this->product_model->getProductById($product_id);
			if ($product) {
				if ($this->cart->contents() == null) {
					$data['id'] = $product->id;
					$data['name'] = $product->name;
					$data['qty'] = 1;
					$data['price'] = $product->price;
					$data['giavi'] = "";
					$data['username'] = $user['name'];
					$data['email'] = $user['email'];
					$data['user_id'] = $user['id'];

					$featured_image = NULL;

					foreach ($product->images as $key => $image) {
						if ($image->featured == 'Yes') {
							$featured_image = $image;
							break;
						}
					}
					$data['image'] = $featured_image;

					// $this->cart->destroy();
					$rowId = $this->cart->insert($data);
					//                $serializeCart = serialize($this->cart->contents());
					//                $this->input->set_cookie('goodbiker_cart_cookie', $serializeCart,36000);
					if ($rowId) {

						// $response = ['image' => $featured_image, 'cart' => $this->cart->contents()];
						$response = $this->_loadElement('cart/cart_alert', ['product' => $product], TRUE);
						die(json_encode(['html' => $response, 'qty' => $this->cart->total_items()]));
					} else {
						$response = ['error' => 'Có lỗi xảy ra! Vui lòng thử lại.'];
						die(json_encode($response));
					}
				} else if ($this->cart->contents() != null) {
					foreach ($this->cart->contents() as $key => $value) {
						$data['rowid'] = $value['rowid'];
					}
					$this->cart->remove($data['rowid']);
					$data['id'] = $product->id;
					$data['name'] = $product->name;
					$data['qty'] = 1;
					$data['price'] = $product->price;
					$data['giavi'] = "";
					$data['username'] = $user['name'];
					$data['email'] = $user['email'];
					$data['user_id'] = $user['id'];

					$featured_image = NULL;

					foreach ($product->images as $key => $image) {
						if ($image->featured == 'Yes') {
							$featured_image = $image;
							break;
						}
					}
					$data['image'] = $featured_image;

					// $this->cart->destroy();
					$rowId = $this->cart->insert($data);
					//                $serializeCart = serialize($this->cart->contents());
					//                $this->input->set_cookie('goodbiker_cart_cookie', $serializeCart,36000);
					if ($rowId) {

						// $response = ['image' => $featured_image, 'cart' => $this->cart->contents()];
						$response = $this->_loadElement('cart/cart_alert', ['product' => $product], TRUE);
						die(json_encode(['html' => $response, 'qty' => $this->cart->total_items()]));
					} else {
						$response = ['error' => 'Có lỗi xảy ra! Vui lòng thử lại.'];
						die(json_encode($response));
					}
				}

			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function addtocartbysatday($product_id) {
		$timebefore = strtotime('8:00:00');
		$hb = (int) date('H', $timebefore);
		$ib = (int) date('i', $timebefore);
		$sb = (int) date('s', $timebefore);
		if ($this->session->userdata('user_info') != null) {
			$user = $this->session->userdata('user_info');
			$user['id'] = $this->session->userdata('user_info')['id'];
		} else {
			$user['id'] = 0;
		}
		if ((int) date('H') < $hb) {
			die(json_encode(['html' => 'Trước 8 giờ sáng quý khách không thể đặt sản phẩm', 'qty' => 0]));
		} else if ($this->order_model->checkOrder($user['id'])) {
			die(json_encode(['html' => 'Bạn đã đặt hàng, không thể đặt thêm', 'qty' => 0]));
		} else if ($product_id > 0) {
			$product = $this->product_model->getProductById($product_id);
			if ($product) {
				if ($this->cart->contents() == null) {
					$data['id'] = $product->id;
					$data['name'] = $product->name;
					$data['qty'] = 1;
					$data['price'] = $product->price;
					$data['giavi'] = "";
					$data['username'] = $user['name'];
					$data['email'] = $user['email'];
					$data['user_id'] = $user['id'];

					$featured_image = NULL;

					foreach ($product->images as $key => $image) {
						if ($image->featured == 'Yes') {
							$featured_image = $image;
							break;
						}
					}
					$data['image'] = $featured_image;

					// $this->cart->destroy();
					$rowId = $this->cart->insert($data);
					//                $serializeCart = serialize($this->cart->contents());
					//                $this->input->set_cookie('goodbiker_cart_cookie', $serializeCart,36000);
					if ($rowId) {

						// $response = ['image' => $featured_image, 'cart' => $this->cart->contents()];
						$response = $this->_loadElement('cart/cart_alert', ['product' => $product], TRUE);
						die(json_encode(['html' => $response, 'qty' => $this->cart->total_items()]));
					} else {
						$response = ['error' => 'Có lỗi xảy ra! Vui lòng thử lại.'];	 
						die(json_encode($response));
					}
				} else if ($this->cart->contents() != null) {
					foreach ($this->cart->contents() as $key => $value) {
						$data['rowid'] = $value['rowid'];
					}
					$this->cart->remove($data['rowid']);
					$data['id'] = $product->id;
					$data['name'] = $product->name;
					$data['qty'] = 1;
					$data['price'] = $product->price;
					$data['giavi'] = "";
					$data['username'] = $user['name'];
					$data['email'] = $user['email'];
					$data['user_id'] = $user['id'];

					$featured_image = NULL;

					foreach ($product->images as $key => $image) {
						if ($image->featured == 'Yes') {
							$featured_image = $image;
							break;
						}
					}
					$data['image'] = $featured_image;

					// $this->cart->destroy();
					$rowId = $this->cart->insert($data);
					//                $serializeCart = serialize($this->cart->contents());
					//                $this->input->set_cookie('goodbiker_cart_cookie', $serializeCart,36000);
					if ($rowId) {

						// $response = ['image' => $featured_image, 'cart' => $this->cart->contents()];
						$response = $this->_loadElement('cart/cart_alert', ['product' => $product], TRUE);
						die(json_encode(['html' => $response, 'qty' => $this->cart->total_items()]));
					} else {
						$response = ['error' => 'Có lỗi xảy ra! Vui lòng thử lại.'];
						die(json_encode($response));
					}
				}

			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function addtocartbysunday($product_id) {
		$timeafter = strtotime('20:00:00');
		$ha = (int) date('H', $timeafter);
		$ia = (int) date('i', $timeafter);
		$sa = (int) date('s', $timeafter);
		if ($this->session->userdata('user_info') != null) {
			$user = $this->session->userdata('user_info');
			$user['id'] = $this->session->userdata('user_info')['id'];
		} else {
			$user['id'] = 0;
		}
		if ((int) date('H') >= $ha && (int) date('i') > $ia && (int) date('s') > $sa) {
			die(json_encode(['html' => 'Sau 20 giờ chiều quý khách không thể đặt sản phẩm', 'qty' => 0]));
		} else if ($this->order_model->checkOrderBySunday($user['id'])) {
			die(json_encode(['html' => 'Bạn đã đặt hàng, không thể đặt thêm', 'qty' => 0]));
		} else if ($product_id > 0) {
			$product = $this->product_model->getProductById($product_id);
			if ($product) {
				if ($this->cart->contents() == null) {
					$data['id'] = $product->id;
					$data['name'] = $product->name;
					$data['qty'] = 1;
					$data['price'] = $product->price;
					$data['giavi'] = "";
					$data['username'] = $user['name'];
					$data['email'] = $user['email'];
					$data['user_id'] = $user['id'];

					$featured_image = NULL;

					foreach ($product->images as $key => $image) {
						if ($image->featured == 'Yes') {
							$featured_image = $image;
							break;
						}
					}
					$data['image'] = $featured_image;

					// $this->cart->destroy();
					$rowId = $this->cart->insert($data);
					//                $serializeCart = serialize($this->cart->contents());
					//                $this->input->set_cookie('goodbiker_cart_cookie', $serializeCart,36000);
					if ($rowId) {

						// $response = ['image' => $featured_image, 'cart' => $this->cart->contents()];
						$response = $this->_loadElement('cart/cart_alert', ['product' => $product], TRUE);
						die(json_encode(['html' => $response, 'qty' => $this->cart->total_items()]));
					} else {
						$response = ['error' => 'Có lỗi xảy ra! Vui lòng thử lại.'];
						die(json_encode($response));
					}
				} else if ($this->cart->contents() != null) {
					foreach ($this->cart->contents() as $key => $value) {
						$data['rowid'] = $value['rowid'];
					}
					$this->cart->remove($data['rowid']);
					$data['id'] = $product->id;
					$data['name'] = $product->name;
					$data['qty'] = 1;
					$data['price'] = $product->price;
					$data['giavi'] = "";
					$data['username'] = $user['name'];
					$data['email'] = $user['email'];
					$data['user_id'] = $user['id'];

					$featured_image = NULL;

					foreach ($product->images as $key => $image) {
						if ($image->featured == 'Yes') {
							$featured_image = $image;
							break;
						}
					}
					$data['image'] = $featured_image;

					// $this->cart->destroy();
					$rowId = $this->cart->insert($data);
					//                $serializeCart = serialize($this->cart->contents());
					//                $this->input->set_cookie('goodbiker_cart_cookie', $serializeCart,36000);
					if ($rowId) {

						// $response = ['image' => $featured_image, 'cart' => $this->cart->contents()];
						$response = $this->_loadElement('cart/cart_alert', ['product' => $product], TRUE);
						die(json_encode(['html' => $response, 'qty' => $this->cart->total_items()]));
					} else {
						$response = ['error' => 'Có lỗi xảy ra! Vui lòng thử lại.'];
						die(json_encode($response));
					}
				}

			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function index_brand($slug) {
		$data_pust = array();
		$id_brand = $this->input->get('id_brand');
		$Sprice = $this->input->get('Startprice');
		$Eprice = $this->input->get('Endprice');
		$totol_pust = 0;
		$current_category = $this->category_model->getCategoryBySlug($slug);
		if (!$current_category) {
			show_404();
		}
		if (isset($id_brand)) {
			if ($id_brand != "") {
				$idbrand_array = explode('-', $id_brand);
				if ((isset($Sprice)) && (isset($Eprice))) {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, $idbrand_array, $Sprice, $Eprice);
				} else {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, $idbrand_array, null, null);
				}
			} else {
				if ((isset($Sprice)) && (isset($Eprice))) {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, null, $Sprice, $Eprice);
				} else {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, null, null, null);
				}
			}
		}if (!isset($id_brand)) {
			if ((isset($Sprice)) && (isset($Eprice))) {
				$data = $this->product_model->getProductByCategory($current_category->id, 1, null, $Sprice, $Eprice);
			} else {
				$data = $this->product_model->getProductByCategory($current_category->id, 1, null, null, null);
			}
		}
		$this->canonical_url = site_url($current_category->slug);
		$this->page_title = $current_category->name;
		$this->page_description = $this->createPageDescription($current_category->name);
		$this->page_seo->title = $current_category->name;
		$this->page_seo->description = $this->createPageDescription($current_category->name);
		$this->page_seo->type = 'product';
		$this->page_seo->meta_url = $this->canonical_url;

		$data['breadcrumbs'] = $this->_breadcrumbs($current_category->id);
		$this->current_category = $current_category;
		$this->_renderFrontLayout('product/index', $data, TRUE);
	}

	public function findtobrand() {
		$slug = $this->input->post('slug');
		$data_pust = array();
		$id_brand = $this->input->post('id');
		$totol_pust = 0;
		$current_category = $this->category_model->getCategoryBySlug($slug);
		if (!$current_category) {
			show_404();
		}
		if (isset($id_brand)) {
			$idbrand_array = explode('-', $id_brand);
			$data = $this->product_model->getProductByCategory($current_category->id, 1, $idbrand_array, null, null);
		} else {
			$data = $this->product_model->getProductByCategory($current_category->id, 1, null, null, null);
		}
		// die(json_encode(['html' => $data]));
		$data['current_category'] = $current_category;
		$response = $this->_loadElement('product/list', $data, TRUE);
		if ($response != null) {
			die(json_encode(['html' => $response]));
		} else {
			die(json_encode(['html' => '<h3>Không có sản phẩm nào phù hợp</h3>']));
		}
	}

	public function findtoprice() {
		$totol_pust = 0;
		$data_pust = array();
		$slug = $this->input->post('slug');
		$Sprice = $this->input->post('Sprice');
		$Eprice = $this->input->post('Eprice');
		$id_brand = $this->input->post('id');
		$current_category = $this->category_model->getCategoryBySlug($slug);
		if (!$current_category) {
			show_404();
		}
		if (isset($id_brand)) {
			if ($id_brand != "") {
				$idbrand_array = explode('-', $id_brand);
				if ((isset($Sprice)) && (isset($Eprice))) {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, $idbrand_array, $Sprice, $Eprice);
				} else {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, $idbrand_array, null, null);
				}
			} else {
				if ((isset($Sprice)) && (isset($Eprice))) {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, null, $Sprice, $Eprice);
				} else {
					$data = $this->product_model->getProductByCategory($current_category->id, 1, null, null, null);
				}
			}
		}if (!isset($id_brand)) {
			if ((isset($Sprice)) && (isset($Eprice))) {
				$data = $this->product_model->getProductByCategory($current_category->id, 1, null, $Sprice, $Eprice);
			} else {
				$data = $this->product_model->getProductByCategory($current_category->id, 1, null, null, null);
			}
		}

		$data['current_category'] = $current_category;
		$response = $this->_loadElement('product/list', $data, TRUE);
		if ($response != null) {
			die(json_encode(['html' => $response]));
		} else {
			die(json_encode(['html' => '<h3>Không có sản phẩm nào phù hợp</h3>']));
		}
	}

	public function search() {

	}

}
