<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UD_WD_LOG_HIST_model extends MY_Model
{

    protected $table = 'UD_WD_LOG_HIST';

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
        $order_by = "ACTION_DATE,ACTION_TIME";
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
    public function get_by_condition($USER_TYPE, $USER_ID, $USER_NAME, $DATE, $FROM, $TO)
    {
        $param = array();
        $where = "";
        if (! empty($USER_TYPE) && $USER_TYPE != 'A') {
            $where = $where . " AND USER_TYPE = ?";
            $param[] = $USER_TYPE;
        }
        
        if (! empty($USER_ID)) {
            $where = $where . " AND USER_ID LIKE '%" . $USER_ID . "%'";
        }
        
        if (! empty($USER_NAME)) {
            $where = $where . " AND USER_NAME LIKE '%" . $USER_NAME . "%'";
        }
        
        if ($DATE == 1) {
            // today
            $where = $where . " AND ACTION_DATE = to_char(sysdate, 'yyyymmdd')";
        } elseif ($DATE == 2) {
            // one week before
            $where = $where . " AND ACTION_DATE >= ? AND ACTION_DATE <= ?";
            $param[] = date("Ymd", strtotime("-1 week"));
            $param[] = date("Ymd");
        } elseif ($DATE == 3) {
            if (! empty($FROM)) {
                $where = $where . " AND ACTION_DATE >= ?";
                $param[] = $FROM;
            }
            if (! empty($TO)) {
                $where = $where . " AND ACTION_DATE <= ?";
                $param[] = $TO;
            }
        }
        
        $strsql = "SELECT *
        FROM UD_WD_LOG_HIST
        WHERE 1 = 1 $where
        ORDER BY
        ACTION_DATE ,
        ACTION_TIME

        ";
        return $this->db->query($strsql, $param)->result_array();
    }

    /**
     * add log data
     */
    /**
     * insert data
     *
     * @param unknown $params            
     */
    public function add_log($params)
    {
        $sql = "insert into UD_WD_LOG_HIST( SEQ,
              USER_TYPE,
              USER_ID,
              SUP_CODE,
              USER_NAME,
              ACTION_TYPE,
              ACTION_DATE,
              ACTION_TIME)
              values (UD_WD_LOG_HISTORY_SEQ.NEXTVAL,?,?,?,?,?,to_char(sysdate,'yyyymmdd'),to_char(sysdate,'HHMMSS'))";
        return $this->db->query($sql, $params);
    }
}