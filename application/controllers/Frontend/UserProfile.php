<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserProfile  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        //$this->isUserLoggedIn();
        $this->load->model('User_model');

    }

    public function index(){

       $this->global['pageTitle'] = 'Profile';
       $isLoggedIn = $this->session->userdata('userloggedin');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {

               redirect('userLogin');
        }
        else {
       $id= $this->session->userdata('userid');

       $data['userprofile'] = $this->User_model->getUserInfo($id);


       $this->loadview("frontend/profile", $data);

      }
        
    }

 }