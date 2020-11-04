<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Termscondition_model extends CI_Model
{


    function conditionsListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_cms as BaseTbl');
        
        $this->db->order_by('BaseTbl.cms_id', 'DESC');
        //$this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

 }