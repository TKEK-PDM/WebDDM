<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Librarys extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PDM_CG_LIB_model', 'cg_lib');
        $this->load->model('TIS_APASSWORD_model', 'tis_lib');
        // $this->output->enable_profiler(TRUE);
    }

    public function index_get()
    {
        $result = $this->cg_lib->get();
        if ($result) {
            $response = create_response(TRUE, '', $result);
        } else {
            $response = create_response(FALSE, 'no data founded', '');
        }
        $this->response($response);
    }

    public function tis_supplier_user_get()
    {
        $result = $this->tis_lib->get_tis_supplier();
        if ($result) {
            $response = create_response(TRUE, '', $result);
        } else {
            $response = create_response(FALSE, 'no data founded', '');
        }
        $this->response($response);
    }
}