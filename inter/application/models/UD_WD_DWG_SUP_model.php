<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UD_WD_DWG_SUP_Model extends MY_Model
{

    protected $table = 'UD_WD_DWG_SUP';

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
     * count rows by dwg no and sup code
     *
     * @param unknown $dwg_no            
     * @param unknown $sup_code            
     */
    public function count_rows_by_dwg_no_and_sup_code($dwg_no, $sup_code)
    {
        return $this->db->where(array(
            'DWG_NO' => $dwg_no,
            'SUP_CODE' => $sup_code
        ))->count_all_results($this->table);
    }

    public function get_list_sup_codes($dwg_no)
    {
        $this->db->select('SUP_CODE');
        return $this->db->get_where($this->table, array(
            'DWG_NO' => $dwg_no,
            'SUBSTR(SUP_CODE,1,1)' => 5
        ))->result_array();
    }

    /**
     *
     * @param string $dwg_no            
     * @param string $sup_code            
     * @param string $uid            
     */
    public function save_dwg_sup($dwg_no, $sup_code, $uid)
    {
        $sql = "INSERT INTO UD_WD_DWG_SUP(DWG_NO, SUP_CODE, CRT_USER, CRT_DATE, CRT_TIME) VALUES (?,?,?,?,?)";
        $cur_date = date("Ymd");
        $cur_time = date("His");
        return $this->db->query($sql, array(
            $dwg_no,
            $sup_code,
            $uid,
            $cur_date,
            $cur_time
        ));
    }

    public function dwg_management_search($sup_code)
    {
        $sql = "SELECT A.* FROM ( SELECT
                b.object_id,
                DWG_NO,
                CRT_USER,
                (SELECT TDM_DESCRIPTION FROM PDM_USERS WHERE TO_CHAR(OBJECT_ID) = CRT_USER) AS USER_NAME,
                REPLACE(B.REVISION, ' ', '00') AS REVISION,
                B.TDM_DESCRIPTION,
                B.CN_LOCAL_DESCRIPTION,
                CRT_DATE,
                CRT_TIME,
                B.TDM_SITE_ID,
                (SELECT TDM_NAME FROM PDM_FILE_TYPE WHERE OBJECT_ID = B.FILE_TYPE) AS FILE_TYPE_NAME
                FROM UD_WD_DWG_SUP A,PDM_DOC B
                WHERE
                A.DWG_NO = B.TDM_ID
                and B.STATE = '3'
                and SUP_CODE = ?
                ) A,
              (
                SELECT
                MAX(b.object_id) object_id

                FROM UD_WD_DWG_SUP A,PDM_DOC B
                WHERE
                A.DWG_NO = B.TDM_ID
                and B.STATE = '3'
                and SUP_CODE = ?
                group by DWG_NO) B
                WHERE A.object_id = B.object_id";
        return $this->db->query($sql, array(
            $sup_code,
            $sup_code
        ))->result_array();
    }

    public function dwg_management_delete($sup_code, $dwg_no)
    {
        $sql = "DELETE FROM UD_WD_DWG_SUP WHERE SUP_CODE=? AND DWG_NO=?";
        return $this->db->query($sql, array(
            $sup_code,
            $dwg_no
        ));
    }

    public function get_DWG_SUP_list_info($TDM_ID)
    {
        $sql = "SELECT DBMS_LOB.SUBSTR(CG, 500) AS CG, SUP_CODE, SUP_NAME FROM
(SELECT A.SUP_CODE,C.SUP_NAME , WM_CONCAT(b.cg) CG
                FROM UD_WD_DWG_SUP A ,
                UD_WD_CG_SUP B ,TIS_MVENDOR C
                WHERE A.SUP_CODE = B.SUP_CODE
                AND A.SUP_CODE = C.SUP_CODE
                AND A.DWG_NO = '" . $TDM_ID . "'
                GROUP BY A.SUP_CODE,C.SUP_NAME)";
        return $this->db->query($sql)->result_array();
    }

    public function del_DWG_SUP_mapping($TDM_ID, $arrDel)
    {
        $strDel = "'" . implode("','", $arrDel) . "'";
        $sql = "DELETE UD_WD_DWG_SUP WHERE DWG_NO = ? AND SUP_CODE in($strDel)";
        return $this->db->query($sql, array(
            $TDM_ID
        ));
    }

    public function insert_sup_mapping($TDM_ID, $arrInsert, $CRT_USE)
    {
        // $sql = "INSERT INTO UD_WD_DWG_SUP(DWG_NO, SUP_CODE, CRT_USER, CRT_DATE, CRT_TIME)
        // VALUES ";
        $arrTmp = array();
        foreach ($arrInsert as $key => $val) {
            $arrTmp[] = array(
                'DWG_NO' => $TDM_ID,
                'SUP_CODE' => $val,
                'CRT_USER' => $CRT_USE,
                'CRT_DATE' => date('Ymd'),
                'CRT_TIME' => date('His')
            );
        }
        return $this->db->insert_batch($this->table, $arrTmp);
        // $strQuery = implode(",",$arrTmp);
        // $sql=$sql.$strQuery;
        // //return $sql;
        // return
        // $this->db->query($sql);
    }

    /**
     *
     * @param string $sup_code_from            
     * @param string $sup_code_to            
     * @param string $uid            
     */
    public function copy_to_new_supplier($sup_code_from, $sup_code_to, $uid)
    {
        $count = 0;
        $dwg_no_arr = $this->get("DWG_NO", array(
            "SUP_CODE" => $sup_code_from
        ));
        foreach ($dwg_no_arr as $key => $val) {
            
            $res = $this->get('*', array(
                'DWG_NO' => $val['DWG_NO'],
                'SUP_CODE' => $sup_code_to
            ));
            if (! count($res)) {
                $flag = $this->save_dwg_sup($val['DWG_NO'], $sup_code_to, $uid);
                if ($flag)
                    $count ++;
            }
        }
        return $count;
    }

    public function delete_dwg_sup($dwg_no, array $sup_code = array())
    {
        $this->db->where('DWG_NO', $dwg_no);
        if (! empty($sup_code)) {
            $this->db->where_in('SUP_CODE', $sup_code);
        }
        return $this->db->delete($this->table);
    }
    
    /**
     * update table
     * @param unknown $where
     * @param unknown $data
     */
    public function update($where, $data)
    {
        $this->db->where($where);
        return $this->db->set($data)->update($this->table);
    }
}