<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class home extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}
	
	public function index(){
		if(session("uid")) redirect(cn("twitter"));
		$data = array(
			'langCurrent' => get_lang_code_defaut()
		);
		$this->template->set_layout('landing_page');
		$this->template->build('index', $data);
	}
	
}