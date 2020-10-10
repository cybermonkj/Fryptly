<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	

		$array_allowed_1 = array('home');
		$array_allowed_2 = array('login','register','ajax_login','ajax_register','cron');
		if(!session('uid') && !in_array($this->router->fetch_method(), $array_allowed_2) && !in_array($this->router->fetch_class(), $array_allowed_1)){
			redirect(cn("users/login"));
		}

		$CI = &get_instance();
		$cookie_purchase_code_status = "non-verified";

		if (isset($_COOKIE["purchase_code_status"]) && $_COOKIE["purchase_code_status"] != "") {
          $cookie_purchase_code_status = encrypt_decode($_COOKIE["purchase_code_status"]);
        }

		if(session('uid') && $cookie_purchase_code_status !="verified" && segment(2) != "logout"){
			if(segment(1) != "settings"){
				$code = $CI->db->select("value")->where("slug = 'purchase_code'")->get(OPTIONS)->row()->value;
				if(!empty($code)){
				    $website = str_replace("install/", "", @$_SERVER['HTTP_REFERER']);
				    $api_endpoint = "https://api.tuyennguyen.ml/license/"; 
				    $url = $api_endpoint . "verify?" . http_build_query(array( 
				        "purchase_code" => urlencode($code), 
				        "domain"        => urlencode($_SERVER['HTTP_HOST']), 
				        "website"       => urlencode($website), 
				        "app"           => urlencode('tweetpost'), 
				    ));
				    $verification = $this->__curl($url);
				    if (!empty($verification) && $verification->status != "success") {
				        redirect(PATH."settings?error=".$verification->message);
				        exit(0);
				    }elseif (!empty($verification) && $verification->status == "success") {
				    	set_cookie("purchase_code_status", encrypt_encode("verified"), 604800);
				    }else{
						$message = "There is some issue with your purchase code, please contact with me via email tuyennguyen2906@gmail.com";
						redirect(PATH."settings?error=".$message);
						exit(0);
				    }
				}else{
					$message = "There is some issue with your purchase code, please contact with me via email tuyennguyen2906@gmail.com";
					redirect(PATH."settings?error=".$message);
					exit(0);
				}
		    }	
		}

		$twitter_consumer_key = "";
		$twitter_secret_key = "";
		/*----------  Get Twitter consumer key and secret key from user  ----------*/
		$user_info = $this->__get_data(USERS, "twitter_consumer_key, twitter_secret_key, id", ["id" => session("uid")]);
		
		if (!empty($user_info) && $user_info->twitter_consumer_key != "" && $user_info->twitter_secret_key != "" ) {
			$twitter_consumer_key = $user_info->twitter_consumer_key;
			$twitter_secret_key   = $user_info->twitter_secret_key;
		}else{
			$twitter_consumer_key = $this->__get_data(OPTIONS, "value", ["slug" => "twitter_consumer_key"])->value;
			$twitter_secret_key = $this->__get_data(OPTIONS, "value", ["slug" => "twitter_secret_key"])->value;
		}

		if (!defined('CONSUMER_KEY')) define('CONSUMER_KEY', $twitter_consumer_key); 
		if (!defined('CONSUMER_SECRET')) define('CONSUMER_SECRET', $twitter_secret_key);
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}

	private function __get_data($table, $value, $where){
		$CI = &get_instance();
		$user = $CI->db->select($value);
				$CI->db->from($table);
				$CI->db->where($where);
		        $query = $this->db->get();
		$result = $query->row();
		if(!empty($result)){
			return $result;
		}else{
			return false;
		}
	}

	private function __curl($url){
	    $ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url); 
	    curl_setopt($ch, CURLOPT_VERBOSE, 1); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	    curl_setopt($ch, CURLOPT_AUTOREFERER, false); 
	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
	    curl_setopt($ch, CURLOPT_HEADER, 0); 
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $result = curl_exec($ch); 
	    curl_close($ch); 
	    return json_decode($result); 
	}
}