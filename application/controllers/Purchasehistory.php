<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Purchasehistory extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
        $this->load->model('Purchasehistory_model');
         $this->load->library('form_validation');
         $this->load->library('csvimport');
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

            $count = $this->Purchasehistory_model->purchaseListingCount($searchText);

            $returns = $this->paginationCompress("purchasehistory/", $count, 10);

            $data['purchaseRecords'] = $this->Purchasehistory_model->purchaselisting($searchText, $returns["page"], $returns["segment"]);

           

            $this->loadViews("purchasehistory_list", $this->global, $data, NULL);
        }
    }

   
    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            $data['users'] = $this->Purchasehistory_model->getUsers();

            

            $this->loadViews("purchasehistory_add", $this->global, $data, NULL);
        }
    }

   
    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('ammount', 'ammount',  'required');
            $this->form_validation->set_rules('title', 'Title',  'required');
            
            $this->form_validation->set_rules('description', 'Description',  'required');


            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['amount'] = $this->input->post('ammount');
                $userInfo['title']  = $this->input->post('title');
                $userInfo['description'] = $this->input->post('description');
                $userInfo['date_added']=date('Y-m-d H:i:s');
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
                $result = $this->Purchasehistory_model->add($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('Purchasehistory/addNew');
            }
        }
    }

  
    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
           
            $data['users'] = $this->Purchasehistory_model->getUsers();
            $data['userInfo'] = $this->Purchasehistory_model->getEditInfo($id);

           

            $this->loadViews("purchasehistory_edit", $this->global, $data, NULL);
        }
    }

   
    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('purchase_id');

            $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('title', 'Title',  'required');
            $this->form_validation->set_rules('ammount', 'ammount',  'required');
            $this->form_validation->set_rules('description', 'Description',  'required');

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['amount'] = $this->input->post('ammount');
                $userInfo['title'] = $this->input->post('title');
                $userInfo['description'] = $this->input->post('description');
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
              
                $result = $this->Purchasehistory_model->edit($userInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', ' updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }

                redirect('Purchasehistory');
            }
        }
    }

   
    function deletepurchasehistory() {
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $userId = $this->input->post('userId');
           $this->load->model('Purchasehistory_model');
            $result = $this->Purchasehistory_model->deletepurchasehistory($userId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

     function importPayout()
     {

     $this->loadViews('import_csv', $this->global);
     }

      function import() {
     
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

        foreach($file_data as $row)
         {
           $data[] = array(
          'user_id' => 1,
          'title' => $row["title"],
          'amount'  => $row["amount"],
          'description'   => $row["description"],
          'date_added'   => date('Y-m-d H:i:s'),
          'date_modified' =>date('Y-m-d H:i:s')
          );
        }
      $result = $this->Purchasehistory_model->insert($data);
      redirect('Purchasehistory');
   }
 }

?>