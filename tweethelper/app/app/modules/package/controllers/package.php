<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class package extends MX_Controller {
	public $module;
	public $tb_module;
	public $module_icon;
	public $module_name;
	public $module_title;
	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'ion-person-add';
		$this->module_name  = 'Manage Users';
		$this->module_title = 'Manage Users';
		$this->tb_module = PACKAGE;
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		if(!get_Role()){
			get_layout('404');
		}

		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"packages"    => $this->model->get_packages(),
		);
		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}


	public function content($ids = ""){
		$package = "";
		if($ids != ""){
			$package = $this->model->get("*", $this->tb_module, "ids = '{$ids}'");
		}

		$data = array(
			"module"      => $this->module,
			"package"     => $package,
		);

		$this->load->view('content', $data);
	}

	public function ajax_save($ids = ""){
		$name 	         	         = post('name');
		$account 	     	         = (int)post('account');
		$day 	     	 	         = (int)post('day');
		$price 	     	             = (float)post('price');
		$auto_post 	     	         = (!empty(post('auto_post')))? 1:0;
		$auto_like 	     	         = (!empty(post('auto_like')))? 1:0;
		$auto_unfollow 	             = (!empty(post('auto_unfollow')))? 1:0;
		$auto_follow 	             = (!empty(post('auto_follow')))? 1:0;
		$auto_reweet 	             = (!empty(post('auto_reweet')))? 1:0;
		$auto_direct_messages 	     = (!empty(post('auto_direct_messages')))? 1:0;
		$search_tweet 	             = (!empty(post('search_tweet')))? 1:0;

		if($name == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang("name_is_required"),
			));
		}

		if($account <= 0 || $account == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang("number_of_accounts_must_to_be_greater_than_zero"),
			));
		}

		if (table_exists(TRANSACTION_LOGS)) {
			if($day <= 0 || $day == ''){
				ms(array(
					'status'  => 'error',
					'message' => 'Numer of  Days must to be greater than zero',
				));
			}

			if($price <= 0 || $price == ''){
				ms(array(
					'status'  => 'error',
					'message' => 'Price must to be greater than zero',
				));
			}
	    }

		$data = array(
			"name"      => $name,
			"day"       => $day,
			"price"     => $price,
			"permission"    => json_encode(array(
						"account"                => $account,
						"auto_post"              => $auto_post,
						"auto_like"              => $auto_like,
						"auto_follow"  	         => $auto_follow,
						"auto_unfollow"          => $auto_unfollow,
						"auto_reweet"            => $auto_reweet,
						"auto_direct_messages"   => $auto_direct_messages,
						"search_tweet"           => $search_tweet,
					)),

			"changed"         => NOW,
		);
		if(!empty($ids)){
			$check_package = $this->model->get("ids", $this->tb_module, "ids = '{$ids}'") ;
			if(!empty($check_package)){

				$this->db->update($this->tb_module, $data, "ids = '".$check_package->ids."'");
				
				ms(array(
					'status'  => 'success',
					'message' => lang('Update_successfully'),
				));
				
			}else{
				ms(array(
					"status"   => "error",
					"message"  => "Package doesn't not exist"
				));
			}
		}else{
			$data["ids"] = ids();
			$data["type"] = 2;
			$data["created"] = NOW;
			if($this->db->insert( $this->tb_module, $data)){
				ms(array(
					'status'  => 'success',
					'message' => lang('Update_successfully').". ". lang("please_refresh_the_page"),
				));
			}
		}
	}

	public function ajax_delete($ids){
		$check_package = $this->model->get('*', $this->tb_module,"ids = '{$ids}'");
		if(!empty($check_package)){
			if($this->db->delete( $this->tb_module, ['ids' => $ids], false)){
				ms(array(
					'status'  => 'success',
					'message' => lang('You_have_been_successfully_deleted'),
					'ids'     => $ids,
				));
			}
		}else{
			ms(array(
				"status"  => "error",
				"message" => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
			));
		}
	}

}