<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TIS_DJOB_Model extends MY_Model
{

    protected $table = 'TIS_DJOB';

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
    
    /**
     * get job info by job code
     *
     * @param unknown $code1
     * @param unknown $code2
     */
    public function get_by_job_code($code1, $code2)
    {
        $where = array();
        if ($code1) {
            $where['JOB1_CODE'] = $code1;
        }
        if ($code2) {
            $where['JOB2_CODE'] = $code2;
        }
        return $this->db->get_where($this->table, $where)->row_array();
    }
}