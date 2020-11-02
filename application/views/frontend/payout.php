
<!-- body -->
<div class="notf_mid sales">
<h2>Total Payout <span>$ <?php echo $totalpayout ?></span></h2>
<ul class="payout_sumlist">
     <?php $i=1;
                   if(!empty($purchaseRecords))
                    {
                      foreach($purchaseRecords as $record)
                        {
                    ?>
<li>
<p><?php echo $record->title ?> <span><?php echo date("d-M-Y", strtotime($record->date_added)) ?></span></p>
<p><?php echo $record->description ?> <span class="amount">$<?php echo $record->amount ?></span></p>
</li>
  <?php
                       $i++;  }
                    }
                    ?>
<!--<li>
<p>vivo/WB/SLS/08/3135-PLN/TRD <span>01 Aug 2020 to 31 Aug 2020</span></p>
<p>Scheme for Deals of GT (PO,
Flexi) & Other CE on X50 Series <span class="amount">₹ 10,00,000.00</span></p>
</li>
<li>
<p>vivo/WB/SLS/08/3135-PLN/TRD <span>01 Aug 2020 to 31 Aug 2020</span></p>
<p>Scheme for Deals of GT (PO,
Flexi) & Other CE on X50 Series <span class="amount">₹ 10,00,000.00</span></p>
</li>
<li>
<p>vivo/WB/SLS/08/3135-PLN/TRD <span>01 Aug 2020 to 31 Aug 2020</span></p>
<p>Scheme for Deals of GT (PO,
Flexi) & Other CE on X50 Series <span class="amount">₹ 10,00,000.00</span></p>
</li>
<li>
<p>vivo/WB/SLS/08/3135-PLN/TRD <span>01 Aug 2020 to 31 Aug 2020</span></p>
<p>Scheme for Deals of GT (PO,
Flexi) & Other CE on X50 Series <span class="amount">₹ 10,00,000.00</span></p>
</li>
<li>
<p>vivo/WB/SLS/08/3135-PLN/TRD <span>01 Aug 2020 to 31 Aug 2020</span></p>
<p>Scheme for Deals of GT (PO,
Flexi) & Other CE on X50 Series <span class="amount">₹ 10,00,000.00</span></p>
</li>-->
</ul>

</div>