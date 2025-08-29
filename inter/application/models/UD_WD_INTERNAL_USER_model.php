<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UD_WD_INTERNAL_USER_Model extends MY_Model
{

    protected $table = 'UD_WD_INTERNAL_USER';

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
     * get internal user info all and by id username assigned
     */
    public function get_internal_user_info_by_8id_username($USER_8_ID, $TDM_DESCRIPTION, $ASSIGNED_VALUE)
    {
        $where = "";
        if ($USER_8_ID != '') {
            $where = $where . " AND A.LOGIN like '%" . $USER_8_ID . "%'";
        }
        if ($TDM_DESCRIPTION != '') {
            $where = $where . " AND TDM_DESCRIPTION like '%" . $TDM_DESCRIPTION . "%'";
        }
        if ($ASSIGNED_VALUE == '2') {
            $where = $where . " AND ROLE_OBJECT_ID IS  NULL";
        } elseif ($ASSIGNED_VALUE == '1') {
            $where = $where . " AND ROLE_OBJECT_ID IS NOT NULL";
        } else {
            $where = $where . "";
        }
        $sql = "SELECT
    		  OBJECT_ID,
    		  USER_DIVISION,
    		  USER_TITLE,
    		  LOGIN,
    		  STATE,
    		  TDM_DESCRIPTION,
    		  B.ROLE_OBJECT_ID,
    		  (SELECT
    		  ROLE_NAME
    		  FROM
    		  UD_WD_ROLE
    		  WHERE
    		  OBJECT_ID = B.ROLE_OBJECT_ID) AS ROLE_NAME,
    		  FIRST_NAME,
    		  LAST_NAME,
    		  USER_PHONE,
    		  USER_FAX,
    		  USER_EMAIL
    		  FROM
    		  PDM_USERS A,
    		  UD_WD_INTERNAL_USER B
    		  WHERE A.TDM_SITE_ID = '402653188' AND 
    		  A.OBJECT_ID = B.USER_OBJECT_ID(+)" . $where;
        
        return $this->db->query($sql)->result_array();
    }

    /**
     * get role name except supplier
     */
    public function get_roles()
    {
        $sql = "SELECT * FROM UD_WD_ROLE WHERE OBJECT_ID != 1";
        return $this->db->query($sql)->result_array();
    }

     /**
     * get email 
     */
    public function get_email($user_id)
    {
        $sql = "SELECT
        USER_EMAIL
        FROM
        PDM_USERS A,
        UD_WD_INTERNAL_USER B
        WHERE A.TDM_SITE_ID = '402653188' AND 
        A.OBJECT_ID = B.USER_OBJECT_ID(+) AND A.LOGIN='".$user_id."'";
  
        return $this->db->query($sql)->result_array();
    }

    /**
     * delete assign by object id
     */
    public function delete_assign($OBJECT_ID)
    {
        $sql = "DELETE FROM UD_WD_INTERNAL_USER WHERE USER_OBJECT_ID IN (" . implode(",", $OBJECT_ID) . ")";
        return $this->db->query($sql);
    }

    /**
     * insert role name
     */
    public function insert_assign($ROLE_OBJECT_ID, $OBJECT_ID, $CRT_USER)
    {
        $sql = "SELECT *  FROM UD_WD_INTERNAL_USER WHERE USER_OBJECT_ID = ? ";
        $num = $this->db->query($sql, array(
            $OBJECT_ID
        ))->row_array();
        
        if ($num != null) {
            $sql = "UPDATE 
                    UD_WD_INTERNAL_USER 
                    SET 
                    ROLE_OBJECT_ID = ?,
                    MOD_USER = ?,
                    MOD_DATE = to_char(sysdate,'yyyymmdd'),
                    MOD_TIME = to_char(sysdate,'HHMMSS')
                    WHERE 
                    USER_OBJECT_ID= ?";
        } else {
            $sql = "INSERT INTO 
	    			UD_WD_INTERNAL_USER 
	    			(ROLE_OBJECT_ID,
	    			CRT_USER,
                    USER_OBJECT_ID,
	    			CRT_DATE,
	    			CRT_TIME)
	    			VALUES
	    			(?,?,?,to_char(sysdate,'yyyymmdd'),to_char(sysdate,'HH24MMSS'))
	    			";
        }
        return $this->db->query($sql, array(
            $ROLE_OBJECT_ID,
            $CRT_USER,
            $OBJECT_ID
        ));
    }

    /**
     *
     * get webddm user by username
     *
     * @param unknown $username            
     */
    public function get_ddm_user_by_id($user_id)
    {
        return $this->db->get_where($this->table, array(
            'USER_OBJECT_ID' => $user_id
        ))->row_array();
    }
}