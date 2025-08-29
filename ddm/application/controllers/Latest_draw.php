<?php
defined('BASEPATH') or exit();

class Latest_draw extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('latest_draw/index'));
        $uid = $this->session->uid;
        $user_login = $this->session->user_login;
        $latest_drawing_info = $this->rest->get("latest_drawings/latest", array(
            "uid" => $uid,
            'user_login' => $user_login
        ));
        if ($latest_drawing_info->status === TRUE) {
            $data = $latest_drawing_info->data;
        }
        $this->layout->view('latest_draw/index', array(
            'data' => $data
        ));
    }

    public function save()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->library('form_validation');
            $this->form_validation->set_data($this->input->post());
            $this->form_validation->set_rules('object_id', 'object_id', 'required');
            $this->form_validation->set_rules('sup_code', 'sup_code', 'required');
            $this->form_validation->set_rules('class_id', 'class_id', 'required');
            if ($this->form_validation->run()) {
                $response = $this->rest->post("latest_drawings/latest", $this->input->post());
                if ($response->status === TRUE) {
                    echo 'save successfully';
                    exit();
                } else {
                    echo 'save failed';
                    exit();
                }
            } else {
                echo $this->form_validation->error_string();
                exit();
            }
        }
    }

    public function multi_hide()
    {
        $object_id_str = $this->input->post('object_id_str');
        $class_id_str = $this->input->post('class_id_str');
        $sup_code = $this->session->uid;
        
        $response = $this->rest->get('latest_drawings/multi_hide', array(
            'object_id_str' => $object_id_str,
            'class_id_str' => $class_id_str,
            'sup_code' => $sup_code
        ));
        if ($response->status === TRUE) {
            $data = $response->data;
        }
    }
}