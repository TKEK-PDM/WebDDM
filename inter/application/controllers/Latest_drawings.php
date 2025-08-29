<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Latest_drawings extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PDM_DOC_model', 'latest');
        $this->load->model('UD_WD_SUP_DOWN_model', 'sup_down');
        $this->load->model('UD_WD_DWG_DIST_SUP_model', 'dist_sup');
    }

    /**
     *
     * @param $uid login            
     *
     *
     */
    public function latest_get()
    {
        $uid = $this->get('uid');
        $user_login = $this->get('user_login');
        $result = $this->latest->get_latest_info($uid, $user_login);
        if ($result) {
            $response = create_response(TRUE, '', $result);
        } else {
            $response = create_response(FALSE, 'no data founded', '');
        }
        $this->response($response);
    }

    /**
     * save latest info
     */
    public function latest_post()
    {
        $object_id = $this->post('object_id');
        $sup_code = $this->post('sup_code');
        $class_id = $this->post('class_id');
        
        if ($this->dist_sup->update_cnt(array(
            'SUP_CODE' => $sup_code,
            'OBJECT_ID' => $object_id,
            'CLASS_ID' => $class_id
        ))) {
            $response = create_response(TRUE, 'save successfully');
        } else {
            $response = create_response(FALSE, 'save failed');
        }
        $this->response($response);
    }

    public function multi_hide_get()
    {
        $object_id_str = $this->get('object_id_str');
        $class_id_str = $this->get('class_id_str');
        $sup_code = $this->get('sup_code');
        $hide_count = 0;
        $object_id_arr = explode(',', $object_id_str);
        $class_id_arr = explode(',', $class_id_str);
        foreach ($object_id_arr as $key => $val) {
            if ($this->dist_sup->update_cnt(array(
                'SUP_CODE' => $sup_code,
                'OBJECT_ID' => $val,
                'CLASS_ID' => $class_id_arr[$key]
            ))) {
                $hide_count ++;
            }
        }
        $response = create_response(TRUE, '', array(
            "hide_count" => $hide_count
        ));
        $this->response($response);
    }
}