<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Feedback_model extends CI_Model
{
  function feedbackListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_feedback as BaseTbl'); 
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');
       
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    function feedbackListing($page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_feedback as BaseTbl');
        $this->db->join('tbl_users as users', 'users.userId = BaseTbl.user_id','left');

       
        $this->db->order_by('BaseTbl.feedback_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

 }