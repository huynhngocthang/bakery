<?php
/**
 * @author nguyenthanhnha , frontend nguyen an, javascript Ho dac quyen
 */
class My_Controller extends CI_Controller {

	public $active_menu = '';
	public $menu = 'dashboard';
	public $page_title = 'BakeryBPOHUE';
	public $page_description = '';
	public $category_lineage;
	public $current_category;
	public $canonical_url = NULL;
	public $page_seo;
	public $theme = 'default';
		public $theme_path = '';

	function __construct() {
		parent::__construct();
		$this->theme_path = 'frontend/themes/' . $this->theme . '/';

		// $this->load->library('carabiner');
		// var_dump('sasot');
		// exit();
		// $carabiner_config = array(
		// 	'script_dir' => 'assets/',
		// 	'style_dir' => 'assets/',
		// 	'cache_dir' => 'assets/cache/',
		// 	'base_uri' => base_url(),
		// 	'combine' => FALSE,
		// 	'dev' => TRUE,
		// );
		if ($this->uri->segment(1) != 'admin') {
			$this->load->library('cart');
			$this->cart->product_name_rules = '[:print:]';
			if ($this->config->item('maintenance_m[:print:]ode') == TRUE) {
				$output = $this->load->view('maintenance', '', TRUE);
				die($output);
			}
			$this->_loadFrontJSCSS();
			// $this->_getCategories();

		}
		$this->page_seo = new stdClass;

		// $this->carabiner->config($carabiner_config);
		$_SESSION['userdata'] = $this->session->userdata();
	}

	public function _is_admin() {
		if (!$this->session->userdata('is_admin')) {
			redirect(site_url('admin/login'));
		}
	}
	public function _is_user() {

		if ($this->session->userdata('is_admin') == null && $this->session->userdata('is_user') == null) {

			redirect('login');
		}
	}

	public function _renderAdminLayout($view, $data = NULL) {
		$this->load->vars($data);
		$this->load->view('admin/_part/header');
		$this->load->view('admin/_part/sidebar', ['menu' => $this->menu]);
		$this->load->view($view);
		$this->load->view('admin/_part/footer');
	}

	public function _renderFrontLayout($views, $data = array(), $include_sidebar = FALSE) {
		$this->load->helper('seo');
		$this->load->model('admin/setting_model');
		$settings = $this->setting_model->getSettings();

		$data['seo'] = json_decode($settings->seo);
		$data['logo'] = $settings->logo;
		$data['hotline'] = $settings->hotline;
		$data['open_time'] = json_decode($settings->open_time);
		$data['social_link'] = json_decode($settings->social_link);
		$data['contact_info'] = json_decode($settings->contact_info);
		$data['category_lineage'] = $this->category_lineage;
		$data['current_category'] = $this->current_category;
		$data['canonical_url'] = $this->canonical_url;
		$data['page_title'] = $this->page_title;

		$this->load->vars($data);
		$this->load->view($this->theme_path . '_part/top');
		$this->load->view($this->theme_path . '_part/header');

		$this->load->view($this->theme_path . $views);
		// var_dump($data);
		// exit();
		$this->load->view($this->theme_path . '_part/footer');
		$this->load->view($this->theme_path . '_part/bottom');
	}

	public function _loadElement($view, $data = [], $html_output = FALSE) {
		if ($html_output) {
			return $this->load->view($this->theme_path . $view, $data, $html_output);
		} else {
			$this->load->view($this->theme_path . $view, $data, $html_output);
		}
	}
	public function _loadElementAdmin($view, $data = [], $html_output = FALSE) {
		if ($html_output) {
			return $this->load->view($view, $data, $html_output);
		} else {
			$this->load->view($view, $data, $html_output);
		}
	}

	public function _loadFrontJSCSS() {

	}

	// public function _getCategories() {
	// 	$this->load->model('admin/category_model');
	// 	//return $this->category_model->getParentCategories();
	// 	$order_by = 'sort';
	// 	$all = $this->category_model->getAllCategories($order_by);
	// 	$category_lineage = [];
	// 	foreach ($all as $key => $category) {
	// 		$category->sub_categories = [];
	// 		$category_lineage[$category->id] = $category;
	// 	}

	// 	foreach ($category_lineage as $key => $val) {
	// 		if ($val->parent_id) {
	// 			$category_lineage[$val->parent_id]->sub_categories[$key] = &$category_lineage[$key];
	// 		}
	// 	}

	// 	$this->category_lineage = $category_lineage;
	// }

	public function _breadcrumbs($current_category) {
		$category_lineage = $this->category_lineage;
		$t = new stdClass;
		$t->breadcrumbs = new stdClass;
		$t->breadcrumbs->current = &$category_lineage[$current_category];
		$t->breadcrumbs->url_mask = site_url($t->breadcrumbs->current->slug);
		$t->breadcrumbs->links = array(
			sprintf('<a href="%1$s">%2$s</a>', $t->breadcrumbs->url_mask, $t->breadcrumbs->current->name
			),
		);
		while ($t->breadcrumbs->current->parent_id) {
			$t->breadcrumbs->current = &$category_lineage[$t->breadcrumbs->current->parent_id];
			array_unshift(
				$t->breadcrumbs->links, sprintf('<a href="%1$s">%2$s</a>', site_url($t->breadcrumbs->current->slug), $t->breadcrumbs->current->name
				)
			);
		}

		$breadcrumbs = '<a href="' . site_url() . '" >Trang chủ</a> > ' . implode(' > ', $t->breadcrumbs->links);
		//custom_debug($breadcrumbs);die();
		return $breadcrumbs;
	}

	public function createPageDescription($description) {
		return "Mua ngay " . $description . ".Chất lượng thượng hạng, ngon bổ rẽ , giao hàng tận nơi , phục vụ tận tình.";
	}
}

?>