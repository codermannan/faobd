<!DOCTYPE html>
<html lang="en">
   <head>
      <?php
         $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
         $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
         ?>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="Star Football Academy" />
      <meta name="author" content="" />
      <title><?php echo get_phrase('booking_session'); ?> | <?php echo $system_title; ?></title>
      <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
      <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
      <link rel="stylesheet" href="assets/css/bootstrap.css">
      <link rel="stylesheet" href="assets/css/neon.css">
      <link rel="stylesheet" href="assets/css/neon-theme.css">
      <link rel="stylesheet" href="assets/css/neon-forms.css">
      <link rel="stylesheet" href="assets/css/custom.css">
      <script src="assets/js/jquery-1.11.0.min.js"></script>
      <link rel="shortcut icon" href="assets/images/favicon.png">
      <style>
         @media (max-width: 768px) {
            a.session_btn{
                display: inline-flex !important;
                margin-top: 10px !important;
            }
            .img_body{
            width: 100% !important;
            height: 60% !important;
             }
             .btn_pay{
               padding: 7px;
               border: 1px solid #f37e3b;
               border-radius: 3px;
               font-size: 13px !important;
               background: #f37e3b;
               color:white;
               font-weight:bold;
             }
         }
         .main-img {
           position: relative;
           text-align: center;
           color: white;
         }
         .centered {
           position: absolute;
           top: 50%;
           left: 50%;
           transform: translate(-50%, -50%);
         }
         .img_body{
            width: 100%;
            height: 50%;
         }
         .btn_pay{
            padding: 7px;
            border: 1px solid #f37e3b;
            border-radius: 3px;
            font-size: 15px;
            background: #f37e3b;
            color:white;
            font-weight:bold;
         }
      </style>
   </head>
   <body class="page-body login-page login-form-fall">
      <div class="container">
         <!--
            <div class="row">
            	<div class="col-md-12">
            		<div class="login-content" style="width:100%;">
            
            			<a href="https://starsacademies.com/" class="logo">
            				<img src="uploads/elogo200719.png" height="160" alt="">
            			</a>
            			
            			<p class="description">
            				</p><h2 style="color:#cacaca; font-weight:100;">
            					Star Football Academy              
                                                                        </h2>
            		 							
            		</div>
            	</div>
            </div>
                                        -->
         <div class="row">
             
         </div>
         <div class="row">
            <div class="col-md-12">

              
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <div class="panel-title">Choose your nearest location and give it a try!</div>
                  </div>
                  <div class="panel-body">
                   
                       <?php
                            $i=1;
                            foreach($booking_session as $row):
                        ?> 
                       <div class="col-md-4">
                             <div class="panel panel-invert" data-collapsed="0" style="position: static;">
                                    <!-- panel head -->
                                    <div class="panel-heading">
                                       <div class="panel-title" style="color: #f37e3b;font-size: 15px;font-weight: bold;"><?php echo $row['vanue_name'];?></div>
                                       
                                    </div>
                                    <!-- panel body -->
                                    <div class="panel-body" style="display: block;">
                                     
                                    </div>
                                    <div class="panel-footer"> 
                                            <a href="#" style="padding: 7px;border: 1px solid #f37e3b;border-radius: 3px;font-size: 15px;background: #f37e3b;color:white;font-weight:bold;" 
                                            onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_booking_session_view/<?php echo $row['id'];?>/<?php echo $tstudent_id;?>');">Book Now</a>
                                           <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup_root/modal_session_price/<?php echo $row['session_price'];?>');" style="padding: 7px;border: 1px solid #f37e3b;border-radius: 3px;font-size: 15px;background: #f37e3b;color:white;font-weight:bold;">Check Prices</a>
                                           <a href="#" class="session_btn" onclick="showAjaxModal('<?php echo base_url();?>/index.php?modal/popup/modal_view_googlemap/<?php echo $row['loc_lat'];?>/<?php echo $row['loc_long'];?>');" style="padding: 7px;border: 1px solid #f37e3b;border-radius: 3px;font-size: 15px;background: #f37e3b;color:white;font-weight:bold;">View Map</a>
                                    </div>

                                 </div>
                          </div>
                           <?php $i++; endforeach;?>

                   
                  </div>
                  <?php if($this->session->flashdata('msg')): ?>

                     <div class="alert alert-success">
                        <?php 
                        echo '<script type="text/javascript">alert("'.$this->session->flashdata('msg').'");</script>';                        
                        echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
                  <div class="row">   
                        <div class="col-md-6 main-img"> 
                              <a href="https://youtu.be/TQkJSl9HF50"><img src="https://elearning.starbasketballacademy.com/assets/images/sba_play.jpg" class="img_body" /></a>
                              <div class="centered">  <a href="https://elearning.starbasketballacademy.com/index.php?common/online_payment" class="btn_pay" style="">Pay Online</a>
                                
                               </div>
                        </div>
                           <div class="col-md-6 main-img"> 
                              <a href="https://elearning.starbasketballacademy.com/assets/Star_basketball_Academy.pdf" target="_blank"><img src="https://elearning.starbasketballacademy.com/assets/images/sba_pay_online.jpg" class="img_body" /></a>
                              <div class="centered">  
                                  <a href="https://elearning.starbasketballacademy.com/assets/Star_basketball_Academy.pdf" target="_blank" class="btn_pay">Download PDF</a>
                               </div>
                        </div>
                          
                     </div>
               </div>
               
               
            </div>
         </div>
         
         <!--<div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                            <table class="table table-bordered datatable" id="table_export">
                            <thead>
                                    <tr>
                                    <th><div><?php //echo get_phrase('booking_session');?></div></th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <?php  //$i=1;
               //echo '<pre>';print_r($training_schedule);
               // foreach($booking_session as $row):?>
                                    <tr>
                                    <td>
                                            <a href="#" onclick="showAjaxModal('<?php// echo base_url();?>index.php?modal/popup/modal_booking_session_view/<?php// echo $row['id'];?>/<?php// echo $tstudent_id;?>');" class="btn btn-default" style="font-size:30px;">
                                         
                                                    <?php //echo $row['vanue_name'];?>
                                            </a>
            
            </td>
                                    
                                    </tr>
                                    <?php // $i++; endforeach;?>
                            </tbody>
                            </table>
            </div>
            </div>-->
      </div>
      <?php include 'modal.php';?>
      <!-- Bottom Scripts -->
      <script src="assets/js/gsap/main-gsap.js"></script>
      <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
      <script src="assets/js/bootstrap.js"></script>
      <script src="assets/js/joinable.js"></script>
      <script src="assets/js/resizeable.js"></script>
      <script src="assets/js/neon-api.js"></script>
      <script src="assets/js/jquery.validate.min.js"></script>
      <script src="assets/js/neon-forgotpassword.js"></script>
      <script src="assets/js/jquery.inputmask.bundle.min.js"></script>
      <script src="assets/js/neon-custom.js"></script>
      <script src="assets/js/neon-demo.js"></script>
   </body>
</html>