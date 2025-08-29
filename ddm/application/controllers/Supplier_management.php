<?php
defined('BASEPATH') or exit();

class Supplier_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Supplier_management/index'));
        $EMP_ID = $this->input->get_post('EMP_ID');
        $EMP_NAME = $this->input->get_post('EMP_NAME');
        $response = $this->rest->get('Supplier_management/index', array(
            'EMP_ID' => $EMP_ID,
            'EMP_NAME' => $EMP_NAME
        ));
        if ($response->status === TRUE) {
            $result = $response->data;
            $responseresult['EMP_ID'] = $response->EMP_ID;
            $responseresult['EMP_NAME'] = $response->EMP_NAME;
            $keep = TRUE;
        } else {
            $responseresult['EMP_ID'] = $response->EMP_ID;
            $responseresult['EMP_NAME'] = $response->EMP_NAME;
        }
        $this->layout->view('supplier_management/supplier_management', array(
            'data' => $result,
            'info' => $responseresult,
            'keep' => $keep
        ));
    }
}