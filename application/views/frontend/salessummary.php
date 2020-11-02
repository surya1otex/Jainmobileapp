
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
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
</select>
<select name="todate">
<?php
if($todate) { ?>
<option value="<?php echo $todate ?>"><?php echo $todate ?></option>
<?php
}
?>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
<input name="" type="submit" value="Go">
</form>
</div>
<div class="notf_mid sales">
<h2>Total Sellout <span>$ <?php if($totalsummery) { echo $totalsummery; } ?></span></h2>
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
    <td align="left" valign="middle">$<?php echo $record->amount ?></td>
  </tr>
    <?php
                       $i++;  }
                    }
                    ?>
<!--  <tr>
    <td align="left" valign="middle">SQ012345</td>
    <td align="left" valign="middle">01</td>
    <td align="left" valign="middle">10,000</td>
  </tr>
  <tr>
    <td align="left" valign="middle">SQ012345</td>
    <td align="left" valign="middle">01</td>
    <td align="left" valign="middle">10,000</td>
  </tr>
  <tr>
    <td align="left" valign="middle">SQ012345</td>
    <td align="left" valign="middle">01</td>
    <td align="left" valign="middle">10,000</td>
  </tr>
  <tr>
    <td align="left" valign="middle">SQ012345</td>
    <td align="left" valign="middle">01</td>
    <td align="left" valign="middle">10,000</td>
  </tr>
  <tr>
    <td align="left" valign="middle">SQ012345</td>
    <td align="left" valign="middle">01</td>
    <td align="left" valign="middle">10,000</td>
  </tr>
  <tr>
    <td align="left" valign="middle">SQ012345</td>
    <td align="left" valign="middle">01</td>
    <td align="left" valign="middle">10,000</td>
  </tr>-->
</table>

</div>