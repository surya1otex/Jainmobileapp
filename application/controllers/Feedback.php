<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Feedback extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Feedback_model');
        $this->isLoggedIn();
    }

    public function index() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
   $this->load->library('pagination');

            $count = $this->Feedback_model->feedbackListingCount();

            $returns = $this->paginationCompress("feedback/", $count, 10);

            
            
            
            
            $data['feedbacks'] = $this->Feedback_model->feedbackListing($returns["page"], $returns["segment"]);
            $this->loadViews("feedback_list", $this->global, $data, NULL);
    }

 }

}