<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaction_model extends MY_Model {
	public $tb_users;
	public $tb_transaction_logs;
	
	public function __construct(){
		parent::__construct();
		$this->tb_users 		     = USERS;
		$this->tb_transaction_logs   = TRANSACTION_LOGS;
	}

	function get_transaction_list(){
		$this->db->select("*");
		$this->db->from($this->tb_transaction_logs);
		$this->db->order_by("id", 'DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}
