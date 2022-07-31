<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {

        parent::__construct();
        $dsn3 = 'mysql://starsaca_starfoo:IZ8D3J1Zw=pd@localhost/starfoot_sms';
        $this->db3 = $this->load->database($dsn3, true);
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    ////////STUDENT/////////////
    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id,'status'=>0));
        return $query->result_array();
    }
    function get_students_list_for_search($age = '',$estatus = '') {
        		
		if($age=='' && $estatus ==''){
                     $query = $this->db->query('SELECT * FROM `student` ORDER BY `student_id` DESC');
        
		}else if($age!='' && $estatus==''){
                    
                        $this->db->select('*');
                        $this->db->from('student');
                        $this->db->where('age',$age);
                        $this->db->order_by("student_id", "desc");
                        $query = $this->db->get();

                }else if($estatus!='' && $age==''){
                    
                        $this->db->select('*');
                        $this->db->from('student');
                        $this->db->where('enrol_status',$estatus);
                        $this->db->order_by("student_id", "desc");
                        $query = $this->db->get();

                }else if($age!='' && $estatus !=''){
                    
                        $this->db->select('*');
                        $this->db->from('student');
                        $this->db->where('age',$age);
                        $this->db->where('enrol_status',$estatus);
                        $this->db->order_by("student_id", "desc");
                        $query = $this->db->get();

		} //echo $this->db->last_query();
        return $query->result_array();
    }
    
    function get_students_list($age = '',$vanue = '',$activity = '',$session_id = '',$estatus = '') {
        		
		if(empty($age) && empty($vanue) && empty($activity) && empty($session_id)&& empty($estatus)){
                     $query = $this->db->query('SELECT * FROM `student` ORDER BY `student_id` DESC');
        
		}else if(!empty($age) || !empty($estatus)){
                    
                        $this->db->select('*');
                        $this->db->from('student');
                        $this->db->or_where('age',$age);
                        $this->db->or_where('enrol_status',$estatus);
                        $this->db->order_by("student_id", "desc");
                        $query = $this->db->get();
		}else{
			$query = $this->db->query("SELECT e.*,s.name,s.sms_number
					FROM enrollment e
					LEFT JOIN student s ON s.student_id=e.student_id
					WHERE e.vanue = '".$vanue."' OR e.activity = '".$activity."' OR e.session_id = '".$session_id."' ORDER BY `enroll_id` DESC");
                } echo $this->db->last_query();
        return $query->result_array();
    }
    //get_students_list_for_sms
	function get_students_list_for_sms($age = '',$vanue = '',$activity = '',$session_id = '',$estatus = '') {
        		
		if($age!='' && $estatus!=''){
                     $query = $this->db->query("SELECT student_id, sms_number  FROM `student` WHERE `enrol_status` = '".$estatus."' AND `age` = '".$age."' ORDER BY `student_id` DESC");
                
                }else if($estatus!='' && $age==''){

                     $query = $this->db->query("SELECT student_id, sms_number  FROM `student` WHERE `enrol_status` = '".$estatus."' ORDER BY `student_id` DESC");

		}else if($vanue!='' || $activity!='' || $session_id!=''){
                    
                    $query = $this->db->query("SELECT e.student_id,s.name,s.sms_number
					FROM enrollment e
					LEFT JOIN student s ON s.student_id=e.student_id
					WHERE e.vanue = '".$vanue."' OR e.activity = '".$activity."' OR e.session_id = '".$session_id."'
                                        group by e.student_id
					ORDER BY `enroll_id` DESC");
		}
		echo $this->db->last_query();
                return $query->result_array();
        }
	
	//enroll student list
	function get_enroll_students_list($stid = '',$vanue = '',$activity = '',$session_id = '') {
        
        if(empty($stid) && empty($vanue) && empty($activity) && empty($session_id)){
            $query = $this->db->query("SELECT e.*,s.name,c.name activity,sc.name sesion FROM enrollment e
					LEFT JOIN student s ON s.student_id=e.student_id
					LEFT JOIN class c ON c.class_id=e.activity
					LEFT JOIN section sc ON sc.section_id=e.session_id AND sc.class_id=e.activity ORDER BY `enroll_id` DESC");
        }else{
			$query = $this->db->query("SELECT e.*,s.name,c.name activity,sc.name sesion 
					FROM enrollment e
					LEFT JOIN student s ON s.student_id=e.student_id
					LEFT JOIN class c ON c.class_id=e.activity
					LEFT JOIN section sc ON sc.section_id=e.session_id AND sc.class_id=e.activity
					WHERE e.student_id = '".$stid."' OR e.vanue = '".$vanue."' OR (e.activity = '".$activity."' AND e.session_id = '".$session_id."') ORDER BY `enroll_id` DESC");
        }
        return $query->result_array();
    }
    //tryout student
    function get_tryoutstudents_list($followup_date = '',$enquery_date = '',$activity = '',$vanue = '') {
        
        if(empty($followup_date) && empty($enquery_date) && empty($activity) && empty($vanue)){
            $this->db->order_by("tstudent_id", "desc");
            $query = $this->db->get('tryout_student');
        }else{
            $this->db->select('*');
            $this->db->from('tryout_student');
            $this->db->or_where('followup_date',date('Y-m-d', strtotime($followup_date)));
            $this->db->or_where('enquery_date',date('Y-m-d', strtotime($enquery_date)));
            $this->db->or_where('activity',$activity);
            $this->db->or_where('vanue',$vanue);
            $this->db->order_by("tstudent_id", "desc");
            $query = $this->db->get();
        }
        return $query->result_array();
    }
    
    function get_students_for_mark($class_id,$subjectid) {
		$data = array( );
		
        $query = $this->db->get_where('student', array('class_id' => $class_id,'status'=>0,'subject_id'=>null));
		$allstudents = $query->result_array();
		
		foreach($allstudents as $val){
			$data[$val['student_id']] 	= $val['name'];
		}

		$query2 = $this->db->get_where('student', array('class_id' => $class_id,'status'=>0,'subject_id!='=>null));

		$allstudents2 = $query2->result_array();
		
		foreach($allstudents2 as $val2){
			$sbid = explode(',',$val2['subject_id']);
			if(in_array($subjectid,$sbid)){
				$data[$val2['student_id']] 	= $val2['name'];
			}
		}
        return $data;
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id,'status'=>0));
        return $query->result_array();
    }
	
	function get_classwise_student($classid){
		$this->db->select('student.*,class.name as clsname,section.name as secname');
        $this->db->from('student');
        $this->db->join('class','class.class_id = student.class_id','left');
		$this->db->join('section','section.section_id = student.section_id','left');
        $this->db->where('student.class_id',$classid);
		$this->db->where('student.status',0);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
	}

    /////////TEACHER/////////////
    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    //////////SUBJECT/////////////
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }
	
	function get_registered_subject($class_id,$student_id,$status) {
		
		$data = array( );
		$sbid = explode(',',$status);
		
		if($status==NULL){
			$query = $this->db->get_where('subject', array('class_id' => $class_id));
			return $query->result_array();
		}else{
			
			$this->db->select('subject_id,name');
			$this->db->from('subject');
			$this->db->where('class_id',$class_id);
			$this->db->where_in('subject_id', $sbid);
			$query = $this->db->get();
			return $query->result_array();
		}
    }

    ////////////CLASS///////////
    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    //////////EXAMS/////////////
    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    //////////GRADES/////////////
    function get_grades() {
        $query = $this->db->get('dbqul0erfk8awo.grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('dbqul0erfk8awo.grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_grade($mark_obtained) {
        $query = $this->db->get('dbqul0erfk8awo.grade');
        $grades = $query->result_array(); //echo $this->db->last_query();

        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {

        $pic = $this->db->get_where('student',array('student_id'=>$id))->row()->profile_picture;

        if (file_exists('uploads/' . $type . '_image/' . $pic))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $pic;
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    ////////STUDY MATERIAL//////////
    function save_study_material_info()
    {
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title'] 		= $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['file_name'] 	= $_FILES["file_name"]["name"];
        $data['file_type'] 	= $this->input->post('file_type');
        $data['class_id'] 	= $this->input->post('class_id');
        
        $this->db->insert('document',$data);
        
        $document_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
    }
    
    function select_study_material_info()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array(); 
    }
    
    function select_study_material_info_for_student()
    {
        $student_id = $this->session->userdata('student_id');
        $class_id   = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document', array('class_id' => $class_id))->result_array();
    }
    
    function update_study_material_info($document_id)
    {
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title'] 		= $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['class_id'] 	= $this->input->post('class_id');
        
        $this->db->where('document_id',$document_id);
        $this->db->update('document',$data);
    }
    
    function delete_study_material_info($document_id)
    {
        $this->db->where('document_id',$document_id);
        $this->db->delete('document');
    }
    
    ////////student registration email message//////
    function send_registration_message($email,$name) {
				
				$from = 'Star Football Academy<register@starfootballacademy.com>';
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 
				// Create email headers
				$headers .= 'From: '.$from."\r\n".
					'Reply-To: '.$from."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
				$email_list = array();
				array_push($email_list, $email);
				
                $sub = 'Thank you for registering your child at Star Football Academy';
                 
                $msg = '';
				$msg .= '<table style="background-color: #f6f6f6;width: 100%;"><tr><td></td><td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600"><div style="max-width: 600px;
				margin: 0 auto;display: block;padding: 20px;"><table style="background-color: #fff;border: 1px solid #e9e9e9;border-radius: 3px;" width="100%" cellpadding="0" cellspacing="0"><tr><td style="font-size: 16px;
				color: #fff;font-weight: 500;padding: 20px;text-align: center;border-radius: 3px 3px 0 0; background-color: #FF9F00;">';
				$msg .= 'Star Football Academy.</td></tr>';
				$msg .= '<tr><td style="padding: 10px !important;"><table width="100%" cellpadding="0" cellspacing="0"><tr><td style="padding: 0 0 20px;">Dear Mr/Mrs.<strong>'.$name.',</strong>.</td></tr><tr><td style="padding: 0 0 20px;">
				Thank you for registering your child at Star Football Academy.</td></tr><tr><td style="padding: 0 0 20px;">Follow us on social media to see your child photos and to stay updated with the upcoming events.</td></tr><tr><td style="padding: 0 0 20px;">Facebook:https://www.facebook.com/sfa2008/</td></tr>
				<tr><td style="padding: 0 0 20px;">Instagram:https://www.instagram.com/starfootballacademy/</td></tr>
				<tr><td style="padding: 0 0 20px;">https://www.snapchat.com/add/staracademy2008</td></tr>
				</tr><tr><td style="padding: 0 0 20px;">Twitter: https://twitter.com/StarFAcademy</td></tr>
				</tr><tr><td style="padding: 0 0 20px;">Website:https://starfootballacademy.com/</td></tr>
				</tr>
				<tr><td style="padding: 0 0 20px;">Kind Regards,</td></tr><tr><td style="padding: 0 0 20px;">Anees Makrous (Manager)<br/>Star Football Academy<br/>Tel + 971 50 6337857<br/>register@starfootballacademy.com<br/>https://starfootballacademy.com/<br/></td></tr><tr><td style="padding: 0 0 20px;">This is an automatically generated e-mail. If you have any query please email to this info@starfootballacademy.com.
	                Thank you for your co-operation.</td></tr>';
				$msg .= '</table>';
				//echo $msg;exit;
				// Sending email
				
				$email = $this->email_model->notify_email($sub, $msg, $email_list);
				
				if($email){
					return true;
				} else{
					return false;
				}
        
    }
    ////////private message//////
    function send_new_private_message() {
        
        $subject    = $this->input->post('subject');
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        //$reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        
        $age               = $this->input->post('age');
        $vanue             = $this->input->post('vanue');
        $activity          = $this->input->post('class_id');
        $session_id        = $this->input->post('section_id');
                
        $students   =   $this->get_students_list($age,$vanue,$activity,$session_id);
        
        if(count($students)>0){
            
            $email_list = array();
            
            foreach ($students as $value) {
                $reciever = 'student-'.$value['student_id'];
                array_push($email_list, $value['mother_email']);

                //check if the thread between those 2 users exists, if not create new thread
                $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
                $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

                if ($num1 == 0 && $num2 == 0) {
                    $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
                    $data_message_thread['message_thread_code'] = $message_thread_code;
                    $data_message_thread['sender']              = $sender;
                    $data_message_thread['reciever']            = $reciever;
                    $this->db->insert('message_thread', $data_message_thread);
                }
                if ($num1 > 0)
                    $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
                if ($num2 > 0)
                    $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


                $data_message['message_thread_code']    = $message_thread_code;
                $data_message['message']                = $message;
                $data_message['sender']                 = $sender;
                $data_message['timestamp']              = $timestamp;
                $this->db->insert('message', $data_message);

            }
            // notify email to email reciever
            $this->email_model->notify_email($subject, $message, $email_list);
        }
        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
    }

    function mark_thread_messages_read($message_thread_code) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }
    
    function message_list($receiver,$date){
		if(!empty($receiver) || !empty($date)){
			$query = $this->db->query("SELECT m.message,m.timestamp,mt.reciever FROM message m, message_thread mt WHERE m.message_thread_code=mt.message_thread_code AND (DATE_FORMAT(FROM_UNIXTIME(m.timestamp), '%m/%d/%Y')='".$date."'
OR mt.reciever = 'student-".$receiver."')");
		}else if(empty($receiver) AND empty($date)){
			$query = $this->db->query("SELECT m.message,m.timestamp,mt.reciever FROM message m, message_thread mt WHERE m.message_thread_code=mt.message_thread_code");
		}
		return $query->result_array();
	}
	
	function get_message_receiver($receiver){
		
		$recarr = explode('-',$receiver);
		
		if($recarr[0]=='student'){
			$name	=	$this->db->get_where('student' , array('student_id' => $recarr[1]))->row()->name;
		}else if($recarr[0]=='teacher'){
			$name	=	$this->db->get_where('teacher' , array('teacher_id' => $recarr[1]))->row()->name;
		}
		
		return $name;
	}
	
	public function getNextinvId()
    {
        $this->db->select('MAX(invoice_id)');
        $this->db->from('invoice');
        $query = $this->db->get();
        $row = $query->row_array();		
        $mid = $row['MAX(invoice_id)']+1;		
        if($row['MAX(invoice_id)'] == NULL):
            $p=1;
            $nid = substr(sprintf('%07d', $p),0,7);
        else:
            $nid = substr(sprintf('%07d', $mid),0,7);
        endif;
            
        return $nid;
    }
  public function getNextDraftinvId()
    {
        $this->db->select('MAX(draft_invoice_id)');
        $this->db->from('draft_invoice');
        $query = $this->db->get();
        $row = $query->row_array();		
        $mid = $row['MAX(draft_invoice_id)']+1;		
        if($row['MAX(draft_invoice_id)'] == NULL):
            $p=1;
            $nid = substr(sprintf('%07d', $p),0,7);
        else:
            $nid = substr(sprintf('%07d', $mid),0,7);
        endif;
            
        return $nid;
    }

	public function count_all($tablename,$haswh, $condition){
		$this->db->select ( 'COUNT(*) AS `numrows`' );
		if($haswh==true):
		$this->db->where ($condition);
		endif;
		$query = $this->db->get ($tablename);
		return $query->row ()->numrows;
	}
	
	public function getIncome($ptype, $start_date, $end_date){
        $this->db->select('SUM(amount)');
        $this->db->from('payment');
        $this->db->where('payment_type', $ptype);
        $this->db->where('timestamp >=', $start_date);
        $this->db->where('timestamp <=', $end_date);
        $query = $this->db->get();
		return $query->result_array();

     }
	public function getincomegraphValue(){
		
		$yearArray = array('2017','2018','2019','2020','2021');
		
		$incomeExpense = '[';
		$incomeExpense .= '["Year", "Income", "Expenses"],';
		
        foreach($yearArray as $val):
			$income = $this->getIncome('income', strtotime('01-01-'.$val), strtotime('31-12-'.$val));
			$expense = $this->getIncome('expense', strtotime('01-01-'.$val), strtotime('31-12-'.$val));
			
			$incomeExpense .= '["'.$val.'",'.round($income[0]['SUM(amount)']).','.round($expense[0]['SUM(amount)']).'],';
        endforeach;
		
        $incomeExpense = substr($incomeExpense, 0,-1);
        $incomeExpense .= ']';
		
        return $incomeExpense;
	}
	public function getNetincomegraphValue(){
		
		$yearArray = array('2017','2018','2019','2020','2021');
		
		$netincome = '[';
		$netincome .= '["Year", "Net Income"],';
		
        foreach($yearArray as $val):
			$income = $this->getIncome('income', strtotime('01-01-'.$val), strtotime('31-12-'.$val));
			$expense = $this->getIncome('expense', strtotime('01-01-'.$val), strtotime('31-12-'.$val));
			
			$comNetIncome = ($income[0]['SUM(amount)']-$expense[0]['SUM(amount)']);
			
			$netincome .= '["'.$val.'",'.round($comNetIncome).'],';
        endforeach;
		
        $netincome = substr($netincome, 0,-1);
        $netincome .= ']';
		
        return $netincome;
	}
	public function paymentperYeargraphValue(){
		
		$yearArray = array('2017','2018','2019','2020','2021');
		
		$perYear = '[';
		$perYear .= '["Year", "Amount"],';
		
        foreach($yearArray as $val):
			$income = $this->getIncome('income', strtotime('01-01-'.$val), strtotime('31-12-'.$val));
			
			$perYear .= '["'.$val.'",'.round($income[0]['SUM(amount)']).'],';
        endforeach;
		
        $perYear = substr($perYear, 0,-1);
        $perYear .= ']';
		
        return $perYear;
	}


       // get grade
       function get_avg_grade($student_id) {

       $examno = $this->db->query("select max(exam_id) exam_no from dbqul0erfk8awo.mark where student_id='".$student_id."'")->row()->exam_no;
	
       $xmno = $examno==''?0:$examno;
        
        $subject =  $this->db->get('dbqul0erfk8awo.subject')->result_array(); 
        $total_subjects = count($subject);
        $total_grade_point = 0;

        foreach ($subject as $row2):

             $verify_data = array('exam_id' => $xmno,'subject_id' => $row2['subject_id'],'student_id' => $student_id);

             $querym = $this->db->get_where('dbqul0erfk8awo.mark', $verify_data);
             $markso = $querym->result_array();

             foreach ($markso as $mk):

              $grade = $this->get_grade($mk['mark_obtained']);
              
              $total_grade_point += $grade['grade_point'];

             endforeach;  
 
        endforeach; 

        $total_gpa = round($total_grade_point / $total_subjects, 2);

        return $total_gpa;

	
      }

      // get reward points
      function get_reward_points($student_id){
           
          $rp = $this->db->query("select total_reward_points from dbpq7gd8mqbgvv.reward_points_master where student_id='".$student_id."'")->row()->total_reward_points;
          $trp = $rp==''?0:$rp;
          return $trp; 
      }
	
    // reward point insert
    public function redeem_insert($student_id = '', $invoice_id = '', $reward_point = '', $student_name = ''){
        
		$totaldeductedrp = ($reward_point*100);
        							
	    $rp['student_id']			= $student_id;  
        $rp['student_name']			= $student_name; //$this->db->get_where('student',array('student_id'=>$student_id))->row()->name;
	    $rp['invoice_id']			= $invoice_id;
	    $rp['redeem_points']		= $totaldeductedrp;
        //echo '<pre>';print_r($rp); exit;
        $this->db->insert('dbpq7gd8mqbgvv.redeem_points_details' , $rp);
           
        $ms =  $this->db->get_where('dbpq7gd8mqbgvv.redeem_points_master',array('student_id'=>$student_id))->num_rows();
           
        if($ms>0){

               $this->db->where('student_id' , $student_id);
               $this->db->set('total_redeem_points', 'total_redeem_points+ ' . $rp['redeem_points'], FALSE);
               $this->db->update('dbpq7gd8mqbgvv.redeem_points_master');

	    }else{
               
               $rpm['student_id']			= $student_id;  
               $rpm['total_redeem_points']  = $rp['redeem_points'];

               $this->db->insert('dbpq7gd8mqbgvv.redeem_points_master' , $rpm);
             
        }
 							
		  // end reward system entry 
									
          
		  $this->db->where('student_id' , $student_id);
          $this->db->set('total_reward_points', 'total_reward_points- ' . $totaldeductedrp, FALSE);
          $this->db->update('dbpq7gd8mqbgvv.reward_points_master');

          return true;
      }

    public function pay_online($orderid,$customername,$customeremail,$customernumber,$net_total)
	{
	    $data=array(
			'merchant_id'=>48810, //45011,
			//'merchant_id'=>45990,
			'order_id'=>$orderid,
			'billing_name'=>$customername,
			'billing_tel'=>$customernumber,
			'billing_email'=>$customeremail,
			'amount'=>$net_total,
			'currency'=>'AED',
			'redirect_url'=>'https://elearning.starbasketballacademy.com/index.php?student/return_from_gateway/'.$orderid,
			'cancel_url'  =>'https://elearning.starbasketballacademy.com/index.php?student/return_from_gateway/'.$orderid
		);
	//var_dump($data);
	
	$merchant_data='';
	//$working_key='C529139CECDB51B7D75354578B070B07';//Shared by CCAVENUES
	//$access_code='AVUU03HK61AW09UUWA';//Shared by CCAVENUES
	$working_key='1332D2985235869D5071F72507CFE57E';//Shared by CCAVENUES
	$access_code='AVXD04IL20CL46DXLC';//Shared by CCAVENUES
	
	foreach ($data as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	//$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	$this->load->library('crypto');

	$encrypted_data=$this->crypto->encrypt($merchant_data,$working_key); 

	//var_dump($encrypted_data);

	?>
	<form method="post" name="redirect" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction"> 
	<?php
	echo "<input type=hidden name=encRequest value=$encrypted_data>";
	echo "<input type=hidden name=access_code value=$access_code>";
	?>
	</form></center><script language='javascript'>document.redirect.submit();</script>


	<?php
		echo "Payment Works";
	}
}
