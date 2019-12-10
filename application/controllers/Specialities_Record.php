<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Specialities_Record extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('speciality');
        // $this->load->model('personalspeciality');
    }
    

    

    public function index() {
        $doc = new speciality();
        $data = array();
        $data['page_title'] = 'Specialities Records';
        $data['result'] = $doc->find_all();
        $data['main_content'] = $this->load->view('specialities_record/index', $data, TRUE);
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
        $data['page_title'] = 'Specialities Records';
        $data['main_content'] = $this->load->view('specialities_record/export_excel', $data, TRUE);
        $this->load->view('layout', $data);
    }


                public function add() {

                  $speciality = new speciality();
        $file = $speciality->save();

        if(isset($_REQUEST['fileid']) && !empty($_REQUEST['fileid'])){
            $speciality->pk_id = $_REQUEST['fileid'];
        }
         $speciality->specility = $_POST['specility'];
         $speciality->is_active = 1;

            $file = $speciality->save();
                            redirect(base_url() .'specialities_record/index', 'refresh');
                        }



                 public function edit()
                 {
                        $speciality = new speciality();
                        $file_id = $_POST['id'];
                        $file = $speciality->find_by_id($file_id);
                        $data['result'] = $file->result_array();
                        $data['file_id'] = $file_id;
                        $data['page_title'] = 'Speciality Records';
                        $this->load->view('specialities_record/edit', $data);
                 }


                


}
