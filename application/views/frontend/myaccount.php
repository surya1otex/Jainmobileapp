
<!-- body -->
<form  id="submit">
<div class="profile_midsec">
<div class="login_midsec">
<div class="edit_profile">
<?php
if(empty($userprofile->image)) { ?>
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_pic.png" alt="" class="profi_pic">
<?php
}else { ?>
<img src="<?php echo base_url(); ?>uploads/photos/profile/<?php echo $userprofile->image ?>" alt="" class="profi_pic" id="profile-img-tag">
<?php } ?>
<h3>
	<img src="<?php echo base_url(); ?>assets/frontend/img/edit_icon.png" alt="">
    <input type="file" name="profile_pic" id="profile-img" style="display:none">
	<a href="#" onclick="openFileOption();return;">Edit Profile Image</a>
</h3>
</div>
<button type="submit" class="right_savebutt">Save</button>
<!--<a href="#" class="right_savebutt" id="updateprofile">Save</a>!-->
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
<input name="name" type="text" id="name" value="<?php echo $userprofile->name ?>">
<input type="hidden" name="userid" id="userid" value="<?php echo $userprofile->userId ?>">
</div>

<div class="frm_div">
<label>User Code</label>
<input name="" type="text" value="<?php echo $userprofile->usercode ?>" disabled>
</div>

<div class="frm_div">
<label>Password:</label>
<input name="" type="password" id="password" value="Password" disabled>
</div>

<div class="frm_div">
<label>Contact No:</label>
<input name="phone" type="text" id="phone" value="<?php echo $userprofile->mobile ?>">
</div>

<div class="frm_div">
<label>Email:  </label>
<input name="email" type="email" id="email" value="<?php echo $userprofile->email ?>">
</div>

<div class="frm_div textarea">
<label>Address:</label>
<textarea name="address" cols="" rows="" id="address"><?php echo $userprofile->address ?></textarea>
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
button {
  border: none;
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



    $(document).ready(function(){

        var hitURL =  '<?php echo base_url(); ?>' + "updateaccount";
        $('#submit').submit(function(e){
            e.preventDefault();
            $.ajax({
            url:hitURL,
            type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             cache:false,
             async:false,
            success: function(data){
            //alert(data); 
            }
           });
        });
      });

</script>