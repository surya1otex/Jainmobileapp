<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Termcondition extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Termscondition_model');
        //$this->load->library('form_validation');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    function index() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            //$searchText = $this->security->xss_clean($this->input->post('searchText'));
            //$data['searchText'] = $searchText;

            //$this->load->library('pagination');

            //$count = $this->notification_model->notificationListingCount($searchText);

            //$returns = $this->paginationCompress("notification/", $count, 10);

            //$data['userRecords'] = $this->notification_model->notificationListing($searchText, $returns["page"], $returns["segment"]);

             $data['termsconditions'] = $this->Termscondition_model->conditionsListing();

           

            $this->loadViews("terms_list", $this->global, $data, NULL);
        }
    }

   
    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            //$data['users'] = $this->notification_model->getUsers();

            

            $this->loadViews("termcondition_add", $this->global,  NULL);
        }
    }

   
    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('title', 'Title',  'required');
            $this->form_validation->set_rules('description', 'Description',  'required');
            
           

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                $conditionInfo['title'] = $this->input->post('title');
                $conditionInfo['description'] = $this->input->post('description');
               
                $conditionInfo['date_added']=date('Y-m-d H:i:s');
                $conditionInfo['date_modified']= date('Y-m-d H:i:s');  
                $result = $this->Termscondition_model->add($conditionInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('Termcondition/addNew');
            }
        }
    }

  
    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
           
            //$data['users'] = $this->notification_model->getUsers();
            $data['conditionInfo'] = $this->Termscondition_model->getEditInfo($id);

           

            $this->loadViews("termcondition_edit", $this->global, $data, NULL);
        }
    }

   
    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

                $id = $this->input->post('condition_id');

           $this->form_validation->set_rules('title', 'Title',  'required');
            $this->form_validation->set_rules('description', 'Description',  'required');
           

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
                $conditionInfo['title'] = $this->input->post('title');
                $conditionInfo['description'] = $this->input->post('description');
               
                
                $conditionInfo['date_modified']= date('Y-m-d H:i:s');  
              
                $result = $this->Termscondition_model->edit($conditionInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', ' updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }
               
                $this->index();
                //redirect('notification');
            }
        }
    }

   
    function deletenotification() {
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $userId = $this->input->post('userId');
           $this->load->model('notification_model');
            $result = $this->notification_model->deletenotification($userId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

}

?>