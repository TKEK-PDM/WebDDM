<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TIS_APASSWORD_model', 'tis_apassword');
        // $this->output->enable_profiler(TRUE);
    }

    public function index_get()
    {
        $EMP_ID = $this->get('EMP_ID');
        $EMP_NAME = $this->get('EMP_NAME');
        $result = $this->tis_apassword->get($EMP_ID, $EMP_NAME);
        
        if ($result) {
            $response = create_response(TRUE, '', $result);
            $response['EMP_ID'] = $EMP_ID;
            $response['EMP_NAME'] = $EMP_NAME;
        } else {
            $response = create_response(FALSE, 'no data founded', '');
            $response['EMP_ID'] = $EMP_ID;
            $response['EMP_NAME'] = $EMP_NAME;
        }
        $this->response($response);
    }
}