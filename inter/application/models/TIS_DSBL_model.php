<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TIS_DSBL_Model extends MY_Model
{

    protected $table = 'TIS_DSBL';

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

    public function get_sbl_by_job($job1_code, $job2_code, $clas_kind, $user_id, $level)
    {
        $sql = 'SELECT
            	TIS_DSBL.PART_CODE supper_assy,
            	0 M_LEVEL,
            	TIS_DPART.PROP_KIND super_prop,
            	TIS_DPART.PROP_KIND,
            	TIS_DPART.PART_NAME,
            	TIS_DPART.DRAW_NO,
            	TIS_DSBL.PART_CODE,
            	MAX (TIS_DSBL.PART_QTY) PART_QTY,
            	TIS_DSBL.MEMO,
            	TIS_DSBL.JOB1_CODE,
            	TIS_DSBL.JOB2_CODE,
            	TIS_PROJECT.PROJ_NAME,
            	TIS_DJOB.E_KIND || \'   \' || TIS_DJOB.SPEC SPEC,
            	TIS_DJOB.JOB_QTY,
            	TIS_DPART.SAP_PART,
            	TIS_DPART.COMP_GROUP,
            	TIS_DPART.COMP_GROUP CGROUP,
                UD_WD_JOB.DWG_NO,
                (SELECT TDM_NAME FROM PDM_FILE_TYPE WHERE OBJECT_ID = PDM_DOC.FILE_TYPE) AS FILE_TYPE_NAME
            FROM
            	TIS_DPART,
            	TIS_DSBL,
            	TIS_PROJECT,
            	TIS_DJOB,
                UD_WD_JOB,
                PDM_DOC
            WHERE
            	TIS_DJOB.JOB1_CODE (+) = TIS_DSBL.JOB1_CODE
            AND TIS_DJOB.JOB2_CODE (+) = TIS_DSBL.JOB2_CODE
            AND TIS_DSBL.part_code = TIS_DPART.part_code (+)
            AND TIS_PROJECT.PROJ_CODE (+) = TIS_DSBL.JOB1_CODE
            AND UD_WD_JOB.JOB1_CODE (+) = TIS_DSBL.JOB1_CODE
            AND UD_WD_JOB.JOB2_CODE (+) = TIS_DSBL.JOB2_CODE
            AND UD_WD_JOB.PART_CODE (+) = TIS_DSBL.PART_CODE
            AND TIS_DSBL.JOB1_CODE = ?
            AND TIS_DSBL.JOB2_CODE = ?
            AND TIS_DSBL.CLAS_KIND = ?
            AND TIS_DSBL.USER_ID = ?			
            AND UD_WD_JOB.DWG_NO =  PDM_DOC.TDM_ID (+)
            GROUP BY
            	TIS_DSBL.PART_CODE,
            	TIS_DPART.PROP_KIND,
            	TIS_DPART.PART_NAME,
            	TIS_DPART.DRAW_NO,
            	TIS_DSBL.MEMO,
            	TIS_DSBL.JOB1_CODE,
            	TIS_DSBL.JOB2_CODE,
            	TIS_PROJECT.PROJ_NAME,
            	TIS_DJOB.E_KIND,
            	TIS_DJOB.SPEC,
            	TIS_DJOB.JOB_QTY,
            	TIS_DPART.SAP_PART,
            	TIS_DPART.COMP_GROUP,
            	UD_WD_JOB.DWG_NO,
                PDM_DOC.FILE_TYPE
            	';
        if ($level == 1) {
            $sql .= 'UNION ALL
            	SELECT
            		TIS_DSBL.PART_CODE supper_assy,
            		1,
            		TIS_DPART.PROP_KIND,
            		TIS_DPART_1.PROP_KIND,
            		TIS_DPART_1.PART_NAME,
            		TIS_DPART_1.DRAW_NO,
            		TIS_DSBL.CHPA_CODE,
            		TIS_DSBL.CHPA_QTY,
            		TIS_DSBL.MEMO,
            		TIS_DSBL.JOB1_CODE,
            		TIS_DSBL.JOB2_CODE,
            		TIS_PROJECT.PROJ_NAME,
            		TIS_DJOB.E_KIND || \'   \' || TIS_DJOB.SPEC SPEC,
            		TIS_DJOB.JOB_QTY,
            		TIS_DPART_1.SAP_PART,
            		TIS_DPART.COMP_GROUP,
            		\' \' CGROUP,
                    UD_WD_JOB.DWG_NO,
					(SELECT TDM_NAME FROM PDM_FILE_TYPE WHERE OBJECT_ID = PDM_DOC.FILE_TYPE) AS FILE_TYPE_NAME
            	FROM
            		TIS_DPART,
            		TIS_DSBL,
            		TIS_PROJECT,
            		TIS_DJOB,
            		TIS_DPART TIS_DPART_1,
                    UD_WD_JOB,
                    PDM_DOC
            	WHERE
            		TIS_DJOB.JOB1_CODE (+) = TIS_DSBL.JOB1_CODE
            	AND TIS_DJOB.JOB2_CODE (+) = TIS_DSBL.JOB2_CODE
            	AND (
            		TIS_DSBL.part_code = TIS_DPART.part_code (+)
            	)
            	AND (
            		TIS_DSBL.chpa_code = TIS_DPART_1.part_code (+)
            	)
            	AND TIS_PROJECT.PROJ_CODE (+) = TIS_DSBL.JOB1_CODE
                AND UD_WD_JOB.JOB1_CODE (+) = TIS_DSBL.JOB1_CODE
            	AND UD_WD_JOB.JOB2_CODE (+) = TIS_DSBL.JOB2_CODE
            	AND UD_WD_JOB.PART_CODE (+) = TIS_DSBL.PART_CODE
            	AND TIS_DSBL.JOB1_CODE = ?
            	AND TIS_DSBL.JOB2_CODE = ?
            	AND TIS_DSBL.CLAS_KIND = ?
            	AND NVL (TIS_DSBL.CHPA_CODE, \' \') <> \' \'
            	AND TIS_DSBL.USER_ID = ?
				AND UD_WD_JOB.DWG_NO =  PDM_DOC.TDM_ID (+)';
        }
        $sql .= 'ORDER BY
        		COMP_GROUP,
        		SUPPER_ASSY,
        		M_LEVEL';
        $param = $level == 1 ? array(
            $job1_code,
            $job2_code,
            $clas_kind,
            $user_id,
            $job1_code,
            $job2_code,
            $clas_kind,
            $user_id
        ) : array(
            $job1_code,
            $job2_code,
            $clas_kind,
            $user_id
        );
        $query = $this->db->query($sql, $param);
        return $query->result_array();
    }
}
