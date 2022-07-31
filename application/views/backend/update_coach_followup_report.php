<!DOCTYPE html>



<html lang="en">



<head>

 

  <title>Star FootBall Academy</title>



  <meta charset="utf-8">



  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>



  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-repeat: no-repeat;
    background-size: 100% 100%
}
.card {
    padding: 30px 40px;
    margin-top: 60px;
    margin-bottom: 60px;
    border: none !important;
    box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
}
.blue-text {
    color: #00BCD4
}
.form-control-label {
    margin-bottom: 0
}
input,
textarea,
button {
    padding: 8px 15px;
    border-radius: 5px !important;
    margin: 5px 0px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    font-size: 18px !important;
    font-weight: 300
}
input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #00BCD4;
    outline-width: 0;
    font-weight: 400
}
.btn-block {
    text-transform: uppercase;
    font-size: 15px !important;
    font-weight: 400;
    height: 43px;
    cursor: pointer
}
.btn-block:hover {
    color: #fff !important
}
button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}
</style>
</head>
<body>
<div class="container">
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Star Football Academy</h3>
            <div class="card">
                <h5 class="text-center mb-4">Coach Follow Up Report</h5>
                    <?php if($this->session->flashdata('error_message')): ?>
                    <div class="alert alert-danger">
                        <strong>Message!</strong> <?= $this->session->flashdata('error_message'); ?>.
                    </div>
                <?php endif; ?>
                 <?php if($this->session->flashdata('flash_message')): ?>
                    <div class="alert alert-success">
                        <strong>Message!</strong> <?= $this->session->flashdata('flash_message'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-card" action="<?php echo base_url();?>index.php?login/update_coach_followup_report/update/<?php echo $cfid?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    
                    <div class="row justify-content-between text-left">
						<div class="form-group col-sm-12 flex-column d-flex"> 
                            <label class="form-control-label px-3">Name<span class="text-danger"> *</span></label>
                            <input type="text" readonly name="name" value="<?= $student_name; ?>" class="form-control"> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-12 flex-column d-flex "> 
                           <label class="form-control-label px-3">Comments<span class="text-danger"> *</span></label>
                           <textarea name="parent_comments" class="response_price" required="required"></textarea>                           
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                         <button type="submit" class="btn-block form-group col-sm-12" style="background-color:#F9CB0E !important">Submit</button> 
                    </div>
                </form>
                <div class="row age_group"> </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/select2/select2.css">
<script src="assets/js/select2/select2.min.js"></script>
<script>
$(document).ready(function(){


});
</script>
</body>
</html>
