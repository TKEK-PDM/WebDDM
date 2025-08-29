<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('layout');
        $idiom = $this->input->get('language') ? $this->input->get('language') : $this->session->language;
        $this->session->userdata['language'] = $idiom;
        $this->session->userdata['lan_package'] = "$idiom.json";
        $this->lang->load('common', $idiom);
        $this->load->helper('language');
        if (! $this->session->username && ! $this->session->uid) {
            redirect('user/login');
        }
    }
    
    // check file exist
    public function check_files()
    {
        $arr_file_name = $this->input->post('exist_file_name');
        $arr_site_name = $this->input->post('site');
        $object_id = $this->input->post('object_id');
        $org_down = $this->input->post('org_down');
        $dwg_no_hidden = $this->input->post('tdm_id');
        //var_dump(json_encode($this->input->post()));exit; //string(109) "{"exist_file_name":["4F1N2335_130939_250.pdf"],"site":["KO"],"object_id":["402681649"],"tdm_id":["4F1N2335"]}"
        $arr_result = array();

        foreach ($arr_file_name as $key => $filename) {
//            echo json_encode($filename);exit;
//            echo json_encode($filename);
//            exit;
//            if (strtolower(trim(strrchr($filename, '.'), '.')) == 'dwg') {
//                $filename = substr($filename, 0, strlen($filename) - 3) . 'pdf';
//            }
            if (! empty($filename) && ! empty($arr_site_name[$key])) {
                $response = $this->rest->get("files/exists", array(
                    'file_name' => $filename,
                    'site' => $arr_site_name[$key],
                    'org_down' => $org_down[$key]
                ));


                if ($response->status) {
                    $arr_result["pdf_$object_id[$key]"] = 'Y|' . $dwg_no_hidden[$key].'|'.$org_down[$key];
                } else {
                    $arr_result["pdf_$object_id[$key]"] = 'N|' . $dwg_no_hidden[$key].'|'.$org_down[$key];
                }
            }
        }
        
        echo json_encode($arr_result);
        exit();
    }

    public function check_single_file_exist()
    {
        $filename = $this->input->post('file_name');
        $site_name = $this->input->post('site');
        $org_down = $this->input->post('org_down');
        $response = $this->rest->get("files/exists", array(
            'file_name' => $filename,
            'site' => $site_name
        ));
        $result = "";
        if ($response->status || $org_down === 'Y') {
            $result = 'Y';
        } else {
            $result = 'N';
        }
        exit();
    }
}