<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Specialoffer_model extends CI_Model
{
   
    function specialofferListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_specialoffer as BaseTbl'); 
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.offer_price  LIKE '%".$searchText."%' 
                            OR  BaseTbl.offer_image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function specialofferListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_specialoffer as BaseTbl');
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        // New Join Table //
        //$this->db->join('tbl_pricedrop as pricedrop', 'pricedrop.pricedrop_id = BaseTbl.pricedrop_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.offer_price  LIKE '%".$searchText."%' 
                            OR  BaseTbl.offer_image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $this->db->order_by('BaseTbl.specialoffer_id', 'DESC');
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
  function add($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_specialoffer', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
     function getEditInfo($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_specialoffer');
        $this->db->where('specialoffer_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
 
    
     function edit($userInfo, $id)
    {
        $this->db->where('specialoffer_id', $id);
        $this->db->update('tbl_specialoffer', $userInfo);
        
        return TRUE;
    }
    
    
    
   
    function deletespecialoffer($userId)
    {
        $this->db->where('specialoffer_id', $userId);
		$this->db->delete('tbl_specialoffer');
        
        return $this->db->affected_rows();
    }  
    
    
    
    
   

}

  