<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserPricedrop  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/UserPricedrop_model');
    }

    public function index(){
$userid=$this->session->userdata('userid');
       // echo 'Hello World';
       $this->global['pageTitle'] = 'Price Drop';
          

            $this->load->library('pagination');

            $count = $this->UserPricedrop_model->pricedropListingCount($userid);

            $returns = $this->paginationCompress("userPricedrop/", $count, 10);

            $data['userRecords'] = $this->UserPricedrop_model->pricedropListing($userid, $returns["page"], $returns["segment"]);

       $this->loadfrontViews("frontend/pricedrop", $this->global,  NULL ,NULL,$data );
        
    }

 }