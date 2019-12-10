<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Degree_Management extends CI_controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('degree');
    }

    public function index() {
        $doc = new degree();
        $data = array();
        $data['page_title'] = 'Manage Degree';
        $data['result'] = $doc->find_all();
        $data['main_content'] = $this->load->view('degree_management/index', $data, TRUE);
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

$degree = new degree();

if (isset($_REQUEST['degreeid']) && !empty($_REQUEST['degreeid'])) {
    $degree->pk_id = $_REQUEST['degreeid'];
}

$degree->degree_title = $_POST['degree_title'];
$degree->duration = $_POST['duration'];
$degree->degree_recognised_by = $_POST['degree_recognised_by'];
$degree->is_active = 1;


$file = $degree->save();

        redirect(base_url() .'Degree_Management/index', 'refresh');
    }


            public function edit()
            {
                    $degree = new degree();
                    $degree_id = $_POST['id'];
                    $file = $degree->find_by_id($degree_id);
                    $data['result'] = $file->result_array();
                    $data['degree_id'] = $degree_id;
                    $data['page_title'] = 'Degree Records';
                    $this->load->view('degree_management/edit', $data);
            }
}