<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Onlyforyou_model extends CI_Model
{
   
    function OnlyforyouListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_onlyforyou as BaseTbl');
         $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.onlyforyou_price  LIKE '%".$searchText."%'
                          
                            OR  BaseTbl.onlyforyou_image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function OnlyforyouListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_onlyforyou as BaseTbl');
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        //$this->db->join('tbl_pricedrop as pricedrop', 'pricedrop.pricedrop_id = BaseTbl.pricedrop_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.onlyforyou_price  LIKE '%".$searchText."%'
                          
                            OR  BaseTbl.onlyforyou_image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $this->db->order_by('BaseTbl.onlyforyou_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function add($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_onlyforyou', $userInfo);
        
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
        $this->db->from('tbl_onlyforyou');
        $this->db->where('onlyforyou_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
       function edit($userInfo, $id)
    {
        $this->db->where('onlyforyou_id', $id);
        $this->db->update('tbl_onlyforyou', $userInfo);
        
        return TRUE;
    }
    
   function deleteonlyforyou($userId)
    {
        $this->db->where('onlyforyou_id', $userId);
		$this->db->delete('tbl_onlyforyou');
        
        return $this->db->affected_rows();
    }

    
    
    
}

  