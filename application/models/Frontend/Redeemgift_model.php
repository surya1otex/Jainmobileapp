<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Redeemgift_model extends CI_Model
{
    function redeemgiftListing($userId,$page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_redeemgift as BaseTbl');
        $this->db->where('BaseTbl.user_id', $userId);
    
        $this->db->order_by('BaseTbl.redeemgift_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function redeemListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_redeemgift as BaseTbl');
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }

   function totalpurchase($userid) {
     $this->db->select_sum('redeemgift_price');
     $this->db->where('tbl_redeemgift.user_id', $userid);
     $result = $this->db->get('tbl_redeemgift')->row();
     return $result->redeemgift_price;
   }

   function totalpoints($userid) {
     $this->db->select_sum('redeem_value');
     $this->db->where('tbl_redeemgift.user_id', $userid);
     $result = $this->db->get('tbl_redeemgift')->row();
     return $result->redeem_value;
   }
}