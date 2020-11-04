
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
<form action="<?php echo base_url(); ?>updatepassword" method="post">
<div class="frm_div">

<label>Old Password</label>
<input name="oldPassword" type="password" placeholder="Old Password">
</div>
<div class="frm_div">

<label>New Password</label>
<input name="newPassword" type="password" placeholder="New Password">
</div>
<div class="frm_div">

<label>Confirm new Password</label>
<input name="cNewPassword" type="password" placeholder="Confirm New Password">
</div>

<input name="" type="submit" value="Change Password">

</form>
</div>
</div>
<style type="text/css">
	.flashmsg {
		color: #f9f9f9;
	}
</style>