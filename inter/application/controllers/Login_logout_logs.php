<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_logout_logs extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UD_WD_LOG_HIST_model', 'log_hist');
    }

    public function index_get()
    {
        $USER_TYPE = $this->get('USER_TYPE');
        $USER_ID = $this->get('USER_ID');
        $USER_NAME = $this->get('USER_NAME');
        $DATE = $this->get('DATE');
        $FROM = $this->get('FROM');
        $TO = $this->get('TO');
        $result = $this->log_hist->get_by_condition($USER_TYPE, $USER_ID, $USER_NAME, $DATE, $FROM, $TO);
        if ($result) {
            $response = create_response(TRUE, '', $result);
            $response['USER_TYPE'] = $USER_TYPE;
            $response['USER_ID'] = $USER_ID;
            $response['USER_NAME'] = $USER_NAME;
            $response['DATE'] = $DATE;
            $response['FROM'] = $FROM;
            $response['TO'] = $TO;
        } else {
            $response = create_response(FALSE, 'no data founded', '');
            $response['USER_TYPE'] = $USER_TYPE;
            $response['USER_ID'] = $USER_ID;
            $response['USER_NAME'] = $USER_NAME;
            $response['DATE'] = $DATE;
            $response['FROM'] = $FROM;
            $response['TO'] = $TO;
        }
        $this->response($response);
    }
}
