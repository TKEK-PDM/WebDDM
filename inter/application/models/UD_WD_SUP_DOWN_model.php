<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UD_WD_SUP_DOWN_Model extends MY_Model
{

    protected $table = 'UD_WD_SUP_DOWN';

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
        $order_by = "DOWN_D , DOWN_T";
        $this->db->select($select)
            ->where($where)
            ->order_by($order_by)
            ->limit($limit, $offset);
        return $this->db->get($this->table)->result_array();
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
    public function get_by_condition($USER_TYPE, $DWG_NO, $USER_ID, $USER_NAME, $DATE, $FROM, $TO)
    {
        $param = array();
        $where = "";
        if (! empty($USER_TYPE) && $USER_TYPE != 'A') {
            $where = $where . " AND USER_TYPE = ?";
            $param[] = $USER_TYPE;
        }
        
        if (! empty($DWG_NO)) {
            $where = $where . " AND A.TDM_ID LIKE '%" . $DWG_NO . "%'";
        }
        if (! empty($USER_ID)) {
            $where = $where . " AND USER_ID LIKE'%" . $USER_ID . "%'";
        }
        if (! empty($USER_NAME)) {
            $where = $where . " AND USER_NAME LIKE'%" . $USER_NAME . "%'";
        }
        if ($DATE == 1) {
            // today
            $where = $where . " AND DOWN_D = to_char(sysdate, 'yyyymmdd')";
        } elseif ($DATE == 2) {
            // one week before
            $where = $where . " AND DOWN_D >= ? AND DOWN_D <= ?";
            $param[] = date("Ymd", strtotime("-1 week"));
            $param[] = date("Ymd");
        } elseif ($DATE == 3) {
            // manula input
            if (! empty($FROM)) {
                $where = $where . " AND DOWN_D >= ?";
                $param[] = $FROM;
            }
            if (! empty($TO)) {
                $where = $where . " AND DOWN_D <= ?";
                $param[] = $TO;
            }
        }
        
        $strsql = "SELECT A.*,B.TDM_DESCRIPTION,B.CN_LOCAL_DESCRIPTION
            FROM UD_WD_SUP_DOWN A,PDM_DOC B
            WHERE A.TDM_ID = B.TDM_ID 
            AND decode(a.revision,'00',' ',a.revision) = b.revision
            $where
            ORDER BY
            DOWN_D ,
            DOWN_T

            ";
        return $this->db->query($strsql, $param)->result_array();
    }

    /**
     *
     * get information
     *
     * @param unknown $class_id            
     * @param unknown $dwg_no            
     * @param unknown $sup_code            
     */
    public function get_info($class_id, $dwg_no, $sup_code)
    {
        return $this->db->order_by('OBJECT_ID DESC')
            ->get_where($this->table, array(
            'CLASS_ID' => $class_id,
            'TDM_ID' => $dwg_no,
            'SUP_CODE' => $sup_code
        ))
            ->row_array();
    }

    /**
     * get download info
     *
     * @param unknown $object_id            
     * @param unknown $class_id            
     */
    public function get_download_info($object_id, $class_id)
    {
        $sql = "SELECT DOWN_D, DOWN_T FROM ( SELECT * FROM UD_WD_SUP_DOWN WHERE OBJECT_ID = ? AND CLASS_ID = ? ORDER BY DOWN_D DESC, DOWN_T DESC) WHERE ROWNUM = 1";
        return $this->db->query($sql, array(
            $object_id,
            $class_id
        ))->row_array();
    }

    /**
     * get download info by sup code
     *
     * @param unknown $object_id            
     * @param unknown $class_id            
     * @param unknown $sup_code            
     */
    public function get_download_info_by_sup_code($tdm_id, $class_id, $sup_code)
    {
        $sql = "SELECT DOWN_D, DOWN_T FROM ( SELECT * FROM UD_WD_SUP_DOWN WHERE TDM_ID = ? AND CLASS_ID = ? AND SUP_CODE = ? ORDER BY DOWN_D DESC, DOWN_T DESC) WHERE ROWNUM = 1";
        return $this->db->query($sql, array(
            $tdm_id,
            $class_id,
            $sup_code
        ))->row_array();
    }

    /**
     * get download total
     *
     * @param unknown $object_id            
     * @param unknown $class_id            
     * @param unknown $sup_code            
     */
    public function get_download_total_by_sup_code($tdm_id, $class_id, $sup_code)
    {
        $sql = "SELECT count(*) total FROM UD_WD_SUP_DOWN WHERE TDM_ID = ? AND CLASS_ID = ? AND SUP_CODE = ?";
        return $this->db->query($sql, array(
            $tdm_id,
            $class_id,
            $sup_code
        ))->row_array();
    }

    /**
     * insert data
     *
     * @param unknown $params            
     */
    public function add_sup_down($params)
    {
        return $this->db->set($params)->insert($this->table);
    }

    public function add_sup_down_batch($params)
    {
        return $this->db->insert_batch($this->table, $params);
    }
}