<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Feedback
        <small>List</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Feedback List</h3>
                    <div class="box-tools">

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Sl</th>
                        <th>User Name</th>
                        <th>Purchase Product</th>
                        <th>Message</th>                        
                        <th>Date Added</th>
                        <th>Date Modified On</th>
                    </tr>
                     <?php $i=1;
                   if(!empty($feedbacks))
                    {
                      foreach($feedbacks as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->purchase_product_name ?></td>
                        <td><?php echo $record->messase ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->date_added)) ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->date_modified)) ?></td>
                    </tr>
                    <?php
                       $i++;  }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class=" box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

