</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.11.0.js"></script> 
<!-- Script for detects HTML5 and CSS3 features in the user’s browser --> 
<script>
$(document).ready(function(){
  $(".pro_pic").click(function(){
    $(".menu").toggle();
  });
});
</script>
</body>
</html>