

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Redeem Gift Management
        <small> Edit </small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Redeem Gift Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>redeemgift/edit" method="post" enctype="multipart/form-data" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">User Email</label>
                                        <select class="form-control" id="user_id" name="user_id">
                                            <option value="">Select Email</option>
                                            <?php
                                            if(!empty($users))
                                            {
                                                foreach ($users as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->userId; ?>" <?php if($rl->userId == $userInfo->user_id) {echo "selected=selected";} ?>><?php echo $rl->email ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                         <input type="hidden" value="<?php echo $userInfo->redeemgift_id; ?>" name="redeemgift_id" id="redeemgift_id" />    
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Redeem Gift Price</label>
                                        <input type="text" class="form-control required " id="redeemgift_price" value="<?php echo $userInfo->redeemgift_price ?>" name="redeemgift_price" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Redeem Gift Name</label>
                                        <input type="text" class="form-control required " id="redeem_giftname" value="<?php echo $userInfo->redeemgift_name ?>" name="redeem_giftname" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Redeem Gift Description</label>
                                        <input type="text" class="form-control required " id="redeem_giftdesc" value="<?php echo $userInfo->redeemgift_desc ?>" name="redeem_giftdesc" >
                                    </div>
                                </div>
                            </div>
                         <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file">Redeem Gift image</label>
                                        <input type="file" class="form-control" id="redeemgift_image" placeholder="Mobile redeem Gift" name="redeemgift_image" value="<?php echo $userInfo->redeemgift_image; ?>" >
                                        <img src="<?php echo base_url();?>uploads/photos/redeem/<?php echo $userInfo->redeemgift_image; ?>" width="100"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Redeem Gift feature</label>
                                        <input type="text" class="form-control required " id="redeem_feature" value="<?php echo $userInfo->redeemgift_feature ?>" name="redeem_feature" >
                                    </div>
                                </div>

                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Redeem Gift Value</label>
                                        <input type="text" class="form-control required " id="redeem_value" value="<?php echo $userInfo->redeem_value ?>" name="redeem_value" >
                                    </div>
                                </div>
                        </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>