<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_FTP extends CI_FTP
{

    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    /**
     * get file contents from a remote server
     *
     * @param string $rempath            
     * @param string $locpath            
     * @param string $mode            
     * @return string || boolean
     */
    public function ftp_get_contents($rempath, $mode = 'auto')
    {
        if (! $this->_is_conn()) {
            return FALSE;
        }
        
        if ($mode === 'auto') {
            $ext = $this->_getext($rempath);
            $mode = $this->_settype($ext);
        }
        
        $mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;
        $tempHandle = fopen('php://temp', 'r+');
        if (@ftp_fget($this->conn_id, $tempHandle, $rempath, $mode)) {
            rewind($tempHandle);
            return stream_get_contents($tempHandle);
        } else {
            $this->_error('ftp_unable_to_download');
            return false;
        }
    }

    /**
     * 
     * get ftp file size
     * 
     * @param unknown $file
     * @return number|boolean
     */
    public function ftp_get_fize($file)
    {
        ftp_raw($this->conn_id,'OPTS UTF8 ON');
        $res = ftp_size($this->conn_id, $file);
    
        log_message('info','file : '.$file);
        log_message('info','res : '.$res);
        //return $res;exit;
        
        if ($res != - 1) {
            return $res;
        } else {
            return FALSE;
        }
    }
}