  <script src="../js/bootstrap.bundle.min.js"></script>

      <script src="../js/feather.min.js" ></script>
      <script src="../js/chart.umd.min.js"></script>
      <script src="../js/dashboard.js"></script>
      <script src="../js/jquery-1.12.4.min.js"></script>

      <script type="text/javascript">

         new bootstrap.Modal("#<?php echo (isset($errors)? ($errors['modal']?? ''): '');?>", {
         keyboard: false
         }).show();

      </script>
      
     <script type="text/javascript">
        $(document).ready(function(){
		       $('#img_upload').change(function(e){
                var reader = new FileReader();
			    reader.onload = function(e){
				    $('#img').attr('src',e.target.result);
			    }
			    reader.readAsDataURL(e.target.files['0']);
		    });
	    });
     </script>
     
  </body>
</html>

<?php
  ob_flush();
?>