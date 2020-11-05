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
        $this->load->library('form_validation');
        $this->load->model('Frontend/Myaccount_model');
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

       $data['userprofile'] = $this->Myaccount_model->getUserInfo($id);
       $this->loadfrontViews("frontend/myaccount", $this->global, NULL , NULL, $data);

      }
        
    }

    function updateprofile() {

    if($_FILES["profile_pic"]["name"] != "")
    {

      $config['upload_path'] = './uploads/photos/profile';  
      $config['allowed_types']  = 'gif|jpg|png';  
       $this->load->library('upload', $config); 


       if(!$this->upload->do_upload('profile_pic'))  
          {  
              echo $this->upload->display_errors();  
          } 

              else  
             {  
         $data = array('upload_data' => $this->upload->data());
         $userinfo['image'] = $data['upload_data']['file_name'];
          }
        }
         $userid = $this->input->post('userid');
         $userinfo['name']= $this->input->post('name');
         $userinfo['email']= $this->input->post('email');
         $userinfo['mobile'] = $this->input->post('phone');
         $userinfo['address'] = $this->input->post('address');
         
        // $image = $data['upload_data']['file_name'];
 
         $result= $this->Myaccount_model->editUser($userinfo,$userid);

         redirect('userMyaccount');

         //return $result;
    //}
}


 }