<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Pricedrop_model extends CI_Model
{
   
    function pricedropListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_pricedrop as BaseTbl');
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.product_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function pricedropListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_pricedrop as BaseTbl');
         $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.product_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.pricedrop_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function pricedropproducts() {
        $this->db->select('*');
        $this->db->from('tbl_pricedrop as BaseTbl');
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
        $this->db->from('tbl_pricedrop');
        $this->db->where('pricedrop_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
      
    function edit($userInfo, $id)
    {
        $this->db->where('pricedrop_id', $id);
        $this->db->update('tbl_pricedrop', $userInfo);
        
        return TRUE;
    }
    
    
    
   
     function deletepricedrop($userId)
    {
        $this->db->where('pricedrop_id', $userId);
		$this->db->delete('tbl_pricedrop');
        
        return $this->db->affected_rows();
    }

       
    function add($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_pricedrop', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
}

  