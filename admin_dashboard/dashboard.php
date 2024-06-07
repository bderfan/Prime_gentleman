 <?php
       require('sidebar.php'); 
     ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background: rgb(170,0,0); background: radial-gradient(circle, rgba(170,0,0,1) 0%, rgba(14,103,0,1) 100%);">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5 class="text-white fw-bold fs-1">Dashboard</h5>
      </div>
      <div>
           <form class="d-flex justify-content-center mt-3" method="post">
               <button class="btn btn-light" style="padding:10px 30px;" name="Loggedout">Logout</button>
          </form>
      </div>    
        <canvas width="900" height="380"></canvas>
    </main>
  
<?php
   require('footer.php');    
?>