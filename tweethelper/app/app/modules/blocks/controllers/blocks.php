<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class blocks extends MX_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function header(){
		
        $data = array(
        	'languages'   => $this->model->fetch('*', LANG_LIST,'status = 1'),
        	'langCurrent' => get_lang_code_defaut()
        );
		$this->load->view('header',$data);
	}
	
	public function footer(){
        $data = array();
		$this->load->view('footer',$data);
	}

	public function sidebar(){
		$data = array();
		$this->load->view('sidebar',$data);
	}

}
