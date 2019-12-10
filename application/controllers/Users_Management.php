<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('user');
        $this->load->model('locations');
    }

    public function index() {
        $doc = new user();
        $data = array();
        $data['result'] = $doc->find_all();
        $data['page_title'] = 'Manage Users';
        $data['main_content'] = $this->load->view('users_management/index', $data, TRUE);
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

$user = new user();

if (isset($_REQUEST['userid']) && !empty($_REQUEST['userid'])) {
    $user->pk_id = $_REQUEST['userid'];
}

$user->username = $_POST['username'];
$user->designation = $_POST['designation'];
$user->login_id = $_POST['login_id'];
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $user->password = md5($_POST['password']);
} else {
    $user->password = $_POST['old_password'];
}
$user->email = $_POST['email'];
$user->phone = $_POST['phone'];
$user->district_of_domicile = $_POST['district_of_domicile'];
$user->role_id = $_POST['role_id'];
$user->is_active = $_POST['status'];

$file = $user->save();

        redirect(base_url() .'users_management/index', 'refresh');
    }


public function edit()
{
    $user = new user();
    $location = new locations();
    $user_id = $_POST['id'];
    $data['location'] = new locations();
    $data['location'] = $location->districtdropdown();
    $file = $user->find_by_id($user_id);
    $data['result'] = $file->result_array();
    $data['user_id'] = $user_id;
    $data['page_title'] = 'Users Records';
    $this->load->view('users_management/edit', $data);
    }
}
