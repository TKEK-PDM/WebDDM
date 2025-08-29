<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PDM_DPC_CG_Model extends MY_Model
{

    protected $table = 'PDM_DPC_CG';

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
     *
     * @param string $dwg_no            
     */
    public function get_CG_list_info($dwg_no)
    {
        $sql = "SELECT (SELECT CG_CODE FROM PDM_DPC_CG WHERE PART_CODE = TDM_ID) AS CG,
                      TDM_ID AS PART_CODE,
                      TDM_DESCRIPTION AS PART_NAME,
                      CN_DRAWING_NUMBER AS DRAW_CODE, (SELECT TDM_PREFIX FROM PDM_DB_SITE WHERE OBJECT_ID = TDM_SITE_ID) AS SITE_NAME
                FROM PDM_ITEMS
                    WHERE CN_DRAWING_NUMBER LIKE '" . $dwg_no . "%'
                        AND TDM_SITE_ID = '402653188'
                        ORDER BY CG, PART_NAME";
        return $this->db->query($sql)->result_array();
    }
}