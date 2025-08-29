<?php
/**
 * Created by dhc.zack.quan.
 * User: dhc.zack.quan.
 * Date: 2016/6/17
 * Time: 13:45
 */
if (! function_exists('download')) {

    function download($file_dir, $file_name)
    {
        $file_dir = chop($file_dir);
        
        if ($file_dir != '') {
            $file_path = $file_dir;
            if (substr($file_dir, strlen($file_dir) - 1, strlen($file_dir)) != '/')
                $file_path .= '/';
            $file_path .= $file_name;
        } else
            $file_path = $file_name;
        if (! file_exists($file_path)) {
            echo "file not exists";
            return false;
        }
        
        $file_size = filesize($file_path);
//         header('Content-Type: application/octet-stream');
//         header("Content-Disposition: attachment; filename=\"" . $file_name . "\"");
//         header('Expires: 0');
//         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//         header('Pragma: public');
//         header('Content-Length: ' . filesize($file_path)); // $_REQUEST['file_size']
//         header('Set-Cookie: fileLoading=true');
        
        $fp = fopen($file_path, "r");
        $buffer_size = 1;
        $cur_pos = 0;
        
        while (! feof($fp) && $cur_pos < $file_size) {
            $buffer = fread($fp, $buffer_size);
            echo $buffer;
            $cur_pos += $buffer_size;
        }
        return true;
    }
}

if (! function_exists('create_response')) {

    /**
     * create the response infomation
     *
     * @param string $status            
     * @param string $message            
     * @param unknown $data            
     * @return string
     */
    function create_response($status = TRUE, $message = '', $data = array())
    {
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $data;
        return $response;
    }
}

if (! function_exists('create_uuid')) {

    /**
     * create GUID(UUID)
     *
     * @author zack.quan
     * @param string $prefix            
     * @return string
     */
    function create_uuid($prefix = "")
    {
        $str = md5(uniqid(mt_rand(), true));
        $uuid = substr($str, 0, 8) . '-';
        $uuid .= substr($str, 8, 4) . '-';
        $uuid .= substr($str, 12, 4) . '-';
        $uuid .= substr($str, 16, 4) . '-';
        $uuid .= substr($str, 20, 12);
        return $prefix . $uuid;
    }
}

if (! function_exists('pr')) {

    /**
     *
     * output format
     *
     * @author zack.quan
     * @param anyType $data            
     * @param string $exit            
     */
    function pr($data, $exit = true)
    {
        echo "<pre>";
        print_r($data);
        $exit ? exit() : "";
    }
}