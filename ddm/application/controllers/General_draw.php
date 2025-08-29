<?php
defined('BASEPATH') or exit();

class General_draw extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $ismatch = false;
        $isemail =false;
        $isgeneraldwg = false;
        $pattern = $this->pattern();
        $this->session->set_userdata('menu_url', base_url('general_draw/index'));
        $search_count = 0;
        $item_count = 0;
        $request_dwg_arr = array();
        $result_dwg_arr = array();
        $no_exist_dwg_arr = array();
        if ($_POST) {
            $revision_status = $this->input->post('revision_status');
            $dwg_no = strtoupper($this->input->post('dwg_no'));
            $uid = $this->session->uid;
            $dwg_no_arr = explode("\n", trim($dwg_no));
            foreach ($dwg_no_arr as $k => $v) {
                if (isset($v) && !empty($v)) {
                    $request_dwg_arr[] = trim($v);
                }
            }
            foreach ($request_dwg_arr as $key => $val) {
                $arr_dwg_no[] = trim($val);
            
                //$pattern = config_item('check_file_name');
                preg_match($pattern, $val, $matches);
                if($matches){
                    $ismatch = true;
                }
            }


            $response = $this->rest->get('Drawings/general_drawing', array(
                'dwg_no' => $arr_dwg_no,
                'revision_status' => $revision_status,
                'uid' => $uid
            ));

            if ($response->status === true) {
                $result = $response->data;
                $search_count = 1;
                $keep = true;
            }
            $request_dwg_str = $dwg_no;
        }



        if($this->session->user_type == 'supplier' && $ismatch){
                    echo "<script>
                    alert('" . lang('message_drawing_invalid_user') . "');
                    window.location.href = '" . site_url('general_draw/index') . "'; 
                    </script>";
                    //$this->layout->view('general_draw/index'); 
        } else{
            foreach ($result as $key => $val) {
                $result_dwg_arr[] = $val->TDM_ID;
                $item_count++;
            }

            $no_exist_dwg_arr = array_diff($request_dwg_arr, $result_dwg_arr);
            $email_array =array();

            foreach ($result_dwg_arr as $key => $val){

                if(strpos($val, $result_dwg_arr[0]) === 0){
                    $no_exist_dwg_arr =  array();
                }
            }
            foreach ($no_exist_dwg_arr as $key => $val){
                $firstChar = substr($val, 0, 1);
                
                if ($firstChar == 'M' || $firstChar == 'E') {
                    $code = '1' . substr($val, 1);
                    $code =  substr($code, 0, 2).'20' . substr($code, 2);
                    $code = substr($code, 0, -4) . '.' . substr($code, -4, 1);
                
                $response = $this->rest->get('Drawings/useremail', array(
                    'dwg_no' => $code,
                    'first_char' => $firstChar,
                ));
                if ($response->status === true) {
                    $email_info = $response->data[0];
                    
                    array_push($email_array,$email_info->USER_EMAIL);

                    if(!empty($email_info)){
                        $isemail = true;
                    }
                }else{
                    array_push($email_array,config_item('to'));
                }
                }
                else{
                    $isgeneraldwg = true;
                    array_push($email_array,config_item('to'));
                }

            }
            $email_array= array_unique($email_array);
            $result_email = implode(";", $email_array);

            $no_exist_dwg_str = implode('<br>', $no_exist_dwg_arr);
            $email_dwg_email = implode('%0A', $no_exist_dwg_arr);

            // load comment sup mapping page
            $assign_supplier_page = $this->load->view('assign_supplier', "", true);
        }

        if(!$result || $ismatch){

            if($isemail){
                if(!$isgeneraldwg){
                    $this->layout->view('general_draw/index', array(
                        'user_email' => $result_email,
                        'email_dwg' => $no_exist_dwg_str,
                        'email_dwg_email' => $email_dwg_email,
                        'assign_supplier_page' => $assign_supplier_page,
                        'request_dwg_str' => $request_dwg_str,
                        'keep' => $keep,
                        'data' => [],
                    ));
                }
                else{
                    $this->layout->view('general_draw/index', array(
                        'isgeneraldwg' => $isgeneraldwg,
                        'user_email' => $result_email,
                        'email_dwg' => $no_exist_dwg_str,
                        'email_dwg_email' => $email_dwg_email,
                        'assign_supplier_page' => $assign_supplier_page,
                        'request_dwg_str' => $request_dwg_str,
                        'keep' => $keep,
                        'data' => [],
                    ));
                }
            }
            else if($result && $ismatch && $this->session->user_type != 'supplier'){
                $this->layout->view('general_draw/index', array(
                    'data' => is_array($result) ? $result : [],
                    'search_count' => $search_count,
                    'item_count' => $item_count,
                    'email_dwg' => $no_exist_dwg_str,
                    'email_dwg_email' => $email_dwg_email,
                    'assign_supplier_page' => $assign_supplier_page,
                    'request_dwg_str' => $request_dwg_str,
                    'keep' => $keep
                ));
            }
            else{
                
                $this->layout->view('general_draw/index', array(
                    'email_dwg' => $no_exist_dwg_str,
                    'email_dwg_email' => $email_dwg_email,
                    'assign_supplier_page' => $assign_supplier_page,
                    'request_dwg_str' => $request_dwg_str,
                    'keep' => $keep,
                    'data' => [],
                )); 
            }
        }
        else{

            $this->layout->view('general_draw/index', array(
                'data' => is_array($result) ? $result : [],
                'search_count' => $search_count,
                'item_count' => $item_count,
                'email_dwg' => $no_exist_dwg_str,
                'email_dwg_email' => $email_dwg_email,
                'assign_supplier_page' => $assign_supplier_page,
                'request_dwg_str' => $request_dwg_str,
                'keep' => $keep
            ));
        }

    }

    public function cg_list()
    {
        $this->session->set_userdata('menu_url', base_url('general_draw/index'));
        $TDM_ID = $this->input->get_post('TDM_ID');

        $response = $this->rest->get('Drawings/cg_list', array(
            'TDM_ID' => $TDM_ID
        ));
        if ($response->status === true) {
            $result = $response->data;
        }
        echo $this->load->view('general_draw/cg_list', array(
            'data' => $result
        ), true);
        exit();
    }

    public function get_sup_name()
    {
        $sup_code = $this->input->post('sup_code');
        $sup_response = $this->rest->get("Drawings/sup_name", array(
            'sup_code' => $sup_code
        ));

        $cg_response = $this->rest->get("Drawings/cg_count", array(
            'sup_code' => $sup_code
        ));

        if ($sup_response->status === true) {
            $sup_name = $sup_response->data;
        }
        if ($cg_response->status === true) {
            $cg_count = $cg_response->data;
        }
        echo $sup_name . "," . $cg_count;
        exit();
    }

    public function easy_assign()
    {
        $sup_code = $this->input->post('sup_code');
        $dwg_no_str = $this->input->post('dwg_no_str');
        $uid = $this->session->uid;
        $response = $this->rest->get("Drawings/easy_assign", array(
            'dwg_no_str' => $dwg_no_str,
            'sup_code' => $sup_code,
            'uid' => $uid
        ));
        if ($response->status === true) {
            $result = $response->data;
        }
        echo $result->easy_count;
        exit();
    }

    public function pattern()
    {
        $prefix_info = $this->rest->get('Prefix_management/prefix/');
        if ($prefix_info->status === TRUE) {
            $data = $prefix_info->data;
            $prefixes = array_map(function($item) {
                return $item->PREFIX; 
            }, $data);

            $unique_prefixes = array_unique($prefixes);

            $pattern = '/^(' . implode('|', $unique_prefixes) . ')/';
            return $pattern;
        }else {
            return '/^$/'; 
        }    
    }
}