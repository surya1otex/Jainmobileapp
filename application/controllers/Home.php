<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Home  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
       // $this->load->model('frontend/Login_model');
    }

    public function index(){

       // echo 'Hello World';

       $this->loadView("frontend/index", $this->global, NULL , NULL);
        
    }

 }