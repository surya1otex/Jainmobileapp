<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserRedeemgift  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/Redeemgift_model');
    }

    public function index(){

       // echo 'Hello World';
       $this->global['pageTitle'] = 'Redeem Gift & Point';

       $isLoggedIn = $this->session->userdata('userloggedin');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {

               redirect('userLogin');
        }
        else {
          
            $this->load->library('pagination');

            $count = $this->Redeemgift_model->redeemListingCount();
            $returns = $this->paginationCompress("userRedeemgift/", $count, 3);

        $userid = $this->session->userdata('userid');
        $data['redeemgift'] = $this->Redeemgift_model->redeemgiftListing($userid, $returns["page"], $returns["segment"]);
        $data['totalpurchase'] = $this->Redeemgift_model->totalpurchase($userid);
        $data['totalpoints'] = $this->Redeemgift_model->totalpoints($userid);
         $this->loadfrontViews("frontend/redeemgift", $this->global, NULL , NULL, $data);
     }
        
    }

 }