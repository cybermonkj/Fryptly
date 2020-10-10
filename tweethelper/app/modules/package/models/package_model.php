<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class package_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->tb_module = PACKAGE;
	}

	function get_packages(){
		$get_packages = $this->model->fetch('*',$this->tb_module, "", 'id', 'ASC');
		return $get_packages;
	}
}
