<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PDM_PROJECT_Model extends MY_Model
{

    protected $table = 'PDM_PROJECT';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get data
     *
     * @param array $where            
     * @param int $limit            
     * @param int $offset            
     * @param string $order_by            
     * @return array()
     */
    public function get($select = "*", $where = array(), $limit = NULL, $offset = NULL, $order_by = NULL)
    {
        $this->db->select($select)
            ->where($where)
            ->order_by($order_by)
            ->limit($limit, $offset);
        return $this->db->get($this->table)->result_array();
    }

    function get_project_name($data)
    {
        /*
         * $array = array(
         * 'CN_PROJECT_NO' => $data,
         * 'SUBSTR(CN_ORDER_TYPE, 4, 1)' => '3'
         * );
         */
        $where = "UPPER(CN_PROJECT_NO) = '" . $data . "' and SUBSTR(CN_ORDER_TYPE, 4, 1) = 3";
        $this->db->select('OBJECT_ID, TDM_DESCRIPTION');
        $this->db->from('PDM_PROJECT');
        $this->db->where($where);
        // $this->db->where('SUBSTR(CN_ORDER_TYPE, 4, 1)' , '3');
        return $this->db->get()->result_array();
    }
}