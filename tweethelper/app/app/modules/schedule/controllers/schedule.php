<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class schedule extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;


	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-calendar-o';
		$this->module_name  = 'Scheduled Tweet';
		$this->module_title = 'Scheduled Tweet';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"schedules"   => $this->model->getSchedules(),
		);
		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}

	public function ajax_delete_item(){
		$data_ids = post('ids');
		if (!empty($data_ids)) {

			foreach ($data_ids as $ids) {
				$item = $this->model->get('ids,uid',POSTS,"uid = '".session('uid')."'");
				if(!empty($item)){
					$this->db->delete(POSTS,"ids = '".$ids."' AND uid = '".session('uid')."'");
				}
			}
			ms(array(
				'status'  => 'success',
				'message' => lang('You_have_been_successfully_deleted'),
				'ids'	  => json_encode($data_ids),
			));
		}
		ms(array(
			'status'  => 'error',
			'message' => lang('Count_not_find_any_item_Please_choose_an_item'),
		));
	}
}