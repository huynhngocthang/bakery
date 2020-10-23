<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */
class Secury_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getVerifyEmail($send_code) {
		$query = $this->db->get_where('secury_verify', array('id_sendmail' => $send_code));
		return $query->row();
	}
	public function getVerifyEmail_2($value = '') {
		# code...
	}
}
?>