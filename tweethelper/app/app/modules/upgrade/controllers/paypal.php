<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class paypal extends MX_Controller {
	public $tb_users;
	public $tb_package;
	public $tb_transaction_logs;
	public $paypal;
	public $payment_type;
	public $currency_code;
	public $mode;

	public function __construct(){
		parent::__construct();
		$this->tb_users            = USERS;
		$this->tb_transaction_logs = TRANSACTION_LOGS;
		$this->tb_package          = PACKAGE;
		$this->payment_type		   = "paypal";
		$this->mode                = getOption("payment_environment", "");
		$this->currency_code       = (getOption("currency_code", "USD") == "")? 'USD' : getOption("currency_code", "USD");
		$this->load->library("paypalapi");
		$this->paypal 			   = new paypalapi(getOption('paypal_client_id',""), getOption('paypal_client_secret',""));
	}

	public function index(){
		redirect(cn("upgrade"));
	}

	/**
	 *
	 * Create payment
	 *
	 */

	public function create_payment(){
		$amount = session("amount");
		if (!empty($amount) && $amount > 0) {
			$data = (object)array(
				"amount" => $amount,
				"currency" => $this->currency_code,
				"redirectUrls" => cn("upgrade/paypal/complete"),
				"cancelUrl" => cn("upgrade/unsuccess"),
			);	
			unset_session("amount");
			$this->paypal->create_payment($data, $this->mode);
		}else{
			redirect(cn("upgrade"));
		}
	}

	/**
	 *
	 * Call Execute payment after creating payment
	 *
	 */
	public function complete(){
		$package_id = session("package_id");
		if (isset($_GET["paymentId"]) && $_GET["paymentId"] != "" && isset($_GET["paymentId"])) {
			$result = $this->paypal->execute_payment($_GET["paymentId"], $_GET["PayerID"], $this->mode);
			// get Transaction Id
			$transactions = $result->getTransactions();
			$related_resources = $transactions[0]->getRelatedResources();
			$sale = $related_resources[0]->getSale();
			$sale_id = $sale->getId();
			if(!empty($result) && $result->state == 'approved'){
				/*----------  Insert to Transaction table  ----------*/
				$amount = $result->transactions[0]->amount;
				$data = array(
					"ids" 				=> ids(),
					"uid" 				=> session("uid"),
					"type" 				=> $this->payment_type,
					"transaction_id" 	=> $sale_id,
					"amount" 	        => $amount->total,
					"created" 			=> NOW,
				);

				$this->db->insert($this->tb_transaction_logs, $data);
				$transaction_id = $this->db->insert_id();

				/*----------  Update Package  ----------*/
				$this->update_package($package_id);
				
				set_session("transaction_id", $transaction_id);
				redirect(cn("upgrade/success"));
			}else{
				redirect(cn("upgrade/unsuccess"));
			}

		}else{
			redirect(cn("upgrade/unsuccess"));
		}
	}

	private function update_package($package_id = ""){
		$package = $this->model->get("id, ids, name, day, price, permission", $this->tb_package, ["id" => $package_id]);
		if (!empty($package)) {
			$user = $this->model->get("id, email, username, package_id, expired_date", $this->tb_users, ["id" => session("uid")]);
			$expired_date = $user->expired_date;
			if (strtotime($expired_date) > strtotime(NOW)) {
				$new_date = date('Y-m-d H:i:s', strtotime($expired_date. ' + '.$package->day.' days'));
			}else{
				$new_date = date('Y-m-d H:i:s', strtotime(NOW. ' + '.$package->day.' days'));
			}
			$data = array(
				"package_id" 	=> $package->id,
				"expired_date" 	=> $new_date,
				"permission" 	=> $package->permission,
			);
			$this->db->update($this->tb_users, $data, ["id" => session("uid")]);
		}
	}
}