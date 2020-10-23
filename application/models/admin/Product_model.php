<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */
class Product_model extends CI_Model {

	private $table = 'products';
	function __construct() {
		parent::__construct();

	}

	public function getAllProduct() {
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getProduct($page, $total_page) {
		$total = $this->db->count_all_results($this->table);
		$limit = $total_page;
		$start = ((int) $page <= 1) ? 0 : ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$this->db->from($this->table . ' p');
		$this->db->join('product_images pi', 'p.id = pi.product_id', 'left');
		$this->db->join('categories c', 'p.category_id = c.id', 'left');
		$this->db->where('pi.featured', 'Yes');
		$this->db->select('p.*,pi.path as image,c.name as category');
		$query = $this->db->get();
		$products = $query->result();
		return ['total' => $total, 'products' => $products];
	}

	public function getProductById($id = 0) {
		if ((int) $id > 0) {
			$this->db->select('p.*, c.name as category');
			$this->db->join('categories c', 'c.id = p.category_id', 'left');
			$this->db->where('p.id', $id);
			$this->db->from($this->table . ' p');
			$query = $this->db->get();
			$product = $query->row();
			if (!$product) {
				show_404();
			}
			//Get product images
			$this->db->select('featured,path');
			$query = $this->db->get_where('product_images', array('product_id' => $id));
			$images = $query->result();
			$product->images = $images;
			return $product;
		} else {
			return NULL;
		}
	}

	public function insert() {
		$name = $this->input->post('name');
		$slug = create_slug($name);

		$category_id = $this->input->post('category_id');
		$description = $this->input->post('description');
		$price = implode(explode(',', $this->input->post('price')));
		$now = date('Y-m-d H:i:s');

		$uniq_slug = createUniqueSlug($slug, 'products', 'slug');
		$data = array(
			'name' => $name,
			'slug' => $uniq_slug,
			'price' => $price,
			'category_id' => $category_id,
			'description' => $description,
			'created_date' => $now,
		);

		if ($this->input->post('is_active') == 'Yes') {
			$data['is_active'] = 'Yes';
		} else {
			$data['is_active'] = 'No';
		}
		if (!$this->db->insert($this->table, $data)) {
			return false;
		}
		$product_id = $this->db->insert_id();
		//add images
		$image = $this->input->post('image');
		$other_imgs = $this->input->post('other_img');
		$product_images = array(['product_id' => $product_id, 'featured' => 'Yes', 'path' => $image]);
		foreach ($other_imgs as $key => $img) {
			$product_images[] = [
				'product_id' => $product_id,
				'path' => $img,
				'featured' => 'No',
			];
		}
		$this->db->insert_batch('product_images', $product_images);
		return $product_id;
	}

	public function update() {
		$id = $this->input->post('pid');
		$name = $this->input->post('name');
		$slug = create_slug($name);

		$category_id = $this->input->post('category_id');
		$description = $this->input->post('description');
		$price = implode(explode(',', $this->input->post('price')));
		$now = date('Y-m-d H:i:s');

		$uniq_slug = createUniqueSlug($slug, 'products', 'slug');
		$data = array(
			'name' => $name,
			'slug' => $uniq_slug,
			'price' => $price,
			'category_id' => $category_id,
			'description' => $description,
			'updated_date' => $now,
		);

		if ($this->input->post('is_active') == 'Yes') {
			$data['is_active'] = 'Yes';
		} else {
			$data['is_active'] = 'No';
		}

		//Remove all old images
		$this->db->delete('product_images', ['product_id' => $id]);
		//Add Product images
		$image = $this->input->post('image');
		$other_imgs = $this->input->post('other_img');
		$product_images = array(['product_id' => $id, 'featured' => 'Yes', 'path' => $image]);
		foreach ($other_imgs as $key => $img) {
			$product_images[] = ['product_id' => $id,
				'path' => $img,
				'featured' => 'No',
			];
		}
		$this->db->insert_batch('product_images', $product_images);

		return $this->db->update($this->table, $data, array('id' => $id));
	}

	public function getFrontProducts($page = 0, $total_page = 30) {
		$this->db->select('id');
		$total = $this->db->count_all_results($this->table);
		$limit = ($total > $total_page) ? $total_page : $total;
		$start = ($page <= 1) ? 0 : ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$this->db->from('products p');
		$this->db->join('categories c', 'p.category_id = c.id', 'left');
		$this->db->join('product_images im', 'p.id = im.product_id', 'left');
		$this->db->where(array('im.featured' => 'Yes'));
		$this->db->select('p.id, p.name, p.price, p.slug, p.code, im.path as image, c.name as category');
		$query = $this->db->get();
		$products = $query->result();
		return ["total" => $total, "products" => $products];
	}

	public function searchproduct($keyword, $page, $total_page) {
		$keywords = explode(' ', $keyword);
		$x = 0;
		$this->db->start_cache();
		$this->db->group_start();
		foreach ($keywords as $words) {
			$x++;
			if ($x == 1) {
				$this->db->like('p.name ', $words);
				$this->db->or_like('cat.name ', $words);
			} else {
				$this->db->or_like('p.name ', $words);
				$this->db->or_like('cat.name ', $words);
			}
		}
		$this->db->group_end();
		$this->db->stop_cache();
		$this->db->select('p.id');
		$this->db->from($this->table . ' p');
		$this->db->join('categories cat', 'cat.id = p.category_id', 'left');

		$this->db->group_by('p.id');
		$total = $this->db->count_all_results();
//        debug_sql();
		$limit = $total_page;
		$start = ($page <= 1) ? 0 : ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->order_by('p.id', 'DESC');
		$this->db->group_by('p.id');
		$this->db->from($this->table . ' p');
		$this->db->join('product_images im', 'p.id = im.product_id', 'left');
		$this->db->join('categories cat', 'cat.id = p.category_id', 'left');
		$this->db->where(array('im.featured' => 'Yes'));
		$this->db->select('p.*, im.path as image, cat.name as category');
		$query = $this->db->get();
		$products = $query->result();
		$this->db->flush_cache();

		// debug_sql();exit();
		return ["total" => $total, "products" => $products, "keyword" => $keyword];
	}
}

?>