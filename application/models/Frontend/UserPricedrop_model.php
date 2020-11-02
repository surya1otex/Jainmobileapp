<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserPricedrop_model extends CI_Model {

    function pricedropListingCount($userid)
    {
        $this->db->select('*');
        $this->db->from('tbl_pricedrop as BaseTbl');
        
         $this->db->where('user_id', $userid);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function pricedropListing($userid, $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_pricedrop as BaseTbl');
         $this->db->where('user_id', $userid);
        $this->db->order_by('BaseTbl.pricedrop_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

}

?>