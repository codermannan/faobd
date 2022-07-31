<?php 
$edit_data		=	$this->db->get_where('dbqul0erfk8awo.tryout_student' , array('tstudent_id' => $tstudent_id) )->result_array();
foreach ( $edit_data as $row):
?>
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
            .form-groups-bordered >.form-group{

                    border-bottom:none !important;
            }
        </style>
    </head>
    <body class="page-body login-page login-form-fall">

        <div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="login-content" style="width:100%;">
			
							<a href="https://starsacademies.com/" class="logo">
								<img src="uploads/elogo200719.png" height="160" alt="">
							</a>
							
							<p class="description">
								</p><h2 style="color:#cacaca; font-weight:100;">
									Star Basketball Academy             </h2>
						 							
						</div>
					</div>
				</div>
                        <div class="row">
    
			<div class="panel-body">
                                        <?php echo form_open(base_url() . 'index.php?login/update_tryout_student/update/'.$row['tstudent_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Players Name</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autofocus value="<?php echo $row['name'];?>">
						</div>
					</div>
                                        <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Age</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="age" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autofocus value="<?php echo $row['age'];?>">
						</div>
					</div>
                                        <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Parent Email</label>
						<div class="col-sm-5">
							<input type="email" class="form-control" name="player_email" autofocus value="<?php echo $row['player_email'];?>">
						</div>
					</div>
                                
                                        
                                        <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Parent's Name</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="parents_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autofocus value="<?php echo $row['parents_name'];?>">
						</div>
					</div>
                                        <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Nationality</label>
						<div class="col-sm-5">
                                                        <select name="nationality" class="form-control selection2search" required>
                                                          <option value=""><?php echo get_phrase('select');?></option>
                                                          <?php 
                                                                                          $Nationality = $this->db->get('dbqul0erfk8awo.countries')->result_array();
                                                                                          foreach($Nationality as $nrow):
                                                                                                  ?>
                                                                  <option value="<?php echo $nrow['num_code'];?>" <?php if($nrow['num_code']==$row['nationality']){ echo 'selected';}?>>
                                                                                                                  <?php echo $nrow['en_short_name'];?>
                                                                      </option>
                                                          <?php
                                                                                          endforeach;
                                                                                    ?>
                                                        </select>
 						</div>
					</div>
                                        <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Area</label>
						<div class="col-sm-5">
                                                        <select name="area" class="form-control selection2search" required>
                                                          <option value=""><?php echo get_phrase('select');?></option>
                                                          <?php 
                                                                 $area = $this->db->get('dbqul0erfk8awo.area')->result_array();
                                                                 foreach($area as $arow):
                                                                                                  ?>
                                                                  <option value="<?php echo $arow['id'];?>" <?php if($arow['id']==$row['area']){ echo 'selected';}?>><?php echo $arow['area_name'];?>
                                                                      </option>
                                                          <?php endforeach;?>
                                                      </select>
						</div>
					</div>
					
					
                                        <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-success"><?php echo get_phrase('update_student');?></button>
						</div>
					</div>
                                        <?php echo form_close();?>
                                </div>
                        </div>
        </div>

<?php
endforeach;
?>
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