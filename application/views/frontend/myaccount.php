
<!-- body -->
<div class="profile_midsec">
<div class="login_midsec">
<div class="edit_profile">
<img src="<?php echo base_url(); ?>assets/frontend/img/profile_pic.png" alt="" class="profi_pic">
<h3><img src="<?php echo base_url(); ?>assets/frontend/img/edit_icon.png" alt=""><a href="#">Edit Profile Image</a></h3>
</div>
<a href="#" class="right_savebutt">Save</a>
<form action="" method="post">
<div class="frm_editsec">
<div class="frm_div">
<label>Name</label>
<input name="" type="text" value="<?php echo $userprofile->name ?>">
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
<div class="acctab">
<ul>
<li><img src="<?php echo base_url(); ?>assets/frontend/img/only_icon2.png" alt="">
<h4><span>1000</span>
Earned Point</h4></li>
<li>
<img src="<?php echo base_url(); ?>assets/frontend/img/only_icon1.png" alt="">
<h4><span>100</span>
Purchase History</h4></li>
</ul>
</div>
<div class="frm_div">
<label>Parched Product</label>
<select name="">
<option>Select your parched product..</option>
</select>
</div>
<div class="frm_div">
<label>Feedback</label>
<input name="" type="email" placeholder="Type your message here..">
</div>
<input name="" type="submit" value="Send Your Feedback">
</form>
</div>
</div>