<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Purchasehistory_model extends CI_Model
{
   
    function purchaseListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_purchase_history as BaseTbl'); 
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function purchaselisting($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_purchase_history as BaseTbl');
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $this->db->order_by('BaseTbl.purchasehistory_id', 'DESC');
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
        $this->db->from('tbl_purchase_history');
        $this->db->where('purchasehistory_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
 
    function add($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_purchase_history', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }  
    
      function edit($userInfo, $id)
    {
        $this->db->where('purchasehistory_id', $id);
        $this->db->update('tbl_purchase_history', $userInfo);
        
        return TRUE;
    }
    
      function deletepurchasehistory($userId)
    {
        $this->db->where('purchasehistory_id', $userId);
		$this->db->delete('tbl_purchase_history');
        
        return $this->db->affected_rows();
    }

    function insert($data)
    {
        $this->db->insert_batch('tbl_purchase_history', $data);
    }
    
}

  