<?php
defined('BASEPATH') or exit();

class Tis_supplier_user extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('tis_supplier_user/index'));
        $response = $this->rest->get('Librarys/tis_supplier_user');
        if ($response->status === TRUE) {
            $result = $response->data;
        }
        $i = 1;
        $arrResult = array();
        foreach ($result as $key => $val) {
            $arrTemp['index'] = $i;
            $arrTemp['EMP_ID'] = $val->EMP_ID;
            $arrTemp['EMP_NAME'] = $val->EMP_NAME;
            $arrTemp['PASSWORD'] = $val->PASSWORD;
            $arrTemp['SUP_CODE'] = $val->SUP_CODE;
            $arrTemp['SUP_NAME'] = $val->SUP_NAME;
            $arrTemp['INST_NAME'] = $val->INST_NAME;
            $arrTemp['BUSI_NO'] = $val->BUSI_NO;
            $arrTemp['BUYER_CODE'] = $val->BUYER_CODE;
            $arrTemp['UPTAE'] = $val->UPTAE;
            $arrTemp['JONGMOK'] = $val->JONGMOK;
            $arrTemp['TEL_NO'] = $val->TEL_NO;
            $arrResult[] = $arrTemp;
            $i ++;
        }
        $this->layout->view('library/tis_supplier_user', array(
            'data' => $arrResult,
            'count' => count($result)
        ));
    }
}