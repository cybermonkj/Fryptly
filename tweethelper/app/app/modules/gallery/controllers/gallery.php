<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class gallery extends MX_Controller {
	public $module;
	public $module_icon;
	public $module_name;
	public $module_title;


	public function __construct(){
		parent::__construct();
		$this->module_icon  = 'fa fa-folder-open-o';
		$this->module_name  = 'Gallery';
		$this->module_title = 'Gallery';
		$this->module = get_class($this);
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){

		$data = array(
			"module"      => $this->module,
			"module_icon" => $this->module_icon,
			"module_name" => $this->module_name,
			"media_data"  => $this->model->fetch("*",GALLERY_MANAGER,"uid = '".session('uid')."'","created","DESC"),
		);

		$this->template->build('index', $data);
	}

	public function upload_media(){
		create_folder();
		$path          = './assets/uploads/user'.session("uid");
		$allowed_types = 'gif|jpg|png|mp4';
		$max_size      = 5*1024;
		$width         = 1024;
		$height        = 768;
		// config
		$config = array(
			'upload_path'   => $path,			
			'allowed_types' => $allowed_types,			
			'max_size'      => $max_size,			
			'width'         => $width,			
			'encrypt_name'  => true,			
		);

		if(!empty($_FILES)){
			$files = $_FILES;
			for ($i=0; $i< count($_FILES['files']['name']); $i++) { 
		        $_FILES['files']['name']= $files['files']['name'][$i];
		        $_FILES['files']['type']= $files['files']['type'][$i];
		        $_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
		        $_FILES['files']['error']= $files['files']['error'][$i];
		        $_FILES['files']['size']= $files['files']['size'][$i];


				// load libary;
				$this->load->library('upload', $config);

				$this->upload->initialize($config);
		        if ( ! $this->upload->do_upload('files')){
		                ms(array(
		                	"status"  => "error",
		                	"message" => $this->upload->display_errors()
		                ));
		        }else{
		            $file_info = (object)$this->upload->data();
		            $data = array(
		            	"ids"           => ids(),
						"uid"           => session("uid"),
						"file_name"     => $file_info->file_name,
						"file_type"     => $file_info->file_type,
						"file_size"     => $file_info->file_size,
						"is_image"      => $file_info->is_image,
						"image_width"   => $file_info->image_width,
						"image_height"  => $file_info->image_height,
						"file_ext"      => str_replace(".", "",strtolower($file_info->file_ext)),
						"created"       => NOW,	
		            );
		            $this->db->insert(GALLERY_MANAGER,$data);
		            ms(array(
		            	"status"      => "success",
		            	"link"        => get_media_path($file_info->file_name),
		            	"ids"         => $data["ids"],
		            	"message"     => lang('Upload_media_successfully'),
		            ));
		        }
			}
		}else{
			pr("Error",1);
		}

	}

	public function ajax_delete_item(){
		$ids       = post('ids');
		$file_name = post('file_name');
		$path = APPPATH."../assets/uploads/user".session('uid')."/".$file_name;
		if(is_file($path)){
			if($this->db->delete(GALLERY_MANAGER,['ids' => $ids,'uid' => session('uid')],false)){
				unlink($path);
				ms(array(
					"status"  => "success",
					"message" => lang('You_have_been_successfully_deleted'),
				));
			};
		}else{
			ms(array(
				"status"  => "error",
				"message" => lang('There_was_an_error_processing_your_request_Please_try_again_later'),
			));
		}
	}
	
	public function ajax_delete_multi_items(){
		if (post('ids')=="delete_all") {
			$media_data = $this->model->fetch("*",GALLERY_MANAGER,"uid = '".session('uid')."'");
			if(!empty($media_data)){
				foreach ($media_data as $key => $row) {
					$path = APPPATH."../assets/uploads/user".session('uid')."/".$row->file_name;
					if (is_file($path)) {
						unlink($path);
						$this->db->delete(GALLERY_MANAGER,['uid' => session('uid')],false);
					}
				}
				ms(array(
					"status"  => "success",
					"message" => lang('You_have_been_successfully_deleted')	
				));
			}
			ms(array(
				"status"  => "error",
				"message" => lang('Your_media_is_empty')
			));

		}
		ms(array(
			"status"  => "error",
			"message" => lang('There_was_an_error_processing_your_request_Please_try_again_later')
		));

	}

}

