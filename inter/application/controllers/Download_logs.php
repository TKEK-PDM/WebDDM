<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download_logs extends MY_Controller
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
        $USER_NAME = $this->get('USER_NAME');
        $DATE = $this->get('DATE');
        $FROM = $this->get('FROM');
        $TO = $this->get('TO');
        $result = $this->sup_down->get_by_condition($USER_TYPE, $DWG_NO, $USER_ID, $USER_NAME, $DATE, $FROM, $TO);
        if ($result) {
            $response = create_response(TRUE, '', $result);
            $response['USER_TYPE'] = $USER_TYPE;
            $response['DWG_NO'] = $DWG_NO;
            $response['USER_ID'] = $USER_ID;
            $response['USER_NAME'] = $USER_NAME;
            $response['DATE'] = $DATE;
            $response['FROM'] = $FROM;
            $response['TO'] = $TO;
        } else {
            $response = create_response(FALSE, 'no data founded', '');
            $response['USER_TYPE'] = $USER_TYPE;
            $response['DWG_NO'] = $DWG_NO;
            $response['USER_ID'] = $USER_ID;
            $response['USER_NAME'] = $USER_NAME;
            $response['DATE'] = $DATE;
            $response['FROM'] = $FROM;
            $response['TO'] = $TO;
        }
        $this->response($response);
    }
}