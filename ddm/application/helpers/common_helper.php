<?php
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

if (! function_exists('create_orders')) {

    /**
     * create the order by string for dataTables ajax search
     *
     * @author zack.quan
     * @param array $orders            
     * @param array $columns            
     * @return string
     */
    function create_orders(array $orders, array $columns)
    {
        $return = array();
        foreach ($orders as $key => $val) {
            if ($columns[$val['column']]) {
                $return[] = $columns[$val['column']] . " " . $val['dir'];
            }
        }
        return implode(',', $return);
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

if (! function_exists('_get_destination_name')) {

    function get_destination_name($file_name, $version)
    {
        $file_name = urldecode($file_name);
        $ext = get_ext($file_name);
        return substr($file_name, 0,  strrpos($file_name, '_',(strrpos($file_name, '_')-strlen($file_name)-1))) . '_' . $version . '.' . $ext;
    }
}

if (! function_exists('get_ext')) {

    function get_ext($filename)
    {
        return (($dot = strrpos($filename, '.')) === FALSE) ? FALSE : substr($filename, $dot + 1);
    }
}

function download($file_name, $size, $content)
{
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=\"" . $file_name . "\"");
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . $size); // $_REQUEST['file_size']
    header('Set-Cookie: fileLoading=true');
    echo $content;
}