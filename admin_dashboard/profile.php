
     <?php
       require('sidebar.php'); 

       require_once('../class_libs/HOMECLASS.php');

       $home = new HOMECLASS;

       $profiles = $home->profiles();
     
     ?>

    <?php

    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background-color: #005a8f;">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5 class="fw-bold fs-1" style="color:#fe2424;">Customers' Profiles</h5>
      </div>
      <div>
          
      <?php
         if(isset($success)){
      ?>
      <div class="alert alert-primary" role="alert" name="success">
        <?php print $success['success']; ?>
      </div>
      <?php
         header('Refresh:3,url=profile.php');
         }
      ?>
         
          <div class="row mx-1 mt-3">
            <form class="card text-center" style="background: rgb(214,136,20); background: linear-gradient(40deg, rgba(214,136,20,1) 43%, rgba(255,255,255,1) 100%);">
              
               <div class="card-body">
                  <!-- ================== image form ===================== -->   
                      
                    <div class="row">
                        <table class="table table-primary">
                          <thead>
                            <tr>
                              <th>SL</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Image</th>
                              <th>Date of Birth</th>
                              <th>City</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              if(mysqli_num_rows($profiles)>0){
                                  while($profile = mysqli_fetch_assoc($profiles)){
                                    $x = 1;
                            ?>
                            <tr>
                              <td><?php echo $x; ?></td>
                              <td><?php echo $profile['name']?></td>
                              <td><?php echo $profile['email']?></td>
                              <td><?php echo $profile['phone_number']?></td>
                              <td>
                                 <img src="../images/profile_image/<?php echo $profile['image']; ?>" style="width:100px; height:100px;" alt="<?php echo $profile['name']; ?>">
                              </td>
                              <td><?php echo $profile['date_of_birth']; ?></td>
                              <td><?php echo $profile['city']; ?></td>
                            </tr>
                            <?php
                                      $x++;
                                  }
                              }
                            ?>
                          </tbody>
                        </table>
                    </div>
                   
                 </div>
              </form>
          </div>
          <form class="d-flex justify-content-center mt-3" method="post">
               <button class="btn btn-light" style="padding:10px 30px;" name="Loggedout">Logout</button>
          </form>
         
        </div>    
        <canvas width="900" height="380"></canvas>
    </main>



<?php
  include('footer.php');
?>