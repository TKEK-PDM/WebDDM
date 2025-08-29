<?php
defined('BASEPATH') or exit();

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation', 'input');
        $language = $this->input->post('language')?$this->input->post('language'):$_COOKIE['language'];
        $user_type = $this->input->post('user_type')?$this->input->post('user_type'):$_COOKIE['user_type'];
        if (empty($language)) {
            $language = 'korean';
            $user_type = 'supplier';
        }
        $_COOKIE['language'] = $language;
        $_COOKIE['user_type'] = $user_type;
        setcookie('language',$language,time()+3600*24*30);
        setcookie('user_type',$user_type,time()+3600*24*30);
        $session_data = array(
            'language' => $language
        );
        $this->session->set_userdata($session_data);
        $idiom = $this->input->post('language') ? $this->input->post('language') : $this->session->language;
        $this->lang->load('common', $idiom);
        $this->load->helper('language');
    }

    public function switch_language()
    {
        $this->load->view('login');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            $data['username'] = $this->input->post('username');
            $data['password'] = md5($this->input->post('password'));
            $data['email'] = $this->input->post('email');
            $this->user->add($data);
            redirect('welcome/test');
        }
    }

    public function login()
    {
        if ($this->session->username || $this->session->uid) {
            redirect('search_job');
            exit();
        }
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => lang("message_login_userid_check")
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => lang("message_login_password_check")
        ));
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            if ($_POST) {
                $responseEmail = $this->rest->get('Internal_users_management/email', array(
                    'user_id' => $this->input->post('username')
                ));
                if ($responseEmail->status === TRUE) {
                    $result_email = $responseEmail->data[0];
                }

                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $language = $this->input->post('language');
                $user_type = $this->input->post('user_type');
                $user_email = $result_email->USER_EMAIL;
                $user_email_id = explode('@',$user_email);
                
                $user_info = $this->rest->get("users", array(
                    'username' => $username,
                    'password' => $password,
                    'user_type' => $user_type
                ));
                if (! $user_info || $user_info->status !== TRUE) {
                    if ($user_info->message == "INCONRRECT") {
                        $data['message'] = lang("message_login_info_incorrect");
                    } elseif ($user_info->message == "INVALID") {
                        $data['message'] = lang("message_login_invalid_user");
                    } else {
                        $data['message'] = lang("message_login_no_user_found");
                    }
                    $this->load->view('login', $data);
                } else {
                    $session_data = array(
                        'language' => $language,
                        'user_login' => $username,
                        'username' => $username . " / " . $user_info->data->username,
                        'user_display_name' => $user_info->data->username == " " ? $user_email_id[0] : $user_info->data->username,
                        'user_role' => $user_info->data->ROLE_OBJECT_ID,
                        'user_type' => $user_type,
                        'user_type_brief' => $user_type == "supplier" ? "S" : "I",
                        'uid' => strpos(strtoupper($username), 'V') === 0 ? substr($username, 1) : $username,
                        'logintime' => time(),
                        'object_id' => $user_info->data->OBJECT_ID
                    );
                    $this->session->set_userdata($session_data);
                    $this->session->set_userdata('menu_url', base_url('search_job/index'));
                    redirect('search_job/index');
                }
            }
        }
    }

    public function logout()
    {
        $this->rest->post("users/logout", array(
            'user_id' => $this->session->user_login,
            'user_type_brief' => $this->session->user_type_brief,
            'sup_code' => $this->session->uid,
            'user_name' => $this->session->user_display_name
        ));
        
        $this->session->sess_destroy();
        redirect('/');
    }
}