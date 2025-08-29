<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TIS_APASSWORD_Model extends MY_Model
{

    protected $table = 'TIS_APASSWORD';

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
    public function get($EMP_ID, $EMP_NAME)
    {
        $where = "";
        if (! empty($EMP_ID)) {
            $where = $where . " AND EMP_ID LIKE '%" . $EMP_ID . "%'";
        }
        if (! empty($EMP_NAME)) {
            $where = $where . " AND EMP_NAME LIKE '%" . $EMP_NAME . "%'";
        }
        $strsql = "SELECT 
                   EMP_ID,
                   EMP_NAME,
                   trim(lpad(' ',length(password)+1,'*')) AS PASSWORD
                   FROM 
                   TIS_APASSWORD 
                   WHERE 1=1 $where";
        
        return $this->db->query($strsql)->result_array();
    }

    /**
     * get project info by emp name code
     *
     * @param
     *            string null
     */
    public function get_tis_supplier()
    {
        $sql = "SELECT EMP_ID, EMP_NAME, PASSWORD, SUP_CODE, SUP_NAME, INST_NAME, BUSI_NO, BUYER_CODE, UPTAE, JONGMOK, TEL_NO FROM TIS_APASSWORD A, TIS_MVENDOR B WHERE REPLACE(EMP_ID, 'V', '') = B.SUP_CODE";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}