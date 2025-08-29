<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TIS_PROJECT_Model extends MY_Model
{

    protected $table = 'TIS_PROJECT';

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
     * get project info by project code
     * 
     * @param string $project_code            
     */
    public function get_by_project_code($project_code)
    {
        return $this->db->get_where($this->table, array(
            'PROJ_CODE' => $project_code
        ))->row_array();
    }

    /**
     * get project info by project name
     * 
     * @param string $project_name            
     */
    public function get_by_project_name($project_name)
    {
        return $this->db->get_where($this->table, array(
            'PROJ_NAME' => $project_name
        ))->row_array();
    }
}