<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Redeem Gift Management
        <small>List </small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>redeemgift/addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Redeem Gift List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>redeemgift" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Price"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr><th>Sl</th>
                        <th> User Name</th>
                        <th>Gift Name</th>
                        <th>Gift feature</th>
                        <th>Gift Description
                        <th>Gift Price</th>
                        <th>Gift Image </th>
                        <th>Redeem Value</th>
                        <th>DAte Added</th>
                        <th>Date Modified</th>
                        <th class="text-center">Actions</th>
                    </tr>
                   <?php $i=1;
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr> <td><?php echo $i ?></td>
                         <td><?php echo $record->name ?></td>
                         <td><?php echo $record->redeemgift_name ?></td>
                         <td><?php echo $record->redeemgift_feature ?></td>
                         <td><?php echo $record->redeemgift_desc ?></td>
                         <td>$<?php echo $record->redeemgift_price ?></td>
                         <td><img src="<?php echo base_url(); ?>uploads/photos/redeem/<?php
                         echo $record->redeemgift_image ?>" height="55px" /></td>
                         <td><?php echo $record->redeem_value ?></td>
                         <td><?php echo date("d-m-Y", strtotime($record->date_added)) ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->date_modified)) ?></td>
                        <td class="text-center">
                            
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'redeemgift/editOld/'.$record->redeemgift_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteredeemgift" href="#" data-userid="<?php echo $record->redeemgift_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                                               $i++;  }

                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "redeemgift/" + value);
            jQuery("#searchList").submit();
        });
        
         jQuery(document).on("click", ".deleteredeemgift", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteredeemgift",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this  ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert(" successfully deleted"); }
				else if(data.status = false) { alert(" deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
        
        
    });
</script>
