<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_data_logs($account_ids =""){
		$result = (object)array(
			"total_follow"                  => 0,
			"total_unfollow"                => 0,
			"total_reweet"                  => 0,
			"total_like"                    => 0,
			"total_direct_messages"         => 0,
			"total_postSuccessed"           => 0,
			"total_postFailed"              => 0,
			"total_post"                    => 0,
			"total_postProcessing"          => 0,
		);

		if($account_ids == "" || $account_ids == "859637fd"){
			$data_logs = $this->model->fetch("data_logs", TWITTER_ACCOUNTS, "uid = '".session("uid")."'");
			$checkProcessingPosts = $this->model->fetch("*", POSTS, "status = 1 AND uid = '".session("uid")."'");

			if(!empty($checkProcessingPosts)){
				$result->total_postProcessing = count($checkProcessingPosts);
			}

		}else{

			$account = $this->model->get("id, ids, data_logs",TWITTER_ACCOUNTS, "ids = '{$account_ids}' AND uid = '".session("uid")."'");

			$data_logs[0] = $account;

			$checkProcessingPosts = $this->model->fetch("*", POSTS, "account_id = {$account->id} AND status = 1 AND uid = '".session("uid")."'");

			if(!empty($checkProcessingPosts)){
				$result->total_postProcessing = count($checkProcessingPosts);
			}
			
		}

		
		if(!empty($data_logs)){
			foreach ($data_logs as $key => $row) {
				$result->total_follow += (!empty(get_value($row->data_logs, "follow")))?get_value($row->data_logs, "follow"):0;

				$result->total_unfollow += (!empty(get_value($row->data_logs, "unfollow")))?get_value($row->data_logs, "unfollow"):0;

				$result->total_like += (!empty(get_value($row->data_logs, "like")))?get_value($row->data_logs, "like"):0;

				$result->total_reweet += (!empty(get_value($row->data_logs, "reweet")))?get_value($row->data_logs, "reweet"):0;

				$result->total_direct_messages += (!empty(get_value($row->data_logs, "direct_messages")))?get_value($row->data_logs, "direct_messages"):0;

				$result->total_post += (!empty(get_value($row->data_logs, "totalPostCounter")))?get_value($row->data_logs, "totalPostCounter"):0;				
				$result->total_postSuccessed += (!empty(get_value($row->data_logs, "postSuccessCounter")))?get_value($row->data_logs, "postSuccessCounter"):0;				
				$result->total_postFailed += (!empty(get_value($row->data_logs, "postErrorCounter")))?get_value($row->data_logs, "postErrorCounter"):0;
			}
		}

		$data_post =  array(

			'processing' => (object)array(
								'icon'  => 'fa fa-hourglass-start',
								'name'  => lang('In_Progress'),
								'color' => 'Green',
								'value' => $result->total_postProcessing,
							),
			'total_post' => (object)array(
								'icon'  => 'fa fa-paper-plane-o',
								'name'  => lang('Completed'),
								'color' => 'Red',
								'value' => $result->total_post,
							),
			'successed' => (object)array(
								'icon'  => 'fa fa-check-square-o',
								'name'  => lang('Published'),
								'color' => 'Blue',
								'value' => $result->total_postSuccessed,
							),
			'failed'    => (object)array(
								'icon'  => 'fa fa-exclamation-triangle',
								'name'  => lang('Failed'),
								'color' => 'Yellow',
								'value' => $result->total_postFailed,
							),
			

		);

		$data_activity =  array(

			'follow' => (object)array(
								'icon'  => 'fa fa-user-plus',
								'name'  => lang('Follows'),
								'color' => 'Red',
								'value' => $result->total_follow,
							),
			'unfollow' => (object)array(
								'icon'  => 'fa fa-user-times',
								'name'  => lang('Unfollows'),
								'color' => 'Blue',
								'value' => $result->total_unfollow,
							),
			'reweet'    => (object)array(
								'icon'  => 'fa fa-retweet',
								'name'  => lang('Reweets'),
								'color' => 'Yellow',
								'value' => $result->total_reweet,
							),

			'like' => (object)array(
								'icon'  => 'fa fa-heart-o',
								'name'  => lang('Likes'),
								'color' => 'Green',
								'value' => $result->total_like,
							),	

			'direct_messages' => (object)array(
								'icon'  => 'fa fa-paper-plane-o',
								'name'  => lang('direct_messages'),
								'color' => 'orange',
								'value' => $result->total_direct_messages,
							),

		);

		return $data = (object)array(
			"post"    => $data_post,
			"activity" => $data_activity,
		);
	}

	function get_data_chart_logs($account_ids = ""){

		$data_chart_logs = (object)array(
			"activity"  => (object)array(
							"like"      		=> $this->stats_log( LIKE_LOGS, $account_ids)->value,
							"follow"    		=> $this->stats_log( FOLLOW_LOGS, $account_ids)->value,
							"unfollow"  		=> $this->stats_log( UNFOLLOW_LOGS, $account_ids)->value,
							"reweet"    		=> $this->stats_log( REWEET_LOGS, $account_ids)->value,
							"direct_messages"   => $this->stats_log( DIRECT_MESSAGES_LOGS, $account_ids)->value,
							"date_logs"         => $this->stats_log( LIKE_LOGS, $account_ids)->date,
						),

			"post"     => (object)array(
							"successed"  => $this->stats_log( POSTS, $account_ids, 2)->value,
							"failed"     => $this->stats_log( POSTS, $account_ids, 3)->value,
							"date_logs"  => $this->stats_log( POSTS, $account_ids, 2)->date,
						),
		);

		return $data_chart_logs;
	}

	public function stats_log($table, $account_ids = "", $status = ""){
		$value_string = "";
		$date_string = "";

		$date_list = array();
		$date = strtotime(date('Y-m-d', strtotime(NOW)));

		if ($table == 'posts' ) {
			$i = 15;

			if ($account_ids == "" || $account_ids == "859637fd") {
				$sql = "SELECT COUNT(created) as count, DATE(created) as created FROM ".$table." WHERE uid = '".session("uid")."' AND status = '{$status}' AND created > NOW() - INTERVAL 15 DAY GROUP BY DATE(created), status;";
			}else{
				$account = $this->model->get("id, ids", TWITTER_ACCOUNTS, "ids = '{$account_ids}' AND uid = '".session("uid")."'");
				$sql = "SELECT COUNT(created) as count, DATE(created) as created FROM ".$table." WHERE account_id = '{$account->id}' AND status = '{$status}' AND uid = '".session("uid")."' AND  created > NOW() - INTERVAL 15 DAY GROUP BY DATE(created), status;";
			}

		}else{
			$i = 7;
			//Get data
			if ($account_ids == "" || $account_ids == "859637fd") {
				$sql = "SELECT COUNT(created) as count, DATE(created) as created FROM ".$table." WHERE uid = '".session("uid")."' AND created > NOW() - INTERVAL 7 DAY GROUP BY DATE(created), type;";
			}else{
				$account = $this->model->get("id, ids", TWITTER_ACCOUNTS, "ids = '{$account_ids}' AND uid = '".session("uid")."'");
				$sql = "SELECT COUNT(created) as count, DATE(created) as created FROM ".$table." WHERE account_id = '{$account->id}' AND uid = '".session("uid")."' AND  created > NOW() - INTERVAL 7 DAY GROUP BY DATE(created), type;";
			}
		}

		for ($i; $i >= 0; $i--) { 
			$left_date = $date - 86400 * $i;
			$date_list[date('Y-m-d', $left_date)] = 0;
		}
		

		$query = $this->db->query($sql);

		if($query->result()){
			foreach ($query->result() as $key => $value) {
				if(isset($date_list[$value->created])){
					$date_list[$value->created] = $value->count;
				}
			}
			
		}
		foreach ($date_list as $date => $value) {
			$value_string .= "{$value},";
			$date_string .= "'{$date}',";
		}
		
		$value_string = "[".substr($value_string, 0, -1)."]";
		$date_string  = "[".substr($date_string, 0, -1)."]";

		return (object)array(
			"value" => $value_string,
			"date" => $date_string
		);
	}

}
