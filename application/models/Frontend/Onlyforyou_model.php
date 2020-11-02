<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Onlyforyou_model extends CI_Model
{
    function OnlyforyouListing($userId,$page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_onlyforyou as BaseTbl');
        $this->db->where('BaseTbl.user_id', $userId);
    
        $this->db->order_by('BaseTbl.onlyforyou_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    function onlyforyouListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_redeemgift as BaseTbl');
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }

   function totalpurchase($userid) {
     $this->db->select_sum('onlyforyou_price');
     $this->db->where('tbl_onlyforyou.user_id', $userid);
     $result = $this->db->get('tbl_onlyforyou')->row();
     return $result->onlyforyou_price;
   }

   function totalredeem($userid) {
     $this->db->select_sum('redeem');
     $this->db->where('tbl_onlyforyou.user_id', $userid);
     $result = $this->db->get('tbl_onlyforyou')->row();
     return $result->redeem;
   }
}