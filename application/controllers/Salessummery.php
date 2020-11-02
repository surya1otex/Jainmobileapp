<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Salessummery extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('salessummery_model');
         $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    function index() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->salessummery_model->salessummeryListingCount($searchText);

            $returns = $this->paginationCompress("salessummery/", $count, 10);

            $data['userRecords'] = $this->salessummery_model->salessummeryListing($searchText, $returns["page"], $returns["segment"]);

           

            $this->loadViews("salessummery_list", $this->global, $data, NULL);
        }
    }

   
    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            $data['users'] = $this->salessummery_model->getUsers();

            

            $this->loadViews("salessummery_add", $this->global, $data, NULL);
        }
    }

   
    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('user_id', 'user id',  'required');
           
            $this->form_validation->set_rules('model', 'model',  'required');
             $this->form_validation->set_rules('unit', 'unit',  'required');
              $this->form_validation->set_rules('amount', 'amount',  'required');
            
           

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['model'] = $this->input->post('model');
                 $userInfo['unit'] = $this->input->post('unit');
                  $userInfo['amount'] = $this->input->post('amount');
               
                $userInfo['date_added']=date('Y-m-d H:i:s');
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
                $result = $this->salessummery_model->add($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('salessummery/addNew');
            }
        }
    }

  
    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
           
            $data['users'] = $this->salessummery_model->getUsers();
            $data['userInfo'] = $this->salessummery_model->getEditInfo($id);

           

            $this->loadViews("salessummery_edit", $this->global, $data, NULL);
        }
    }

   
    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('sales_summery_id');

           $this->form_validation->set_rules('user_id', 'user id',  'required');
           
             $this->form_validation->set_rules('model', 'model',  'required');
             $this->form_validation->set_rules('unit', 'unit',  'required');
              $this->form_validation->set_rules('amount', 'amount',  'required');
           

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
                 $userInfo['model'] = $this->input->post('model');
                 $userInfo['unit'] = $this->input->post('unit');
                  $userInfo['amount'] = $this->input->post('amount');
               
                
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
              
                $result = $this->salessummery_model->edit($userInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', ' updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }

                redirect('salessummery');
            }
        }
    }

   
    function deletesalessummery() {
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $userId = $this->input->post('userId');
           $this->load->model('salessummery_model');
            $result = $this->salessummery_model->deletesalessummery($userId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

}

?>