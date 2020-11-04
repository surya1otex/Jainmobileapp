
<!-- body -->
<form action="" method="post">
<div class="profile_midsec">
<div class="login_midsec">
<div class="edit_profile">
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_pic.png" alt="" class="profi_pic" id="profile-img-tag">
<h3>
	<img src="<?php echo base_url(); ?>assets/frontend/img/edit_icon.png" alt="">
    <input type="file" name="profile" id="profile-img" style="display:none">
	<a href="#" onclick="openFileOption();return;">Edit Profile Image</a>
</h3>
</div>
<a href="#" class="right_savebutt" onclick="updateaccount()">Save</a>
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


<div class="frm_editsec">

<div class="frm_div">
<label>Name</label>
<input name="" type="text" id="name" value="<?php echo $userprofile->name ?>">
</div>

<div class="frm_div">
<label>User Code</label>
<input name="" type="text" value="<?php echo $userprofile->usercode ?>">
</div>

<div class="frm_div">
<label>Password:</label>
<input name="" type="password" value="Password">
</div>

<div class="frm_div">
<label>Contact No:</label>
<input name="" type="text" value="<?php echo $userprofile->mobile ?>">
</div>

<div class="frm_div">
<label>Email:  </label>
<input name="" type="email" value="<?php echo $userprofile->email ?>">
</div>

<div class="frm_div textarea">
<label>Address:</label>
<textarea name="" cols="" rows=""><?php echo $userprofile->address ?></textarea>
</div>
</div>
</form>

</div>
</div>
<style type="text/css">
	.flashmsg {
		color: #f9f9f9;
	}
.chooser {  opacity: 0; cursor: pointer;}
.profi_pic {
	height: 102px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });

  function openFileOption()
  {
  document.getElementById("profile-img").click();
  }

  function updateaccount() {
      var name = $("#name").val();
      alert(name);
  }
</script>