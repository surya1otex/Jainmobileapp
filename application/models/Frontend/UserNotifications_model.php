<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserNotifications_model extends CI_Model {

    function notificationListingCount($userid) {
        $this->db->select('*');
        $this->db->from('tbl_notification as BaseTbl');
        $this->db->where('user_id', $userid);

        
        $query = $this->db->get();

        return $query->num_rows();
    }

    function notificationListing($userid, $page, $segment) {
        $this->db->select('*');
        $this->db->from('tbl_notification as BaseTbl');
        $this->db->order_by('BaseTbl.notification_id', 'DESC');
        $this->db->limit($page, $segment);
         $this->db->where('user_id', $userid);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

}

?>