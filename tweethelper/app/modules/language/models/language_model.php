<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class language_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	function langLists(){
		$langLists = $this->model->fetch('*',LANG_LIST,"",'id','DESC');
		return $langLists;
	}
}
