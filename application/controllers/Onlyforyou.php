<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Onlyforyou extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Onlyforyou_model');
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

            $count = $this->Onlyforyou_model->OnlyforyouListingCount($searchText);

            $returns = $this->paginationCompress("Onlyforyou/", $count, 10);

            $data['userRecords'] = $this->Onlyforyou_model->OnlyforyouListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'jain mobile app : special offer Listing';

            $this->loadViews("Onlyforyou_list", $this->global, $data, NULL);
        }
    }

   
    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            $data['users'] = $this->Onlyforyou_model->getUsers();

            $data['products'] = $this->Pricedrop_model->pricedropproducts();

            $this->global['pageTitle'] = 'Jain Mobile App : Add New User';

            $this->loadViews("onlyforyou_add", $this->global, $data, NULL);
        }
    }

   
    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           

           $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('onlyforyou_price', 'onlyforyou_price',  'required');          
           // $this->form_validation->set_rules('onlyforyou_image', 'onlyforyou image', 'required');

           $this->form_validation->set_rules('imei_number', 'IMEI Number', 'required');

           $this->form_validation->set_rules('product_name', 'Product Name', 'required');

           $this->form_validation->set_rules('product_feature', 'Product Feature', 'required');

           $this->form_validation->set_rules('product_desc', 'Product Description', 'required');
              
           $this->form_validation->set_rules('redeem_point', 'Redeem Point', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['onlyforyou_price'] = $this->input->post('onlyforyou_price');
                $userInfo['imei'] = $this->input->post('imei_number');
                $userInfo['product_name'] = $this->input->post('product_name');
                $userInfo['product_feature'] = $this->input->post('product_feature');
                $userInfo['product_desc'] = $this->input->post('product_desc');
                $userInfo['redeem'] = $this->input->post('redeem_point');

                //$userInfo['onlyforyou_image'] = $this->input->post('onlyforyou_image');
                $userInfo['date_added']=date('Y-m-d H:i:s');
                $userInfo['date_modified']= date('Y-m-d H:i:s');

                 if ($_FILES['onlyforyou_image']['name'] != "") {

                    $imagename = $_FILES['onlyforyou_image']['name'];
                
                $config['upload_path']          = './uploads/photos/onlyforyou/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('onlyforyou_image'))
                {
                        // return the error message and kill the script
                        echo $this->upload->display_errors() . 'File Type: ' . $this->upload->file_type;
                        die();
                }
             
             } 
                $userInfo['onlyforyou_image'] = $imagename;
                $result = $this->Onlyforyou_model->add($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('onlyforyou/addNew');
            }
        }
    }

  
    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            
            $data['users'] = $this->Onlyforyou_model->getUsers();
            $data['userInfo'] = $this->Onlyforyou_model->getEditInfo($id);

            $data['products'] = $this->Pricedrop_model->pricedropproducts();

            $this->loadViews("onlyforyou_edit", $this->global, $data, NULL);
        }
    }

   
    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            $id = $this->input->post('onlyforyou_id');

             $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('onlyforyou_price', 'onlyforyou_price',  'required');          
            //$this->form_validation->set_rules('onlyforyou_image', 'onlyforyou image', 'required');
           $this->form_validation->set_rules('imei_number', 'IMEI Number', 'required');

           $this->form_validation->set_rules('product_name', 'Product Name', 'required');

           $this->form_validation->set_rules('product_feature', 'Product Feature', 'required');

           $this->form_validation->set_rules('product_desc', 'Product Description', 'required');
              
           $this->form_validation->set_rules('redeem_point', 'Redeem Point', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
                $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['onlyforyou_price'] = $this->input->post('onlyforyou_price');
                //$userInfo['onlyforyou_image'] = $this->input->post('onlyforyou_image');
                $userInfo['imei'] = $this->input->post('imei_number');
                $userInfo['redeem'] = $this->input->post('redeem_point');
                $userInfo['product_name'] = $this->input->post('product_name');
                $userInfo['product_feature'] = $this->input->post('product_feature');
                $userInfo['product_desc'] = $this->input->post('product_desc');
                $userInfo['date_modified']= date('Y-m-d H:i:s');  

                $this->load->library('upload');
                 $this->load->library('image_lib');
                  if ($_FILES['onlyforyou_image']['name'] != "") {
                    $value = $_FILES['onlyforyou_image']['name'];
                    $config = array(
                        'file_name' => $value,
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => './uploads/photos/onlyforyou/',
                        'overwrite' => FALSE,
                        'max_size' => 20000,
                    );
                    $this->upload->initialize($config);
                    // $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('onlyforyou_image')) {
                        // return the error message and kill the script
                        echo $this->upload->display_errors() . 'File Type: ' . $this->upload->file_type;
                        die();
                    } else {
                        $flag = 1;
                        $image_data = $this->upload->data('onlyforyou_image');
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

                if ($this->upload->do_upload('onlyforyou_image')) {
                    $userInfo['onlyforyou_image'] = $value;
                }

                $result = $this->Onlyforyou_model->edit($userInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'User updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'User updation failed');
                }

                redirect('onlyforyou');
            }
        }
    }

   
    function deleteonlyforyou() {
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $userId = $this->input->post('userId');
           $this->load->model('Onlyforyou_model');
            $result = $this->Onlyforyou_model->deleteonlyforyou($userId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

}

?>