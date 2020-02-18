<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Training_Records extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('training');
        $this->load->model('date_time');
    }

    public function index() {
        $doc = new training();
        $data = array();
        $data['page_title'] = 'Training Records';
        $data['result'] = $doc->find_all();
        $data['main_content'] = $this->load->view('training_records/index', $data, TRUE);
        $this->load->view('layout', $data);
    }

    public function user() {
        $data = array();
        $data['page_title'] = 'Training User Records';
        $data['main_content'] = $this->load->view('training_records/user', $data, TRUE);
        $this->load->view('layout', $data);
    }

    public function add() {

        $training = new training();
        $dt = new date_time();

        if (isset($_REQUEST['fileid']) && !empty($_REQUEST['fileid'])) {
            $training->pk_id = $_REQUEST['fileid'];
        }

        $training->title = $_POST['title'];
        $training->training_date = $dt->dbformat($_POST['training_date']);
        $training->is_active = 1;

        $training->save();

        redirect(base_url() .'training_records/index', 'refresh');
    }

    public function edit()
    {
            $training = new training();
            $file_id = $_POST['id'];
            $file = $training->find_by_id($file_id);
            $data['result'] = $file->result_array();
            $data['file_id'] = $file_id;
            $data['page_title'] = 'Training User Records';
            //$data['main_content'] = $this->load->view('training_records/edit', $data, TRUE);
            $this->load->view('training_records/edit', $data);
    }


    public function delete()
    {
        $training = new training();
        $file_id = $_GET['id'];
        $file = $training->delete($file_id);
        $data['result'] = $training->is_active();
        $data['result'] = $file->result_array();
            $data['file_id'] = $file_id;
            $this->load->view('training_records/delete', $data);

    }

}

