<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Internal_users_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UD_WD_INTERNAL_USER_model', 'internal_user');
        // $this->output->enable_profiler(TRUE);
    }

    public function index_get()
    {
        $USER_8_ID = $this->get('USER_8_ID');
        $TDM_DESCRIPTION = $this->get('TDM_DESCRIPTION');
        $ASSIGNED_VALUE = $this->get('ASSIGNED_VALUE');
        
        $result = $this->internal_user->get_internal_user_info_by_8id_username($USER_8_ID, $TDM_DESCRIPTION, $ASSIGNED_VALUE);
        if ($result) {
            $response = create_response(TRUE, '', $result);
            $response['USER_8_ID'] = $USER_8_ID;
            $response['TDM_DESCRIPTION'] = $TDM_DESCRIPTION;
            $response['ASSIGNED_VALUE'] = $ASSIGNED_VALUE;
        } else {
            $response = create_response(FALSE, 'no data founded', '');
            $response['USER_8_ID'] = $USER_8_ID;
            $response['TDM_DESCRIPTION'] = $TDM_DESCRIPTION;
            $response['ASSIGNED_VALUE'] = $ASSIGNED_VALUE;
        }
        $this->response($response);
    }

    public function index_post()
    {
        $OBJECT_ID = $this->post('OBJECT_ID');
        $ROLE_OBJECT_ID = $this->post('ROLE_OBJECT_ID');
        $CRT_USER = $this->post('CRT_USER');
        if ($this->internal_user->insert_assign($ROLE_OBJECT_ID, $OBJECT_ID, $CRT_USER)) {
            $response = create_response(TRUE, 'save successfully');
        } else {
            $response = create_response(FALSE, 'save failed');
        }
        $this->response($response);
    }

    public function index_delete()
    {
        $OBJECT_ID = $this->delete('OBJECT_ID');
        $result = $this->internal_user->delete_assign($OBJECT_ID);
        if ($result) {
            $response = create_response(TRUE, 'delete successfully');
        } else {
            $response = create_response(FALSE, 'delete failed');
        }
        $this->response($response);
    }

    public function role_get()
    {
        $result = $this->internal_user->get_roles();
        if ($result) {
            $response = create_response(TRUE, '', $result);
        } else {
            $response = create_response(FALSE, 'no data founded', '');
        }
        $this->response($response);
    }

    public function email_get()
    {   
        $user_id = $this->get('user_id');
        $result = $this->internal_user->get_email($user_id);
        if ($result) {
            $response = create_response(TRUE, '', $result);
        } else {
            $response = create_response(FALSE, 'no data founded', '');
        }
        $this->response($response);
    }
}