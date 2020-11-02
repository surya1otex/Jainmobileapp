
<!-- body -->
<div class="profile_midsec">
    
     <?php $i=1;
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
<div class="mobb_pan dpprice">
<div class="lft_mobpic"><img src="<?php echo base_url();?>uploads/photos/large/<?php echo $record->product_image ?>" alt=""></div>
<div class="rightmob_dtls">
<h3><?php echo $record->product_name ?> (<?php echo $record->feature ?>) – <?php echo $record->description ?></h3>
<p>Date: <strong><?php echo date("d-M-Y", strtotime($record->date_added)) ?></strong></p>
<p>Price: <strong class="price">$<?php echo $record->price ?></strong>
<span>Drop Price: <strong class="price">$<?php echo $record->drop_price ?></strong></span></p>

</div>
<br class="clr"></div>
  <?php
                                              $i++;  }

                    }
                    ?>


</div>