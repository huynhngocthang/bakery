<?php
/**
 *
 */
class Setting_model extends CI_Model {

	private $table = 'site_settings';
	function __construct() {
		parent::__construct();
	}

	public function getSettings() {
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		$settings = $query->row();
		return $settings;
	}

	public function getSettingById($id = 0) {
		if ((int) $id > 0) {
			$query = $this->db->get_where($this->table, array('id' => $id));
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function FunctionName($value = '') {
		# code...
	}
}
?>