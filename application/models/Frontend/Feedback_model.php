<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Feedback_model extends CI_Model
{


    function send($feedbackInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_feedback', $feedbackInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getUserInfo($userId)
    {
        $this->db->select('userId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function payoutlists($userid) {
        $this->db->select('*');
        $this->db->from('tbl_purchase_history as BaseTbl');
        $this->db->where('BaseTbl.user_id', $userid);
        $this->db->order_by('BaseTbl.purchasehistory_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
       
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