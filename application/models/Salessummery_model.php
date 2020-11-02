<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Salessummery_model extends CI_Model
{
   
    function salessummeryListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_sales_summery as BaseTbl'); 
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.model  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function salessummeryListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_sales_summery as BaseTbl');
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.model  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $this->db->order_by('BaseTbl.sales_summery_id', 'DESC');
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
        $this->db->from('tbl_sales_summery');
        $this->db->where('sales_summery_id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
 
    function add($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_sales_summery', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }  
    
      function edit($userInfo, $id)
    {
        $this->db->where('sales_summery_id', $id);
        $this->db->update('tbl_sales_summery', $userInfo);
        
        return TRUE;
    }
    
      function deletesalessummery($userId)
    {
        $this->db->where('sales_summery_id', $userId);
		$this->db->delete('tbl_sales_summery');
        
        return $this->db->affected_rows();
    }

    
}

  