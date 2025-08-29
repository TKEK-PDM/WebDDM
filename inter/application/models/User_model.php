<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends MY_Model
{

    protected $table = 'PDM_USERS';

    public function add($data)
    {
        $this->db->insert($this->table, $data);
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
    public function get($where = array(), $limit = NULL, $offset = NULL, $order_by = NULL)
    {
        $this->db->where($where)
            ->order_by($order_by)
            ->limit($limit, $offset);
        return $this->db->get($this->table)->result_array();
    }

    /**
     *
     * get user by username
     *
     * @param unknown $username            
     */
    public function get_user_by_username($username)
    {
        return $this->db->get_where($this->table, array(
            'LOGIN' => $username
        ))->row_array();
    }

    /**
     * get supplier by username
     *
     * @param unknown $username            
     */
    public function get_supplier_by_username($username)
    {
        $this->db->from('TIS_APASSWORD');
        $this->db->join('TIS_MVENDOR', "REPLACE (EMP_ID, 'V', '') = TIS_MVENDOR.SUP_CODE");
        $this->db->where(array(
            'EMP_ID' => $username
        ));
        return $this->db->get()->row_array();
    }
}