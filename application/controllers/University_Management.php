<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class University_Management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('university');
    }

    public function index() {
         $doc = new university();
        $data = array();
        $data['result'] = $doc->find_all();
        $data['page_title'] = 'Manage Universities';
        $data['main_content'] = $this->load->view('university_management/index', $data, TRUE);
        $this->load->view('layout', $data);
    }
    
//    public function user() {
//        $data = array();
//        $data['page_title'] = 'Training User Records';
//        $data['main_content'] = $this->load->view('training_records/user', $data, TRUE);
//        $this->load->view('layout', $data);
//    }
    
//    public function export_excel() {
//        $data = array();
//        $data['page_title'] = 'Specialities Records';
//        $data['main_content'] = $this->load->view('posting_place/export_excel', $data, TRUE);
//        $this->load->view('layout', $data);
//    }

  public function add() {

       $university = new university();

if (isset($_REQUEST['uniid']) && !empty($_REQUEST['uniid'])) {
    $university->pk_id = $_REQUEST['uniid'];
}

$university->university_name = $_POST['university_name'];
$university->city = $_POST['city'];
$university->country = $_POST['country'];
$university->is_active = 1;


$file = $university->save();

        redirect(base_url() .'university_management/index', 'refresh');
    }




public function edit()
{
    $university = new university();
    $uni_id = $_POST['id'];
    $file = $university->find_by_id($uni_id);
    $data['result'] = $file->result_array();
    $data['uni_id'] = $uni_id;
    $data['page_title'] = 'Universities Records';
    $this->load->view('university_management/edit', $data);
    }
}

