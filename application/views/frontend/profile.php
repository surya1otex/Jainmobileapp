
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
<link href="<?php echo base_url(); ?>assets/frontend/css/slider.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body>
<div class="wrapper">
<div class="header_profile">
<div class="collect_sec">
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_jainsm.png" alt="">
<h3>Collect <img src="<?php echo base_url(); ?>assets/frontend/img/down_arrow.png" alt=""></h3>
</div>
    <div class="notification"><a href="<?php echo base_url(); ?>userNotifications"><img src="<?php echo base_url(); ?>assets/frontend/img/notification_icon.png" alt=""></a></div>
<div class="pro_logout"><a href="<?php echo base_url(); ?>logoutuser">
	<img src="<?php echo base_url(); ?>assets/frontend/img/logout_icon.png" alt=""></a></div>
<div class="pro_pic">

<h2><?php echo $userprofile->name ?>
<span><?php echo $userprofile->usercode ?></span></h2>
<?php
if(empty($userprofile->image)) { ?>
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_pic.png" alt="">
<?php
}else { ?>
<img src="<?php echo base_url(); ?>uploads/photos/profile/<?php echo $userprofile->image ?>" alt="" class="pro_pic_user" id="profile-img-tag">
<?php } ?>
<!-- Profile click !-->
<div class="menu" style="display:none;">
<ul>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon1.png" alt=""></span>
	<a href="<?php echo base_url(); ?>userMyaccount" class="active">
    <?php
     if(!empty($userprofile->name)) {
     echo $userprofile->name.'’s' ; } ?> Home</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon2.png" alt=""></span><a href="tel:+1-847-555-5555">Call To Us</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon3.png" alt=""></span><a href="<?php echo base_url(); ?>changemypassword">Change Password</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon4.png" alt=""></span><a href="<?php echo base_url(); ?>termsconditions">Terms & Conditions</a></li>
<li><span><img src="<?php echo base_url(); ?>assets/frontend/img/menu_icon5.png" alt=""></span><a href="<?php echo base_url(); ?>userFeedback">Submit Feedback</a></li>
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
<div class="prof_addbanner">
<!-- slider banner images !-->
<div id="wowslider-container">
   <div class="ws_images">
     <ul>
      <?php
      if(!empty($slideimages))
         {
          foreach ($slideimages as $images)
           {
            ?>
      <li><img src="<?php echo base_url(); ?>uploads/photos/special/<?php echo $images->offer_image ?>" alt=""></li>
      <?php
      }
    }
  ?>
    </ul>
   </div>
<div class="ws_shadow"></div>
</div>
<!-- end of banner images !-->

</div>
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
<!--<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.11.0.js"></script>!-->

<script src="<?php echo base_url(); ?>assets/frontend/js/wowslider.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/script.js"></script>
<!-- Script for detects HTML5 and CSS3 features in the user’s browser --> 
<style type="text/css">
	.pro_pic_user  {
    border: 2px solid #4a5270;
    border-radius: 50px;
    padding: 2px;
	  height: 100px;
	}
</style>
<script>
$(document).ready(function(){
  $(".pro_pic").click(function(){
    $(".menu").toggle();
  });
});

</script>
</body>
</html>