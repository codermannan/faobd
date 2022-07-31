<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl';?>">
<head>
	
	<title>Online Payment</title>
    
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Shooting Star Sports Services" />
	<meta name="author" content="Datastate Solutions" />
	<meta name="google-site-verification" content="fKN6eNaYKeVmKFaEzD-nLg9-Ezc6ALz9HL6bcDlr3Bc" />
	

	<?php include 'includes_top.php';?>
	<link rel="stylesheet" href="https://demo.neontheme.com/assets/js/icheck/skins/minimal/_all.css" id="style-resource-1"> 
    <link rel="stylesheet" href="https://demo.neontheme.com/assets/js/icheck/skins/square/_all.css" id="style-resource-2"> 
    <style>
        img{
            height:80px;
            width:70px
            vertical-align:middle;
        }
		 .form-control{
			 color:#000000 !important;
			 border:1px solid #000 !important; 
		 }
		 .table-bordered > thead > tr > th{
			 background-color: #f37e3b !important;
			 color: black;
			 font-size: 14px;
			 font-weight:600;
		 }
		 label{
			 color:black !important;
			 font-size:14px !important;
		 }
		 strong{
			 color:black;
		 }
		
		.btn-warning{
			margin-top: -15px;
			}
			@media only screen and (max-width: 600px) {
				.btn-warning{
				margin-top: 15px !important;
				}
				.icheck-list>li{
					margin-top:10px !important;
				}
			}
			.icheck-list{
				display:inline-flex !important;
			}
			.icheck-list li{
				width:100%;
			}
    </style>
</head>
<body class="page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour;?>" >
	<div class="row" style="background: black;">
		<div class="container">
			<div class="col-md-12">    
				<div class="col-md-6">
						 <img src="https://crm.starbasketballacademy.com/uploads/rehan.png">
				</div>
				<div class="col-md-6">
					<h1 style="text-align:center;color: white;">Calculator for Online Guest Payment</h1>
				</div>				   
						
			</div>
		</div>
	</div>
	<div class="page-container sidebar-collapsed" >
			
		<div class="container">
          
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
              
                <div class="panel-options">
                  
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                </div>
            </div>
            <div class="panel-body with-table">
                <table class="table table-bordered">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?common/online_payment/payonline" method="post" enctype="multipart/form-data" id="onlineCalculator">
                    <tbody>
                        <tr>
                            <td class="padding-lg">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Name : <input class="form-control" type="text" name="studentname" required/></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>Email : <input class="form-control" type="text" name="primaryemail" required/></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>Mobile : <input class="form-control" type="text" name="mothernumber" required/></p>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50%">Choose:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" name="paymenttype" id="paymentType" value="">
                        <tr>
                            <td class="padding-lg">
                                <div class="row">
                                   
                                    <div class="col-sm-6">
                                        <ul class="icheck-list">
                                            <li><input tabindex="5" type="checkbox" class="icheck-6 payment-type" name="payment_type" id="NewRegistration" value="New Registration" /> <label for="minimal-checkbox-1-11">New Registration</label></li>
                                            <li><input tabindex="5" type="checkbox" class="icheck-6 payment-type" name="payment_type" id="Renewal" value="Renewal"/> <label for="minimal-checkbox-1-11">Renewal</label></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="icheck-list">
                                            <li><input tabindex="5" type="checkbox" class="icheck-6 payment-type" name="payment_type" id="AdditionalItem" value="Camp"/> <label for="minimal-checkbox-1-11">Camp</label></li>
                                            <li><input tabindex="5" type="checkbox" class="icheck-6 payment-type" name="payment_type" id="Others" value="Others"/> <label for="minimal-checkbox-1-11">Others</label></li>
                                        </ul>
                                    </div>
                                </div>

                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-body with-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>The prices depends on the number per session per week and number of weeks you choose</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="padding-lg">
                                <div class="col-md-12">
                                        <strong>Choose Venue</strong> <br />
                                        <br />
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                     <select class="form-control" name="venue" id="venue" required>
                                             <option value="">Please Select</option>
                                             <?php 
                                              $venue = $this->db->query('SELECT * FROM dbqul0erfk8awo.vanue where status=1 and venue_category=1 order by vanue_name')->result_array();
                                              foreach($venue as $value){
                                             ?>
                                             <option value="<?php echo $value['id'];?>"><?php echo $value['vanue_name'];?></option>
                                             <?php } ?>
                                     </select>
                                    </div>
                                </div>

                                <br /><br />
                                <div class="col-md-12">
                                        <strong>Choose number of classes per week:</strong> <br />
                                        <br />
                                </div>
                                <div class="row">
                                    <input type="hidden" name="sessionperweek" id="sessionPerWeek" value="0"/>
                                    <div class="col-md-6">
                                        <ul class="icheck-list">
                                            <li><input class="icheck-11 session_per_week" type="radio" id="session_per_week1" name="session_per_week" value="1" /> <label for="minimal-radio-1-11">One</label></li>
                                            <li><input class="icheck-11 session_per_week" type="radio" id="session_per_week2" name="session_per_week" value="2"/> <label for="minimal-radio-1-11">Two</label></li>
                                             <li><input class="icheck-11 session_per_week" type="radio" id="session_per_week3" name="session_per_week" value="3"/> <label for="minimal-radio-1-11">Three</label></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="icheck-list">
                                           
                                            <li><input tabindex="8" class="icheck-11 session_per_week" type="radio" id="session_per_week4" name="session_per_week" value="4"/> <label for="minimal-radio-2-11">Four</label></li>
                                            <li><input tabindex="8" class="icheck-11 session_per_week" type="radio" id="session_per_week5" name="session_per_week" value="5"/> <label for="minimal-radio-2-11">Five</label></li>
                                            <li><input class="icheck-11 session_per_week" type="radio" id="session_per_week6" name="session_per_week" value="6"/> <label for="minimal-radio-1-11">Six</label></li>
                                          
                                            
                                        </ul>
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="padding-lg">
                                  
                                <div class="col-md-12">
                                        <strong>Choose weekly packages:</strong> <br />
                                        <br />
                                </div>
                                <div class="row">
                                    <input type="hidden" name="howmanyweeks" id="howmanyWeeks" value="0"/>
                                    <div class="col-sm-6">
                                        <ul class="icheck-list">
                                            <li><input class="icheck-11 how_many_week" type="radio" id="how_many_week4" name="how_many_week" value="4"/> <label for="minimal-radio-1-11" id="4Weeks">4 Weeks (Points)</label></li>

                                            <li><input class="icheck-11 how_many_week" type="radio" id="how_many_week16" name="how_many_week" value="16"/> <label for="minimal-radio-1-11" id="16Weeks">16 Weeks (% Discount)</label></li>

                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="icheck-list">

                                            <li><input tabindex="8" class="icheck-11 how_many_week" type="radio" id="how_many_week24" name="how_many_week" value="24"/> <label for="minimal-radio-2-11" id="24Weeks">24 Weeks (% Discount)</label></li>
                                            
                                            <li><input tabindex="8" class="icheck-11 how_many_week" type="radio" id="how_many_week32" name="how_many_week" value="32"/> <label for="minimal-radio-2-11" id="32Weeks">32 Weeks (% Discount)</label></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                
                                <br /><br />
                                
                                <div class="col-md-12">
                                        <strong>Total amount for Weeks </strong> <br />
                                        <br />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="total_amount" id="totalAmount" data-mask="99999" placeholder="Total Amount" value="0" style="font-size: 20px;">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-body with-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Choose the following items:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="padding-lg">
                                <div class="row">
                                <input type="hidden" name="additems" id="addItems" value="0"/>                         
                                <?php

                                $additionalitem= $this->db->get('dbqul0erfk8awo.calculator_additionalitem_price')->result_array();
                                foreach($additionalitem as $key){ ?>

                                <div class="col-sm-6">
                                    <ul class="icheck-list">
                                    <li><input tabindex="5" type="checkbox" class="icheck-6 additionalitem" id="<?= $key['attribute_id'] ?>" name="additioanl_item" value="<?= $key['item_id'] ?>"/>
                                        <label for="minimal-checkbox-1-11"><?= $key['item_name'] ?> (<?= $key['item_price'] ?>)</label>
                                    </li>             
                                </ul>
                                </div>

                                <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <input type="hidden" name="net_total" id="netTotal" value="0"/> 
                               <div class="label label-primary" style="font-size: 34px;">Total : <span id="GrandTotal">0</span></div>
          
                               <input type="submit" class="btn" value="Pay Now" style="font-size: 24px;margin-top:-15px;color: #000;font-weight: bold;background-color:#f37e3b;border-color:#f37e3b;"> 

                               <input type="button" class="btn btn-warning" value="Clear" style="font-size: 24px;color: #000;font-weight: bold;background-color:#f37e3b;border-color:#f37e3b;" onclick="clearForm()"> 
            
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            </form>

        </div>
    </div>
</div>
<script src="https://demo.neontheme.com/assets/js/icheck/icheck.min.js" id="script-resource-8"></script>
<script type="text/javascript">
               jQuery(document).ready(function ($) {
                    
                       $('#NewRegistration').on('ifChanged', function(){
                              if($(this).is(':checked')){
                                 $('#RegistrationFee').prop('checked', true);
                                 $('#RegistrationFee').iCheck('update');
                              } else {
                                 $('#RegistrationFee').prop('checked', false);
                                 $('#RegistrationFee').iCheck('update');
                              }
                        });
                        
                       var calculator = {
               
                          session_per_week : 0,
                          how_many_week    : 0,
                          calc : function(session_per_week,how_many_week,venueid) { //console.log("session_per_week",session_per_week);
                             //console.log("how_many_week",how_many_week);console.log("venueid",venueid);
                             bodyContent = $.ajax({
                                url: "<?php echo base_url();?>index.php?common/get_base_price",
                                global: false,
                                type: "POST",
                                data: {'venue':venueid,'session_per_week':session_per_week,'how_many_week':how_many_week},
                                dataType: "json",
                                //beforeSend: beforesend,
                                //complete: complete,
                                async:false
                            }).responseText;
               
                             //var pricedata = this.ajaxcall(session_per_week,how_many_week,venueid);
                             
                             var data = JSON.parse(bodyContent);
                             //alert(data.base_price);
               
                             if(data.how_many_week==4){
                                  $("#4Weeks").html("4 Weeks ("+data.discount+"% Discount)");
                             }else if(data.how_many_week==16){
                                  $("#16Weeks").html("16 Weeks ("+data.discount+"% Discount)");
                             }else if(data.how_many_week==24){
                                  $("#24Weeks").html("24 Weeks ("+data.discount+"% Discount)");
                             }else if(data.how_many_week==32){
                                  $("#32Weeks").html("32 Weeks ("+data.discount+"% Discount)");
                             }
               
                             return data.base_price;
                             
                          },
                          additionalitem : function(itemid){
                           
                           bodyContent = $.ajax({
                                    url: "<?php echo base_url();?>index.php?common/get_additionalitem_price",
                                    global: false,
                                    type: "POST",
                                    data: {'itemid':itemid==''?0:itemid},
                                    dataType: "json",
                                    async:false
                                } 
                             ).responseText;
                            
                            var data = JSON.parse(bodyContent); 
                            return data.item_price; //alert(data.item_price);
               
                          }
                       }; 
               
                       $('.session_per_week').on('ifChanged', function() {
                           
                             if( $(this).is(":checked") ){
                                 
                                 let sessionper_week    = $(this).val();
                                 
                                 $("#sessionPerWeek").val(sessionper_week);
               
                                 let howmany_week       = $("input[name=how_many_week]:checked").val()==null?0:$("input[name=how_many_week]:checked").val();
                                 let venueid            = $("#venue :selected").val();
                                 
                                 if(venueid==0){
                                    alert("Please select venue first");
                                 }
                                 var totalAmount = 0;
                                 var GrandTotal = 0;
                                 var netTotal = 0;
                                 var totalChecker = 0;
               
                                 var additionalitemid = new Array();
                                 var additionalamount = parseInt(0);
                                 $("input:checkbox[name=additioanl_item]:checked").each(function() {
                                     additionalitemid.push($(this).val());
                                 });

                                 totalAmount      = parseInt(calculator.calc(sessionper_week,howmany_week,venueid));
                                 additionalamount = parseInt(calculator.additionalitem(additionalitemid.toString()));
               
                                 GrandTotal  = (totalAmount+additionalamount);
                                 netTotal    = (totalAmount+additionalamount);
                                 
                                 $('#totalAmount').val(totalAmount);
                                 $('#GrandTotal').html(GrandTotal);
                                 $('#netTotal').val(netTotal);
                             }
               
                       });
               
                       $('.how_many_week').on('ifChanged', function() {
                           
                             if( $(this).is(":checked") ){
               
                                 var rewardpoint = $("input[name=arpoint]:checked").val();
                                 let howmany_week = $(this).val();
                                 $("#howmanyWeeks").val(howmany_week);
                                 let sessionper_week = $("input[name=session_per_week]:checked").val()==null?0:$("input[name=session_per_week]:checked").val();
                                 let venueid  =    $("#venue :selected").val();
                                 
                                 if(venueid==0){
               
                                    alert("Please select venue first");
                                    false;
                                 }
                                 
                                 var totalAmount = 0;
                                 var GrandTotal = 0;
                                 var netTotal = 0;
                                 var totalChecker = 0;
               
                                 var additionalitemid = new Array();
                                 var additionalamount = parseInt(0);
                                 $("input:checkbox[name=additioanl_item]:checked").each(function() {
                                     additionalitemid.push($(this).val());
                                 });
               
                                 totalAmount      = parseInt(calculator.calc(sessionper_week,howmany_week,venueid));
                                 additionalamount = parseInt(calculator.additionalitem(additionalitemid.toString()));
                                 
                                 GrandTotal  = (totalAmount+additionalamount);
                                 netTotal    = (totalAmount+additionalamount);
                                 
                                 $('#totalAmount').val(totalAmount);
                                 $('#GrandTotal').html(GrandTotal);
                                 $('#netTotal').val(netTotal);
                             }
               
                       });
                       
                       //additional item
                       $('.additionalitem').on('ifChanged', function() {
                           
                             var howmany_week    = $("input[name=how_many_week]:checked").val()==null?0:$("input[name=how_many_week]:checked").val();
                             var sessionper_week = $("input[name=session_per_week]:checked").val()==null?0:$("input[name=session_per_week]:checked").val();
                             var venueid         = $("#venue :selected").val();
                             
                             //alert(howmany_week);alert(sessionper_week);
                             if(venueid==0){
                               alert("Please select venue first");
                               false;
                             }
                                 
                             var totalAmount = 0;
                             var GrandTotal = 0;
                             var netTotal = 0;
                             var totalChecker = 0;
               
                             totalAmount = parseInt(calculator.calc(sessionper_week,howmany_week,venueid)) || 0;
                             
                             var additionalitemid = new Array();
               
                              $("input:checkbox[name=additioanl_item]:checked").each(function() {
                                        additionalitemid.push($(this).val());
                              });
               
                             //console.log("additionalitemid",additionalitemid);
               
                             if( $(this).is(":checked") ){
               
                                 
                                 //var additionalitemid = $(this).val();
                                 //alert(additionalitemid);
               
                             var additionalamount = parseInt(0);
                             additionalamount     = calculator.additionalitem(additionalitemid.toString());
                             var totalAmount      = $('#netTotal').val();
                             $("#addItems").val(additionalitemid.toString());
                                 //var nettotal = parseInt(0);
                                 
                             if(additionalamount==null){
                                     nettotal = parseInt(totalAmount);
                             }else{ //console.log("netTotalw",netTotal);
               
                                     //GrandTotal  = parseInt(calculator.calc(sessionper_week,howmany_week,venueid)) || 0;
                                     netTotal    = parseInt(calculator.calc(sessionper_week,howmany_week,venueid)) || 0;
                                     
                                     totalChecker= parseInt(additionalamount) + parseInt(netTotal);
                                     //alert(totalChecker);
                                     if(totalChecker>0){ 
                                        nettotal    = totalChecker;
                                     }else{ //alert(additionalamount);
                                        nettotal    = 0;
                                     }
                                     //console.log(netTotal);
                                     
                                     //console.log("netTotalwtot",nettotal);
                             }
                             
                             $('#netTotal').val(nettotal);
                             $('#GrandTotal').html(nettotal);
                                 
                             }else{ //uncheck
                                 var additionalamount = parseInt(0);
                                 additionalamount     = calculator.additionalitem(additionalitemid.toString());
                                 var totalAmount      = $('#netTotal').val();
               
                                     //var nettotal = parseInt(0);
                                     
                                 if(additionalamount==null){
                                         nettotal = parseInt(totalAmount);
                                 }else{ //console.log("netTotalw",netTotal);
               			
                                     //GrandTotal  = parseInt(calculator.calc(sessionper_week,howmany_week,venueid)) || 0;
                                     netTotal    = parseInt(calculator.calc(sessionper_week,howmany_week,venueid)) || 0;
                                         
                                     totalChecker= parseInt(additionalamount) + parseInt(netTotal);
                                         //alert(totalChecker);
                                     if(totalChecker>0){ 
                                         nettotal    = totalChecker;
                                     }else{ //alert(additionalamount);
                                         nettotal    = 0;
                                     }
                                         //console.log(netTotal);
                                         
                                         //console.log("netTotalwtot",nettotal);
                                 }
               
                                 $('#netTotal').val(nettotal);
                                 $('#GrandTotal').html(nettotal);
                             }
               
                       });
               
                   //payment type
                   $('.payment-type').on('ifChanged', function() {

                        var paymenttypearray = new Array();

                        if( $(this).is(":checked") ){
                            
                              $("input:checkbox[name=payment_type]:checked").each(function() {
                                        paymenttypearray.push($(this).val());
                              });
                            $("#paymentType").val(paymenttypearray);
                        }else{
                            $("input:checkbox[name=payment_type]:checked").each(function() {
                                        paymenttypearray.push($(this).val());
                              });
                              $("#paymentType").val(paymenttypearray);
                        }
                   });

                   $("input.icheck-6").iCheck({
               
                      checkboxClass: "icheckbox_minimal-grey",
                      radioClass: "iradio_minimal-grey",
               
                   });
                   $("input.icheck-11").iCheck({
                      //alert(3333333);
                      checkboxClass: "icheckbox_square-blue",
                      radioClass: "iradio_square-yellow",
               
                   });
                   
                       
               });
               
               function clearForm(){
                 location.reload();
               }
               
</script>

<?php include 'footer.php';?>

		</div>
		
        	
	</div>
  <?php include 'includes_bottom.php';?>
    
</body>
</html>