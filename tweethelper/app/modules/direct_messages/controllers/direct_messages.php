<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class direct_messages extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;
	public $tb_accounts;
	public $tb_schedule;
	public $tb_logs;

	public function __construct(){
		parent::__construct();
		$this->tb_accounts     = TWITTER_ACCOUNTS;
		$this->tb_schedule     = DIRECT_MESSAGES;
		$this->tb_logs         = DIRECT_MESSAGES_LOGS;
		$this->module_type     = 'direct_messages';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$permission = check_permission();
		if(!$permission->direct_messages){
			redirect(cn());
		}
		$data = array(
			"tw_accounts" => $this->model->fetch("*", $this->tb_accounts, "status = 1 AND uid ='".session('uid')."'"),
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
		$speed               = post('speed');
		$usernames 	         = post('usernames');
		$tags 	             = post('tags');
		$target 	         = post('target');
		$messages 	         = post('messages');

		$auto_pause_daily 	 = (!empty(post('auto_pause_daily')))? 1:0;
		$pause_daily_from 	 = post('pause_daily_from');
		$pause_daily_to 	 = post('pause_daily_to');
		$stop                = (int)post('stop');
		$status              = (post('is_schedule'))?5:4;
		$type 			     = $this->module;
		switch (post('speed')) {
			case 'auto':
				$speed = getOption('direct_messages_speed_auto');
				break;
			case 'slow':
				$speed = getOption('direct_messages_speed_slow');
				break;
			case 'medium':
				$speed = getOption('direct_messages_speed_medium');
				break;
			case 'fast':
				$speed = getOption('direct_messages_speed_fast');
				break;
		}
		if($stop < 0){
			ms(array(
				'status'  => 'error',
				'message' => lang("auto_stop_counter_must_to_be_greater_than_or_equal_to_zero_set_to_zero_to_disable_the_limit")
			));
		}

		switch ($target) {
			case 'tag':
				if(empty($tags)){
					ms(array(
						'status'  => 'error',
						'message' => lang("please_add_least_a_tag_to_get_started")
					));
				}
				break;	
						
			case 'username':
				if(empty($usernames)){
					ms(array(
						'status'  => 'error',
						'message' => lang('please_add_least_an_username_to_get_started')
					));
				}
				break;
		}
		if ($messages == "") {
			ms(array(
				'status'  => 'error',
				'message' => "Messages field is required"
			));
		}
		$messages = str_replace("\\", "", $messages);
		if(!empty($ids)){
			$tw_account =$this->model->get("id, access_token", $this->tb_accounts, "ids = '".$ids."' AND uid = '".session('uid')."'") ;
			if(!empty($tw_account)){
				$data = array(
					"ids"             => ids(),
					"uid"             => session("uid"),
					"account_id"      => $tw_account->id,
					"type"            => $type,
					"data"            => json_encode(array(
											"speed"             => post('speed'),
											"target"            => $target,
											"tags"              => $tags,
											"usernames"         => $usernames,
											"messages"          => $messages,
											"auto_pause_daily"  => $auto_pause_daily,
											"pause_daily_from"  => $pause_daily_from,
											"pause_daily_to"    => $pause_daily_to,
											"stop"              => $stop,
										),JSON_UNESCAPED_UNICODE),
					"time_post"       => date('Y-m-d H:i:s', strtotime(NOW) + 90),
					"status"          => $status,
					"created"         => NOW,
					"changed"         => NOW,
					"delay"           => (60*60)/$speed,
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
		$target = get_value($item->data, "target");
		switch ($target) {

			case 'follower':
				$feeds 		= $tw->get_self_followers();
				$feeds 		= $this->remove_user_messaged($feeds, $item->uid);
				$feed_tmp  	= get_value_rand_array($feeds, "feed");
				if(!empty($feed_tmp)){
					$feed = (object)array(
						"id" => $feed_tmp,
					);
				}
				break;

			case 'following':
				$feeds 		= $tw->get_self_followings();
				$feeds 		= $this->remove_user_messaged($feeds, $item->uid);
				$feed_tmp  	= get_value_rand_array($feeds, "feed");
				if(!empty($feed_tmp)){
					$feed = (object)array(
						"id" => $feed_tmp,
					);
				}
				break;
			case 'tag':

				$tags  = get_value($item->data, "tags");
				$tag   = get_value_rand_array($tags);
				$feeds = $tw->get_tweet_by_keyword($tag, 300, "hashtag");
				if (!empty($feeds)) {
					$users_id = [];

					foreach ($feeds as $key => $feed) {
						$user = $feed->user;
						$users_id[] = $user->id;
					}

					$feeds 		= $this->remove_user_messaged($users_id, $item->uid);
				}
				if (!empty($feeds)) {
					$feed_tmp  	= get_value_rand_array($feeds, "feed");
					if(!empty($feed_tmp)){
						$feed = (object)array(
							"id" => $feed_tmp,
						);
					}
				}else{
					exit(0);
				}

				break;

			case 'username':
				$usernames 			 = get_value($item->data, "usernames");
				$username  			 = get_value_rand_array($usernames);
				$get_followers       = $tw->get_followers($username, 200);
				$feeds 				 = $this->remove_user_messaged($get_followers, $item->uid);
				$feed_tmp            = get_value_rand_array($feeds, "feed");
				if(!empty($feed_tmp)){
					$feed = (object)array(
						"id" => $feed_tmp,
					);
				}
				break;
		}

		if(!empty($feed)){
			$messages 	= get_value($item->data, "messages");
			$message  	= get_value_rand_array($messages);
			$user_info 	= $tw->get_request("users/show", ["user_id" => $feed->id]);
			$message 	= str_replace("{{username}}", $user_info->screen_name, $message);
			$action 	= $tw->direct_messages_event($feed->id, $message);
			if(isset($action->errors)){
				$error  = $action->errors[0];
				$result = array(
					"error" => $error->message."(@".$user_info->screen_name.")",
				);
				$this->db->where("ids", $item->ids);
				$this->db->update($this->tb_schedule, array("result" => json_encode($result), "time_post" => date('Y-m-d H:i:s', strtotime(NOW) + $item->delay)));
				exit(0);
			}

			$data_update = array();
			if(!empty($action)){
				if(is_object($action) && isset($action->event->id)){
					$data = array(
						"id_post"             => $action->event->id,
						"id_profile"          => $user_info->id_str,
						"message"             => $message,
						"screen_name"         => $user_info->screen_name,
						"profile_image_url"   => $user_info->profile_image_url,
					);

					$logs = array(
						"ids"                 => ids(),
						"uid"                 => $item->uid,
						"id_str"              => $user_info->id_str,
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
					$rand_time = rand(1000,3600);
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

	private function remove_user_messaged($feeds, $uid){
		if (!empty($feeds)) {
			$all_messaged_user =$this->model->fetch("id_str", $this->tb_logs, ["uid" => $uid]);

			if(!empty($all_messaged_user)){
				$users_messaged = array();
				foreach ($all_messaged_user as $key => $value) {
					$users_messaged[] = $value->id_str;
				}
				$result = get_array_diff($feeds, $users_messaged);
			}else{
				$result = $feeds;
			}
			return $result;
		}else{
			return false;
		}
	}

}