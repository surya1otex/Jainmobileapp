<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Specialoffer extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('specialoffer_model');
        $this->load->model('Pricedrop_model');
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

            $count = $this->specialoffer_model->specialofferListingCount($searchText);

            $returns = $this->paginationCompress("specialoffer/", $count, 10);

            $data['userRecords'] = $this->specialoffer_model->specialofferListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'jain mobile app : special offer Listing';

            $this->loadViews("specialoffer_list", $this->global, $data, NULL);
        }
    }

   
    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            $data['users'] = $this->specialoffer_model->getUsers();

            $data['products'] = $this->Pricedrop_model->pricedropproducts();

            $this->loadViews("specialoffer_add", $this->global, $data, NULL);
        }
    }

   
    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('user_id', 'user id',  'required');
           $this->form_validation->set_rules('offer_name', 'Offer Name',  'required');
           
           $this->form_validation->set_rules('offer_price', 'offer_price',  'required');
           $this->form_validation->set_rules('regular_price', 'Regular Price',  'required');

           $this->form_validation->set_rules('offer_desc', 'Offer Description',  'required');
           

           // $this->form_validation->set_rules('offer_image', 'offer image',  'required');
           

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
               
                $userInfo['offer_price'] = $this->input->post('offer_price');
                $userInfo['regular_price'] = $this->input->post('regular_price'); 
                $userInfo['offer_name'] = $this->input->post('offer_name');
                $userInfo['offer_description'] = $this->input->post('offer_desc');
                $userInfo['date_added']=date('Y-m-d H:i:s');
                $userInfo['date_modified']= date('Y-m-d H:i:s');

                 if ($_FILES['offer_image']['name'] != "") {

                    $imagename = $_FILES['offer_image']['name'];
                
                $config['upload_path']          = './uploads/photos/special/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 6000;
                $config['max_height']           = 6000;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('offer_image'))
                {
                        // return the error message and kill the script
                        echo $this->upload->display_errors() . 'File Type: ' . $this->upload->file_type;
                        die();
                }
             
             }
                $userInfo['offer_image'] = $imagename;
                $result = $this->specialoffer_model->add($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('specialoffer/addNew');
            }
        }
    }

  
    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
           
            $data['users'] = $this->specialoffer_model->getUsers();
            $data['userInfo'] = $this->specialoffer_model->getEditInfo($id);

            $data['products'] = $this->Pricedrop_model->pricedropproducts();


            $this->loadViews("specialoffer_edit", $this->global, $data, NULL);
        }
    }

   
    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('specialoffer_id');

           $this->form_validation->set_rules('user_id', 'user id',  'required');
           $this->form_validation->set_rules('offer_name', 'Offer Name',  'required');
           
           $this->form_validation->set_rules('offer_price', 'offer_price',  'required');
           $this->form_validation->set_rules('regular_price', 'Regular Price',  'required');

           $this->form_validation->set_rules('offer_desc', 'Offer Description',  'required');


            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
               $userInfo['user_id'] = $this->input->post('user_id');
               
                $userInfo['offer_price'] = $this->input->post('offer_price');
                $userInfo['regular_price'] = $this->input->post('regular_price'); 
                $userInfo['offer_name'] = $this->input->post('offer_name');
                $userInfo['offer_description'] = $this->input->post('offer_desc');
                
                $userInfo['date_modified']= date('Y-m-d H:i:s');  

                  $this->load->library('upload');
                  if ($_FILES['offer_image']['name'] != "") {
                    $value = $_FILES['offer_image']['name'];
                    $config = array(
                        'file_name' => $value,
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => './uploads/photos/special/',
                        'overwrite' => FALSE,
                        'max_size' => 20000,
                    );

                    $this->upload->initialize($config);
                    //$this->upload->initialize($config);
                    // $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('offer_image')) {
                        // return the error message and kill the script
                        echo $this->upload->display_errors() . 'File Type: ' . $this->upload->file_type;
                        die();
                    } else {
                        $flag = 1;
                        $image_data = $this->upload->data('offer_image');
                        $upName = $image_data['file_name'];

                        $config = array(
                            'source_image' => $image_data['full_path'],
                            'new_image' => './uploads/photos/thumbs/',
                            'maintain_ration' => true,
                            'overwrite' => FALSE,
                            'width' => 400,
                            'height' => 310
                        );
                        //$this->image_lib->initialize($config);
                        // $this->load->library('image_lib', $config);
                        //$this->image_lib->resize();
                    }

                    $img = $upName;
                }
                if ($this->upload->do_upload('offer_image')) {
                    $userInfo['offer_image'] = $value;
                }
                $result = $this->specialoffer_model->edit($userInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', ' updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }

                redirect('specialoffer');
            }
        }
    }

   
    function deletespecialoffer() {
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $userId = $this->input->post('userId');
           $this->load->model('specialoffer_model');
            $result = $this->specialoffer_model->deletespecialoffer($userId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

}

?>