<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserSpecialoffer_model extends CI_Model {

    function specialofferListingCount($userid)
    {
        $this->db->select('*');
        $this->db->from('tbl_specialoffer as BaseTbl'); 
         $this->db->where('user_id', $userid);
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function specialofferListing($userid, $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_specialoffer as BaseTbl');
        $this->db->where('user_id', $userid);
        $this->db->order_by('BaseTbl.specialoffer_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

}

?>