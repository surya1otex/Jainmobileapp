<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Pricedrop extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
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

            $count = $this->Pricedrop_model->pricedropListingCount($searchText);

            $returns = $this->paginationCompress("pricedrop/", $count, 10);

            $data['userRecords'] = $this->Pricedrop_model->pricedropListing($searchText, $returns["page"], $returns["segment"]);



            $this->loadViews("pricedrop_list", $this->global, $data, NULL);
        }
    }

    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $data['users'] = $this->Pricedrop_model->getUsers();
            $this->loadViews("pricedrop_add", $this->global, $data, NULL);
        }
    }

    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {


            $this->form_validation->set_rules('user_id', 'user id', 'required');
            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('drop_price', 'drop price', 'required');
            $this->form_validation->set_rules('feature', 'feature', 'required');
            $this->form_validation->set_rules('product_name', 'product name', 'required');
           //$this->form_validation->set_rules('product_image', 'product image', 'required');


            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {

                $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['price'] = $this->input->post('price');
                $userInfo['drop_price'] = $this->input->post('drop_price');
                $userInfo['feature'] = $this->input->post('feature');
                $userInfo['description'] = $this->input->post('description');
                $userInfo['product_name'] = $this->input->post('product_name');

                $this->load->library('upload');

                $this->load->library('image_lib');

                 if ($_FILES['product_image']['name'] != "") {
                    $value = $_FILES['product_image']['name'];

                    $config = array(
                        'file_name' => $value,
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => './uploads/photos/large/',
                        'overwrite' => FALSE,
                        'max_size' => 2000
                    );
                    //
                    $this->load->library('upload', $config);
                     $this->upload->initialize($config);



                    if (!$this->upload->do_upload('product_image')) {
                        // return the error message and kill the script
                        echo $this->upload->display_errors() . 'File Type: ' . $this->upload->file_type;
                        die();


                    } else {
                        $flag = 1;
                        $image_data = $this->upload->data('product_image');
                        $upName = $image_data['file_name'];

                        $config = array(
                            'source_image' => $image_data['full_path'],
                            'new_image' => './uploads/photos/thumbs/',
                            'maintain_ration' => true,
                            'overwrite' => FALSE,
                            'width' => 400,
                            'height' => 210
                        );

                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                    }

                    $img = $upName;

                } else {
                    $img = $this->input->post('product_image');
                }
                
                
                
                $userInfo['product_image'] = $value;
                $userInfo['date_added'] = date('Y-m-d H:i:s');
                $userInfo['date_modified'] = date('Y-m-d H:i:s');

                $result = $this->Pricedrop_model->add($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('pricedrop/addNew');
            }
        }
    }

    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {


            $data['users'] = $this->Pricedrop_model->getUsers();
            $data['userInfo'] = $this->Pricedrop_model->getEditInfo($id);



            $this->loadViews("pricedrop_edit", $this->global, $data, NULL);
        }
    }

    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $id = $this->input->post('pricedrop_id');

            $this->form_validation->set_rules('user_id', 'user id', 'required');
            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('drop_price', 'drop price', 'required');
            $this->form_validation->set_rules('feature', 'feature', 'required');

            $this->form_validation->set_rules('product_name', 'product name', 'required');
            //$this->form_validation->set_rules('product_image', 'product image', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
                $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['price'] = $this->input->post('price');
                $userInfo['drop_price'] = $this->input->post('drop_price');
                $userInfo['feature'] = $this->input->post('feature');
                $userInfo['description'] = $this->input->post('description');
                $userInfo['product_name'] = $this->input->post('product_name');
               
                $this->load->library('upload');
                 $this->load->library('image_lib');
                  if ($_FILES['product_image']['name'] != "") {
                    $value = $_FILES['product_image']['name'];
                    $config = array(
                        'file_name' => $value,
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => './uploads/photos/large/',
                        'overwrite' => FALSE,
                        'max_size' => 20000,
                    );
                    $this->upload->initialize($config);
                    // $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('product_image')) {
                        // return the error message and kill the script
                        echo $this->upload->display_errors() . 'File Type: ' . $this->upload->file_type;
                        die();
                    } else {
                        $flag = 1;
                        $image_data = $this->upload->data('product_image');
                        $upName = $image_data['file_name'];

                        $config = array(
                            'source_image' => $image_data['full_path'],
                            'new_image' => './uploads/photos/thumbs/',
                            'maintain_ration' => true,
                            'overwrite' => FALSE,
                            'width' => 400,
                            'height' => 310
                        );
                        $this->image_lib->initialize($config);
                        // $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                    }

                    $img = $upName;
                }
                if ($this->upload->do_upload('product_image')) {
                    $userInfo['product_image'] = $value;
                }
                
                
                
                
                $userInfo['date_added'] = date('Y-m-d H:i:s');
                $userInfo['date_modified'] = date('Y-m-d H:i:s');

                $result = $this->Pricedrop_model->edit($userInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'updation failed');
                }

                redirect('pricedrop');
            }
        }
    }

    function deletepricedrop() {
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $userId = $this->input->post('userId');
            $this->load->model('Pricedrop_model');
            $result = $this->Pricedrop_model->deletepricedrop($userId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

}

?>