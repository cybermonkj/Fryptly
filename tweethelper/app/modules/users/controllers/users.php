<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class users extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;
	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'ion-person-add';
		$this->module_name  = 'Manage Users';
		$this->module_title = 'Manage Users';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		if(!get_Role()){
			get_layout('404');
		}
		$packages = $this->model->fetch('*', PACKAGE);
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"users"       => $this->model->getUsers(),
			'packages'    => $packages,
		);
		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}


	public function edit(){
		$ids = get('ids');
		$checkUser = $this->model->get('*', USERS,"ids = '{$ids}'");
		$packages = $this->model->fetch('*', PACKAGE);
		if(!empty($checkUser)){
			$data = array(
				'user'     => $checkUser,
				'packages' => $packages,
			);
			$this->template->build('edit', $data);
		}else{
			get_layout('404');
		}
	}

	public function add(){
		$packages = $this->model->fetch('*', PACKAGE);
		$data = array(
			'packages' => $packages,
		);
		$this->template->build('edit', $data);
	}

	public function login(){
		if(session('uid')){
			redirect(cn('twitter'));
		}
		$data = array();
		$this->template->set_layout('oauth');
		$this->template->build('login', $data);
	}

	public function logout(){
		if(session('uid')){
			unset_session('langCurrent');
			delete_cookie("purchase_code_status");
			unset_session('uid');
		}
		redirect(cn());
	}

	public function register(){
		if(session('uid')){
			redirect(cn('twitter'));
		}
		$data = array();
		$this->template->set_layout('oauth');
		$this->template->build('register', $data);
	}

	public function ajax_login(){
		$email       = post('email');
		$password    = post('password');
		if($email == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang('Email_is_required'),
			));
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	      	ms(array(
				'status'  => 'error',
				'message' => lang('Invalid_email_format'),
			));
	    }	

		if($password == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang('Password_is_required'),
			));

		}

		$checkUser = $this->model->get('id,status,email,password',USERS,"email ='{$email}'");

		if(empty($checkUser)){
			ms(array(
				'status'  => 'error',
				'message' => lang('The_email_address_you_entered_does_not_match_any_account'),
			));
		}

		if($checkUser->status!=1){
			ms(array(
				'status'  => 'error',
				'message' => lang('Your_account_is_not_activated'),
			));
		}

		if($checkUser->password != md5($password)){
			ms(array(
				'status'  => 'error',
				'message' => lang('The_password_is_incorrect'),
			));
		}
		set_session('uid',$checkUser->id);
		ms(array(
			'status'  => 'success',
			'message' => lang('Login_successfully'),
		));
	}

	public function ajax_register(){
		$username    = post('username');
		$email       = post('email');
		$password    = post('password');
		$re_password = post('re_password');
		$timezone    = post('timezone');

		if($username == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang('Username_is_required'),
			));
		}

		if($email == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang('Email_is_required'),
			));
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	      	ms(array(
				'status'  => 'error',
				'message' => lang('Invalid_email_format'),
			));
	    }	

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

		$checkUser = $this->model->get('email,ids,username',USERS,"email='{$email}'");
		if(!empty($checkUser)){
			ms(array(
				'status'  => 'error',
				'message' => lang('An_account_for_the_specified_email_address_already_exists_Try_another_email_address'),
			));
		}

		// if not
		$data = array(
			"ids"             => ids(),
			"admin"           => 0,
			"username"        => $username,
			"package_id"      => 1,
			"email"           => $email,
			"password"        => md5($password),
			"status"          => 1,
			"timezone"        => $timezone,
			"created"         => NOW,
			"changed"         => NOW,
		);
		$data['expired_date']   = date("Y-m-d H-i-s", strtotime('+3 days'));

		if($this->db->insert(USERS, $data)){
			$id = $this->db->insert_id();
			set_session('uid',$id);
			ms(array(
				'status'  => 'success',
				'message' => lang('You_have_been_successfully_registered_and_logged_in'),
			));
		}
	}

	public function ajax_delete_user(){
		$ids = post('ids');
		$checkUser = $this->model->get('admin',USERS,"ids = '{$ids}' AND `id`!= 1");
		if(!empty($checkUser)){
			if($this->db->delete(USERS,"ids = '{$ids}' AND `id`!= 1")){
				ms(array(
					'status'  => 'success',
					'message' => lang('You_have_been_successfully_deleted'),
				));
			}
		}
		ms(array(
			'status'  => 'error',
			'message' => lang('The_process_cannot_delete_Administrator_account'),
		));
	}

	public function ajax_delete_users(){
		$idss = post('ids');
		if(empty($idss)){
			ms(array(
				'status'  => 'error',
				'message' => lang('Please_select_at_least_one_item'),
			));
		}
		
		$check = false;
		foreach ($idss as $key => $ids) {
			$checkUser = $this->model->get('admin',USERS,"ids = '{$ids}' AND `id`!= 1");
			if(!empty($checkUser)){
				$this->db->delete(USERS,"ids = '{$ids}' AND `id` != 1");
				$check = true;
			}
		}

		if($check){
			ms(array(
				'status'  => 'success',
				'message' => lang('You_have_been_successfully_deleted'),
				'ids'     => json_encode($idss),
			));
		}else{
			ms(array(
				'status'  => 'error',
				'message' => lang('The_process_cannot_delete_Administrator_account'),
			));
		}
	}

	public function ajax_update_user(){
		$ids                = post('ids');
		$admin              = (int)post('admin');
		$email              = post('email');
		$username           = post('username');
		$password           = post('password');
		$re_password        = post('re_password');
		$status             = (int)post('status');
		$timezone           = post('timezone');
		$expiration_date    = post('expiration_date');
		$package_id         = (int)post('package_id');

		if($username == ''){
			ms(array(
				'status'  => 'error',
				'message' => lang('Username_is_required'),
			));
		}

		$data = array(
			"username"        => $username,
			"admin"           => $admin,
			"status"          => $status,
			"timezone"        => $timezone,
			"expired_date"    => get_timezone_system($expiration_date),
			"package_id"      => $package_id,
			"changed"         => NOW,
		);


		if($password != ''|| $ids == ''){
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
		
		$checkPackage = $this->model->get('id, day', PACKAGE, "`id` = '{$package_id}'");
		if(empty($checkPackage)){
			ms(array(
				'status'  => 'error',
				'message' => "Package does not exists",
			));
		}

		if($ids != ''){
			$checkUser = $this->model->get('id, ids, email', USERS, "`ids` = '{$ids}'");

			if(empty($checkUser)){
				ms(array(
					'status'  => 'error',
					'message' => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
				));
			}

			// check email
			$checkUserEmail = $this->model->get('email,ids,username', USERS,"email='{$email}' AND `ids` != '{$ids}'");
			if(!empty($checkUserEmail)){
				ms(array(
					'status'  => 'error',
					'message' => lang('An_account_for_the_specified_email_address_already_exists_Try_another_email_address'),
				));
			}

			$data['email']   = $email;
			if($this->db->update(USERS, $data ,"ids = '{$ids}'")){
				ms(array(
					'status'  => 'success',
					'message' => lang('Update_successfully'),
				));
			}
		}else{

			if($email == ''){
				ms(array(
					'status'  => 'error',
					'message' => lang('Email_is_required'),
				));
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      	ms(array(
					'status'  => 'error',
					'message' => lang('Invalid_email_format'),
				));
		    }

		    // check email
			$checkUserEmail = $this->model->get('email,ids,username',USERS,"email='{$email}'");
			if(!empty($checkUserEmail)){
				ms(array(
					'status'  => 'error',
					'message' => lang('An_account_for_the_specified_email_address_already_exists_Try_another_email_address'),
				));
			}

			$data['ids']     = ids();
			$data['created'] = NOW;
			$data['email']   = $email;


			if($this->db->insert(USERS,$data)){
				ms(array(
					'status'  => 'success',
					'message' => lang('Update_successfully'),
				));
			}
		}
	}
}