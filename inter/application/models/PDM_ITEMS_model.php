<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PDM_ITEMS_Model extends MY_Model
{

    protected $table = 'PDM_ITEMS';

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
     */
    public function get_cg_general_info($dwg_no)
    {
        $sql = "SELECT DBMS_LOB.SUBSTR(CG, 500) AS CG, CG_QTY FROM 
                (SELECT wm_concat(DISTINCT C.T) AS CG,
                  COUNT(DISTINCT C.T) AS CG_QTY
                FROM
                  (SELECT
                    (SELECT CG_CODE FROM PDM_DPC_CG WHERE PART_CODE = TDM_ID
                    ) AS T
                  FROM PDM_ITEMS
                  WHERE CN_DRAWING_NUMBER LIKE '" . $dwg_no . "%'
                  ORDER BY T
                  ) C)";
        return $this->db->query($sql)->row_array();
    }
}