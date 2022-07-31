<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }


	
	function notify_email($email_sub = '', $message = '' , $email_to = '')
	{
		/*$recarr = explode('-',$reciever);
		
		if($recarr[0]=='student'){
			$email_to	=	$this->db->get_where('student' , array('student_id' => $recarr[1]))->row()->mother_email;
		}else if($recarr[0]=='teacher'){
			$email_to	=	$this->db->get_where('teacher' , array('teacher_id' => $recarr[1]))->row()->email;
		}*/
			$email_msg		=  $message;
			$email_from		= 'register@starfootballacademy.com';
		
		$this->do_email($email_msg , $email_sub , $email_to, $email_from);
	}

	/***invoice_email_with_attachment****/
        function invoice_email_with_attachment($name, $email = '',$fromEmail = '',$invno= '')
	{
		
		$email_msg		=	"Dear Customer, <br />";
		$email_msg		.=	"Your invoice details are in the above attachment"."<br /><br /><br /><br /><br />";
                $email_msg		.=	"Kind Regards,<br />";
                $email_msg		.=	"Anees Makrous (Manager)<br />";
                $email_msg		.=	"Star Football Academy<br />";
                $email_msg		.=	"Tel + 971 50 6337857<br />";
                $email_msg		.=	"info@starfootballacademy.com<br />";
                $email_msg		.=	"https://starfootballacademy.com/";
		
		$email_sub		=	"Thank you for paying your fee!";
		$email_to		=	$email;
                $email_from		=	$fromEmail;

		$this->do_email($email_msg , $email_sub , $email_to,$email_from,TRUE,$invno);
	}

        function password_reset_email($student_id= '', $email = '' , $plain_password= '',$emailto =''){

		$maildata['username']       = $email;
		$maildata['plain_password'] = $plain_password;

		$email_msg = $this->load->view("backend/mailscripts/".'reset_password',$maildata,true);
		
		//$email_msg	   = " Your user name is ".$email." and password is ".$plain_password;
        $email_sub         = " SFA username and password";
		$email_to	   = $emailto;
	
		$this->do_email($email_msg , $email_sub , $email_to,'register@starsacademies.com',false,null);
		}

	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL, $attachment=FALSE,$invno)
	{
		
		$config = array();
                $config['protocol'] = "smtp";
		$config['smtp_host'] = "mail.starbasketballacademy.com";
		$config['smtp_port'] = "25";
		$config['smtp_user'] = "register@starbasketballacademy.com"; 
		$config['smtp_pass'] = "1982may12";
		$config['charset'] = "iso-8859-1";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

        $this->load->library('email');

        $this->email->initialize($config);

		
		$this->email->from($from, 'Star Basketball Academy');
		$this->email->to($to);
		$this->email->subject($sub);
		
		$this->email->message($msg);
		
                if($attachment==TRUE):
		  $this->email->attach("././uploads/invoice/".$invno.".pdf");
                endif;

		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}

