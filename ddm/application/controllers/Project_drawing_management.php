<?php
 defined('BASEPATH') or exit();
class Project_drawing_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', site_url('Project_drawing_management/index'));
        $this->layout->view('project_draw/project_drawing_management', array(
            'data' => []
        ));
    }

    public function search()
    {
        if ($_POST) {
            $project_no = $this->input->post('project_no');
            $project_name = $this->rest->get("projects/project_name", array(
                'project_no' => $project_no
            ));
            
            if (! $project_name || $project_name->status !== TRUE) {
                $this->layout->view('project_draw/project_drawing_management', array(
                    'message' => $project_name->message == 1 ? $project_no . ' ' . lang('message_info_not_exist') : $project_no . '' . lang('message_exist_more'),
                    'modal_flag' => '1',
                    'project_id' => $project_no,
                    'data' => []
                ));
            } else {
                $pro_name = $project_name->data->TDM_DESCRIPTION;
                $object_id = $project_name->data->OBJECT_ID;
                $folder_info = $this->rest->get("projects/folder", array(
                    'object_id' => $object_id
                ));
                if (! $folder_info || $folder_info->status !== TRUE) {
                    $this->layout->view('project_draw/project_drawing_management', array(
                        'message' => lang('message_no_folder'),
                        'modal_flag' => '1',
                        'project_id' => $project_no
                    ));
                } else {
                    $folder_object_id = $folder_info->data->OBJECT_ID1;
                    // $projectname = $this->input->get('projectname');
                    $search_info = $this->rest->get("drawings/project_drawing", array(
                        'folder_object_id' => $folder_object_id
                    ));
                    if ($search_info->status === TRUE) {
                        $data = $search_info->data;
                    }
                    $email_array =array();
                    $count = 0;
                    $message = '';
                    foreach ($data as $value) {
                        if ($value->pdf == 'N' || $value->dwg == 'N') {
                            $count = $count + 1;
                            $message = $message . $value->TDM_ID . '|' . $value->pdf . '|' . $value->dwg . '%0A';

                            $firstChar = substr($value->TDM_ID, 0, 1);
            
                            if ($firstChar == 'M' || $firstChar == 'E') {
                                $code = '1' . substr($value->TDM_ID, 1);
                                $code =  substr($code, 0, 2).'20' . substr($code, 2);
                                $code = substr($code, 0, -4) . '.' . substr($code, -4, 1);

                            $response = $this->rest->get('Drawings/useremail', array(
                                'dwg_no' => $code,
                                'first_char' => $firstChar,
                            ));
                            if ($response->status === true) {
                                $email_info = $response->data[0];
                                
                                array_push($email_array,$email_info->USER_EMAIL);

                            }else{
                                array_push($email_array,config_item('to'));
                            }}
                        }
                    }
                    $email_array= array_unique($email_array);
                    $result_email = implode(";", $email_array);
                    
                    $email_message = "요청자 ID(Requester ID) : " . $this->session->user_login . "%0A요청자 이름(Requester Name) : " . $this->session->user_display_name . "%0APDF가 존재하지 않는 항목이 ".$count."개 발견되었습니다.%0A도면번호%0ADWG_NO|PDF_YN|DWG_YN%0A" . $message;
                    $this->layout->view('project_draw/project_drawing_management', array(
                        'data' => is_array($data) ? $data : [],
                        'pro_name' => $pro_name,
                        'project_id' => $project_no,
                        'user_email' => $result_email,
                        'modal_flag' => 2,
                        'folder_object_id' => $folder_object_id,
                        'email_message' => $email_message,
                        'count' => $count,
                        'keep' => true
                    ));
                }
            }
        } else {
            $this->layout->view('project_draw/project_drawing_management', array(
                'data' => []
            ));
        }
    }
}