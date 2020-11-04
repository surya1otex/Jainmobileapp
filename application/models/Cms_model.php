<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Cms_model extends CI_Model
{
   
    function notificationListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_notification as BaseTbl'); 
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.message  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function notificationListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_notification as BaseTbl');
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.message  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $this->db->order_by('BaseTbl.notification_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
  
    function getUsers()
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('userId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

     function getEditInfo($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_notification');
        $this->db->where('notification_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
 
    function add($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_notification', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }  
    
      function edit($userInfo, $id)
    {
        $this->db->where('notification_id', $id);
        $this->db->update('tbl_notification', $userInfo);
        
        return TRUE;
    }
    
      function deletenotification($userId)
    {
        $this->db->where('notification_id', $userId);
		$this->db->delete('tbl_notification');
        
        return $this->db->affected_rows();
    }

    
}

  