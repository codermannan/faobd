<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('user_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');

        $this->load->view('backend/login');
    }

    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email    = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email, 'password' => md5($password));
        
        // Checking login credential for student
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('user_login', '1');
            $this->session->set_userdata('user_id', $row->id);
            $this->session->set_userdata('login_user_id', $row->id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'student');
            //print_r($this->session->userdata());exit;
            return 'success';
        }


        return 'invalid';
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    /**********MANAGING BOOKING SESSION******************/
    function booking_session($param1 = '', $param2 = '', $param3 = '')
    {
        if($param1=='update'){

            $data['booking_date']      = date('Y-m-d', strtotime($this->input->post('booking_date')));
            $data['training_schedule'] = $this->input->post('booking_session');

            $this->db->where('tstudent_id',$this->input->post('tstudent_id'));
            $this->db->update('dbqul0erfk8awo.tryout_student',$data);
            $dates = $data['booking_date'];
            $sche = $this->input->post('session_time');

            $message = "Your Booking on ".$dates." at ".trim($sche)." is Updated";
            $this->session->set_flashdata('msg', $message );
            redirect(base_url() . 'index.php?login/booking_session/'.$this->input->post('tstudent_id'), 'refresh');

        }else{
                //$page_data['booking_session'] = $this->db->query("select distinct v.id,v.vanue_name,v.session_price,locid,loc_lat,loc_long from dbqul0erfk8awo.training_schedule s join dbqul0erfk8awo.vanue v on s.venue=v.id order by v.vanue_name")->result_array();
                $page_data['booking_session'] = $this->db->query("select distinct v.id,v.vanue_name,v.session_price,locid,loc_lat,loc_long from dbqul0erfk8awo.training_schedule s left join dbqul0erfk8awo.vanue v on s.venue=v.id left join dbqul0erfk8awo.sfa_location l on l.venue_id=s.venue order by v.vanue_name")->result_array();

                $page_data['tstudent_id']  = $param1;
                $page_data['page_title'] = get_phrase('manage_booking_session');
                $this->load->view('backend/booking_session', $page_data);
        }
    }

    /**********MANAGING UPDATE TRYOUT STUDENT******************/
    function update_tryout_student($param1 = '', $param2 = '', $param3 = '')
    {
        if($param1=='update'){
            
			$data['name']         = $this->input->post('name');
			$data['age']          = $this->input->post('age');
			$data['player_email'] = $this->input->post('player_email');
			$data['parents_name'] = $this->input->post('parents_name');
                        $data['nationality']  = $this->input->post('nationality');
                        $data['area']         = $this->input->post('area');
			
			//echo '<pre>';
			//print_r($this->session->userdata());
			//echo '<pre>';
                        //echo '<pre>';print_r($this->input->post());
			//echo '<pre>';print_r($data); 
                        //echo $param2;
                        //exit;
			$this->db->where('tstudent_id', $param2);
			$this->db->update('dbqul0erfk8awo.tryout_student', $data);

           // $this->session->set_flashdata('msg', "Booking is updated");
            redirect(base_url() . 'index.php?login/booking_session/'.$param2, 'refresh');

        }else{

                $page_data['tstudent_id'] = $param1;
                $page_data['page_title']  = get_phrase('update_tryout_student');
                $this->load->view('backend/update_tryout_student', $page_data);
        }
    }

    /**********coach_followup_report******************/
    function update_coach_followup_report($param1 = '', $param2 = '', $param3 = '')
    {
        if($param1=='update'){
            
          $data['parent_comments'] = $this->input->post('parent_comments');
          
		  $this->db->where('cfid', $param2); //cfid
		  $this->db->update('dbqul0erfk8awo.coach_followup_report', $data);

          redirect(base_url().'index.php?login/update_coach_followup_report/'.$param2, 'refresh');

        }else{
            $page_data['cfid'] = $param1;
            $page_data['student_name'] = $this->db->query("SELECT name FROM dbqul0erfk8awo.coach_followup_report r left join dbqul0erfk8awo.student s on s.student_id=r.student_id where cfid in ($param1)")->row()->name;
            $page_data['page_title']  = get_phrase('update_coach_followup_report');
            //echo '<pre>';print_r($page_data);
            $this->load->view('backend/update_coach_followup_report', $page_data);
        }
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        //resetting user password here

        $query = $this->db->query("select s.student_id,e.email ,e.plain_password from dbqul0erfk8awo.student s, student e where s.student_id=e.student_id and  (mother_email='".$email."' or father_email='".$email."')")->result_array();
        //echo $this->db->last_query();exit;
        if(count($query)>0){ 
          // send new password to user email  
          $email = $this->email_model->password_reset_email($query[0]['studnet_id'],$query[0]['email'],$query[0]['plain_password'],$email);
           $resp['status']         = 'true';
        }else{
           $resp['status']         = 'false';
        }

        $resp['submitted_data'] = $_POST;
        
        echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
