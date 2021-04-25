<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Changepassword  extends BaseController//extends CI_Controller
{

    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Frontend/Changepassword_model');
    }

    public function index(){

        $this->global['pageTitle'] = 'Change Password';


       $isLoggedIn = $this->session->userdata('userloggedin');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {

               redirect('userLogin');
        }
        else {
       $this->loadfrontViews("frontend/changepassword", $this->global, NULL , NULL);

      }
        
    }
    function changepassword()
    {
        //$this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|callback_valid_password|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            //redirect('changemypassword');

            $this->index();


        }
        else
        {
        	$id= $this->session->userdata('userid');
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->Changepassword_model->matchOldPassword($id, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');

               redirect('changemypassword');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->Changepassword_model->changePassword($id, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }

                redirect('changemypassword');
            }
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