

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Only For You Management
        <small>Edit </small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Only For You Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>onlyforyou/edit" method="post" enctype="multipart/form-data" id="editUser" role="form">
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
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Price</label>
                                        <input type="text" class="form-control" id="onlyforyou_price" placeholder="Price" name="onlyforyou_price" value="<?php echo $userInfo->onlyforyou_price; ?>">
                                        <input type="hidden" value="<?php echo $userInfo->onlyforyou_id; ?>" name="onlyforyou_id" id="onlyforyou_id" />    
                                    </div>
                                    
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file"> Image</label>
                                        <input type="file" class="form-control" id="onlyforyou_image" placeholder="Image" value="<?php echo $userInfo->onlyforyou_image; ?>" name="onlyforyou_image" >
                                        <img src="<?php echo base_url();?>uploads/photos/onlyforyou/<?php echo $userInfo->onlyforyou_image; ?>" width="100"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file">IMEI No </label>
                                        <input type="text" class="form-control required " id="imei_number" name="imei_number" value="<?php echo $userInfo->imei; ?>">
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Product name</label>
                                        <input type="text" class="form-control required " id="product_name" name="product_name" value="<?php echo $userInfo->product_name ?>">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Product feature</label>
                                        <input type="text" class="form-control required " id="product_feature" name="product_feature" value="<?php echo $userInfo->product_feature ?>">
                                    </div>
                                </div> 

                            </div>
                            <div class="row">

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Product description</label>
                                        <input type="text" class="form-control required " id="product_desc" name="product_desc" value="<?php echo $userInfo->product_desc ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file">Earn Point </label>
                                        <input type="text" class="form-control required " id="redeem_point" name="redeem_point" value="<?php echo $userInfo->redeem; ?>">
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
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>