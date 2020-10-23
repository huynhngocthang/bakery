<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 *
 */

 class Wallet_model extends CI_Model { 
        
    private $table = 'wallet' ;

    function __construct()
    {
        parent::__construct() ;
    }

    public function getAllWallet($id) {
        $this->db->select('wallet.*','wallet.TOTAL as total') ;
        $this->db->where('wallet.ID_USER', $id) ;
        $this->db->from($this->table) ;
        $query = $this->db->get();
        // echo $this->db->insert_id->last_query();die;   
       
        $wallets = $query->row() ;
        return ['wallets' => $wallets] ;
    }

    public function getTotal() {

    }

 }

?>