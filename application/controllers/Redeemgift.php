<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Redeemgift extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Redeemgift_model');
         
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

            $count = $this->Redeemgift_model->redeemgiftListingCount($searchText);

            $returns = $this->paginationCompress("redeemgift/", $count, 10);

            $data['userRecords'] = $this->Redeemgift_model->redeemgiftListing($searchText, $returns["page"], $returns["segment"]);

           

            $this->loadViews("redeemgift_list", $this->global, $data, NULL);
        }
    }

   
    function addNew() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            $data['users'] = $this->Redeemgift_model->getUsers();

          

            $this->loadViews("redeemgift_add", $this->global, $data, NULL);
        }
    }

   
    function add() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('redeemgift_price', 'Redeem Gift Price',  'required');
            $this->form_validation->set_rules('redeem_giftname', 'Redeem Gift Name',  'required');
            $this->form_validation->set_rules('redeem_giftdesc', 'Redeem Gift Description',  'required');
            $this->form_validation->set_rules('redeem_value', 'Redeem Value',  'required');
           // $this->form_validation->set_rules('redeemgift_image', 'redeemgift image', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['redeemgift_price'] = $this->input->post('redeemgift_price');
                $userInfo['redeemgift_name'] = $this->input->post('redeem_giftname');
                $userInfo['redeemgift_feature'] = $this->input->post('redeem_feature');
                $userInfo['redeemgift_desc'] = $this->input->post('redeem_giftdesc');
                $userInfo['redeem_value'] = $this->input->post('redeem_value');
                //$userInfo['redeemgift_image'] = $this->input->post('redeemgift_image');
                $userInfo['date_added']=date('Y-m-d H:i:s');
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
                
                 if ($_FILES['redeemgift_image']['name'] != "") {

                    $imagename = $_FILES['redeemgift_image']['name'];
                
                $config['upload_path']          = './uploads/photos/redeem/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('redeemgift_image'))
                {
                        // return the error message and kill the script
                        echo $this->upload->display_errors() . 'File Type: ' . $this->upload->file_type;
                        die();
                }
             
             }
                $userInfo['redeemgift_image'] = $imagename;
                $result = $this->Redeemgift_model->add($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New  created successfully');
                } else {
                    $this->session->set_flashdata('error', ' creation failed');
                }

                redirect('redeemgift/addNew');
            }
        }
    }

  
    function editOld($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            
           
            $data['users'] = $this->Redeemgift_model->getUsers();
            $data['userInfo'] = $this->Redeemgift_model->getEditInfo($id);

            

            $this->loadViews("redeemgift_edit", $this->global, $data, NULL);
        }
    }

   
    function edit() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('redeemgift_id');

            $this->form_validation->set_rules('user_id', 'user id',  'required');
            $this->form_validation->set_rules('redeemgift_price', 'Redeem Gift Price',  'required');
            $this->form_validation->set_rules('redeem_giftname', 'Redeem Gift Name',  'required');
            $this->form_validation->set_rules('redeem_giftdesc', 'Redeem Gift Description',  'required');
            $this->form_validation->set_rules('redeem_feature', 'Redeem Gift Feature',  'required');
            
            $this->form_validation->set_rules('redeem_value', 'Redeem Value',  'required');
           // $this->form_validation->set_rules('redeemgift_image', 'redeemgift image', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($id);
            } else {
                $userInfo['user_id'] = $this->input->post('user_id');
                $userInfo['redeemgift_price'] = $this->input->post('redeemgift_price');
                $userInfo['redeemgift_name'] = $this->input->post('redeem_giftname');
                $userInfo['redeemgift_desc'] = $this->input->post('redeem_giftdesc');
                $userInfo['redeem_value'] = $this->input->post('redeem_value');
                $userInfo['redeemgift_feature'] = $this->input->post('redeem_feature');
                //$userInfo['redeemgift_image'] = $this->input->post('redeemgift_image');
                
                $userInfo['date_modified']= date('Y-m-d H:i:s');  
                  $this->load->library('upload');
                  if ($_FILES['redeemgift_image']['name'] != "") {
                    $value = $_FILES['redeemgift_image']['name'];
                    $config = array(
                        'file_name' => $value,
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => './uploads/photos/redeem/',
                        'overwrite' => FALSE,
                        'max_size' => 20000,
                    );

                    $this->upload->initialize($config);
                    //$this->upload->initialize($config);
                    // $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('redeemgift_image')) {
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
                        //$this->image_lib->initialize($config);
                        // $this->load->library('image_lib', $config);
                        //$this->image_lib->resize();
                    }

                    $img = $upName;
                }
                if ($this->upload->do_upload('redeemgift_image')) {
                    $userInfo['redeemgift_image'] = $value;
                }
                $result = $this->Redeemgift_model->edit($userInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', ' updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }

                redirect('redeemgift');
            }
        }
    }

   
     function deleteredeemgift() {
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $userId = $this->input->post('userId');
           $this->load->model('Redeemgift_model');
            $result = $this->Redeemgift_model->deleteredeemgift($userId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

}

?>