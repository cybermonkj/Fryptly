<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class unfollow extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;
	public $tb_accounts;
	public $tb_schedule;
	public $tb_logs;

	public function __construct(){
		parent::__construct();
		$this->module_icon     = 'fa fa-commenting-o';
		$this->module_name     = 'Unfollow';
		$this->tb_accounts     = TWITTER_ACCOUNTS;
		$this->tb_schedule     = UNFOLLOW;
		$this->tb_logs         = UNFOLLOW_LOGS;
		$this->module_type     = 'unfollow';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$permission = check_permission();
		if(!$permission->unfollow){
			redirect(cn(''));
		}

		$data = array(
			"tw_accounts" => $this->model->fetch("*", TWITTER_ACCOUNTS, "status = 1 AND uid ='".session('uid')."'"),
		);
		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}	

	public function content($ids){
		$setting = $this->model->get_schedule_detail($ids);
		if(empty($setting)){
			get_layout('404');
		}

		$data = array(
			"setting"     => $setting,
		);

		$this->load->view('content', $data);
	}
	// link view logs: 
	public function logs($ids){
		$account = $this->model->get_schedule_detail($ids);
		if(empty($account)){
			ms(array(
				'status'  => 'error',
				'message' => lang('Twitter_Account_does_not_exist')
			));
		}

		// delete log over 5 days
		$default_save_logs = getOption('default_save_logs', 5);
		$day               = $default_save_logs*24*60*60;
		$day_tmp           = strtotime(NOW) - $day;
		$this->db->delete($this->tb_logs, "created<='".date("Y-m-d H:i:s", $day_tmp)."'");

		$logs = $this->model->fetch('ids, uid, account_id, type, id_str, data ,created', $this->tb_logs,"uid ='".session('uid')."' AND account_id ='".$account->id."'",'id','desc','0','40');
		$data = array(
			"logs"        => $logs,
			"account"     => $account,
		);
		$this->load->view('log', $data);
		
	}

	public function ajax_save_schedule($ids){

		if($ids == ""){
			ms(array(
				'status'  => 'error',
				'message' => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
			));
		}

		$speed                 = post('speed');
		$usernames_black_list  = post('usernames_black_list');
		$auto_pause_daily 	   = (!empty(post('auto_pause_daily')))? 1:0;
		$pause_daily_from 	   = post('pause_daily_from');
		$pause_daily_to 	   = post('pause_daily_to');
		$stop                  = (int)post('stop');
		$status                = (post('is_schedule'))?5:4;
		$keep_my_followers     = (post('keep_my_followers'))?1:0;
		$type 			       = $this->module;
		
		switch (post('speed')) {
			case 'auto':
				$speed = getOption('unfollow_speed_auto', 5);
				break;
			case 'slow':
				$speed = getOption('unfollow_speed_slow', 3);
				break;
			case 'medium':
				$speed = getOption('unfollow_speed_medium', 4);
				break;
			case 'fast':
				$speed = getOption('unfollow_speed_fast', 8);
				break;
		}

		if($stop < 0){
			ms(array(
				'status'  => 'error',
				'message' => lang("auto_stop_counter_must_to_be_greater_than_or_equal_to_zero_set_to_zero_to_disable_the_limit")
			));
		}

		if(!empty($ids)){
			$tw_account =$this->model->get("id, access_token", $this->tb_accounts, "ids = '".$ids."' AND uid = '".session('uid')."'") ;
			if(!empty($tw_account)){
				$data = array(
					"ids"             => ids(),
					"uid"             => session("uid"),
					"account_id"      => $tw_account->id,
					"type"            => $type,
					"data"            => json_encode(array(
											"speed"                       => post('speed'),
											"keep_my_followers"           => $keep_my_followers,
											"usernames_black_list"        => $usernames_black_list,
											"auto_pause_daily"            => $auto_pause_daily,
											"pause_daily_from"            => $pause_daily_from,
											"pause_daily_to"              => $pause_daily_to,
											"stop"                        => $stop,
										)),
					"time_post"       => date('Y-m-d H:i:s', strtotime(NOW) + 90),
					"status"          => $status,
					"created"         => NOW,
					"changed"         => NOW,
					"delay"           => 60*60/$speed,
				);
				// check scheduled exists 
				$scheduled_item = $this->model->get('ids, id', $this->tb_schedule,"account_id = '".$tw_account->id."' AND type = '{$type}' AND uid = '".session('uid')."'");
				if(empty($scheduled_item)){
					$this->db->insert($this->tb_schedule,$data);
				}else{
					$this->db->update($this->tb_schedule, $data, "ids = '".$scheduled_item->ids."'");
				}
				
				ms(array(
					"status"   => "success",
					"message"  => lang('Your_Activity_has_been_scheduled_successfully')
				));
				
			}else{
				ms(array(
					"status"   => "error",
					"message"  => lang('Twitter_Account_does_not_exist')
				));
			}
		}
	}

	public function cron(){
		ini_set('max_execution_time', 300000);
		$schedule_list = $this->model->get_scheduled_list();
		if(empty($schedule_list)){
			echo lang('There_is_not_any_scheduled_activity')."<br>";
		}
		foreach ($schedule_list as $key => $row) {
			$stop = $this->stop_module($row);
			if($stop){
				break;
			}
			$result = $this->action($row);
		}
		echo lang('Successfully');
	}

	private function action($item){
		$tw        = new TwitterAPI(CONSUMER_KEY, CONSUMER_SECRET);
		$tw->getConnectionWithAccessToken($item->access_token);
		$keep_my_followers = get_value($item->data, "keep_my_followers");

		switch ($keep_my_followers) {
			case 1:
				$get_self_followings = $tw->get_self_followings();
				$get_self_followers = $tw->get_self_followers();
				$feeds = get_array_diff($get_self_followings, $get_self_followers);
				$feed_id = get_value_rand_array($feeds);
				break;
			
			default:
				$get_self_followings = $tw->get_self_followings();
				$feeds = $get_self_followings;
				$feed_id = get_value_rand_array($feeds);
				break;
		}

		if(!empty($feed_id)){
			$action = $tw->unfollow($feed_id);
			if(isset($action->errors)){
				$error  = $action->errors[0];
				$result = array(
					"error" => $error->message,
				);
				$this->db->where("ids", $item->ids);
				$this->db->update($this->tb_schedule, array("result" => json_encode($result), "time_post" => date('Y-m-d H:i:s', strtotime(NOW) + $item->delay)));
			}
			$data_update = array();
			if(!empty($action)){
				if(is_object($action) && isset($action->id_str)){
					$data = array(
						"id_post"             => $action->id_str,
						"id_profile"          => $action->id_str,
						"screen_name"         => $action->screen_name,
						"profile_image_url"   => $action->profile_image_url,
					);

					$logs = array(
						"ids"                 => ids(),
						"uid"                 => $item->uid,
						"id_str"              => $action->id_str,
						"account_id"          => $item->account_id,
						"data"                => json_encode($data),
						"type"     		      => $item->type,
						"created"             => NOW,
					);
					
					// save logs
					$this->db->insert($this->tb_logs, $logs);

					updateLogsCounter('data_logs',$item->type,'up', $this->tb_accounts, $item->account_id);	
					updateLogsCounter('data',$item->type.'_tmp','up', $this->tb_schedule, $item->id);
					// set time for next schedule
					$data_update['status'] = 5;
					$data_update['result'] = 'Successfully';
					$rand_time = rand(5,30);
					$data_update['time_post'] = date('Y-m-d H:i:s', strtotime(NOW) + $item->delay + $rand_time);
				}
				$this->db->where("ids", $item->ids);
				$this->db->update($this->tb_schedule, $data_update);
			}
		}
		
	}

	private function stop_module($schedule){
		$is_stop = false;

		// auto stop
		$stop     = get_value($schedule->data, "stop");
		$stop_tmp = get_value($schedule->data, $this->module_type.'_tmp');
		if ($stop_tmp >= $stop && isset($stop_tmp) && $stop > 0) {
			$this->db->update($this->tb_schedule, array("status" => "4"),"ids = '{$schedule->ids}'");
			updateLogsCounter('data', $this->module_type.'_tmp','zero', $this->tb_schedule, $schedule->id);
			$is_stop = true;
		}

		// pause daily
		$auto_pause_daily = get_value($schedule->data, 'auto_pause_daily');
		if($auto_pause_daily){
			$pause_daily_from 		= get_value($schedule->data, 'pause_daily_from');
			$pause_daily_to   		= get_value($schedule->data, 'pause_daily_to');
			$next                   = check_auto_pause_daily($pause_daily_from, $pause_daily_to, $schedule->time_post, $schedule->uid);
			if($next->check_auto_pause_daily){
				$this->db->update($this->tb_schedule, array('time_post' => $next->next_time), "ids = '{$schedule->ids}'");
				$check_auto_pause_daily = true;
			};
		}

		if($is_stop){
			return true;
		}

		return false;
	}

	private function remove_favorited_feed($feeds){
		if (!empty($feeds)) {
			foreach ($feeds as $key => $row) {
				if(isset($row->favorited) && $row->favorited == 1){
					unset($feeds[$key]);
				}
			}
			return array_values($feeds);
		}else{
			return false;
		}
	}
}