
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
<div class="header_profile">
<div class="collect_sec">
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_jainsm.png" alt="">
<h3>Collect <img src="<?php echo base_url(); ?>assets/frontend/img/down_arrow.png" alt=""></h3>
</div>
    <div class="notification"><a href="<?php echo base_url(); ?>userNotifications"><img src="<?php echo base_url(); ?>assets/frontend/img/notification_icon.png" alt=""></a></div>
<div class="pro_logout"><a href="<?php echo base_url(); ?>logoutuser"><img src="<?php echo base_url(); ?>assets/frontend/img/logout_icon.png" alt=""></a></div>
<div class="pro_pic">
<h2><?php echo $userprofile->name ?>
<span><?php echo $userprofile->usercode ?></span></h2>
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_pic.png" alt="">
<!-- Profile click !-->
<div class="menu" style="display:none;">
<ul>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon1.png" alt=""></span><a href="#" class="active"><?php echo $userprofile->name ?>’s Home</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon2.png" alt=""></span><a href="#">Call To Us</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon3.png" alt=""></span><a href="#">Change Password</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon4.png" alt=""></span><a href="#">Terms & Conditions</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon5.png" alt=""></span><a href="<?php echo base_url(); ?>userMyaccount">Submit Feedback</a></li>
</ul>
</div>
<!-- end of click button !-->
</div>
</div>
<!-- header end-->

<!-- body -->
<div class="profile_midsec">
<div class="rotate_jains">Jain’s Mobile Appliances</div>
<div class="mid_usercode">
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_jainbig.png" alt="">
<h3><span>User Name:</span> <?php echo $userprofile->name ?></h3>
<h3><span>User Code:</span> <?php echo $userprofile->usercode ?></h3>
<h3 class="estate"><span>Estate:</span> Jain’s</h3>
</div>
<div class="proright_logo"><img src="<?php echo base_url(); ?>assets/frontend/img/profile_logo.png" alt=""></div>
<div class="prof_addbanner"><img src="<?php echo base_url(); ?>assets/frontend/img/pro_banner.png" alt=""></div>
<div class="profile_tab">
<ul>
<li>
<a href="<?php echo base_url(); ?>userOnlyforyou"><img src="<?php echo base_url(); ?>assets/frontend/img/profilr_icon1.png" alt="">
Only For You</a></li>
<li>
<a href="<?php echo base_url(); ?>userRedeemgift"><img src="<?php echo base_url(); ?>assets/frontend/img/profilr_icon2.png" alt="">
Redeem Gift & Point</a></li>
<li>
<a href="<?php echo base_url(); ?>userPricedrop"><img src="<?php echo base_url(); ?>assets/frontend/img/profilr_icon3.png" alt="">
Price Drop</a></li>
<li>
<a href="<?php echo base_url(); ?>userSpecialoffers"><img src="<?php echo base_url(); ?>assets/frontend/img/profilr_icon4.png" alt="">
Special Offer</a></li>
<li>
<a href="<?php echo base_url(); ?>userPayoutsummary"><img src="<?php echo base_url(); ?>assets/frontend/img/profilr_icon1.png" alt="">
Payout Summary</a></li>
<li>
<a href="<?php echo base_url(); ?>userSalessummary"><img src="<?php echo base_url(); ?>assets/frontend/img/profilr_icon2.png" alt="">
Sales Summary</a></li>
</ul>
</div>
</div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.11.0.js"></script> 
<!-- Script for detects HTML5 and CSS3 features in the user’s browser --> 
<script>
$(document).ready(function(){
  $(".pro_pic").click(function(){
    $(".menu").toggle();
  });
});
</script>
</body>
</html>