<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class twitter extends MX_Controller {
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
		
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"tw_accounts" => $this->model->fetch("*",TWITTER_ACCOUNTS,"uid = '".session('uid')."'"),
		);

		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}

	public function oauth(){
		$permission = check_permission();
		if($permission->max_accounts){
			redirect(cn('twitter'));
		}
		$tw = new TwitterAPI(CONSUMER_KEY, CONSUMER_SECRET);
		redirect($tw->login_url());
	}
	
	public function add_account(){
		$tw           = new TwitterAPI(CONSUMER_KEY, CONSUMER_SECRET);
		$access_token = (object)$tw->get_access_token();
		$tw->getConnectionWithAccessToken($access_token);
		$data_tw = $tw->get_request('users/show',['screen_name'=> $access_token->screen_name]);

		$data_profile = array(
			"followers_count" => (isset($data_tw->followers_count))?$data_tw->followers_count:"",
			"friends_count"   => (isset($data_tw->friends_count))?$data_tw->friends_count:"",
			"statuses_count"  => (isset($data_tw->statuses_count))?$data_tw->statuses_count:"",
			"name"            => (isset($data_tw->name))?$data_tw->name:"",
		);

		// get data
		$data = array(
			"ids"             => ids(),
			"uid"             => session("uid"),
			"pid"             => $access_token->user_id,
			"screen_name"     => $access_token->screen_name,
			"avatar"          => (isset($data_tw->profile_image_url_https))?$data_tw->profile_image_url_https:"",
			"access_token"    => json_encode($access_token),
			"created"         => NOW,
			"status"          => 1,
			"data_profile"    => json_encode($data_profile),
		);

		// Check twitter account
		$account = $this->model->get("*",TWITTER_ACCOUNTS,"pid ={$access_token->user_id} AND uid ='".session('uid')."'");
		if(empty($account)){
			$this->db->insert(TWITTER_ACCOUNTS,$data);
		}else{
			$data['changed'] = NOW;
			$this->db->where("id",$account->id);
			$this->db->update(TWITTER_ACCOUNTS,$data);
		}
		redirect(cn('twitter'));
		
	}

	public function ajax_delete_item(){
		$ids = post('ids');
		$checkTwitterAccount = $this->model->get('id,ids,uid',TWITTER_ACCOUNTS,['ids' => $ids,'uid' => session('uid')]);
		if(!empty($checkTwitterAccount)){
			if($this->db->delete(TWITTER_ACCOUNTS,['ids' => $ids,'uid' => session('uid')],false)){
				$this->db->delete(SCHEDULES,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(REWEET,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(FOLLOW,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(UNFOLLOW,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(LIKE,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(DIRECT_MESSAGES,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(REWEET_LOGS,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(FOLLOW_LOGS,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(UNFOLLOW_LOGS,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(LIKE_LOGS,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(DIRECT_MESSAGES_LOGS,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				$this->db->delete(POSTS,['account_id' => $checkTwitterAccount->id, 'uid' => session('uid')],false);
				ms(array(
					'status'  => 'success',
					'message' => lang('You_have_been_successfully_deleted'),
					'ids'     => $ids
				));
			}
		}

		ms(array(
			'status'  => 'error',
			'message' => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
		));
	}

	public function ajax_update_item(){
		$ids = post('ids');
		$account_item = $this->model->get("*",TWITTER_ACCOUNTS,"ids = '{$ids}' AND uid = '".session('uid')."'");

		if(!empty($account_item)){

			$tw = new TwitterAPI(CONSUMER_KEY,CONSUMER_SECRET);
			$tw->getConnectionWithAccessToken($account_item->access_token);
			$access_token=json_decode($account_item->access_token);
			$data_tw = $tw->get_request('users/show',['screen_name'=> $access_token->screen_name]);
			if(isset($data_tw->errors[0])){
				ms(array(
	            	"status"      => "error",
	            	"message"     => $data_tw->errors[0]->message,
	            ));
			}
			$data_profile = array(
			"followers_count" => (isset($data_tw->followers_count))?$data_tw->followers_count:"",
			"friends_count"   => (isset($data_tw->friends_count))?$data_tw->friends_count:"",
			"statuses_count"  => (isset($data_tw->statuses_count))?$data_tw->statuses_count:"",
			"name"            => (isset($data_tw->name))?$data_tw->name:"",
			);
			
			$data = array(
				"avatar"       => (isset($data_tw->profile_image_url_https))?$data_tw->profile_image_url_https:"",
				"data_profile" => json_encode($data_profile),
			);

			if(!empty($data_profile)){
				$this->db->where("id",$account_item->id);
				$this->db->update(TWITTER_ACCOUNTS,$data);
				ms(array(
	            	"status"      => "success",
	            	"message"     => lang('Update_successfully'),
	            ));
			}
		}
	}

}