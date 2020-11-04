
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
 <?php echo $this->pagination->create_links(); ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userNotifications/" + value);
            jQuery("#searchList").submit();
        });
        
     
    });
</script>