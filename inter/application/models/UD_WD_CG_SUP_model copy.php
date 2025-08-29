<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UD_WD_CG_SUP_Model extends MY_Model
{

    protected $table = 'UD_WD_CG_SUP';

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
     * @param string $sup_code            
     */
    public function get_cg_by_sup_code($sup_code)
    {
        return $this->db->get_where($this->table, array(
            'SUP_CODE' => $sup_code
        ))->row_array();
    }

    public function get_sup_code_by_cg($cg)
    {
        $this->db->select('SUP_CODE');
        if (is_array($cg)) {
            $this->db->where_in('CG', $cg);
        } else {
            $this->db->where('CG', $cg);
        }
        return $this->db->get($this->table)->result_array();
    }

    public function get_cg_mapping($SUP_CODE, $SUP_NAME)
    {
        $where = "";
        if (! empty($SUP_CODE)) {
            $where = $where . " AND A.SUP_CODE LIKE '%" . $SUP_CODE . "%'";
        }
        if (! empty($SUP_NAME)) {
            $where = $where . " AND B.SUP_NAME LIKE '%" . $SUP_NAME . "%'";
        }
        $sql = "SELECT  DISTINCT A.SUP_CODE,
                  B.SUP_NAME AS SUP_NAME,
                  A.CG
                FROM UD_WD_CG_SUP A ,
                TIS_MVENDOR B
                WHERE  A.SUP_CODE = B.SUP_CODE $where
                ORDER BY SUP_CODE,CG";
        return $this->db->query($sql)->result_array();
    }

    /**
     *
     * @param string $cg            
     * @param string $uid            
     */
    public function save_sup_info_by_cg($cg, $uid)
    {
        $crt_date = date("Ymd");
        $crt_time = date("His");
        $sql = "INSERT INTO UD_WD_CG_SUP(SUP_CODE, CG, CRT_USER, CRT_DATE, CRT_TIME)
            SELECT A.SUP_CODE, A.CG,?,?,? FROM UD_WD_CG_SUP A, TIS_MVENDOR B WHERE A.SUP_CODE = B.SUP_CODE AND CG = ?";
        return $this->db->query($sql, array(
            $uid,
            date('Ymd'),
            date('His'),
            $cg
        ));
    }

    public function check_sup_code($sup_code, $cg)
    {
        $this->db->where('SUP_CODE', $sup_code);
        $this->db->where('CG', $cg);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save_mapping($sup_code, $cg, $object_id)
    {
        $data = array(
            'SUP_CODE' => $sup_code,
            'CG' => $cg,
            'CRT_USER' => $object_id,
            'CRT_DATE' => date('Ymd'),
            'CRT_TIME' => date('His')
        );
        return $this->db->insert($this->table, $data);
    }

    public function delete_cg_mapping($sup_code, $cg)
    {
        $this->db->where('SUP_CODE', $sup_code);
        $this->db->where('CG', $cg);
        $this->db->delete($this->table);
    }

    public function delete_form_all()
    {
        $this->db->empty_table($this->table);
    }

    public function save_mapping_batch($params)
    {
        $this->db->insert_batch($this->table, $params);
    }

    public function get_SUP_CG_list_info($TDM_ID, $cg_filter)
    {
        $filter = '';
        if ($cg_filter != '') {
            $filter = "a.CG in (" . $cg_filter . ") and ";
        }
        $sql = "select a.SUP_CODE,a.sup_name SUP_NAME,wm_concat(a.cg ) CG from (
                select a.SUP_CODE,b.sup_name,a.cg  from UD_WD_CG_SUP a ,TIS_MVENDOR b
                where a.sup_code = b.sup_code
                and a.sup_code in (
                SELECT a.SUP_CODE FROM UD_WD_CG_SUP a
                where  " . $filter . " a.SUP_CODE not in ( select distinct SUP_CODE from UD_WD_DWG_SUP where dwg_no = '" . $TDM_ID . "')
                )
                 order by a.cg
                ) a
                group by a.SUP_CODE,a.sup_name";
        return $this->db->query($sql)->result_array();
    }

    public function get_cg_sup_info($cg)
    {
        $sql = "SELECT A.SUP_CODE, B.SUP_NAME, A.CG FROM UD_WD_CG_SUP A, TIS_MVENDOR B WHERE A.SUP_CODE = B.SUP_CODE AND CG = ?";
        return $this->db->query($sql, array(
            $cg
        ))->result_array();
    }

    public function get_cg_count_by_supcode($sup_code)
    {
        $sql = "SELECT * FROM UD_WD_CG_SUP WHERE SUP_CODE = ?";
        return $this->db->query($sql, array(
            $sup_code
        ))->num_rows();
    }
}