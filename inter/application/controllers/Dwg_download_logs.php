<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dwg_download_logs extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UD_WD_SUP_DOWN_model', 'sup_down');
    }

    public function index_get()
    {
        $USER_TYPE = $this->get('USER_TYPE');
        $DWG_NO = $this->get('DWG_NO');
        $USER_ID = $this->get('USER_ID');
        $DATE = $this->get('DATE');
        $result = $this->sup_down->getbycondition($USER_TYPE, $DWG_NO, $USER_ID, $DATE);
        if ($result) {
            $response = create_response(TRUE, '', $result);
            $response['USER_TYPE'] = $USER_TYPE;
            $response['DWG_NO'] = $DWG_NO;
            $response['USER_ID'] = $USER_ID;
            $response['DATE'] = $DATE;
        } else {
            $response = create_response(FALSE, 'no data founded', '');
            $response['USER_TYPE'] = $USER_TYPE;
            $response['DWG_NO'] = $DWG_NO;
            $response['USER_ID'] = $USER_ID;
            $response['DATE'] = $DATE;
        }
        $this->response($response);
    }
}