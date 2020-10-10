<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class upgrade extends MX_Controller {
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
		$this->tb_users            = USERS;
		$this->tb_transaction_logs = TRANSACTION_LOGS;
		$this->tb_package          = PACKAGE;
		$this->module       = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		if (!table_exists(TRANSACTION_LOGS)) {
			redirect(cn());
		}
		$packages = $this->model->fetch("*", $this->tb_package, ["status" => 1, "type " => 2]);
		$data = array(
			"module"      => $this->module,
			"packages"    => $packages,
			
		);
		$this->template->build('index', $data);
	}

	public function process($id){
		$agree  = post("agree");

		if (!$agree) {
			ms(array(
				"status"  => "error",
				"message" => lang("you_must_confirm_to_the_conditions_before_paying")
			));
		}

		$package = $this->model->get("*", $this->tb_package, ["status" => 1, "id" => $id]);
		if (!empty($package)) {
			$amount = $package->price;
			$package_id = $package->id;
			set_session("amount", $amount);
			set_session("package_id", $package_id);
			ms(array(
				"status" => "success",
				"message" => lang("processing_"),
			));
		}else{
			ms(array(
				"status" => "error",
				"message" => lang("There_was_an_error_processing_your_request_Please_try_again_later"),
			));
		}
	}

	public function review($ids = ""){
		$package = $this->model->get("id, ids, name, day, price", $this->tb_package, ["ids" => $ids]);
		
		if (empty($package)) {
			get_layout(404);
		}

		$data = array(
			"module"      => $this->module,
			"package"     => $package,
		);

		$this->template->build('review', $data);
	}

	public function stripe_form(){
		$data = array(
			"module"        => get_class($this),
			"amount"        => session('amount'),
			"package_id"    => session("package_id")
		);
		$this->template->build('stripe_form', $data);
	}

	public function success(){
		$id = session("transaction_id");
		$transaction = $this->model->get("*", $this->tb_transaction_logs, "id = '{$id}' AND uid ='".session('uid')."'");
		if (!empty($transaction)) {
			$data = array(
				"module"        => get_class($this),
				"transaction"   => $transaction,
			);
			unset_session("transaction_id");
			unset_session("package_id");
			unset_session("amount");
			$this->template->build('payment_successfully', $data);
		}else{
			redirect(cn("upgrade"));
		}
	}

	public function unsuccess(){
		unset_session("package_id");
		unset_session("amount");
		$data = array(
			"module"        => get_class($this),
		);
		$this->template->build('payment_unsuccessfully', $data);
	}

}