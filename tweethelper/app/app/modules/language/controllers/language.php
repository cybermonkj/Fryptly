<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class language extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;


	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-language';
		$this->module_name  = 'Language';
		$this->module_title = 'Language';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"langLists"   => $this->model->langLists(),
		);
		$this->template->title($this->module_title);
		$this->template->build('index', $data);
	}

	public function edit(){
		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
		);

		if(isset( $_GET['ids'] ) && !empty( $_GET['ids'] )){
			$ids = get('ids');
			$checkLang = $this->model->get('*',LANG_LIST,"ids = '{$ids}'");
			if(!empty($checkLang)){
				$data['lang']      = $checkLang;
				$lang_data = $this->model->fetch('*',LANG,"lang_code = '{$checkLang->code}'");
				$lang_db = array();
				if(!empty($lang_data)){
					foreach ($lang_data as $key => $row) {
						$lang_db[$row->slug] = $row->value;
					}
				}
				$data['lang_db'] = $lang_db;
			}else{
				get_layout('404');
			}
		}
		$this->template->build('edit', $data);

	}

	public function ajax_edit(){
		$ids                 = post('ids');
		$language_code       = post('language_code');
		$country_code        = post('country_code');
		$status    		     = (int)post('status');
		$default    		 = (int)post('default');
		$langs               = post('lang');

		$data = array(
			"code"               => $language_code,
			"country_code"       => $country_code,
			"status"             => $status,
			"is_default"         => $default,
		);

		// check exists language code
		if(!language_codes($language_code)){
			ms(array(
				"status"  => "error",
				"message" => lang('Language_code_does_not_exists_Please_choose_a_language_code')
			));
		}

		// Check lang defaut
		if($default==1){
			$checkLangDefault = $this->model->fetch('*',LANG_LIST,"is_default = 1");
			if(!empty($checkLangDefault)){
				$this->db->update(LANG_LIST,array('is_default' => 0));
			}
		}

		if ($ids!='') {
			// check lang exists
			$checkLangList = $this->model->get('*',LANG_LIST,"ids = '{$ids}'");
			if(!empty($checkLangList)){
				$this->db->update(LANG_LIST, $data, ['ids' => $ids]);
				if(is_array($langs) && !empty($langs)){
					foreach ($langs as $slug => $value) {
						$checklang = $this->model->get('*',LANG,"slug = '{$slug}' AND lang_code = '{$language_code}'");
						if(!empty($checklang)){
							$this->db->update(LANG, array('value' => $value) , array('slug' => $slug , 'lang_code' => $language_code));
						}else{
							$this->db->insert(LANG,array(
								"ids"        => ids(),
								"lang_code"  => $language_code,
								"slug"       => $slug,
								"value"      => $value,
							));
						}
					}
					ms(array(
						'status'  => 'success',
						'message' => lang('Update_successfully'),
					));
				}
			}

		} else {
			$checklang = $this->model->get('*',LANG_LIST,"code = '{$language_code}'");
			if(!empty($checklang)){
				ms(array(
					'status'  => 'error',
					'message' => lang('Language_already_exists'),
				));
			}
			$data['ids']     = ids();
			$data['created'] = NOW;
			$this->db->insert(LANG_LIST,$data);
			if(is_array($langs) && !empty($langs)){
				foreach ($langs as $slug => $value) {
					$checklang = $this->model->get('*',LANG,"slug = '{$slug}' AND lang_code = '{$language_code}'");
					if(empty($checklang)){
						$this->db->insert(LANG,array(
							"ids"        => ids(),
							"lang_code"  => $language_code,
							"slug"       => $slug,
							"value"      => $value,
						));
					}
				}
				ms(array(
					'status'  => 'success',
					'message' => lang('Update_successfully'),
				));
			}
		}
	}

	public function ajax_delete_item(){
		$ids = post('ids');
		$checkLang = $this->model->get('*',LANG_LIST,"ids = '{$ids}'");
		if(!empty($checkLang)){
			if($this->db->delete(LANG_LIST,"ids = '{$ids}'")){
				$this->db->delete(LANG,"lang_code = '{$checkLang->code}'");
				ms(array(
					'status'  => 'success',
					'message' => lang('You_have_been_successfully_deleted'),
				));
			}
		}
		ms(array(
			'status'  => 'error',
			'message' => lang('The_language_code_doest_not_exists'),
		));
	}

	public function ajax_delete_items(){
		$idss = post('ids');
		if(empty($idss)){
			ms(array(
				'status'  => 'error',
				'message' => lang('Please_select_at_least_one_item'),
			));
		}
		
		$check = false;
		foreach ($idss as $key => $ids) {
			$checkLang = $this->model->get('*',LANG_LIST,"ids = '{$ids}'");
			if(!empty($checkLang)){
				$this->db->delete(LANG_LIST,"ids = '{$ids}'");
				$this->db->delete(LANG,"lang_code = '{$checkLang->code}'");
				$check = true;
			}
		}

		if($check){
			ms(array(
				'status'  => 'success',
				'message' => lang('You_have_been_successfully_deleted'),
				'ids'     => json_encode($idss),
			));
		}else{
			ms(array(
				'status'  => 'error',
				'message' => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
			));
		}
	}

	public function set_language(){
		$ids = post('ids');
		$checkLang = $this->model->get('*',LANG_LIST,"ids = '{$ids}'");
		if(!empty($checkLang)){
			unset_session('langCurrent');
			set_session('langCurrent',$checkLang);
			ms(array(
				'status'  => 'success',
				'message' => lang('Update_successfully'),
			));
		}
	}	
}