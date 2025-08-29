<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PREFIXES_Model extends MY_Model
{

    protected $table = 'PREFIXES';

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
    
    public function insert_prefix($prefix) {
        $sql = "INSERT INTO PREFIXES (PREFIX) VALUES (?)";

        return $this->db->query($sql, array(
            $prefix
        ));
    }

    public function delete_prefix($ID) {
        $sql = "DELETE FROM PREFIXES WHERE ID IN (" . implode(",", $ID) . ")";
        return $this->db->query($sql);
    }
}