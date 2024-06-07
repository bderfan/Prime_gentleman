
     <?php
       require('sidebar.php'); 
     ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background-color: #005a8f;">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5 class="fw-bold fs-1" style="color:#fe2424;">Customer profile</h5>
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
            <form class="card text-center" method="post" enctype="multipart/form-data" style="background: rgb(214,136,20); background: linear-gradient(40deg, rgba(214,136,20,1) 43%, rgba(255,255,255,1) 100%);">
              
               <div class="card-body">
                  <!-- ================== image form ===================== -->   
                    <?php
                      if($_SESSION['authenticate']['image']){
                    ?>
                        <img src="../images/profile_image/<?php echo $_SESSION['authenticate']['image']; ?>" style="max-height:200px; border-radius:50%; border:5px solid #ffff76;" id="img">
                    <?php
                      }else{
                    ?>
                      <img src="../images/man.png" style="max-height:200px; border-radius:50%; border:5px solid #ffff76;" id="img">
                   <?php
                      }
                    ?>
                      
                    <div class="row">
                      <div class="col-9 mx-auto">
                      
                      <div class="input-group my-3">
                        <input type="file" class="form-control" id="img_upload" name="img_upload">
                        <label class="input-group-text" for="img_upload">Upload Image</label>
                      </div>  
                      <p class="text-warning" style="font-size:15px;"><?php echo $errors['img_upload']??'' ?></p>
                      
                        <!-- ============================= Input form =============================== -->    
                        <table class="table table-light mt-5">
                    <tbody>
                      <tr>
                        <th scope="row">Name</th>
                        <td><input type="text" class="form-control" id="Name" name="Name" value="<?php echo $_SESSION['authenticate']['name']; ?>"></td>
                      </tr>
                      <tr>
                        <th scope="row">Email</th>
                          <td><input type="email" class="form-control" id="Email" name="Email" value="<?php  echo $_SESSION['authenticate']['email']; ?>" readonly></td>
                        </tr>
                        <tr>
                          <th scope="row">Password</th>
                          <td><input type="password" class="form-control" id="Password" name="Password" value="<?php echo $_SESSION['authenticate']['password']; ?>"></td>
                        </tr>
                         <tr>
                          <th scope="row">Phone No.</th>
                          <td><input type="text" class="form-control" id="Phone_no" name="Phone_no" value="<?php echo $_SESSION['authenticate']['phone_number']; ?>"></td>
                        </tr>
                         <tr>
                          <th scope="row">Date Of Birth</th>
                          <td><input type="date" class="form-control" id="Birthday" name="Birthday" value="<?php echo $_SESSION['authenticate']['date_of_birth']; ?>"></td>
                        </tr>
                        <tr>
                          <th scope="row">City</th>
                          <td><input type="text" class="form-control" id="City" name="City" value="<?php echo $_SESSION['authenticate']['city']; ?>"></td>
                        </tr>
                      </tbody>
                    </table>
                            
                      </div>
                    </div>
                    <form method="post">
                      <button class="btn btn-dark" name="save_btn">Save</button> 
                    </form>
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