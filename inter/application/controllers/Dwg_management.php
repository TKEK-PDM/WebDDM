<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dwg_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UD_WD_DWG_SUP_model', 'dwg_sup');
        $this->load->model('TIS_MVENDOR_model', 'vendor');
        $this->load->model('UD_WD_SUP_DOWN_model', 'sup_down');
        $this->load->model('PDM_DOC_model', 'doc');
        $this->load->model('PDM_DB_SITE_model', 'site');
        $this->load->library('file');
    }

    /**
     *
     * @param $uid login            
     *
     *
     */
    public function index_get()
    {
        $sup_code = $this->get('sup_code');
        $result = $this->dwg_sup->dwg_management_search($sup_code);
        $arr_data = array();
        foreach ($result as $key => $row) {
            $class_id = $this->doc->get_class_id($row['DWG_NO']);
            foreach ($class_id as $key => $val) {
                $row['CLASS_ID'] = $val['CLASS_ID'];
                $down_info = $this->sup_down->get_download_info_by_sup_code($row['DWG_NO'], $val['CLASS_ID'], $sup_code);
                $row['DOWN_D'] = $down_info['DOWN_D'];
                $row['DOWN_T'] = $down_info['DOWN_T'];
                $down_total = $this->sup_down->get_download_total_by_sup_code($row['DWG_NO'], $val['CLASS_ID'], $sup_code);
                $row['DOWN_COUNT'] = $down_total['TOTAL'];
                $file_info = $this->doc->get_single_file_info($row['DWG_NO'], $row['REVISION']);
                $file_name = $file_info['FILE_NAME'];
                $site = $this->site->get_site_name($row['TDM_SITE_ID']);
                $row['SITE_NAME'] = $site['TDM_PREFIX'];
                $pdf_file_name = "";
                $row['FILE_NAME'] = $file_name;
                if (strtolower(trim(strrchr($file_name, '.'), '.')) == 'dwg' && $site['TDM_PREFIX'] == "KO") {
                    $pdf_file_name = substr($file_name, 0, strlen($file_name) - 3) . 'pdf';
                }
                if (empty($pdf_file_name)) {
                    $row['PDF_YN'] = "";
                    $row['PDF_FILE_NAME'] = "";
                } else {
                    $file_exist = $this->file->file_exists($pdf_file_name, $site['TDM_PREFIX']);
                    if ($file_exist) {
                        $row['PDF_YN'] = "Y";
                    } else {
                        $row['PDF_YN'] = "N";
                    }
                    $row['PDF_FILE_NAME'] = $pdf_file_name;
                }
            }
            $arr_data[] = $row;
        }
        
        if ($arr_data) {
            $response = create_response(TRUE, '', $arr_data);
        } else {
            $response = create_response(FALSE, 'no data founded', '');
        }
        $this->response($response);
    }

    /**
     * save delete_dwg_sup
     */
    public function delete_dwg_sup_get()
    {
        $count = 0;
        $sup_code = $this->get('sup_code');
        $dwg_no_str = $this->get('dwg_no_str');
        $dwg_no_arr = explode(",", $dwg_no_str);
        foreach ($dwg_no_arr as $key => $val) {
            $flag = $this->dwg_sup->dwg_management_delete($sup_code, $val);
            if ($flag) {
                $count ++;
            }
        }
        $response = create_response(TRUE, '', array(
            "delete_count" => $count
        ));
        $this->response($response);
    }

    public function select_suppliers_get()
    {
        $result = $this->vendor->get("*", array(), null, null, 'SUP_CODE');
        
        if ($result) {
            $response = create_response(TRUE, '', $result);
        } else {
            $response = create_response(FALSE, 'no data founded', '');
        }
        $this->response($response);
    }

    public function copy_dwg_supplier_get()
    {
        $sup_code_from = $this->get('sup_code_from');
        $sup_code_to = $this->get('sup_code_to');
        $uid = $this->get('uid');
        $result = $this->dwg_sup->copy_to_new_supplier($sup_code_from, $sup_code_to, $uid);
        $response = create_response(TRUE, '', array(
            "copy_count" => $result
        ));
        $this->response($response);
    }
}