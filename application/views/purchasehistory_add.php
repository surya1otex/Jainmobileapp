<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Payout summary Management
        <small>Add </small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Payout summary Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>Purchasehistory/add" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">User Email</label>
                                        <select class="form-control required" id="user_id" name="user_id">
                                            <option value="">Select Email</option>
                                            <?php
                                            if(!empty($users))
                                            {
                                                foreach ($users as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->userId ?>" <?php if($rl->userId == set_value('user_id')) {echo "selected=selected";} ?>><?php echo $rl->email ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message">Ammount</label>
                                        <input type="text" class="form-control required " id="ammount" value="<?php echo set_value(''); ?>" name="ammount" maxlength="128">
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message">Title</label>
                                        <input type="text" class="form-control required " id="title" value="<?php echo set_value(''); ?>" name="title" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message">Description</label>
                                        <input type="text" class="form-control required " id="description" value="<?php echo set_value(''); ?>" name="description" maxlength="128">
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
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>