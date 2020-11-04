<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserPayoutsummary  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/UserPayoutsummery_model');
    }

    public function index(){
$userid=$this->session->userdata('userid');
       // echo 'Hello World';
       $this->global['pageTitle'] = 'Payout Summary';
       
        
            $this->load->library('pagination');

            $count = $this->UserPayoutsummery_model->purchaseListingCount($userid);

            $returns = $this->paginationCompress("userPayoutsummary/", $count, 10);

            $data['purchaseRecords'] = $this->UserPayoutsummery_model->purchaselisting($userid, $returns["page"], $returns["segment"]);

           $data['totalpayout'] = $this->UserPayoutsummery_model->totalpayout($userid);
       $this->loadfrontViews("frontend/payout", $this->global,  NULL, NULL,$data );
        
    }

 }