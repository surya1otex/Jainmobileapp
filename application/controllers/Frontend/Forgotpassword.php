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
         $this->load->model('Frontend/Forgotpassword_model');
         $this->load->library('form_validation');
      
    }

    /**
     * This function used to load the first screen of the user
     */
    function index() {
      
            $this->global['pageTitle'] = 'Forgot passaword';
            $this->loadView("Frontend/forgotpassword", $this->global, NULL, NULL);
        }
    

   
    function otp() {
      
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|numeric|exact_length[10]');        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();

        }
        else {
        $username = "mantdemo1";
        $password = "1819786680";
        $name = "JainMobiles";
        $mobile = $this->input->post('mobile');
        $msg = "OTP Sent successfully";
        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=$username&password=$password&sendername=$name&mobileno=$mobile&message=$msg";

       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $curl_scraped_page = curl_exec($ch);
       curl_close($ch);

        //$data['userinfo'] = $this->Forgotpassword_model->getuserid($mobile);

        $result = $this->Forgotpassword_model->getuserid($mobile);

         if(!empty($result)) {

             $data['userinfo'] = $result;
             $this->global['pageTitle'] = 'Otp';
             $this->loadView("frontend/sendotp",  $data);
         }
         else {
            $this->session->set_flashdata('nomatchmobile', 'No number registered with this number');
            redirect('userforgotPassword');
         }
         
        //print_r($result);

        //$this->global['pageTitle'] = 'Otp';

        //print_r($data['userinfo']);

        //$this->loadView("frontend/sendotp",  $data);
            //echo 'Proceed to next step';
     }
 
            

    }
    
    function resetpassword() {

        // otp validation code to be written here //
       
        // if otp validated then redirect to resetpassword page

        //otherwise redirect to sendotp page
        
         if(!$otpvalidated) {

            $this->loadView("frontend/sendotp", $this->global, NULL, NULL);

         }

         else {


           $this->loadView("frontend/resetpassword", $this->global, NULL, NULL);
          }

    }

   function updatepassword() {

     $this->form_validation->set_rules('password', 'Password', 'required|callback_valid_password');
     $this->form_validation->set_rules('conf_password', 'Confirmpassword',  'required|matches[password]');

        if($this->form_validation->run() == FALSE)
        {
            $this->loadView("frontend/resetpassword", $this->global, NULL, NULL);

        }

        else {
            echo 'password changed';
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

?>