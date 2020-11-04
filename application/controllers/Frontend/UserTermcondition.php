<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserTermcondition  extends BaseController//extends CI_Controller
{

    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/Termscondition_model');
    }
    public function index(){

        $this->global['pageTitle'] = 'Terms & Conditions';


       $isLoggedIn = $this->session->userdata('userloggedin');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {

               redirect('userLogin');
        }
        else {
       $data['termconditions'] = $this->Termscondition_model->conditionsListing();
       $this->loadfrontViews("frontend/termcondition", $this->global, NULL , NULL, $data);

      }
        
    }

 }