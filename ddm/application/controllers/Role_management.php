<?php
defined('BASEPATH') or exit();

class Role_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Role_management/index'));
        $role_info = $this->rest->get('Roles/role/');
        if ($role_info->status === TRUE) {
            $data = $role_info->data;
            $this->layout->view('user_management/role_management', array(
                'data' => $data
            ));
        }
    }
}