<?php
defined('BASEPATH') or exit();

class Profile_card extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $TDM_ID = $this->input->get_post('TDM_ID');
        $REVISION = $this->input->get_post('REVISION');
        $response = $this->rest->get('Drawings/profile_card', array(
            'TDM_ID' => $TDM_ID,
            'REVISION' => $REVISION
        ));
        if ($response->status === TRUE) {
            $result = $response->data;
        }
        $arrResult = array();
        foreach ($result as $key => $val) {
            $arrResult['Site Name'] = $val->SITE_NAME;
            $arrResult['Class'] = $val->CLASS_NAME;
            $arrResult['State'] = $val->STATE_NAME;
            $arrResult['Object Id'] = $val->OBJECT_ID;
            $arrResult['Dwg No'] = $val->TDM_ID;
            $arrResult['Revision'] = $val->REVISION;
            $arrResult['Dwg Name (EN)'] = $val->TDM_DESCRIPTION;
            $arrResult['Dwg Name (KO)'] = $val->CN_LOCAL_DESCRIPTION;
            $arrResult['File Type'] = $val->FILE_TYPE_NAME;
            $arrResult['CAD Ref FileName'] = $val->CAD_REF_FILE_NAME;
            $arrResult['File Name'] = $val->FILE_NAME;
            $arrResult['Created by'] = $val->CRT_USER;
            $arrResult['Create Date'] = $val->CRT_DATE;
            $arrResult['Create Time'] = $val->CRT_TIME;
            $arrResult['Modified by'] = $val->MOD_USER;
            $arrResult['Modified Date'] = $val->MOD_DATE;
            $arrResult['Modified Time'] = $val->MOD_TIME;
        }
        echo $this->load->view('profile_card', array(
            'data' => $arrResult
        ), true);
        exit();
    }
}