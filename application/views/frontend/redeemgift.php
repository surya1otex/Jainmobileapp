
<!-- body -->
<div class="onlyforu_mid">
<div class="profile_tab">
<ul>
<li>
<img src="<?php echo base_url(); ?>assets/frontend/img/only_icon1.png" alt="">
<span><?php echo $totalpurchase ?></span>
Purchase History</li>
<li><img src="<?php echo base_url(); ?>assets/frontend/img/only_icon2.png" alt="">
<span><?php echo $totalpoints ?></span>
Point Earned & Consumed</li>
</ul>
</div>
</div>
<div class="profile_midsec">
<?php
foreach($redeemgift as $redeem) { ?>
<div class="mobb_pan giftpoint">
<div class="lft_mobpic"><img src="<?php echo base_url(); ?>uploads/photos/redeem/<?php echo $redeem->redeemgift_image ?>" alt=""></div>
<div class="rightmob_dtls">
<h3><?php echo $redeem->redeemgift_name ?> (
<?php echo $redeem->redeemgift_feature ?> )- <?php echo $redeem->redeemgift_desc ?></h3>
    
<p>Price: <strong class="price">₹ <?php echo $redeem->redeemgift_price ?></strong><br>
Purchase Date:	  <strong><?php echo date("d-M-Y", strtotime($redeem->date_added)) ?></strong>
<span>Points value: <strong class="value"><?php echo $redeem->redeem_value ?></strong></span></p>
</div>
<br class="clr">
</div>
<?php } ?>
<?php echo $this->pagination->create_links(); ?>
</div>