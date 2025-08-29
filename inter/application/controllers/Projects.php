<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PDM_DOC_PRJ_REL_model', 'pdpr');
        $this->load->model('PDM_PROJECT_model', 'project');
    }

    public function folder_get()
    {
        $object_id = $this->get('object_id');
        $result = $this->pdpr->get_folder_info($object_id);
        if (count($result) == 0) {
            $response = create_response(FALSE, 'There is no folder in this project.', $result);
        } else {
            $response = create_response(TRUE, '', $result[0]);
        }
        $this->response($response);
    }

    public function project_name_get()
    {
        $project_no = substr($this->get('project_no'), 0, 1) == 1 ? strtoupper($this->get('project_no')) : "1" . strtoupper($this->get('project_no'));
        $result = $this->project->get_project_name($project_no);
        if (count($result) == 0) {
            $response = create_response(FALSE, 1, $result);
        } elseif (count($result) > 1) {
            $response = create_response(FALSE, 2, $result);
        } else {
            $response = create_response(TRUE, '', $result[0]);
        }
        $this->response($response);
    }
}