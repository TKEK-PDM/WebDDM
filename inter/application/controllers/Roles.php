<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UD_WD_ROLE_model','role');
	}

	public function role_get()
	{
		$result = $this->role->get();
		if ($result) {
			$response = create_response(TRUE, '', $result);
		} else {
			$response = create_response(FALSE, 'no data founded', '');
		}
		$this->response($response);
	}

}