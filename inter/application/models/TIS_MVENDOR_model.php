<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TIS_MVENDOR_Model extends MY_Model
{

    protected $table = 'TIS_MVENDOR';

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
     * get sup names by sup codes
     *
     * @param array $sup_codes            
     * @return string || boolean
     */
    public function get_sup_names(array $sup_codes)
    {
        if (! empty($sup_codes)) {
            foreach ($sup_codes as $key => $val) {
                $rs = $this->db->select('SUP_NAME,SUP_CODE')
                    ->get_where($this->table, array(
                    'SUP_CODE' => $val['SUP_CODE']
                ))
                    ->row_array();
                if (! $rs) {
                    $result[] = $val['SUP_CODE'];
                }
            }
            if (empty($result)) {
                return true;
            } else {
                return implode(',', $result);
            }
        }
        return FALSE;
    }
    public function get_sup_names_by_code(array $sup_codes)
    {
        if (! empty($sup_codes)) {
            foreach ($sup_codes as $key => $val) {
                $rs = $this->db->select('SUP_NAME')
                ->get_where($this->table, array(
                    'SUP_CODE' => $val['SUP_CODE']
                ))
                ->row_array();
                $result[] = $rs['SUP_NAME'];
            }
            return implode(',', $result);
        }
        return FALSE;
    }
}