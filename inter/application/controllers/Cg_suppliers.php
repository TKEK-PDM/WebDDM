<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cg_suppliers extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UD_WD_CG_SUP_model', 'cg_sup');
        $this->load->model('TIS_MVENDOR_model', 'vender');
        $this->load->model('PDM_CG_LIB_model', 'cg_lib');
    }

    public function index()
    {}

    public function cg_mapping_get()
    {
        $SUP_CODE = $this->get('SUP_CODE');
        $SUP_NAME = $this->get('SUP_NAME');
        $search_result = $this->cg_sup->get_cg_mapping($SUP_CODE, $SUP_NAME);
        if ($search_result) {
            $response = create_response(TRUE, '', $search_result);
            $response['SUP_CODE'] = $SUP_CODE;
            $response['SUP_NAME'] = $SUP_NAME;
        } else {
            $response = create_response(FALSE, 'no data founded', '');
            $response['SUP_CODE'] = $SUP_CODE;
            $response['SUP_NAME'] = $SUP_NAME;
        }
        $this->response($response);
    }

    public function supplier_name_get()
    {
        $sup_code[]['SUP_CODE'] = $this->get('sup_code');
        $search_result = $this->vender->get_sup_names_by_code($sup_code);
        if ($search_result) {
            $response = create_response(TRUE, '', $search_result);
        } else {
            $response = create_response(FALSE, 'Supplier Code does not exit  ' . $this->get('sup_code'), array(
                $this->get('sup_code')
            ));
        }
        $this->response($response);
    }

    public function check_exist_get()
    {
        $sup_code = $this->get('sup_code');
        $cg = $this->get('cg');
        $check_result = $this->cg_sup->check_sup_code($sup_code, $cg);
        if ($check_result == 0) {
            $response = create_response(TRUE, '', $check_result);
        } else {
            $response = create_response(FALSE, '[' . $sup_code . '/ ' . $cg . '] already exist', array(
                $sup_code,
                $cg
            ));
        }
        $this->response($response);
    }

    public function save_mapping_get()
    {
        $sup_code = $this->get('sup_code');
        $cg = $this->get('cg');
        $object_id = $this->get('object_id');
        if ($this->cg_sup->save_mapping($sup_code, $cg, $object_id) == TRUE) {
            $response = create_response(TRUE);
        } else {
            $response = create_response(FALSE);
        }
        $this->response($response);
    }

    public function delete_mapping_get()
    {
        $sup_code = $this->get('sup_code');
        $cg = $this->get('cg');
        $this->cg_sup->delete_cg_mapping($sup_code, $cg);
    }

    public function delete_add_form_post()
    {
        $add_data = $this->post('add_data');
        $object_id = $this->post('object_id');
        $this->cg_sup->delete_form_all();
        foreach ($add_data as $key => $value) {
            $add_info[$key]['CG'] = $value['cg'];
            $add_info[$key]['SUP_CODE'] = $value['sup_code'];
            $add_info[$key]['CRT_USER'] = $object_id;
            $add_info[$key]['CRT_DATE'] = date('Ymd');
            $add_info[$key]['CRT_TIME'] = date('His');
        }
        $this->cg_sup->save_mapping_batch($add_info);
    }

    public function check_sup_post()
    {
        $record = $this->post('record');
        foreach ($record as $value) {
            $sup_code[]['SUP_CODE'] = $value['sup_code'];
        }
        $search_result = $this->vender->get_sup_names($sup_code);
        if ($search_result === true) {
            $response = create_response(TRUE, '', $search_result);
        } else {
            $response = create_response(FALSE, '', $search_result);
        }
        $this->response($response);
    }

    public function add_cg_mapping_post()
    {
        $record = $this->post('record');
        $object_id = $this->post('object_id');
        foreach ($record as $value) {
            $is_exist = $this->cg_sup->check_sup_code($value['sup_code'], $value['cg']);
            if ($is_exist == 0) {
                $this->cg_sup->save_mapping($value['sup_code'], $value['cg'], $object_id);
            }
        }
    }

    public function check_cg_exist_get()
    {
        $cg = $this->get('cg');
        $check_result = $this->cg_lib->get_exist_cg($cg);
        
        if ($check_result == 0) {
            // cg not exist
            $response = create_response(FALSE, 'cg_not_exist', array(
                $cg
            ));
        } else {
            $response = create_response(TRUE, '', $check_result);
        }
        $this->response($response);
    }
}
