<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class profile extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;
	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'ion-person-add';
		$this->module_name  = 'My profile';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"user"        => $this->model->getUser(),
		);
		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}

	public function ajax_update_user(){
		$id          = session('uid');
		$email       = post('email');
		$username    = post('username');
		$password    = post('password');
		$re_password = post('re_password');
		$timezone    = post('timezone');
		$twitter_consumer_key    = trim(post('twitter_consumer_key'));
		$twitter_secret_key      = trim(post('twitter_secret_key'));

		if($username == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang('Username_is_required'),
			));
		}

		$data = array(
			"username"                     => $username,
			"changed"                      => NOW,
			"twitter_consumer_key"         => $twitter_consumer_key,
			"twitter_secret_key"           => $twitter_secret_key,
			"timezone"                     => $timezone,
		);

		if($password != ''){
			if($password == ''){
				ms(array(
					'status'  => 'error',
					'message' => lang('Password_is_required'),
				));
			}

			if(strlen($password) < 6){
				ms(array(
					'status'  => 'error',
					'message' => lang('Password_must_be_at_least_6_characters_long'),
				));
			}

			if($re_password!= $password){
				ms(array(
					'status'  => 'error',
					'message' => lang('Password_does_not_match_the_confirm_password'),
				));
			}
			$data['password'] = md5($password);
		}

		if($id!=''){
			$checkUser = $this->model->get('id,ids,email',USERS,"`id` = '{$id}'");

			if(empty($checkUser)){
				ms(array(
					'status'  => 'error',
					'message' => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
				));
			}

			// check email
			if($email == ''){
				ms(array(
					'status'  => 'error',
					'message' => 'Email is required',
				));
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      	ms(array(
					'status'  => 'error',
					'message' => 'Invalid email format',
				));
		    }
		    
			$checkUserEmail = $this->model->get('email,ids,username',USERS,"email='{$email}' AND `id` != '{$id}'");

			if(!empty($checkUserEmail)){
				ms(array(
					'status'  => 'error',
					'message' => lang('An_account_for_the_specified_email_address_already_exists_Try_another_email_address'),
				));
			}

			$data['email']   = $email;

			if($this->db->update(USERS,$data,"id = '{$id}'")){
				ms(array(
					'status'  => 'success',
					'message' => lang('Update_successfully'),
				));
			}
		}else{
			ms(array(
				'status'  => 'success',
				'message' => lang('Update_successfully'),
			));
		}
	}
}