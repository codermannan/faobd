<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
	    $this->load->database();
        $this->load->library('session');
        /*cache control*/
        
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url() . 'index.php', 'refresh');
        if ($this->session->userdata('user_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');
        //print_r($this->session->userdata());
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('student_dashboard');
        $this->load->view('backend/index', $page_data);
    }


    function file_upload($param1 = '')
	{

		if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');

		if ($param1 == 'import_data_cases_1')
		{
            $csv = $_FILES['userfile']['tmp_name'];
            $handle = fopen($csv,"r");
            //echo phpinfo();
            while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
            {
                
				if ($row[0] != 'uuid'){
                    $data['uuid']		=	$row[0];
                    $data['datetime']	=	$row[1];
                    $data['species']    =	$row[2];
                    $data['number_morbidity'] =	$row[3];
                    $data['disease_id']	=	$row[4];
                    $data['number_mortality']	=	$row[4];
                    $data['total_number_cases']	=	$row[6];
                    $data['location']	=	$row[7];

                    $this->db->insert('case_of_animal_diseases' , $data);
                }
                
            }
			redirect(base_url() . '/index.php?student/file_upload', 'refresh');
		}

        if ($param1 == 'import_data_cases_2')
		{
            $csv = $_FILES['userfile']['tmp_name'];
            $handle = fopen($csv,"r");
            //echo phpinfo();
            while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
            {
                
				if ($row[0] != 'uuid'){
                    $data['uuid']		=	$row[0];
                    $data['datetime']	=	$row[1];
                    $data['species']    =	$row[2];
                    $data['number_morbidity'] =	$row[3];
                    $data['disease_id']	=	$row[4];
                    $data['number_mortality']	=	$row[4];
                    $data['total_number_cases']	=	$row[6];
                    $data['location']	=	$row[7];

                    $this->db->insert('case_of_animal_diseases' , $data);
                }
                
            }
			redirect(base_url() . '/index.php?student/file_upload', 'refresh');
		}

        if ($param1 == 'disease_list')
		{
            $csv = $_FILES['userfile']['tmp_name'];
            $handle = fopen($csv,"r");
            //echo phpinfo();
            while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
            {
                
				if ($row[0] != 'id'){
                    $data['id']		=	$row[0];
                    $data['name']	=	$row[1];
                    $this->db->insert('disease_list' , $data);
                }
                
            }
			redirect(base_url() . '/index.php?student/file_upload', 'refresh');
		}

		$page_data['page_name']  = 'file_upload';
		$page_data['page_title'] = get_phrase('file_upload');
		$this->load->view('backend/index', $page_data);
	}
    
    /***indicators_1_json***/
    function indicators_1_json()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');
        //print_r($this->session->userdata());

        $page_data['total_number_cases']  = $this->db->query("SELECT SUM(total_number_cases) total_number_cases FROM case_of_animal_diseases")->row()->total_number_cases;
        $page_data['deaths_reported']     = $this->db->query("SELECT ad.location,SUM(ad.number_mortality) total_mortality FROM case_of_animal_diseases ad group by ad.location order by ad.location")->result_array();
        $page_data['page_name']  = 'indicators_1_json';
        $page_data['page_title'] = get_phrase('indicators_1_json');
        $this->load->view('backend/index', $page_data);
    }

    /***indicators_1_json***/
    function indicators_advanced_1()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');
        //print_r($this->session->userdata());

        $page_data['deaths_disease']  = $this->db->get('total_number_deaths_disease')->result_array();
        $page_data['Average_number_cats_reported_villages']  = $this->db->query("with Average_number_cats_reported_villages as ( SELECT ROUND(SUM(number_morbidity)/count(DISTINCT location),2) Average_numbe_cats_reported_villages FROM case_of_animal_diseases where species='cat' and location like 'Village%' order by location ) select * from Average_number_cats_reported_villages")->row();
        $page_data['page_name']  = 'indicators_advanced_1';
        $page_data['page_title'] = get_phrase('indicators_advanced_1');
        $this->load->view('backend/index', $page_data);
    }
}