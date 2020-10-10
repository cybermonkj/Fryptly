<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class search extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;


	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-search';
		$this->module_name  = 'Search Tweets';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$permission = check_permission();
		if(!$permission->search){
			redirect(cn(''));
		}
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"tw_accounts" => $this->model->fetch("*",TWITTER_ACCOUNTS,"uid = '".session('uid')."'"),
		);
		$this->template->build('index', $data);
	}


	public function ajax_lockup(){
		$ids          	= post('ids');
		$keywords 		= post('keywords');
		$account_item 	= $this->model->get("*",TWITTER_ACCOUNTS,"ids = '{$ids}' AND uid = '".session('uid')."'");

		if($keywords == ""){
			ms(array(
				'status'  => 'error',
				'message' => lang('Please_enter_keyword'),
			));
		}

		if(!empty($account_item)){
			$tw = new TwitterAPI(CONSUMER_KEY, CONSUMER_SECRET);
			$tw->getConnectionWithAccessToken($account_item->access_token);
			$data_tw = $tw->get_request('search/tweets',['q'=> $keywords,'count'=> 50,'result_type' => 'recent']);
			if(isset($data_tw->errors[0])){
				ms(array(
	            	"status"      => "error",
	            	"message"     => $data_tw->errors[0]->message,
	            ));
			}
			if(is_array($data_tw->statuses)){
				$data = array(
					"result" => $data_tw->statuses
				);
				$this->load->view("ajax_search", $data);
			}

		}else{
			ms(array(
				'status'  => 'error',
				'message' => lang('Please_select_at_least_one_Twitter_account'),
			));
		}
	}
}