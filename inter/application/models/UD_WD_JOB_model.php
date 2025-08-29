<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UD_WD_JOB_Model extends MY_Model
{

    protected $table = 'UD_WD_JOB';

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

    /**
     * get dwg no by job code and part code
     *
     * @param String $job1_code            
     * @param String $job2_code            
     * @param unknown $part_code            
     * @return array
     */
    public function get_dwg_no_by_jobcode_and_partcode($job1_code, $job2_code, $part_code)
    {
        $where = array();
        if ($job1_code) {
            $where['JOB1_CODE'] = $job1_code;
        }
        if ($job2_code) {
            $where['JOB2_CODE'] = $job2_code;
        } 
        if ($part_code) {
            $where['PART_CODE'] = $part_code;
        }
        return $this->db->select('DWG_NO')->get_where($this->table, $where)->row_array();
    }

    /**
     * add jobd data
     *
     * @param unknown $data            
     */
    public function add($data)
    {
        return $this->db->set($data)->insert($this->table);
    }

    /**
     * update table
     * @param unknown $where
     * @param unknown $data
     */
    public function update($where, $data)
    {
        $this->db->where($where);
        return $this->db->set($data)->update($this->table);
    }
}