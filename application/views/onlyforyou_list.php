<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Only For You Management
        <small>List</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>onlyforyou/addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Only For You List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>onlyforyou" method="POST" id="searchList">
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
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>IMEI</th>
                        <th>Product name</th>
                        <th>Product feature</th>
                        <th>Product description</th>

                        <th>Earn Point</th>
                        <th>Date Added</th>
                        <th>Date Modified</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php $i=1;
                    
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $record->name ?></td>
                        <td>₹ <?php echo $record->onlyforyou_price ?></td>
                        <td><img src="<?php echo base_url(); ?>uploads/photos/onlyforyou/<?php
                         echo $record->onlyforyou_image ?>" height="55px" /></td>
                        <td><?php echo $record->imei ?></td>
                        <td><?php echo $record->product_name ?></td>
                        <td><?php echo $record->product_feature ?></td>
                        <td><?php echo $record->product_desc ?></td>
                        <td><?php echo $record->redeem ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->date_added)) ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->date_modified)) ?></td>
                        <td class="text-center">
                           
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'onlyforyou/editOld/'.$record->onlyforyou_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteonlyforyou" href="#" data-userid="<?php echo $record->onlyforyou_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
            jQuery("#searchList").attr("action", baseURL + "onlyforyou/" + value);
            jQuery("#searchList").submit();
        });
        
        
        
        
        
            jQuery(document).on("click", ".deleteonlyforyou", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteonlyforyou",
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
