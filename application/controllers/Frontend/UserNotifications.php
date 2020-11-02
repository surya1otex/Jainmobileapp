<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserNotifications  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/UserNotifications_model');
    }

    public function index(){
    $userid=$this->session->userdata('userid');
    //die;
   // echo 'Hello World';
       $this->global['pageTitle'] = 'Notifications';
       
   
           $this->load->library('pagination');

            $count = $this->UserNotifications_model->notificationListingCount($userid);

          $returns = $this->paginationCompress("userNotifications/", $count, 10);

            $data['userRecords'] = $this->UserNotifications_model->notificationListing($userid, $returns["page"], $returns["segment"]);

          // print_r($data);
          // die;
       $this->loadfrontViews("frontend/notification", $this->global, NULL,NULL,$data );
        
    }

 }