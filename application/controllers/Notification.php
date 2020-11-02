<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Notification extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
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

            $count = $this->notification_model->notificationListingCount($searchText);

            $returns = $this->paginationCompress("notification/", $count, 10);

            $data['userRecords'] = $this->notification_model->notificationListing($searchText, $returns["page"], $returns["segment"]);

           

            $this->loadViews("notification_list", $this->global, $data, NULL);
        }
    }

   
    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            $data['users'] = $this->notification_model->getUsers();

            

            $this->loadViews("notification_add", $this->global, $data, NULL);
        }
    }

   
    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('message', 'message',  'required');
            
           

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['message'] = $this->input->post('message');
               
                $userInfo['date_added']=date('Y-m-d H:i:s');
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
                $result = $this->notification_model->add($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('notification/addNew');
            }
        }
    }

  
    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
           
            $data['users'] = $this->notification_model->getUsers();
            $data['userInfo'] = $this->notification_model->getEditInfo($id);

           

            $this->loadViews("notification_edit", $this->global, $data, NULL);
        }
    }

   
    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('notification_id');

           $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('message', 'message',  'required');
           

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['message'] = $this->input->post('message');
               
                
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
              
                $result = $this->notification_model->edit($userInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', ' updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }

                redirect('notification');
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