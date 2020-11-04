<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserOnlyforyou  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/Onlyforyou_model');
    }

    public function index() {

       // echo 'Hello World';
       $this->global['pageTitle'] = 'Only For You';

       $isLoggedIn = $this->session->userdata('userloggedin');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {

               redirect('userLogin');
        }

        else {
          
         $this->load->library('pagination');

         $count = $this->Onlyforyou_model->onlyforyouListingCount();
         $returns = $this->paginationCompress("userOnlyforyou/", $count, 10);


        $userid = $this->session->userdata('userid');
        $data['useronlyforyou'] = $this->Onlyforyou_model->OnlyforyouListing($userid,$returns["page"], $returns["segment"]);

        $data['purchasehistory'] = $this->Onlyforyou_model->totalpurchase($userid);
        $data['redeemammount'] = $this->Onlyforyou_model->totalredeem($userid);


        $this->loadfrontViews("frontend/onlyforyou", $this->global, NULL , NULL, $data);

        }
        
    }

 }