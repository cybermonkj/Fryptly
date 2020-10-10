<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	function getUsers(){
		$getUsers = $this->model->fetch('*',USERS,"",'id','DESC');
		return $getUsers;
	}
}
