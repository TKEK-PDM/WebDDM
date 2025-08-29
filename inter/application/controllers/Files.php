<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Files extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ftp');
        $this->load->library('file');
        $this->load->model('UD_WD_SUP_DOWN_model', 'sup_down');
    }

    /**
     * download single file
     *
     * @param string $file_name            
     * @param string $site            
     */
    public function index_get()
    {
        $file_name = $this->get('file_name');
        $site = $this->get('site');
        $para = $this->get('para');
        $file_data = $this->file->download_file($file_name, $site);
        if ($file_data) {
            $this->sup_down->add_sup_down($para);
            $response = create_response(TRUE, '', $file_data);
        } else {
            $response = create_response(FALSE, 'filed to download file');
        }
        $this->response($response);
    }

    /**
     * download multi-files
     *
     * @param array $file
     *            array(array('file_name'=>'filename','site'=>'site','version'=>'version'))
     */
    public function zip_get()
    {
        $file = $this->get('file');
        $para = $this->get('para');
        $file_data = $this->file->download_zip($file);
        
        if ($file_data) {
            $this->sup_down->add_sup_down_batch($para);
            $response = create_response(TRUE, '', $file_data);
        } else {
            $response = create_response(FALSE, 'filed to download file');
        }
        $this->response($response);
    }

    /**
     * check if the file exists
     *
     * @param string $file_name            
     * @param string $size            
     */
    public function exists_get()
    {
        $file_name = $this->get('file_name');
        $site = $this->get('site');
        $org_down = $this->get('org_down');
        if ($file_name && $site) {
            $exists = $this->file->file_exists($file_name, $site, $org_down);

            $response = create_response($exists);
        } else {
            $response = create_response(FALSE);
        }
        $this->response($response);
    }


    public function pdf_dwg_file_exists_get()
    {
        $file_name = $this->get('file_name');
        $site = $this->get('site');
        if ($file_name && $site) {
            $exists = $this->file->pdf_dwg_file_exists($file_name, $site);
            $response = create_response(TRUE,'',$exists);
        } else {
            $response = create_response(FALSE);
        }
        $this->response($response);
    }
}