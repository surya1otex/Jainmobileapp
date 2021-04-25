<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>JAIN’s Mobile &amp; Appliances</title>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"> 
<!-- Bootstrap CSS-->
<link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css">
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>assets/frontend/css/global-style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/frontend/css/style.css" rel="stylesheet" type="text/css">
<!-- Media queries CSS -->
<link href="<?php echo base_url(); ?>assets/frontend/css/media-queries.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="wrapper">
<!-- header -->
<div class="header">
<h1><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/logo.png" alt=""></a></h1>
<h2>Enter One Time Password</h2>
</div>
<!-- header end-->

<!-- body -->
<?php
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
if($error) { ?>
<p> <?php echo $this->session->flashdata('error'); ?> </p>
<?php
}
if($success) { ?>
<p> <?php echo $this->session->flashdata('success'); ?> </p>
<?php
}
?>
<!--<p><?php //echo validation_errors() ?></p>!-->
<div class="login_midsec">
<form action="<?php echo base_url(); ?>resetpassword" method="post">

<div class="frm_div">
<label>Enter Otp</label>
<input name="otp" type="password" required="required" placeholder="OTP">
</div>
<input type="hidden" name="userid" value="<?php echo $userinfo->userId ?>">
<input name="" type="submit" value="submit">


</form>
</div>
<!-- body mid end-->
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.11.0.js"></script> 
<!-- Script for detects HTML5 and CSS3 features in the user’s browser --> 
</body>
</html>