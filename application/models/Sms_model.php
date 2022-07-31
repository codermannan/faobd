<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    //COMMON FUNCTION FOR SENDING SMS
    function send_sms($message = '' , $reciever_phone = '')
    {
        $message    = $this->input->post('message');
        
        //filter
        $age               = $this->input->post('age');
        $vanue             = $this->input->post('vanue');
        $activity          = $this->input->post('class_id');
        $session_id        = $this->input->post('section_id');
        $enrolled_status   = $this->input->post('enrolled_status');
		
        $students   =   $this->crud_model->get_students_list_for_sms($age,$vanue,$activity,$session_id,$enrolled_status);
		//echo '<pre>';print_r($students);exit;
        if(count($students)>0){
            
            foreach ($students as $value) {
                
				if($value['sms_number']!=''){
										
					$data['receiverId']      = $value['student_id'];
					$data['mobile_no'] 	     = $value['sms_number'];
					$data['sms_body']    	 = $message;
					//echo '<pre>';print_r($data);exit;
					//send sms
					$recipients = array($value['sms_number']);
					$apiresponse = $this->sms_api($message,$recipients);
					//$json = json_decode($apiresponse, true);
					
					//insert database
					//$data['status'] = $json['data']['status'];
                    $data['status'] = $apiresponse;
					$smsresult = $this->db->insert('sms_history',$data);
				}
            }
            
        }     
    }
    
    //COMMON FUNCTION FOR SENDING SMS TO TRY OUT STUDENT
    function send_sms_tryout($message = '' , $reciever_phone = '')
    {
        $message    = $this->input->post('message');
                      
        $students   =   $this->db->get_where('tryout_student',array('sms_number!='=>''))->result_array();
	
        if(count($students)>0){
            
            
            foreach ($students as $value) {
										
					$data['receiverId']      = $value['tstudent_id'];
					$data['mobile_no'] 	     = $value['sms_number'];
					$data['sms_body']    	 = $message;
					
					//send sms
					$recipients = array($value['sms_number']);
					$apiresponse = $this->sms_api($message,$recipients);
					//$json = json_decode($apiresponse, true);
					
					//insert database
					//$data['status'] = $json['data']['status'];
                                        $data['status'] = $apiresponse;
					$smsresult = $this->db->insert('sms_history',$data);
					
            }
			
        }    
			return true;
    }

     //COMMON FUNCTION FOR SENDING SINGLE SMS
    function send_single_sms($message = '' , $reciever_phone = '')
    {
        $number     = $this->input->post('number');
        $message    = $this->input->post('message');
        	
        if(isset($number) && isset($message)){
            
            $number_list = array();
            
                
                
                array_push($number_list, $number);
                
				$data['mobile_no'] 	 = $number ;
				$data['sms_body']    = $message;
                
            
            
                         //send sms
                         $apiresponse = $this->sms_api($message,$number_list);
                         //$json = json_decode($apiresponse, true);
			
			//insert database
			//$data['status'] = $json['data']['status'];
                        $data['status'] = $apiresponse;
			$smsresult = $this->db->insert('sms_history',$data);
            return $json;
			
        }     
    }
    
    //COMMON FUNCTION FOR DUE REMINDER SMS
    function due_reminder_sms($message = '' , $reciever_phone = '')
    {
                     
        $students   =   $this->db->query("SELECT i.student_id,i.due,i.due_date,s.sms_number 
						FROM invoice i,student s WHERE i.student_id=s.student_id AND i.due!=0 AND i.due_date!=''
						AND s.sms_number!=''")->result_array();
		
		
        if(count($students)>0){
            
            
            foreach ($students as $value) {
				
					
                                        $message    = "Dear Parents your Star Football Academy outstanding balance is  ".$value['due']." AED  and payment is due on ".$value['due_date']." Please make the payment this coming session";
					
					$data['receiverId']      = $value['student_id'];
					$data['mobile_no'] 	     = $value['sms_number'];
					$data['sms_body']    	 = $message;
					
					//send sms
					$recipients = array($value['sms_number']);
					$apiresponse = $this->sms_api($message,$recipients);
					//$json = json_decode($apiresponse, true);
					
					//insert database
					//$data['status'] = $json['data']['status'];
                                        $data['status'] = $apiresponse;
					$smsresult = $this->db->insert('sms_history',$data);
					
            }
			
        }    
		return true;    
    }

    //DRAFT INVOICE SMS
    function draft_invoice_sms($message = '' , $reciever_phone = '')
    {
                     
        $students   =   $this->db->query("SELECT i.student_id,i.amount,i.due_date,s.sms_number 
						FROM draft_invoice i,student s WHERE i.student_id=s.student_id
						AND s.sms_number!=''")->result_array();
		
		
        if(count($students)>0){
            
            
            foreach ($students as $value) {
				
					
                    $message    = "Dear Parents your Star Football Academy outstanding balance is  ".$value['amount']." AED  and payment is due on ".$value['due_date']." Please make the payment this coming session";
					
					$data['receiverId']      = $value['student_id'];
					$data['mobile_no'] 	     = $value['sms_number'];
					$data['sms_body']    	 = $message;
					
					//send sms
					$recipients = array($value['sms_number']);
					$apiresponse = $this->sms_api($message,$recipients);
					//$json = json_decode($apiresponse, true);
					
					//insert database
					//$data['status'] = $json['data']['status'];
                                        $data['status'] = $apiresponse;
					$smsresult = $this->db->insert('sms_history',$data);
					
            }
			
        }    
		return true;    
    }

    //sms api call
    function sms_api($message,$recipients){
        
        $param = array(
                'username' => 'starfootball',
                'password' => 'sfa987',
                'senderid' => 'Star F A',
                'text' 	   => $message,
                'type'     => 'text',
                'datetime' => date("Y-m-d H:i:s")
            );
            //$recipients = array('97142869911','97142869912');
            $post = 'to=' . implode(';', $recipients);
            foreach ($param as $key => $val) {
                $post .= '&' . $key . '=' . rawurlencode($val);
            }
            
            //echo '<pre>'; print_r($post);
           // echo $post;exit;
            
            $url = "http://smartsmsgateway.com/api/api_http.php";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Connection: close"));
            $result = curl_exec($ch);//echo '<pre>'; print_r($result);exit;
            if(curl_errno($ch)) {
                $result = "cURL ERROR: " . curl_errno($ch) . " " . curl_error($ch);
            } else {
                $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
                switch($returnCode) {
                    case 200 :
                        break;
                    default :
                        $result = "HTTP ERROR: " . $returnCode;
                }
            }
            curl_close($ch);
            return $result;
    }
    
}