<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UD_WD_DWG_DIST_SUP_Model extends MY_Model
{

    protected $table = 'UD_WD_DWG_DIST_SUP';

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
     * update data
     *
     * @param unknown $where            
     */
    public function update_cnt($where)
    {
        $this->db->set('HIDDEN', 'Y');
        $this->db->where($where);
        return $this->db->update($this->table);
    }
}