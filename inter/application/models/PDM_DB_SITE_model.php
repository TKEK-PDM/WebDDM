<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PDM_DB_SITE_Model extends MY_Model
{

    protected $table = 'PDM_DB_SITE';

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

    public function get_site_name($object_id)
    {
        $this->db->where('OBJECT_ID', $object_id);
        return $this->db->get($this->table)->row_array();
    }
}