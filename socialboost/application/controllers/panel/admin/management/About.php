<?php

defined('BASEPATH') or exit('No direct script access allowed');

class About extends MY_Controller
{
	protected $table;

	public function __construct()
	{
		parent::__construct();
		if (!userLevel(logged(), 'admin')) return redirect(base_url());
	}

	public function index()
	{
		$data = [
			'title' => lang("title_about"),

			'version' => $this->model->get('*', 'purchase_code', '', '', '', true)
		];

		view('layouts/auth_header', $data);
		view('panel/admin/management/about/about');
		view('layouts/auth_footer');
	}

	public function checkUpdate()
	{
		if (isset($_POST) && !empty($_POST)) {
			if (DEMO_VERSION != true) {
				update_boostpanel();
			}

			json([
				'type' => 'error',
				'message' => lang("demo"),
			]);
		}
	}
}
