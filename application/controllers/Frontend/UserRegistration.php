<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserRegistration  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {


       $this->loadView("frontend/register", $this->global, NULL , NULL);
        
    }


   function register() {
    
            $this->load->library('form_validation');
            $this->load->helper('string');
            $this->form_validation->set_rules('name', 'Name',  'required');
            $this->form_validation->set_rules('mobile', 'Mobile',  'required');
            $this->form_validation->set_rules('email', 'Email',  'required');
            $this->form_validation->set_rules('password', 'Password',  'required');
            
            $this->form_validation->set_rules('confirmpassword', 'Confirmpassword',  'required');

              if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
            $userInfo['email'] = strtolower($this->security->xss_clean($this->input->post('email')));
            $userInfo['name'] = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
            $userInfo['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
            $userInfo['password'] = getHashedPassword($this->input->post('password'));
            $userInfo['address'] = $this->input->post('address');
            $userInfo['roleId'] = $this->input->post('role');
            $prefix = "JAIN";
            $userInfo['usercode'] = $prefix.random_string('numeric', 6);
            $this->load->model('user_model');


            $result = $this->user_model->addNewUser($userInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Registration successful.. You can login');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('userLogin');

            }
      }

  }