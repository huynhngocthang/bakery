<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */
class Pagination_model extends CI_Model {

	private $table = 'pagination';
	function __construct() {
		parent::__construct();
	}

	public function getAllPagination() {
		$total = $this->db->count_all_results($this->table);
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get($this->table);
		$paginations = $query->result();
		return ['total' => $total, 'paginations' => $paginations];
	}
	public function getPaginationById($id = 0) {
		$query = $this->db->get_where('pagination', array('id' => $id));
		return $query->row();
	}

	public function getPaginationByPage($page = null) {
		$query = $this->db->get_where('pagination', array('page' => $page));
		return $query->row();
	}

	// public function insert() {
	// 	$page = $this->input->post('page');
	// 	$total = $this->input->post('total');
	// 	$data = array(
	// 		'page' => $page,
	// 		'total' => $total,
	// 	);
	// 	if ($this->db->insert($this->table, $data)) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}

	// }

	public function update() {
		$id = $this->input->post('cid');

		$total = ($this->input->post('total') <= 1) ? 1 : $this->input->post('total');

		$data = array(
			'total' => $total,

		);
		return $this->db->update($this->table, $data, array('id' => $id));
	}
}
?>