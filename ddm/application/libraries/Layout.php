<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layout
{

    protected $CI;

    protected $_layout;

    public function __construct($layout = 'layout')
    {
        $this->CI = &get_instance();
        $this->_layout = $layout;
    }

    public function set_layout($layout)
    {
        $this->_layout = $layout;
    }

    public function view($view, $data = NULL, $return = FALSE)
    {
        $data['content'] = $this->CI->load->view($view, $data, TRUE);
        if ($return) {
            return $this->CI->load->view($this->_layout, $data, TRUE);
        } else {
            $this->CI->load->view($this->_layout, $data);
        }
    }
}