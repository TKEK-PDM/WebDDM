<?php
defined('BASEPATH') or exit();

class Prefix_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Prefix_management/index'));
        $prefix_info = $this->rest->get('Prefix_management/prefix/');
        if ($prefix_info->status === TRUE) {
            $data = $prefix_info->data;
            $this->layout->view('user_management/prefix_management', array(
                'data' => $data
            ));
        }else{
            if(!empty($prefix_info->message)){
                $data = $prefix_info->data;
                $this->layout->view('user_management/prefix_management', array(
                'data' => $data
            ));
            }
        }
    }
    
    public function save()
    {
        $PREFIX = strtoupper($this->input->get_post('PREFIX'));

        $response = $this->rest->post('Prefix_management/index', array(
            'PREFIX' => $PREFIX
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
        $ID = $this->input->get_post('id');
        $response = $this->rest->delete('Prefix_management/index', array(
            'ID' => $ID
        ));
        
        redirect('Prefix_management/index');
    }
}