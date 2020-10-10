<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	function getUser(){

		$getUser = $this->model->get('*', USERS, ['id' => session('uid')]);
		$getUser->package_name 			= "";
		$getUser->package_no_account    = "";
		if(!empty($getUser)){
			$package = $this->model->get("*", PACKAGE, ['id' => session('uid'), "id" => $getUser->package_id]);
			if(!empty($package)){
				$getUser->package_name 			= $package->name;
				$getUser->package_no_account    = get_value($package->permission,"account");
			}
		}
		return $getUser;
	}
}
