<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Validation Form
	 */
	public function validate_form($edit = null)
	{
		if ($edit) {
			$this->form_validation(
				[
					[
						'field' => 'edit_category_name',
						'label' => lang("input_name"),
						'rules' => 'required|alpha_numeric_punct',
						'errors' => [
							'required' => lang("error_empty_field"),
							'alpha_numeric_punct' => lang("error_invalid_characters"),
						],
					],
				]
			);
		} else {
			$this->form_validation(
				[
					[
						'field' => 'category_name',
						'label' => lang("input_name"),
						'rules' => 'required|alpha_numeric_punct',
						'errors' => [
							'required' => lang("error_empty_field"),
							'alpha_numeric_punct' => lang("error_invalid_characters"),
						],
					],
				]
			);
		}
	}
}
