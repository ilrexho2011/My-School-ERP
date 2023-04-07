<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	#autori : Ilirjan Rexho
 *	29 qershor, 2016
 *	http://computerhouse.al
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* kontrollimi i kashese */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Funksioni standart, ridirekton ne hapesiren e duhur perdoruesit e loguar
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
			
		if ($this->session->userdata('accountant_login') == 1)
            redirect(base_url() . 'index.php?accountant/dashboard', 'refresh');
			
		if ($this->session->userdata('secretary_login') == 1)
            redirect(base_url() . 'index.php?secretary/dashboard', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');

        $this->load->view('backend/login');
    }

    // Funksioni i logimit ne Ajax 
    function ajax_login() {
        $response = array();

        // Marrja me metoden e POST-imit e email, password-it nepermjet kerkeses ne ajax
        $email = $_POST["email"];
        $password = sha1($_POST["password"]);
        $response['submitted_data'] = $_POST;

        // Validimi i logimit
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }

        // Pergjigja validuese me ane te ajax
        echo json_encode($response);
    }

    // Validimi i logimit me ane te kerkeses ne ajax
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email, 'password' => $password);


        // Kontrollimi i kredencialeve te logimit per admin-in
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }

// Kontrollimi i kredencialeve te logimit per llogaritaret
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('accountant_login', '1');
            $this->session->set_userdata('accountant_id', $row->accountant_id);
            $this->session->set_userdata('login_user_id', $row->accountant_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'accountant');
            return 'success';
        }
		
		// Kontrollimi i kredencialeve te logimit per sekretaret
        $query = $this->db->get_where('secretary', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('secretary_login', '1');
            $this->session->set_userdata('secretary_id', $row->secretary_id);
            $this->session->set_userdata('login_user_id', $row->secretary_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'secretary');
            return 'success';
        }

        // Kontrollimi i kredencialeve te logimit per mesuesit
        $query = $this->db->get_where('teacher', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('teacher_login', '1');
            $this->session->set_userdata('teacher_id', $row->teacher_id);
            $this->session->set_userdata('login_user_id', $row->teacher_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'teacher');
            return 'success';
        }

        // Kontrollimi i kredencialeve te logimit per nxenesit
        $query = $this->db->get_where('student', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('student_login', '1');
            $this->session->set_userdata('student_id', $row->student_id);
            $this->session->set_userdata('login_user_id', $row->student_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'student');
            return 'success';
        }

        // Kontrollimi i kredencialeve te logimit per prinderit
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('parent_login', '1');
            $this->session->set_userdata('parent_id', $row->parent_id);
            $this->session->set_userdata('login_user_id', $row->parent_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'parent');
            return 'success';
        }

        return 'invalid';
    }

    /*     * *ERRORI STANDART 404 - DEFAULT NOT FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // RESETIM PASSWORDI ME ANE TE EMAIL-it
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        // ketu behet resetimi i password-it te perdoruesit
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // kontrollimi i kredencialeve per adminin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => sha1($new_password)));
            $resp['status']         = 'true';
        }
        // kontrollimi i kredencialeve per nxenesin
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => sha1($new_password)));
            $resp['status']         = 'true';
        }
        // kontrollimi i kredencialeve per mesuesin
        $query = $this->db->get_where('teacher' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'teacher';
            $this->db->where('email' , $email);
            $this->db->update('teacher' , array('password' => sha1($new_password)));
            $resp['status']         = 'true';
        }
        // kontrollimi i kredencialeve per prinder
        $query = $this->db->get_where('parent' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'parent';
            $this->db->where('email' , $email);
            $this->db->update('parent' , array('password' => sha1($new_password)));
            $resp['status']         = 'true';
        }

        // dergimi i paswordit te ri ne emailin e perdoruesit 
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    /*     * ***** FUNKSIONI LOGOUT ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
