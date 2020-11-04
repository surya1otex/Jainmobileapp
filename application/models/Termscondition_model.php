<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Termscondition_model extends CI_Model
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
    
   
    function conditionsListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_cms as BaseTbl');
        
        $this->db->order_by('BaseTbl.cms_id', 'DESC');
        //$this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    


     function getEditInfo($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_cms');
        $this->db->where('cms_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
 
    function add($conditionInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_cms', $conditionInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }  
    
      function edit($conditionInfo, $id)
    {
        $this->db->where('cms_id', $id);
        $this->db->update('tbl_cms', $conditionInfo);
        
        return TRUE;
    }
    
      function deletenotification($userId)
    {
        $this->db->where('notification_id', $userId);
		$this->db->delete('tbl_notification');
        
        return $this->db->affected_rows();
    }

    
}

  