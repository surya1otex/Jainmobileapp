<!-- body -->
<div class="onlyforu_mid">
<div class="acctab">
<ul>
<li><img src="<?php echo base_url(); ?>assets/frontend/img/only_icon2.png" alt="">
<h4><span><?php echo $redeemammount ?></span>
Earned Point</h4></li>
<li>
<img src="<?php echo base_url(); ?>assets/frontend/img/only_icon1.png" alt="">
<h4><span>₹ <?php echo $purchasehistory ?></span>
Purchase History</h4></li>
</ul>
</div>
</div>
<h3><?php echo validation_errors(); ?></h3>
<?php
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
if($error) {
?>
<h3 class="flashmsg"><?php echo $this->session->flashdata('error'); ?></h3>
<?php
}
if($success) {
	?>
<h3 class="flashmsg"><?php echo $this->session->flashdata('success'); ?></h3>
<?php
}
?>
<div class="profile_midsec">
<div class="login_midsec">
<form action="<?php echo base_url(); ?>sendfeedback" method="post">
<div class="frm_div">

<label>Parched Product</label>
<select name="product">
<option>Select your parched product..</option>
 <?php
   if(!empty($payoutlists))
       {
         foreach ($payoutlists as $rl)
            {
            ?>
             <option value="<?php echo $rl->title ?>">
            	<?php echo $rl->title ?>
            		
            	</option>
                 <?php
                    }
             }
 ?>
</select>
</div>
<div class="frm_div">
<label>Feedback</label>
<input name="messase" type="text" placeholder="Type your message here..">
<input type="hidden" name="user_id" value="<?php echo $userprofile->userId ?>">
</div>
<input name="" type="submit" value="Send Your Feedback">

</form>
</div>
</div>
<style type="text/css">
	.flashmsg {
		color: #f9f9f9;
	}
</style>