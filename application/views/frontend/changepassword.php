
<?php
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
$nomatch = $this->session->flashdata('nomatch');
$sameasold = $this->session->flashdata('sameasold');

if($error) {
?>
<h4 class="flashmsg"><?php echo $this->session->flashdata('error'); ?></h4>
<?php
}
if($success) {
	?>
<h4 class="flashmsg"><?php echo $this->session->flashdata('success'); ?></h4>
<?php
}
if($nomatch) {
	?>
	<h4 class="flashmsg"><?php echo $this->session->flashdata('nomatch'); ?></h4>
	<?php
}
if($sameasold) {
	?>
	<h4 class="flashmsg"><?php echo $this->session->flashdata('sameasold'); ?></h4>
	<?php
}
?>
<h4><?php echo validation_errors(); ?></h4>

<div class="profile_midsec">
<div class="login_midsec">
<form action="<?php echo base_url(); ?>updatepassword" method="post">
<div class="frm_div">

<label>Old Password</label>
<input name="oldPassword" type="password" placeholder="Old Password" value="<?php echo set_value("oldPassword"); ?>">
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