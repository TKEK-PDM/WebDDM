<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prefix_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PREFIXES_model', 'prefix');
    }

    public function prefix_get()
    {
        $result = $this->prefix->get();
		if ($result) {
			$response = create_response(TRUE, '', $result);
		} else {
			$response = create_response(FALSE, 'no data founded', '');
		}
		$this->response($response);
    }

    public function index_post()
    {
        $PREFIX = $this->post('PREFIX');
        if ($this->prefix->insert_prefix($PREFIX)) {
            $response = create_response(TRUE, 'save successfully');
        } else {
            $response = create_response(FALSE, 'save failed');
        }
        $this->response($response);
    }

    public function index_delete()
    {
        $ID = $this->delete('ID');
        $result = $this->prefix->delete_prefix($ID);
        if ($result) {
            $response = create_response(TRUE, 'delete successfully');
        } else {
            $response = create_response(FALSE, 'delete failed');
        }
        $this->response($response);
    }

}