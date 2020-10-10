<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class settings extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;
	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-cogs';
		$this->module_name  = 'Settings';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
		);
		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}

	public function ajax_update(){
		$post = $_POST;
		if(isset($post)){
			foreach ($post as $key => $value) {
				$value = htmlspecialchars(trim($value));
				if ($key == "purchase_code") {
					delete_cookie("purchase_code_status");
				}
				updateOption($key,$value);
			}
		}
		ms(array(
			"status"  => "success",
			"message" => lang('Update_successfully'),
		));
	}
}