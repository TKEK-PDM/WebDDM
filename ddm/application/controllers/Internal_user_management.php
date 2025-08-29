<?php
defined('BASEPATH') or exit();

class Internal_user_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Internal_user_management/index'));
        $this->layout->view('user_management/internal_user_management', array(
            'data' => []
        ));
    }

    public function search()
    {
        $USER_8_ID = $this->input->post('USER_8_ID') ? $this->input->post('USER_8_ID') : $this->session->flashdata('USER_8_ID');
        $TDM_DESCRIPTION = $this->input->post('TDM_DESCRIPTION') ? $this->input->post('TDM_DESCRIPTION') : $this->session->flashdata('TDM_DESCRIPTION');
        $ASSIGNED_VALUE = $this->input->post('ASSIGNED_VALUE') !== null ? $this->input->post('ASSIGNED_VALUE') : $this->session->flashdata('ASSIGNED_VALUE');
        $deleteflag = $this->session->flashdata('deleteflag');
        $response = $this->rest->get('Internal_users_management/index', array(
            'USER_8_ID' => $USER_8_ID,
            'TDM_DESCRIPTION' => $TDM_DESCRIPTION,
            'ASSIGNED_VALUE' => $ASSIGNED_VALUE
        ));
        
        if ($response->status === TRUE) {
            $result = $response->data;
            $request['USER_8_ID'] = $response->USER_8_ID;
            $request['TDM_DESCRIPTION'] = $response->TDM_DESCRIPTION;
            $request['ASSIGNED_VALUE'] = $response->ASSIGNED_VALUE;
            $keep = TRUE;
        } else {
            $request['USER_8_ID'] = $response->USER_8_ID;
            $request['TDM_DESCRIPTION'] = $response->TDM_DESCRIPTION;
            $request['ASSIGNED_VALUE'] = $response->ASSIGNED_VALUE;
        }
        $request['deleteflag'] = $deleteflag;
        
        $responseRole = $this->rest->get('Internal_users_management/role');
        if ($responseRole->status === TRUE) {
            $result_role = $responseRole->data;
        }
        $this->layout->view('user_management/internal_user_management', array(
            'data' => $result,
            'info' => $request,
            'role' => $result_role,
            'keep' => $keep
        ));
    }

    public function save()
    {
        $OBJECT_ID = $this->input->get_post('OBJECT_ID');
        $ROLE_OBJECT_ID = $this->input->get_post('ROLE_OBJECT_ID');
        $CRT_USER = $this->session->object_id;
        $response = $this->rest->post('Internal_users_management/index', array(
            'OBJECT_ID' => $OBJECT_ID,
            'ROLE_OBJECT_ID' => $ROLE_OBJECT_ID,
            'CRT_USER' => $CRT_USER
        ));
        if ($response->status === TRUE) {
            echo lang('message_save_successfully');
            exit();
        } else {
            echo lang('message_save_failed');
            exit();
        }
    }

    public function delete()
    {
        $OBJECT_ID = $this->input->get_post('id');
        $response = $this->rest->delete('Internal_users_management/index', array(
            'OBJECT_ID' => $OBJECT_ID
        ));
        
        if ($response->status === TRUE) {
            $USER_8_ID = $this->input->get_post('USER_8_ID');
            $TDM_DESCRIPTION = $this->input->get_post('TDM_DESCRIPTION');
            $ASSIGNED_VALUE = $this->input->get_post('ASSIGNED_VALUE');
            
            $this->session->set_flashdata('USER_8_ID', $USER_8_ID);
            $this->session->set_flashdata('TDM_DESCRIPTION', $TDM_DESCRIPTION);
            $this->session->set_flashdata('ASSIGNED_VALUE', $ASSIGNED_VALUE);
            $this->session->set_flashdata('deleteflag', TRUE);
            redirect('Internal_user_management/search');
        } else {
            $this->session->set_flashdata('deleteflag', FALSE);
            redirect('Internal_user_management/search');
        }
    }
}