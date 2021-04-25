<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Forgotpassword_model extends CI_Model
{

   function getuserid($mobile) {

   	    $this->db->select('userId');
        $this->db->from('tbl_users');
        $this->db->where('mobile', $mobile);
        $query = $this->db->get();
        
        return $query->row();
   }

}