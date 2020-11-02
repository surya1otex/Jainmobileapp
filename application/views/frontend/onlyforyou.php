<!-- body -->
<div class="onlyforu_mid">
<div class="profile_tab">
<ul>
<li>
<img src="<?php echo base_url(); ?>assets/frontend/img/only_icon1.png" alt="">
<span><?php echo $purchasehistory ?></span>
Purchase History</li>
<li><img src="<?php echo base_url(); ?>assets/frontend/img/only_icon2.png" alt="">
<span><?php echo $redeemammount ?></span>
Point Earned & Consumed</li>
</ul>
</div>
</div>
<div class="profile_midsec">
<?php

foreach($useronlyforyou as $onlyforyou) { ?>

<div class="mobb_pan">
<div class="lft_mobpic">
<img src="<?php echo base_url(); ?>uploads/photos/onlyforyou/<?php echo $onlyforyou->onlyforyou_image ?>" alt=""></div>
<div class="rightmob_dtls">
<h3><?php echo $onlyforyou->product_name ?>(
<?php echo $onlyforyou->product_feature ?>) - <?php echo $onlyforyou->product_desc ?></h3>
<p>IMEI No. <strong><?php echo $onlyforyou->imei ?></strong></p>
<p>Purchase Amount:  <strong class="price">₹ <?php echo $onlyforyou->onlyforyou_price ?></strong><br>
Purchase Date:	  <strong><?php echo date("d-M-Y", strtotime($onlyforyou->date_added)) ?></strong><span>Redeem Points:  <strong><?php echo $onlyforyou->redeem ?></strong></span></p>

</div>
<br class="clr">
</div>

<?php } ?>

<?php echo $this->pagination->create_links(); ?>


</div>