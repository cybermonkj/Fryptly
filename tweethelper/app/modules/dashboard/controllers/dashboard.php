<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class dashboard extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-twitter';
		$this->module_name  = 'Dashboard';
		$this->module_title = 'twitter account';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$follow = $this->model->stats_log(FOLLOW_LOGS);

		$data = array(
			"module"      	  => $this->module,
			"module_icon" 	  => $this->module_icon,
			"module_name" 	  => $this->module_name,
			'data_logs'       => $this->model->get_data_logs(),
			'data_chart_logs' => $this->model->get_data_chart_logs(),
			"accounts"	  => $this->model->fetch("ids, screen_name", TWITTER_ACCOUNTS, "uid = '".session('uid')."'"),
		);

		$this->template->build('index', $data);
	}

	public function stats($account_ids = ""){
		$data = array(
			'data_logs'       => $this->model->get_data_logs($account_ids),
			'data_chart_logs' => $this->model->get_data_chart_logs($account_ids),

		);
		$this->load->view('content', $data);
	}

}