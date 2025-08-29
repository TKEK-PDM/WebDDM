<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PDM_DOC_PRJ_REL_Model extends MY_Model
{

    protected $table = 'PDM_DOC_PRJ_REL';

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

    function get_folder_info($data)
    {
        $where = "OBJECT_ID2 = '" . $data . "' AND CLASS_ID2 = 459 AND CLASS_ID1 = 20";
        $this->db->select('OBJECT_ID1');
        $this->db->from('PDM_DOC_PRJ_REL');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }
}