<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class District_Management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('district');
        $this->load->model('locations');
    }

    public function index() {
        $doc = new district();
        $data = array();
        $data['page_title'] = 'Manage District';
        $data['result'] = $doc->find_all();
        $data['main_content'] = $this->load->view('district_management/index', $data, TRUE);
        $this->load->view('layout', $data);
    }
    
//    public function user() {
//        $data = array();
//        $data['page_title'] = 'Training User Records';
//        $data['main_content'] = $this->load->view('training_records/user', $data, TRUE);
//        $this->load->view('layout', $data);
//    }
    
    public function export_excel() {
        $data = array();
        $data['page_title'] = 'District Records';
        $data['main_content'] = $this->load->view('district_management/export_excel', $data, TRUE);
        $this->load->view('layout', $data);
    }

    public function add() {

$district = new district();

if(isset($_REQUEST['districtid']) && !empty($_REQUEST['districtid'])){
    $district->PkLocID = $_REQUEST['districtid'];
}


$district->LocName = $_POST['LocName'];
$district->ParentID = 3;

//$district->LocLvl = $_POST['lvl'];
//$district->ParentID = $_POST['district_of_domicile'];

$checkname = $district->checkdistrictname($district->LocName);

if($checkname){

    echo "district already exist";
    exit();
    
}else{
    $file = $district->save();
//    print_r($file);
//    exit;
}
        redirect(base_url() .'district_management/index', 'refresh');
    }




    public function edit()
    {
        $district = new district();
        $location = new locations();
        $data['location'] = $location->districtdropdown2();
        $district_id = $_POST['id'];
        $file = $district->find_by_id($district_id);
        $data['result'] = $file->result_array();
        $data['district_id'] = $district_id;
        $data['page_title'] = 'District Records';
        $this->load->view('district_management/edit', $data);
    }

}