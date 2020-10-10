<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class transaction extends MX_Controller {
	public $module;
	public $tb_users;
	public $tb_package;
	public $tb_transaction_logs;
	public $module_icon;
	public $module_name;
	public $module_title;


	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-calendar-o';
		$this->module_name  = 'Transaction Logs';
		$this->module_title = 'Transaction Logs';
		$this->tb_users            = USERS;
		$this->tb_transaction_logs = TRANSACTION_LOGS;
		$this->tb_package          = PACKAGE;
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){

		if (!table_exists(TRANSACTION_LOGS)) {
			redirect(cn());
		}
		
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"transactions"   => $this->model->get_transaction_list(),
		);
		$this->template->build('index', $data);
	}

	public function ajax_delete_item($ids = ""){
		$item = $this->model->get('ids, uid', $this->tb_transaction_logs, ["ids" => $ids]);
		if(!empty($item)){
			$this->db->delete($this->tb_transaction_logs, "ids = '".$ids."'");
			ms(array(
				'status'  => 'success',
				'message' => lang('You_have_been_successfully_deleted'),
				'ids'	  => $ids,
			));
		}else{
			ms(array(
				'status'  => 'error',
				'message' => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
			));
		}
	}
}