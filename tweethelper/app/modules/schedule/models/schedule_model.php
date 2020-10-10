<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class schedule_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	function getSchedules(){

		$day     = 30*24*60*60;
		$day_tmp = strtotime(NOW) - $day;
		$this->db->delete(POSTS, "created <= '".date("Y-m-d H:i:s", $day_tmp)."'");

		$this->db->select("p.*,tw.screen_name");
		$this->db->from("posts p");
		$this->db->join("twitter_accounts tw","p.account_id = tw.id");
		$this->db->where("p.uid = '".session("uid")."'");
		$this->db->order_by('p.id','DESC');
		$this->db->limit(40,0);

		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		return false;
	}
}
