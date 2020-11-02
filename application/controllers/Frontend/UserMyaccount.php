<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserMyaccount  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index(){

        $this->global['pageTitle'] = 'My Account';


       $isLoggedIn = $this->session->userdata('userloggedin');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {

               redirect('userLogin');
        }
        else {

       $id= $this->session->userdata('userid');

       $data['userprofile'] = $this->User_model->getUserInfo($id);

       $this->loadfrontViews("frontend/myaccount", $this->global, NULL , NULL, $data);

      }
        
    }

 }