<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */
class Category_model extends CI_Model {
	private $table = 'categories';
	function __construct() {
		parent::__construct();

	}

	public function getAllCategory($order_by = 'id', $order_direction = 'ASC') {
		$this->db->order_by($order_by, $order_direction);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getCategory($page = 0) {
		$total = $this->db->count_all_results($this->table);
		$limit = $this->config->item('admin_per_page');
		$start = ($page < 1) ? 0 : ($page - 1) * $limit;

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get($this->table);
		$categories = $query->result();
		return ['total' => $total, 'categories' => $categories];
	}

	public function getCategoryById($id = 0) {
		if ((int) $id > 0) {
			$query = $this->db->get_where($this->table, array('id' => $id));
			return $query->row();
		} else {
			return null;
		}
	}

	public function getCategoryBySlug($slug = '') {
		if (!empty($slug)) {
			$query = $this->db->get_where($this->table, array('slug' => $slug));
			return $query->row();
		} else {
			return null;
		}
	}

	public function insert() {
		$slug = create_slug($this->input->post('name'));
		$name = $this->input->post('name');

		$uniq_slug = createUniqueSlug($slug, 'categories', 'slug');
		$data = array(
			'name' => $name,
			'slug' => $uniq_slug,
		);
		return $this->db->insert($this->table, $data);
	}

	public function update() {
		$id = $this->input->post('cid');

		$slug = create_slug($this->input->post('name'));
		$name = $this->input->post('name');
		$uniq_slug = createUniqueSlug($slug, 'categories', 'slug');
		$data = array(
			'name' => $name,
			'slug' => $uniq_slug,
		);
		return $this->db->update($this->table, $data, array('id' => $id));
	}

	public function delete($id) {
		$this->db->delete($this->table, array('id' => $id));
	}
}
?>