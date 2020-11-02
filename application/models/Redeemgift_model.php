<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Redeemgift_model extends CI_Model
{
   
    function redeemgiftListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_redeemgift as BaseTbl');
       $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.redeemgift_price  LIKE '%".$searchText."%'
                          
                            OR  BaseTbl.redeemgift_image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function redeemgiftListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_redeemgift as BaseTbl');
         $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
           $likeCriteria = "(BaseTbl.redeemgift_price  LIKE '%".$searchText."%'
                          
                            OR  BaseTbl.redeemgift_image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.redeemgift_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
     function add($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_redeemgift', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
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
        $this->db->from('tbl_redeemgift');
        $this->db->where('redeemgift_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
   function edit($userInfo, $id)
    {
        $this->db->where('redeemgift_id', $id);
        $this->db->update('tbl_redeemgift', $userInfo);
        
        return TRUE;
    }
    
    
    
   
    function deleteredeemgift($userId)
    {
        $this->db->where('redeemgift_id', $userId);
		$this->db->delete('tbl_redeemgift');
        
        return $this->db->affected_rows();
    }

    
    
    
    
    
    
    
    
    
    
   
}

  