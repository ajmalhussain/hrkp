<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login_user();
        $this->load->model('pagination');
        $this->load->model('personal');
        $this->load->model('locations');
        $this->load->model('date_time');
    }

    public function index() {
        $data = array();
        $data['page_title'] = 'Personal Record';

        $wherestr = '';
        $where = $result = array();
        $submit = false;
        if ($_POST) {
            $submit = true;
            if (isset($_POST['personal']) && !empty($_POST['personal'])) {
                switch ($_POST['personal1']) {
                    case 'district_of_domicile':
                    case 'residential_city':
                    case 'current_city':
                        $where[] = "tbl_locations.LocName LIKE '%" . $_POST['personal'] . "%'";
                        break;
                    case 'gender':
                        $where[] = "personal_record." . $_POST['personal1'] . " LIKE '" . $_POST['personal'] . "%'";
                        break;
                    default:
                        $where[] = "personal_record." . $_POST['personal1'] . " LIKE '%" . $_POST['personal'] . "%'";
                        break;
                }
            }
            if (isset($_POST['training']) && !empty($_POST['training'])) {
                $where[] = "trainings_record." . $_POST['training1'] . " LIKE '%" . $_POST['training'] . "%'";
            }
            if (isset($_POST['education']) && !empty($_POST['education'])) {
                $where[] = "educational_record." . $_POST['education1'] . " LIKE '%" . $_POST['education'] . "%'";
            }
            if (isset($_POST['children']) && !empty($_POST['children'])) {
                $where[] = "childrens_record." . $_POST['children1'] . " LIKE '%" . $_POST['children'] . "%'";
                //$doc->$_POST['children1'] = $_POST['children'];
            }
            if (isset($_POST['speciality']) && !empty($_POST['speciality'])) {
                switch ($_POST['speciality1']) {
                    case 'specility':
                        $where[] = "specialities_record." . $_POST['speciality1'] . " LIKE '%" . $_POST['speciality'] . "%'";
                        break;
                    case 'title':
                    case 'training_date':
                        $where[] = "trainings_record." . $_POST['speciality1'] . " LIKE '%" . $_POST['speciality'] . "%'";
                        break;
                    default:
                        $where[] = "specialities_record." . $_POST['speciality1'] . " LIKE '%" . $_POST['speciality'] . "%'";
                        break;
                }
                //$doc->$_POST['speciality1'] = $_POST['speciality'];
            }

            if (isset($_POST['posting']) && !empty($_POST['posting'])) {
                switch ($_POST['posting1']) {
                    case 'name':
                    case 'designation':
                    case 'bps':
                        $where[] = "posts_record." . $_POST['posting1'] . " LIKE '%" . $_POST['posting'] . "%'";
                        break;
                    case 'location_name':
                        $where[] = "postplace." . $_POST['posting1'] . " LIKE '%" . $_POST['posting'] . "%'";
                        break;
                    default:
                        $where[] = "posting_record." . $_POST['posting1'] . " LIKE '%" . $_POST['posting'] . "%'";
                        break;
                }

                //$doc->$_POST['posting1'] = $_POST['posting'];
            }
        }

        if (isset($_SESSION['userid']) && !empty($_SESSION['userid']) && $_SESSION['role'] != 1) {
            $where[] = "personal_record.created_by =" . $_SESSION['userid'];
            $submit = true;
        }

        if (count($where) > 0) {
            $wherestr = " WHERE " . implode(" AND ", $where);
        }

        $result['wherestr'] = $wherestr;
        $result['submit'] = $submit;

        $result['personalarray'] = array(
            "name" => "Name",
            "father_name" => "Father Name",
            "gender" => "Gender",
            "cnic" => "CNIC",
            "district_of_domicile" => "District of domicile",
            "date_of_birth" => "Date of birth",
            "contact_no" => "Contact no",
            "email" => "Email",
            "postal_address" => "Postal address",
            "pmdc_registration" => "PMDC registration",
            "marital_status" => "Marital status",
            "residential_address" => "Residential address",
            "current_address" => "Current address",
            "residential_city" => "Residential city",
            "current_city" => "Current city"
        );

        $result['childrenarray'] = array(
            "name" => "Name",
            "date_of_birth" => "Date of birth",
            "school_name" => "School name"
        );

        $result['educationarray'] = array(
            "degree_name" => "Degree name",
            "start_date" => "Start date",
            "completion_date" => "Completion date",
            "hec_attestation_no" => "HEC attestation no"
        );

        $result['postingarray'] = array(
            "name" => "Name",
            "designation" => "Designation",
            "bps" => "BPS",
            "location_name" => "Posting place",
            "date_of_appointment" => "Date of appointment"
        );

        $result['otherarray'] = array(
            "specility" => "Specility",
            "title" => "Training title",
            "training_date" => "Training date"
        );

        // Set some useful configuration
        $baseURL = 'personal_record.php';
        $limit = '50';

        // Paging limit & offset
        $offset = !empty($_GET['page']) ? (($_GET['page'] - 1) * $limit) : 0;

        $result['offset'] = $offset;

        $limitstr = '';
        if (!$submit) {
            $limitstr = "LIMIT $offset,$limit";
        }

        $this->load->model('personal');
        $result['result'] = $this->personal->export_all($wherestr, $limitstr);
        // Initialize pagination class
        if ($submit) {
            $pagConfig = array(
                'baseURL' => $baseURL,
                'totalRows' => $result['result']->num_rows,
                'perPage' => $limit
            );
        } else {
            $pagConfig = array(
                'baseURL' => $baseURL,
                'perPage' => $limit
            );
        }
        $result['pagination'] = new Pagination($pagConfig);

        //$data['data'] = $this->profile_model->get_data($_POST);
        $data['main_content'] = $this->load->view('profile/index', $result, TRUE);
        $this->load->view('layout', $data);
    }

    public function user() {
        $data = array();
        $data['page_title'] = 'Personal Record';
        $data['main_content'] = $this->load->view('profile/user', $data, TRUE);
        $this->load->view('layout', $data);
    }

    public function add() {
        $personal = new personal();
        $location = new locations();
        $data['location'] = $location->districtdropdown();
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_REQUEST['personalid']) && !empty($_REQUEST['personalid'])) {
                $personal->pk_id = $_REQUEST['personalid'];
            }
            $personal->name = $_POST['name'];
            $personal->father_name = $_POST['father_name'];
            $personal->gender = $_POST['gender'];
            $personal->cnic = $_POST['cnic'];
            $personal->district_of_domicile = $_POST['district_of_domicile'];
            $personal->date_of_birth = $dt->dbformat($_POST['date_of_birth']);
//$personal->date_of_appointment = $dt->dbformat($_POST['date_of_appointment']);
            $personal->contact_no = $_POST['contact_no'];
            $personal->email = $_POST['email'];
            $personal->postal_address = $_POST['postal_address'];
            $personal->pmdc_registration = $_POST['pmdc_registration'];
            $personal->marital_status = $_POST['marital_status'];
            $personal->health_professional = $_POST['health_professional'];
            $personal->status_two = $_POST['status_two'];
            $personal->residential_address = $_POST['residential_address'];
            $personal->current_address = $_POST['current_address'];
            $personal->residential_city = $_POST['residential_city'];
            $personal->current_city = $_POST['current_city'];
            $personal->employee_number = $_POST['employee_number'];
            $personal->seniority_number = $_POST['seniority_number'];
            $personal->cadre_id = $_POST['cadre_value'];
            $personal->ddo_number = $_POST['ddo_number'];
            $personal->ddo_description = $_POST['ddo_description'];
            $personal->husband_name = $_POST['husband_name'];
            $personal->created_by = $_SESSION['userid'];

            $file = $personal->save();
        }

        $data = array();
        $data['page_title'] = 'Add Personal Record';
        $data['main_content'] = $this->load->view('profile/add', $data, TRUE);
        $this->load->view('layout', $data);
    }

}
