<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PDM_CG_LIB_Model extends MY_Model
{

    protected $table = 'PDM_CG_LIB';

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
     * get list mapping cg
     *
     * @param unknown $object_id            
     */
    public function get_list_mapping_cg($object_id)
    {
        $this->db->select('CG');
        $this->db->group_by('CG');
        $this->db->order_by('CG');
        return $this->db->get_where($this->table, array(
            'USER_OBJECT_ID_PUR' => $object_id
        ))->result_array();
    }

    public function get_exist_cg($cg_id)
    {
        $this->db->where('CG', $cg_id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}