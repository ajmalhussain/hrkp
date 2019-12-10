<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cadre_Management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('cadre');
    }

    public function index() {
        $doc = new cadre();
        $data = array();
        $data['page_title'] = 'Manage Cadre';
        $data['result'] = $doc->find_all();
        $data['main_content'] = $this->load->view('cadre_management/index', $data, TRUE);
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

$cadre = new cadre();

if (isset($_REQUEST['cadreid']) && !empty($_REQUEST['cadreid'])) {
    $cadre->pk_id = $_REQUEST['cadreid'];
}

$cadre->cadre_value = $_POST['cadre_value'];

$cadre->is_active = 1;


$file = $cadre->save();
        redirect(base_url() .'cadre_management/index', 'refresh');
    }




    public function edit()
    {
        $cadre = new cadre();
        $cadre_id = $_POST['id'];
        $file = $cadre->find_by_id($cadre_id);
        $data['result'] = $file->result_array();
                $data['cadre_id'] = $cadre_id;
                $data['page_title'] = 'Cadre Records';
                $this->load->view('cadre_management/edit', $data);
    }

}