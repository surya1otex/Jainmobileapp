
<!-- body -->
<div class="profile_midsec sploffers">
     <?php $i=1;
                   if(!empty($userRecords))
                    {
                      foreach($userRecords as $record)
                        {
                    ?>
  <img src="<?php echo base_url(); ?>uploads/photos/special/<?php
                         echo $record->offer_image ?>" alt="">
 
   <?php
                          $i++;  }
                    }
                    ?>
  <?php echo $this->pagination->create_links(); ?>
  </div>