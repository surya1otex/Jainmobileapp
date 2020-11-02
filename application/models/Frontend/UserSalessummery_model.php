<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserSalessummery_model extends CI_Model {

    function salessummeryListingCount($userid)
    {
        $this->db->select('*');
        $this->db->from('tbl_sales_summery as BaseTbl');

        $this->db->where('user_id', $userid);
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function salessummeryListing($userid,  $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_sales_summery as BaseTbl');
        $this->db->where('user_id', $userid);
        
        $this->db->order_by('BaseTbl.sales_summery_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

   function searchdates($userid,$start_date,$end_date) {

    $this->db->select("*");
    $this->db->from('tbl_sales_summery');

    $this->db->where("DATE_FORMAT(date_added,'%Y') >='$start_date'");
    $this->db->where("DATE_FORMAT(date_added,'%Y') <='$end_date'");
    //$this->db->select_sum('amount');
    $this->db->where('tbl_sales_summery.user_id', $userid);
    $query = $this->db->get();
    return $query->result();

   }

  function totalsummery($userid,$start_date,$end_date) {

     $this->db->select_sum('amount');
   // $this->db->from('tbl_sales_summery');
    if(!empty($start_date) && !empty($end_date)) {
    $this->db->where("DATE_FORMAT(date_added,'%Y') >='$start_date'");
    $this->db->where("DATE_FORMAT(date_added,'%Y') <='$end_date'");

}
    //$this->db->select_sum('amount');
    $this->db->where('tbl_sales_summery.user_id', $userid);
    //$query = $this->db->get();
    
         $result = $this->db->get('tbl_sales_summery')->row();
     return $result->amount;

    //return $query->result();   

  }

}

?>