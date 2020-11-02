<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserSpecialoffers  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/UserSpecialoffer_model');
    }

    public function index(){
$userid=$this->session->userdata('userid');
       // echo 'Hello World';
       $this->global['pageTitle'] = 'Special Offers';
       
            $this->load->library('pagination');

            $count = $this->UserSpecialoffer_model->specialofferListingCount($userid);

            $returns = $this->paginationCompress("userSpecialoffers/", $count, 10);

            $data['userRecords'] = $this->UserSpecialoffer_model->specialofferListing($userid, $returns["page"], $returns["segment"]);

       $this->loadfrontViews("frontend/specialoffer", $this->global, NULL, NULL,$data );
        
    }

 }