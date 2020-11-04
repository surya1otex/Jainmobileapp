
<!-- body -->
<div class="notf_mid sales">
<h2>Total Payout <span>₹  <?php echo $totalpayout ?></span></h2>
<ul class="payout_sumlist">
     <?php $i=1;
                   if(!empty($purchaseRecords))
                    {
                      foreach($purchaseRecords as $record)
                        {
                    ?>
<li>
<p><?php echo $record->title ?> <span><?php echo date("d-M-Y", strtotime($record->date_added)) ?></span></p>
<p><?php echo $record->description ?> <span class="amount">₹ <?php echo $record->amount ?></span></p>
</li>
  <?php
                       $i++;  }
                    }
                    ?>

</ul>

</div><?php echo $this->pagination->create_links(); ?>