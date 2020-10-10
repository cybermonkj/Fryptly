<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class stripe extends MX_Controller {
	public $tb_users;
	public $tb_transaction_logs;
	public $tb_package;
	public $stripeapi;
	public $payment_type;
	public $currency_code;
	public $mode;

	public function __construct(){
		parent::__construct();
		$this->tb_users            = USERS;
		$this->tb_transaction_logs = TRANSACTION_LOGS;
		$this->tb_package          = PACKAGE;
		$this->payment_type		   = "stripe";
		$this->mode 			   = getOption("payment_environment", "");
		$this->currency_code       = (getOption("currency_code", "") == "")? 'USD' : getOption("currency_code", "");
		$this->load->library("stripeapi");
		$this->stripeapi = new stripeapi(getOption('stripe_secret_key',""), getOption('stripe_publishable_key',""), $this->mode);
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
		$package_id = session("package_id");
		$token  = post("stripeToken");
		if(!empty($token)){
			// Card info
			$card_num       = post('card_num');
			$card_cvv       = post('cvv');
			$card_exp_month = post('exp_month');
			$card_exp_year  = post('exp_year');
			
			// Buyer info
			$data_buyer_info = array(
				"source"     => $token,
				"email" 	 => getField("email", USERS, session("uid")),
			);

			//add customer to stripe
			$customer = $this->stripeapi->customer_create($data_buyer_info);
			
			// Item info
			$itemName   = (getOption("website_name","") == "")? "Tweetposts" : getOption("website_name","");
			$itemNumber = 'TweetpstL9271';
			$orderID    = 'SKA92712382139';//charge a credit or a debit card.

			$data_charge = array(
				'customer'     => $customer->id,
		        'amount'       => $amount*100,
		        'currency'     => strtolower($this->currency_code),
		        'description'  => $itemName,
		        'metadata'     => array(
		            'order_id' => $orderID
		        )
			);

			//charge a credit or a debit card
		    $result = $this->stripeapi->create_payment($data_charge);
			if (!empty($result) && $result->status == 'success') {
				/*----------  Insert to Transaction table  ----------*/
				$response = $result->response;
				unset_session("amount");
				$data = array(
					"ids" 				=> ids(),
					"uid" 				=> session("uid"),
					"type" 				=> $this->payment_type,
					"transaction_id" 	=> $response->id,
					"amount" 	        => $amount,
					"created" 			=> NOW,
				);

				$this->db->insert($this->tb_transaction_logs, $data);
				$transaction_id = $this->db->insert_id();

				/*----------  Update Package  ----------*/
				$this->update_package($package_id);
				

				/*----------  Send payment notification email  ----------*/
				// if (getOption("is_payment_notice_email", '')) {
				// 	$CI = &get_instance();
				// 	if(empty($CI->payment_model)){
				// 		$CI->load->model('model', 'payment_model');
				// 	}
				// 	$check_send_email_issue = $CI->payment_model->send_email(getOption('email_payment_notice_subject', ''), getOption('email_payment_notice_content', ''), session('uid'));
				// 	if($check_send_email_issue){
				// 		ms(array(
				// 			"status" => "error",
				// 			"message" => $check_send_email_issue,
				// 		));
				// 	}
				// }
				set_session("transaction_id", $transaction_id);
				redirect(cn("upgrade/success"));
			}else{
				redirect(cn("upgrade/unsuccess"));
			}
	
		}else{
			redirect(cn("upgrade"));
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