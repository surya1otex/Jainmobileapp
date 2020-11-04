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
        $this->load->model('User_model');
        $this->load->model('Frontend/UserPayoutsummery_model');
        //$this->load->model('Frontend/Myaccount_model');
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
       $data['payoutlists'] = $this->UserPayoutsummery_model->payoutlists($id);
       $this->loadfrontViews("frontend/myaccount", $this->global, NULL , NULL, $data);

      }
        
    }

    function updateprofile() {


    }

    function sendfeedback() {
     
       $this->form_validation->set_rules('product', 'Product',  'required');
       $this->form_validation->set_rules('messase', 'Message',  'required');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $feedbackInfo['user_id'] = $this->input->post('user_id');
                $feedbackInfo['purchase_product_name'] = $this->input->post('product');
                $feedbackInfo['messase'] = $this->input->post('messase');
                $feedbackInfo['date_added'] = date('Y-m-d H:i:s');
                $feedbackInfo['date_modified'] = date('Y-m-d H:i:s');

                $result = $this->Myaccount_model->send($feedbackInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Feedback Sent Successfully');
                } else {
                    $this->session->set_flashdata('error', ' Error sending feedback');
                }
            
                redirect('userMyaccount');
              }


    }

 }