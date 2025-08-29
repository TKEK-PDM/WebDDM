<?php
defined('BASEPATH') or exit();

class Dwg_download_log extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Dwg_download_log/index'));
        $this->layout->view('log/dwg_download_log');
    }

    public function search()
    {
        $USER_TYPE = $this->input->post('user_type');
        $DWG_NO = $this->input->post('DRAWING_NO');
        $USER_ID = $this->input->post('USER_ID');
        $DATE = $this->input->post('date');
        
        $response = $this->rest->get('Dwg_download_logs/index', array(
            'USER_TYPE' => $USER_TYPE,
            'DWG_NO' => $DWG_NO,
            'USER_ID' => $USER_ID,
            'DATE' => $DATE
        ));
        // var_dump($response);
        // die();
        if ($response->status === TRUE) {
            $data = $response->data;
            $request['USER_TYPE'] = $response->USER_TYPE;
            $request['DWG_NO'] = $response->DWG_NO;
            $request['USER_ID'] = $response->USER_ID;
            $request['DATE'] = $response->DATE;
        } else {
            $request['USER_TYPE'] = $response->USER_TYPE;
            $request['DWG_NO'] = $response->DWG_NO;
            $request['USER_ID'] = $response->USER_ID;
            $request['DATE'] = $response->DATE;
        }
        $this->layout->view('log/dwg_download_log', array(
            'data' => $data,
            'info' => $request
        ));
    }
}
