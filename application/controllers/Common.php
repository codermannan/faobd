<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Controller
{
     
    
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->library('crypto');

        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    //Default function, redirects to logged in user area
    public function index() {

        $this->load->view('backend/manage_attendance_whatsapp');
    }
    
    /*****************ONLINE PAYMENT*******************/
    function online_payment($param1 = "", $param2 = "", $param3 = "")
    {
       
        if ($param1 == 'payonline') {

          $studentname   = $this->input->post('studentname');
          $primaryemail  = $this->input->post('primaryemail');
          $mothernumber  = $this->input->post('mothernumber');
          
          $studentsql = $this->db->query("select student_id from dbqul0erfk8awo.student where father_email='".$primaryemail."' or mother_email='".$primaryemail."'");
          $cnt = $studentsql->num_rows();
          if($cnt>0){
            $studentid = $studentsql->row()->student_id;
          }else{
            $studentid = 0;  
          }

          $data['student_id']        = $studentid;
          $data['order_id']          = 'P'.time();
          $data['order_date']        = date('Y-m-d');
          $data['parent_name']       = $studentname;
          $data['parent_email']      = $primaryemail;
          $data['parent_phone']      = $mothernumber;
          $data['payment_type']      = $this->input->post('paymenttype');
          $data['venue_id']          = $this->input->post('venue');
          $data['number_class']      = $this->input->post('sessionperweek');
          $data['package']           = $this->input->post('howmanyweeks');
          $data['total_amount']      = $this->input->post('net_total');
          $data['reedem_point']      = 0;//$this->input->post('total_reward_point');
          $data['additional_item']   = $this->input->post('additems');
          $data['net_total']         = $this->input->post('net_total');

          //echo '<pre>';print_r($data);exit;
          //dbqul0erfk8awo.payment_order
          $this->db->insert('dbqul0erfk8awo.payment_order',$data);
          
        if($data['net_total']!=0){
            $this->pay_online($data['order_id'],$studentname,$primaryemail,$mothernumber,$data['net_total']);    
        }else{
            redirect(base_url() . 'index.php?common/online_payment/', 'refresh');
        }    
        exit;
        }

        if($param1 == 'updateorder') {

           $order_id     = $param2;
           $order_status = $param3;

            //if($order_status=='Success'){ 

              //  $data = $this->db->query("select * from dbqul0erfk8awo.payment_order where order_id='".$order_id."'")->row();
            //}

            $udata['order_status'] = $order_status;
            
            $this->db->where('order_id',$order_id);
            $this->db->update('dbqul0erfk8awo.payment_order',$udata);
            //echo $this->db->last_query(); exit;
            
            if($order_status=='Success'){ 
                $this->session->set_flashdata('flash_message' , 'Payment has been successfully processed');
            }else{
                $this->session->set_flashdata('flash_message' , 'Your payment process has been failed');
            }

            redirect(base_url() . 'index.php?common/online_payment/', 'refresh');
        }

        $data['additionalitem'] = $this->db->get('dbqul0erfk8awo.calculator_additionalitem_price')->result_array();
        
        $data['page_title']     =  get_phrase('online_payment');
        $this->load->view('backend/online_payment',$page_data);
    }
    
    public function pay_online($orderid,$customername,$customeremail,$customernumber,$net_total){
	    $data=array(
			'merchant_id'=>48810,
			//'merchant_id'=>45990,
			'order_id'=>$orderid,
			'billing_name'=>$customername,
			'billing_tel'=>$customernumber,
			'billing_email'=>$customeremail,
			'amount'=>$net_total,
			'currency'=>'AED',
			'redirect_url'=>'https://elearning.starbasketballacademy.com/index.php?common/return_from_gateway/'.$orderid,
			'cancel_url'  =>'https://elearning.starbasketballacademy.com/index.php?common/return_from_gateway/'.$orderid
		);
        //var_dump($data);
        
        $merchant_data='';
        //$working_key='C529139CECDB51B7D75354578B070B07';//Shared by CCAVENUES
        //$access_code='AVUU03HK61AW09UUWA';//Shared by CCAVENUES
        //$working_key='4DA431F0D68FFE8B02B4F08F70207982';//Shared by CCAVENUES
        //$access_code='AVZP03IB71CA94PZAC';//Shared by CCAVENUES
        
        $working_key='1332D2985235869D5071F72507CFE57E';//Shared by CCAVENUES
	    $access_code='AVXD04IL20CL46DXLC';//Shared by CCAVENUES

        foreach ($data as $key => $value){
            $merchant_data.=$key.'='.$value.'&';
        }

        //$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
        
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

    public function return_from_gateway($order_id){

		//$workingKey='C529139CECDB51B7D75354578B070B07';		//Working Key should be provided here.
		$working_key='1332D2985235869D5071F72507CFE57E';//Shared by CCAVENUES
		$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
		$rcvdString=$this->crypto->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		//echo "<center>";
		//echo '<pre>';print_r($this->session->userdata());
		//echo '<pre>';print_r($decryptValues);
		//exit;
		for($i = 0; $i < $dataSize; $i++) 
		{
			$information=explode('=',$decryptValues[$i]);
			if($i==3)	$order_status=$information[1];
		}
		redirect("https://elearning.starbasketballacademy.com/index.php?common/online_payment/updateorder/".$order_id."/".$order_status);
		
	}
	
    /***************** GET ADDITIONAL ITEM PRICE*******************/
    function get_additionalitem_price()
    {
        $itemid =  $this->input->post('itemid')!=''?$this->input->post('itemid'):0;
       
        $datasql = $this->db->query("SELECT sum(item_price) item_price FROM dbqul0erfk8awo.calculator_additionalitem_price where item_id in (".$itemid.")");
        //echo $this->db->last_query();
        $cnt = $datasql->num_rows();
        if($cnt>0){
            $data =$datasql->row_array();
            $itemprice = $data['item_price']!=''?$data['item_price']:0;
        }else{
            $itemprice = 0;
        }
        $json =  array('item_price'=>$itemprice);

        echo json_encode($json);

        exit;
        
    }

    /***************** GET BASE PRICE*******************/
    function get_base_price()
    {
        $venueid          =  $this->input->post('venue')!=''?$this->input->post('venue'):0;
        $session_per_week =  $this->input->post('session_per_week')!=''?$this->input->post('session_per_week'):0;
        $how_many_week    =  $this->input->post('how_many_week')!=''?$this->input->post('how_many_week'):0;

        $datasql = $this->db->query("SELECT how_many_week,discount,base_price FROM dbqul0erfk8awo.calculator_basic_price where venue=".$venueid." and session_per_week=".$session_per_week." and how_many_week=".$how_many_week);
        $cnt = $datasql->num_rows();
        if($cnt>0){
            $data =$datasql->row_array();
            $hweek      = $data['how_many_week'];
            $discount   = $data['discount'];
            $base_price = $data['base_price'];
        }else{
            $hweek      = 0;
            $discount   = 0;
            $base_price = 0;
        }

        $json =  array('how_many_week'=>$hweek,'discount'=>$discount,'base_price'=>$base_price);

        echo json_encode($json);


        exit;
        
    }
}