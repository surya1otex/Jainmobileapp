<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserLogin  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    private $exp_time = 60 * 5; //5 minutes
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/Login_model');
        $this->load->library('form_validation');
    }

    public function index(){

        $this->isLoggedIn();
        
    }

    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('userloggedin');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
              $this->loadView("frontend/login");
              
        }
        else
        {
            redirect('userProfile');
        }
    }

    public function loginMe()
    {
        
        
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[32]');
        $this->form_validation->set_rules('password', 'Password', 'required');        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();

        }
        else
        {
            $mobile = $this->input->post('mobile');
            $password = $this->input->post('password');
            $rememberme = $this->input->post('rememberme');

            if($rememberme) {
                //set_cookie('mobile',$mobile);
            }
            
            $result = $this->Login_model->loginUser($mobile, $password);

            
            if(!empty($result))
            {
                $data["userid"] = $result->userId;

                $this->session->set_userdata('userid', $data["userid"]);
                $this->session->set_userdata('userloggedin', TRUE);
                
                redirect('userProfile');
            }



            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                $this->index();
                 redirect ( 'userLogin' );
                //echo 'error';
            }
        }
    }

  function logout() {
    $this->session->sess_destroy ();
    
   redirect ( 'userLogin' );
  }

 }