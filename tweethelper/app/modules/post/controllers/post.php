<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class post extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;


	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-twitter';
		$this->module_name  = 'twitter account';
		$this->module_title = 'twitter account';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$permission = check_permission();
		if(!$permission->post){
			redirect(cn(''));
		}
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"tw_accounts" => $this->model->fetch("*",TWITTER_ACCOUNTS,"uid = '".session('uid')."'"),
			"gallery" => $this->model->fetch("*",GALLERY_MANAGER,"uid = '".session('uid')."'","id","DESC")
		);

		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}

	public function ajax_post(){
		$accounts    = post('account_ids');
		$caption     = post('caption');
		$time_post   = post('time_post');
		$media 	     = post('media');
		$type 	     = post('type');
		$is_schedule = post('is_schedule');
		if(empty($accounts)){
			ms(array(
				"status"   => "error",
				"message"  => lang('Please_select_at_least_one_Twitter_account'),
			));
		}

		switch ($type) {
			case 'video':

				if(empty($media)){
					ms(array(
						"status"   => "error",
						"message"  => lang('Please_choose_a_video_for_new_Tweet'),
					));
				}else{
					foreach ($media as $key => $row) {
						if (!check_file_type($row,'mp4')) {
							ms(array(
								"status"   => "error",
								"message"  => lang('The_media_you_tried_to_upload_was_invalid'),
							));
						}
					}
				}
				break;

			case 'photo':

				if(empty($media)){
					ms(array(
						"status"   => "error",
						"message"  => lang('Please_choose_photo_for_new_Tweet'),
					));
				}else{
					foreach ($media as $key => $row) {
						if (check_file_type($row,'mp4')) {
							ms(array(
								"status"   => "error",
								"message"  => lang('The_media_you_tried_to_upload_was_invalid'),
							));
						}
					}
				}

				if(count($media) > 4){
					ms(array(
						"status"   => "error",
						"message"  => lang('Twitter_allow_maximum_of_4_photos_per_tweet'),
					));
				}

				break;
			
			default:
				if(empty($caption)){
					ms(array(
						"status"   => "error",
						"message"  => lang('Please_add_a_caption_for_new_Tweet'),
					));
				}
				break;
		}


		// get token
		if(!empty($accounts)){
			foreach ($accounts as $account_ids) {
				$tw_account =$this->model->get("id,access_token",TWITTER_ACCOUNTS,"ids = '".$account_ids."' AND uid = '".session('uid')."'") ;
				
				if(!empty($tw_account)){
					$data = array(
						"ids"             => ids(),
						"uid"             => session("uid"),
						"account_id"      => $tw_account->id,
						"type"            => $type ,
						"data"            => json_encode(array(
												"media" => $media,
												"caption" => $caption,
											)),
						"created"         => NOW,
						"delay"           => 0,
					);

					// is_schedule
					if($is_schedule){
						$data['time_post'] = convert_timezone(get_timezone_system($time_post),$conditionByUser = 'system');
						$data['status']    = 1;
						$data['result']    = lang('Processing');
						$this->db->insert(POSTS,$data);
					}else{
						$tw = new TwitterAPI(CONSUMER_KEY,CONSUMER_SECRET);
						$tw->getConnectionWithAccessToken($tw_account->access_token);
						$result = $tw->postMedia($data);
						if($result['status']=='success'){
							$data['time_post'] = NOW;
							$data['changed']   = NOW;
							$data['status']    = 2;
							$data['result']    = $result['message'];
							// count post
							updateLogsCounter('data_logs','totalPostCounter','up',TWITTER_ACCOUNTS,$tw_account->id);
							updateLogsCounter('data_logs','postSuccessCounter','up',TWITTER_ACCOUNTS,$tw_account->id);
							updateLogsCounter('data_logs',$type.'SuccessCounter','up',TWITTER_ACCOUNTS,$tw_account->id);
							$this->db->insert(POSTS,$data);							
						}else{
							$data['status']   = 3;
							$data['changed']  = NOW;
							$data['result']   = $result['message'];
							// count post
							updateLogsCounter('data_logs','totalPostCounter','up',TWITTER_ACCOUNTS,$tw_account->id);
							updateLogsCounter('data_logs','postErrorCounter','up',TWITTER_ACCOUNTS,$tw_account->id);
							updateLogsCounter('data_logs',$type.'ErrorCounter','up',TWITTER_ACCOUNTS,$tw_account->id);
							$this->db->insert(POSTS,$data);
							ms($result);
						}
					}
				}else{
					ms(array(
						"status"   => "error",
						"message"  => lang('Twitter_Account_does_not_exist'),
					));
				}
			}

			// return successfully message 
			if($is_schedule){
				ms(array(
					"status"   => "success",
					"message"  => lang('Your_Tweet_has_been_scheduled_successfully'),
				));
			}else{
				ms($result);
			}
		}
	}

	public function cron(){
		$schedule_list = $this->model->getSchedulesList();
		if(empty($schedule_list)){
			echo lang('There_is_not_any_scheduled_activity').'<br>';
		}
		foreach ($schedule_list as $key => $row) {
			$result = $this->scheduledPostMedia($row);
		}
		echo lang('Successfully');
	}

	private function scheduledPostMedia($item){
		$tw = new TwitterAPI(CONSUMER_KEY,CONSUMER_SECRET);
		$tw->getConnectionWithAccessToken($item->access_token);
		$result = $tw->postMedia($item);
		$data = array();
		$type = $item->type;
		if($result['status'] == 'success'){
			$data['time_post'] = NOW;
			$data['changed']   = NOW;
			$data['status']    = 2;
			$data['result']    = $result['message'];
			// count post
			updateLogsCounter('data_logs','totalPostCounter','up',TWITTER_ACCOUNTS,$item->account_id);
			updateLogsCounter('data_logs','postSuccessCounter','up',TWITTER_ACCOUNTS,$item->account_id);
			updateLogsCounter('data_logs',$type.'SuccessCounter','up',TWITTER_ACCOUNTS,$item->account_id);
			$this->db->update(POSTS,$data,["account_id" => $item->account_id,"ids" => $item->ids]);							
		}else{
			$data['status']   = 3;
			$data['changed']  = NOW;
			$data['result']   = $result['message'];
			// count post
			updateLogsCounter('data_logs','totalPostCounter','up',TWITTER_ACCOUNTS,$item->account_id);
			updateLogsCounter('data_logs','postErrorCounter','up',TWITTER_ACCOUNTS,$item->account_id);
			updateLogsCounter('data_logs',$type.'ErrorCounter','up',TWITTER_ACCOUNTS,$item->account_id);
			$this->db->update(POSTS,$data,["account_id" => $item->account_id,"ids" => $item->ids]);
		}
	}
}