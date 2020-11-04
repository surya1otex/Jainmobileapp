
<!-- body -->
<div class="sales_topsearch">
<form action="<?php echo base_url() ?>searchsales" method="post">
<select name="fromdate">
<?php
if($fromdate) { ?>
<option value="<?php echo $fromdate ?>"><?php echo $fromdate ?></option>
<?php
}
?>
<?php for($y=2020 ;$y<2121; $y++){ ?>
<option value="<?php echo $y;?>"><?php echo $y;?></option>
<?php }?>
</select>
<select name="todate">
<?php
if($todate) { ?>
<option value="<?php echo $todate ?>"><?php echo $todate ?></option>
<?php
}
?>
<?php for($y=2020 ;$y<2121; $y++){ ?>
<option value="<?php echo $y;?>"><?php echo $y;?></option>
<?php }?>

</select>
<input name="" type="submit" value="Go">
</form>
</div>
<div class="notf_mid sales">
<h2>Total Sellout <span>₹  <?php if($totalsummery) { echo $totalsummery; } ?></span></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="salestab">
  <tr>
    <th align="left" valign="middle">Model</th>
    <th align="left" valign="middle">Unit</th>
    <th align="left" valign="middle">Amount</th>
  </tr>
  <?php $i=1;
                   if(!empty($userRecords))
                    {
                      foreach($userRecords as $record)
                        {
                    ?>
  <tr>
    <td align="left" valign="middle"><?php echo $record->model ?></td>
    <td align="left" valign="middle"><?php echo $record->unit ?></td>
    <td align="left" valign="middle">₹ <?php echo $record->amount ?></td>
  </tr>
    <?php
                       $i++;  }
                    }
                    ?>

</table>

</div><?php echo $this->pagination->create_links(); ?>