<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $data = array();
        $data['breadcrumb'] = 'Login';
        $data['page_title'] = 'Login';
        $data['main_content'] = $this->load->view('auth/index', $data, TRUE);
        $this->load->view('login', $data);
    }

//    public function login() {
//        $data = array();
//        $data['breadcrumb'] = 'Login';
//        $data['page_title'] = 'Login';
//        $this->load->view('login', $data);
//    }

    /*     * **************Function login**********************************
     * @type            : Function
     * @function name   : log
     * @description     : Authenticatte when uset try lo login. 
     *                    if autheticated redirected to logged in user dashboard.
     *                    Also set some session date for logged in user.   
     * @param           : null 
     * @return          : null 
     * ********************************************************** */

    public function login() {
        if ($_POST) {
            $query = $this->login_model->validate_user();

            //-- if valid
            if ($query) {
                $data = array();
                foreach ($query as $row) {
                    $data = array(
                        'id' => $row->pk_id,
                        'name' => $row->username,
                        'email' => $row->email,
                        'role' => $row->role_id,
                        'is_login' => TRUE
                    );
                    $this->session->set_userdata($data);
                    $role_id = $row->role;
                }
                
                switch ($role_id) {
                    case 3:
                        $url = base_url('profile/user');
                        break;
                    default:
                        $url = base_url('profile');
                        break;
                }

                redirect($url, 'refresh');
            } else {
                redirect(base_url() . 'auth', 'refresh');
            }
        } else {
            $this->load->view('auth', $data);
        }
    }

    /*     * ***************Function logout**********************************
     * @type            : Function
     * @function name   : logout
     * @description     : Log Out the logged in user and redirected to Login page  
     * @param           : null 
     * @return          : null 
     * ********************************************************** */

    function logout() {
        $this->session->sess_destroy();
        $data = array();
        $data['breadcrumb'] = 'Login';
        $data['page_title'] = 'Login';
        $data['main_content'] = $this->load->view('auth/index', $data, TRUE);
        $this->load->view('login', $data);
    }

}
