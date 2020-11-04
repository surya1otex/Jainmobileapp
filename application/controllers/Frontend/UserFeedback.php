<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserFeedback  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Frontend/Feedback_model');
    }

    public function index(){

        $this->global['pageTitle'] = 'Send Feedback';


       $isLoggedIn = $this->session->userdata('userloggedin');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {

               redirect('userLogin');
        }
        else {

       $id= $this->session->userdata('userid');

       //echo $id;

       $data['userprofile'] = $this->Feedback_model->getUserInfo($id);

       $data['payoutlists'] = $this->Feedback_model->payoutlists($id);
       $data['purchasehistory'] = $this->Feedback_model->totalpurchase($id);
       $data['redeemammount'] = $this->Feedback_model->totalredeem($id);
       $this->loadfrontViews("frontend/feedback", $this->global, NULL , NULL, $data);

      }
        
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

                $result = $this->Feedback_model->send($feedbackInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Feedback Sent Successfully');
                } else {
                    $this->session->set_flashdata('error', ' Error sending feedback');
                }
            
                $this->index();
              }


    }

 }