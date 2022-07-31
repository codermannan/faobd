<style>
   .radio input[type="radio"]{
      margin-top: -3px;
   }
</style>
<div class="row" style="margin:auto !important;">
	<div class="col-md-12">
    <?php echo form_open(base_url() . 'index.php?login/booking_session/update/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
        <div class="form-group">
        <label for="comment"><?php echo get_phrase('booking_date');?>:</label>
        <input type="date" class="form-control datepicker" name="booking_date" id="booking_date" autocomplete="off" required/>
        
		<input type="hidden" name="tstudent_id" value="<?php echo $param3;?>"/>
        </div>
        
        <div class="form-group">
              <?php         
            $schedulequery = $this->db->query("select * from dbqul0erfk8awo.training_schedule where venue=".$param2)->result_array();     
            foreach($schedulequery as $srow){
                ?>
            <div class="radio"> 
               <label> 
                  <input type="radio" name="booking_session" class="" id="booking_session" value="<?php echo $srow['id'];?>" onchange="document.getElementById('session_time').value=$('form input[type=radio]:checked').parent().text();" required><?php echo $srow['schedule_name'];?>    
               </label> 
            </div>
         <?php } ?>  
        </div>
        <input type="hidden" name="session_time" id="session_time" />
        <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary" style="background-color:#f37e3b;border-color:#f37e3b;text-align: center;width: 30%;color:black;font-size:14px;">
        </div>
    <?php echo form_close();?>
    </div>
</div>
<br/>


<script src="assets/js/bootstrap-datepicker.js"></script>
<!--<script src="assets/js/neon-calendar.js"></script>-->