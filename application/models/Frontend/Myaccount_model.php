<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Myaccount_model extends CI_Model
{

    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }

    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, image, mobile, address, usercode, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

}