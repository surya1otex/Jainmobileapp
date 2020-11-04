<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Forgotpassword extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
       // $this->load->model('Userforgotpassword_model');
         $this->load->library('form_validation');
      
    }

    /**
     * This function used to load the first screen of the user
     */
    function index() {
      
 $this->global['pageTitle'] = 'Forgot passaword';
            $this->loadfrontViews("Frontend/forgotpassword", $this->global, NULL, NULL);
        }
    

   
    function otp() {
      
           

            
            $this->global['pageTitle'] = 'Otp';
            $this->loadfrontViews("Frontend/sendotp", $this->global, NULL, NULL);
        }
    

   
}

?>