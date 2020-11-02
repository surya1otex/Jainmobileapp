
<!-- body -->
<div class="notf_mid">
<ul>
     <?php 
    
     $i=1;
                   if(!empty($userRecords))
                    {
                      foreach($userRecords as $record)
                        {
                    ?>
<li><p><?php echo $record->message ?>
<span><?php echo date("d-M-Y", strtotime($record->date_added)) ?></span>
 
</p></li>
<?php
                       $i++;  }
                    }
                    ?>

</ul>
</div>