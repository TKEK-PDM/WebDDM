<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->load->model('UD_WD_INTERNAL_USER_model', 'internal_user');
        $this->load->model('UD_WD_LOG_HIST_model', 'log_history');
    }
    
    // get data
    public function index_get()
    {
        if ($this->get('username')) {
            $user_type = $this->get('user_type');
            $username = $this->get('username');
            $is_supplier = $user_type == 'supplier' ? TRUE : FALSE;
            $user = $is_supplier ? $this->user->get_supplier_by_username($username) : $this->user->get_user_by_username($username);
            if ($user) {
                if ($this->get('password')) {
                    $password = $this->get('password');
                    $user_password = $is_supplier ? $user['PASSWORD'] : $user['USER_PASSWORD'];
                    if ($password == $user_password) {
                        $user_info['username'] = $is_supplier ? $user['EMP_NAME'] : $user['TDM_DESCRIPTION'];
                    } else {
                        $response = create_response(FALSE, "INCONRRECT");
                        $this->response($response);
                    }
                    if ($is_supplier) {
                        $user_info['ROLE_OBJECT_ID'] = '1';
                        $para = array();
                        // USER_TYPE
                        $para[] = "S";
                        // USER_ID
                        $para[] = $username;
                        // SUP_CODE
                        $para[] = substr($username, 1);
                        // USER_NAME
                        $para[] = $user['EMP_NAME'];
                        // ACTION_TYPE
                        $para[] = 'login';
                        $this->log_history->add_log($para);
                        
                        $response = create_response(TRUE, '', $user_info);
                        $this->response($response);
                    } else {
                        $ddm_user = $this->internal_user->get_ddm_user_by_id($user['OBJECT_ID']);
                        
                        if (empty($ddm_user)) {
                            $response = create_response(FALSE, "INVALID");
                            $this->response($response);
                        } else {
                            $ddm_user['username'] = $user['TDM_DESCRIPTION'];
                            $ddm_user['OBJECT_ID'] = $user['OBJECT_ID'];
                            // insert log
                            $para = array();
                            // USER_TYPE
                            $para[] = "I";
                            // USER_ID
                            $para[] = $username;
                            // SUP_CODE
                            $para[] = $username;
                            // USER_NAME
                            $para[] = $ddm_user['username'];
                            // ACTION_TYPE
                            $para[] = 'login';
                            $this->log_history->add_log($para);
                            $response = create_response(TRUE, '', $ddm_user);
                            $this->response($response);
                        }
                    }
                } else {
                    unset($user['USER_PASSWORD']);
                    $response = create_response(TRUE, '', $user);
                    $this->response($response);
                }
            } else {
                $response = create_response(FALSE, 'NOTEXIST');
                $this->response($response);
            }
        }
    }
    
    // add data
    public function suppliers_get()
    {
        $username = $this->get('username');
        $user = $this->user->get_supplier_by_username($username);
        $response = create_response(TRUE, '', $user);
        $this->response($response);
    }
    
    // update data
    public function index_put()
    {
        $this->response(array(
            'put',
            $this->put()
        ));
    }
    
    // delete data
    public function index_delete()
    {
        $this->response(array(
            'delete',
            $this->delete()
        ));
    }

    public function logout_post()
    {
        // insert log
        $para = array();
        // USER_TYPE
        $para[] = $this->post('user_type_brief');
        // USER_ID
        $para[] = $this->post('user_id');
        // SUP_CODE
        $para[] = $this->post('sup_code');
        // USER_NAME
        $para[] = $this->post('user_name');
        // ACTION_TYPE
        $para[] = 'logout';
        
        $this->log_history->add_log($para);
    }
}