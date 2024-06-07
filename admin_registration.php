<?php
  include('header.php');

  if(isset($_SESSION['authenticate'])){
    header('Location:adminlogin.php');
  }
  
   if(isset($_POST['admin_registration'])){
    $old = $_POST;
    require('authenticate.php'); 
    $new_admin = New_admin();
    if($new_admin['status'] == 'error'){
        $errors = $new_admin['message'];
    }
    if($new_admin['status'] == 'success'){
        $success = $new_admin['message'];
    }
  }
?>

<main>
  <section id="Registration">
    <?php
         if(isset($success)){
      ?>
      <div class="alert alert-danger" role="alert" name="sucess">
        <?php print $success['sucess']; ?>
      </div>
      <?php
         header('Refresh:3,url=adminlogin.php');
         }
      ?>
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <form class="p-5 bg-warning" style="background: rgb(136,35,0); background: radial-gradient(circle, rgba(136,35,0,1) 0%, rgba(0,0,0,1) 100%);" method="post">
              <h1 class="text-center text-light mb-5">Admin Registration Page</h1>
              <div class="d-flex justify-content-center">
                <img src="images/admin2.jpeg" alt="admin2" style="border-radius:50%; border:3px solid #fff; width:250px; height:250px;">
              </div>
             <div class="mb-3">
               <label for="text" class="form-label text-light fw-bold">User Name</label>
               <input type="user_name" class="form-control" id="user_name" aria-describedby="emailHelp" name="user_name" value="<?php echo $old['user_name']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['user_name']??''; ?></p>
             <div class="mb-3">
               <label for="password" class="form-label text-light fw-bold">Password</label>
               <input type="password" class="form-control" id="password" name="password" value="<?php echo $old['password']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['password']??''; ?></p>
             <div class="mb-3">
               <label for="confirm_password" class="form-label text-light fw-bold">Confirm Password</label>
               <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo $old['confirm_password']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['confirm_password']??''; ?></p>
             <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-light" name="admin_registration">Registration</button>
             </div>
             <h6 class="mt-5"><a class="text-danger" href="adminlogin.php">Old admin? please login ....</a></h6>
           </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
  include('footer.php');
?>