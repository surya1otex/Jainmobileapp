<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserPayoutsummery_model extends CI_Model {

    function purchaseListingCount($userid)
    {
        $this->db->select('*');
        $this->db->from('tbl_purchase_history as BaseTbl'); 
         $this->db->where('user_id', $userid);
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function purchaselisting($userid, $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_purchase_history as BaseTbl');
       
         $this->db->where('user_id', $userid);
        $this->db->order_by('BaseTbl.purchasehistory_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

   function totalpayout($userid) {
     $this->db->select_sum('amount');
     $this->db->where('tbl_purchase_history.user_id', $userid);
     $result = $this->db->get('tbl_purchase_history')->row();
     return $result->amount;
   }

}

?>