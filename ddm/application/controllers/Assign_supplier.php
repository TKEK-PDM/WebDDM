<?php
defined('BASEPATH') or exit();

class Assign_supplier extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $TDM_ID = $this->input->get_post('TDM_ID');
        $cg_filter = $this->input->get_post('cg_filter');
        $response = $this->rest->get('Drawings/sup_cg', array(
            'TDM_ID' => $TDM_ID,
            'cg_filter' => $cg_filter
        ));
        if ($response->status === TRUE) {
            $result = $response->data;
        }
        $arrResult = array();
        foreach ($result as $key => $val) {
            $arrTem['SUP_CODE'] = $val->SUP_CODE;
            $arrTem['SUP_NAME'] = $val->SUP_NAME;
            $arrTem['CG'] = $val->CG;
            $arrResult[]=$arrTem;
        }
        

        $response_cg = $this->rest->get('Drawings/dwg_sup', array(
            'TDM_ID' => $TDM_ID
        ));
        if ($response_cg->status === TRUE) {
            $result_cg = $response_cg->data;
        }
        $arrTem = array();
        $arrRightResult = array();
        foreach ($result_cg as $key => $val) {
            $arrTem['SUP_CODE'] = $val->SUP_CODE;
            $arrTem['SUP_NAME'] = $val->SUP_NAME;
            $arrTem['CG'] = $val->CG;
            $arrRightResult[]=$arrTem;
        }
        
        echo $this->load->view('assign_supplier_table', array(
            'data' => $arrResult,
            'rightDate'=>$arrRightResult
        ), true);
        exit();
    }
    public function assignSupplier(){
        $TDM_ID = $this->input->get_post('TDM_ID');
        $cg_filter = $this->input->get_post('cg_filter');
        $arrNew = $this->input->get_post('sup_code[]');
        $delFlag = true;
        $saveFlag = true;
        $response_cg = $this->rest->get('Drawings/dwg_sup', array(
            'TDM_ID' => $TDM_ID
        ));
        $result_cg = $response_cg->data;
        foreach ($result_cg as $key => $val) {
            $arrOld[] = $val->SUP_CODE;
        }
        $arrDel = array_diff((array)$arrOld, (array)$arrNew);
        if(count($arrDel)>0){
             $response = $this->rest->delete('Drawings/sup_mapping', array(
                'TDM_ID' => $TDM_ID,
                'arrDel' => $arrDel
            ));
            if ($response->status === TRUE) {
                $delFlag = true;
            }else{
                $delFlag = false;
            }
        }
        
        $arrInsert = array_diff((array)$arrNew, (array)$arrOld);
        $CRT_USER = $this->session->user_login;
        if(count($arrInsert)>0){
            $response = $this->rest->post('Drawings/sup_mapping', array(
                'TDM_ID' => $TDM_ID,
                'CRT_USE' => $CRT_USER,
                'arrInsert' => $arrInsert
            ));
            
            if ($response->status === TRUE) {
                $saveFlag = true;
            }else{
                $saveFlag = false;
            }
        }
        if ($delFlag && $saveFlag) {
            echo 'successfully';
            exit();
        } else {
            echo 'failed';
            exit();
        }
    }
}