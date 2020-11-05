<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model
{
    function loginUser($mobile, $password)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.roleId, BaseTbl.email, BaseTbl.mobile');
        $this->db->from('tbl_users as BaseTbl');
        //$this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.mobile', $mobile)->or_where('BaseTbl.email', $mobile);
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('Roles.role', 'User');
        $query = $this->db->get();
		//echo $this->db->last_query().'<br>';
        
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

  
    function checkEmailExist($email)
    {
        $this->db->select('userId');
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


   
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('tbl_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

  
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('userId, email, name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    function isRecordExist($table, $condition, $monitor=false){
        
        $this->db->select('userId');
        $this->db->from($table);
        $this->db->where('isDeleted', 0);
        $this->db->where($condition);
        $query = $this->db->get();
        if($monitor ==  true)
		    echo $this->db->last_query().'<br>';

        return $query->num_rows();;
    }
	
	function insertData($tblname,$data){		
		if(!empty($data)){ 
			$this->db->insert($tblname, $data);				
			$insert_id = $this->db->insert_id();				
			return  $insert_id;
		}			
		else{
			return 0;
		}		
	}

	function update($tbname,$condition,$data){
		if(!empty($data) && $tbname){
			
			$this->db->where($condition);
			$this->db->update($tbname,$data);
			//echo $this->db->last_query().'<br>';
			$afftid	= $this->db->affected_rows();
			if($afftid>0){	            
					
			return $afftid;
			}else{
				return 0;  
			}			
		}		
	}

   
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('email'=>$email));
    }

   
    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_last_login', $loginInfo);
        $this->db->trans_complete();
    }

  
    function lastLoginInfo($userId)
    {
        $this->db->select('BaseTbl.createdDtm');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_last_login as BaseTbl');

        return $query->row();
    }
}

?>