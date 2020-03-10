<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

    /**
     * @param array $data
     * @param null $user_id
     * @return bool|null
     */
	public function addUpdateUser( $data=array(), $user_id=NULL )
	{
        $data['update_date'] = date('Y-m-d H:i:s');
		if( $user_id )
		{
            $data['demise_date'] = $data['inactivity_date'];
            unset($data['inactivity_date']);
			$result = $this->db->update('user_master', $data, array( 'user_id' => $user_id ) );
			return $result ? $user_id : FALSE;
		}
		else
		{
            $data['status'] = 'Active';
            $data['demise_date'] = $data['inactivity_date'];
            unset($data['inactivity_date']);
            $data['insert_date'] = date('Y-m-d H:i:s');

			$result = $this->db->insert('user_master', $data );
			return $result ? $this->db->insert_id() : FALSE;
		}
	}

    /**
     * @param $user_id
     * @param $user_name
     * @return mixed
     */
	public function check_user_name($user_id, $user_name)
    {
        $where = " WHERE 1=1 AND `user_name`='". htmlentities($user_name, ENT_QUOTES)."'";
        if( $user_id ){
            $where .= " AND `user_id`<>".$user_id;
        }
        $result = $this->db->query("SELECT COUNT(*) AS `total` 
								FROM `user_master`
								 $where
								");
        return $result->row('total');
    }

    /**
     * @param null $data
     * @return mixed
     */
	public function get_user( $data = NULL)
	{
		if( $data['user_id'] )
		{
			$q  = $this->db->get_where('user_master', array('user_id'=>$data['user_id']));
            /*$this->db->select("user_master")
                ->where('fcm IS NOT ',NULL)
                ->from('user_master');
            $q =  $this->db->get();*/
			return $q->row_array();
		}
		else
		{
			
//			$q = $this->db->get('user_master');
            $this->db->select("user_master.*,DATE_FORMAT(demise_date,'%d-%m-%Y') AS inactivity_date")
                    ->from('user_master')
                ->where('user_type != ','Admin' )
                ->order_by("name",'ASC')

            ;
            /*if($limit != NULL){
                $this->db->limit($limit);
            }*/
            $q =  $this->db->get();
			return $q->result_array();
		}
	}

    /**
     * @param null $data
     * @return mixed
     */
	public function get_fcm_list()
	{
        $this->db->select("fcm")
            ->where('fcm IS NOT ',NULL)
            ->from('user_master');
        /*if($limit != NULL){
            $this->db->limit($limit);
        }*/
        $q =  $this->db->get();

        //echo $this->db->last_query();exit;
        return $q->result_array();
	}

}
