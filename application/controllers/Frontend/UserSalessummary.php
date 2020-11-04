<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class UserSalessummary  extends BaseController//extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Frontend/UserSalessummery_model');
    }

    public function index(){
$userid=$this->session->userdata('userid');
       // echo 'Hello World';
       $this->global['pageTitle'] = 'Sales Summary';
      //  $searchText = $this->security->xss_clean($this->input->post('searchText'));
        //    $data['searchText'] = $searchText;

             $fromdate = $this->input->post('fromdate');
             $todate = $this->input->post('todate');


            $this->load->library('pagination');

            $count = $this->UserSalessummery_model->salessummeryListingCount($userid);

            $returns = $this->paginationCompress("userSalessummary/", $count, 10);

            $data['userRecords'] = $this->UserSalessummery_model->salessummeryListing($userid,
               $returns["page"], $returns["segment"]);
            
            $data['totalsummery'] = $this->UserSalessummery_model->totalsummery($userid,$firstdate='',$lastdate='');
           
       $this->loadfrontViews("frontend/salessummary", $this->global, NULL, NULL, $data );
        
    }

   public function search() {

       $this->global['pageTitle'] = 'Sales Summary';
       $userid=    $this->session->userdata('userid');
       $fromdate = $this->input->post('fromdate');
       $todate = $this->input->post('todate');

       //echo $fromdate;
       $this->load->library('pagination');
       
       
       $data['userRecords'] = $this->UserSalessummery_model->searchdates($userid,$fromdate,$todate);
       $data['todate'] = $todate;
       $data['fromdate'] = $fromdate;
       $data['totalsummery'] = $this->UserSalessummery_model->totalsummery($userid,$fromdate,$todate);

      $this->loadfrontViews("frontend/salessummary", $this->global, NULL, NULL, $data );
   }

 }