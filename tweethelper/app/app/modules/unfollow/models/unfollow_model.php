<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class unfollow_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->tb_accounts     = TWITTER_ACCOUNTS;
		$this->tb_schedule     = UNFOLLOW;
		$this->module_type     = 'unfollow';
	}

	function get_scheduled_list(){
		$this->db->select("s.*,tw.access_token,tw.ids as account_ids");
		$this->db->from($this->tb_schedule." as s");
		$this->db->join($this->tb_accounts." as tw","s.account_id = tw.id");
		$this->db->where("s.status = 5");
		$this->db->where("s.type ", $this->module_type);
		$this->db->where("s.time_post <=", NOW);
		$this->db->where("tw.status = 1");
		$this->db->order_by('s.id','ASC');
		$this->db->limit(2,0);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		return false;
	}


	function get_schedule_list_tmp(){
		$this->db->select("accounts.*, schedules.ids as schedule_ids, schedules.type, schedules.data, schedules.status as is_schedule");
		$this->db->from($this->tb_accounts." as accounts");
		$this->db->join($this->tb_schedule." as schedules", "schedules.account_id = accounts.id", "left outer");
		$this->db->where("accounts.uid = '".session("uid")."' AND accounts.status = 1");
		$this->db->order_by("accounts.created", "asc");

		$query = $this->db->get();
		if ($query->result()) {
			$result = $query->result();
		}else{
			$result = false;
		}
		return $result;
	}

	function get_schedule_detail($ids){
		$this->db->select("accounts.*, schedules.ids as schedule_ids, schedules.type, schedules.data as schedule, schedules.status as is_schedule, schedules.time_post as schedule_time, schedules.result");
		$this->db->from($this->tb_accounts." as accounts");
		$this->db->join($this->tb_schedule." as schedules", "schedules.account_id = accounts.id", "left outer");
		$this->db->where("accounts.uid = '".session("uid")."' AND accounts.status = 1 AND accounts.ids = '{$ids}'");
		$this->db->order_by("accounts.created", "asc");

		$query = $this->db->get();
		if ($query->row()) {
			$result = $query->row();
		}else{
			$result = false;
		}
		return $result;
	}

}
