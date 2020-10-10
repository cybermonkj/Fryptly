<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class post_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	function getSchedulesList(){
		$this->db->select("s.*,tw.access_token,tw.ids as account_ids");
		$this->db->from("posts s");
		$this->db->join("twitter_accounts tw","s.account_id = tw.id");
		$this->db->where("s.status = 1");
		$this->db->where("s.time_post <=",NOW);
		$this->db->where("tw.status = 1");
		$this->db->order_by('s.id','DESC');
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		return false;
	}
}
