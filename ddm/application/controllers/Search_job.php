<?php
defined('BASEPATH') or exit();

class Search_job extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Search_job/index'));
        if ($_POST) {
            $job1_code = $this->input->post('job1_code');
            $job2_code = $this->input->post('job2_code');
            $clas_kind = $this->input->post('clas_kind');
            $level = $this->input->post('level');
            
            $response = $this->rest->get('Drawings/job', array(
                'job1_code' => $job1_code,
                'job2_code' => $job2_code,
                'clas_kind' => $clas_kind,
                'user_id' => 'SAPXI',
                'sup_code' => $this->session->uid,
                'level' => $level,
                'user_type' => $this->session->user_role ? $this->session->user_role : 1
            ));
            if ($response->status === TRUE) {
                $result = $response->data;
                // load comment sup mapping page
                $assign_supplier_page = $this->load->view('assign_supplier', "", true);
                $keep = TRUE;
            } else {
                $info = array(
                    'job1_code' => $job1_code,
                    'job2_code' => $job2_code,
                    'clas_kind' => $clas_kind,
                    'level' => $level
                );
            }
        }
        $this->layout->view('search_job/index', array(
            'info' => $info ? (object) $info : $result->info,
            'data' => is_array($result->data) ? $result->data : [],
            'assign_supplier_page' => $assign_supplier_page,
            'keep' => $keep
        ));
    }

    public function sup_down($dwg_no)
    {
        if ($dwg_no) {
            $response = $this->rest->get('Drawings/sup_downs', array(
                'dwg_no' => $dwg_no
            ));
            if ($response->status === TRUE) {
                $result = $response->data;
                $data = end(end($result));
                echo json_encode(array(
                    'status' => TRUE,
                    'message' => '',
                    'data' => $data
                ));
                exit();
            } else {
                echo json_encode($response);
                exit();
            }
        }
    }

    public function check_files()
    {
        $tdm_id = $this->input->post('tdm_id');
        $arr_result = array();
        foreach ($tdm_id as $key => $val) {
            if (! empty($val)) {
                $file_exists = $this->rest->get('Drawings/pdf_dwg_file_exists', array(
                    'tdm_id' => $val
                ));
                if ($file_exists->status === TRUE) {
                    $arr_result[$val] = $file_exists->data;
                }
            }
        }
        echo json_encode($arr_result);
        exit();
    }

    public function update_dwg_no()
    {
        if ($this->input->is_ajax_request()) {
            $job1_code = $this->input->post('job1_code');
            $job2_code = $this->input->post('job2_code');
            $part_code = $this->input->post('part_code');
            $dwg_no = $this->input->post('dwg_no');
            $old_dwg_no = $this->input->post('old_dwg_no');
            $user_id = $this->session->user_login;
            $response = $this->rest->put('Drawings/job', array(
                'job1_code' => $job1_code,
                'job2_code' => $job2_code,
                'part_code' => $part_code,
                'dwg_no' => $dwg_no,
                'old_dwg_no' => $old_dwg_no,
                'user_id' => $user_id
            ));
            if ($response->status === TRUE) {
                echo 1;
                exit();
            } else {
                echo 0;
                exit();
            }
        }
    }
}