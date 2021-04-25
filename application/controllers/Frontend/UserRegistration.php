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
        //$this->load->library('form_validation');
        $this->load->library('form_validation');
        //$this->load->library('mailboxvalidator');
    }

    public function index() {

       $this->loadView("frontend/register", $this->global, NULL , NULL);
        
    }


   function register() {
    
            
            $this->load->helper('string');
            $this->load->helper('email');
            $this->load->helper('security');

           // $this->form_validation->
            //set_rules('mobile', 'Mobile Number', 'required|numeric|exact_length[10]');

            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|exact_length[10]|xss_clean|regex_match[/^[0-9,]+$/]');

            //$this->form_validation->set_rules('email', 'Email',  'trim|required|valid_email|xss_clean');


//$this->form_validation->set_rules('email', 'Email', 'required|valid_email|disposable', array('disposable' => 'A disposable email address is detected.'));


            $this->form_validation->set_rules('password', 'Password', 'required|callback_valid_password');

            $this->form_validation->set_rules('confirmpassword', 'Confirmpassword',  'required|matches[password]');

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

    //Create strong password 
    public function valid_password($password = '')
    {
        $password = trim($password);

        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');

            return FALSE;
        }

        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');

            return FALSE;
        }

        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');

            return FALSE;
        }

        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');

            return FALSE;
        }

        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));

            return FALSE;
        }

        if (strlen($password) < 8)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');

            return FALSE;
        }

        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

            return FALSE;
        }

        return TRUE;
    }

  }