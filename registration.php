<?php
  include('header.php');

  if(isset($_SESSION['authenticate'])){
    header('Location:login.php');
  }
  
   if(isset($_POST['registration'])){
    $old = $_POST;
    require('authenticate.php'); 
    $new_user = New_user();
    if($new_user['status'] == 'error'){
        $errors = $new_user['message'];
    }
    if($new_user['status'] == 'success'){
        $success = $new_user['message'];
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
         header('Refresh:3,url=login.php');
         }
      ?>
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <form class="p-5 bg-warning" style="box-shadow: rgba(255, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(255, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(255, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(255, 0, 0, 0.06) 0px 2px 1px, rgba(255, 0, 0, 0.09) 0px 4px 2px, rgba(255, 0, 0, 0.09) 0px 8px 4px, rgba(255, 0, 0, 0.09) 0px 16px 8px, rgba(255, 0, 0, 0.09) 0px 32px 16px;" method="post">
              <h1 class="text-center text-dark mb-5">Registration Page</h1>
              <div class="d-flex justify-content-center">
                <img src="images/watch2.jpeg" alt="watch2" style="border-radius:50%; border:3px solid #fff; width:250px; height:250px;">
              </div>
             <div class="mb-3">
               <label for="name" class="form-label text-dark fw-bold">Name</label>
               <input type="text" class="form-control" id="name" name="name" value="<?php echo $old['name']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['name']??''; ?></p>
             <div class="mb-3">
               <label for="email" class="form-label text-dark fw-bold">Email address</label>
               <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?php echo $old['email']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['email']??''; ?></p>
             <div class="mb-3">
               <label for="password" class="form-label text-dark fw-bold">Password</label>
               <input type="password" class="form-control" id="password" name="password" value="<?php echo $old['password']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['password']??''; ?></p>
             <div class="mb-3">
               <label for="confirm_password" class="form-label text-dark fw-bold">Confirm Password</label>
               <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo $old['confirm_password']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['confirm_password']??''; ?></p>
             <div class="mb-3">
               <label for="number" class="form-label text-dark fw-bold">Phone Number</label>
               <input type="number" class="form-control" name="number" id="number" value="<?php echo $old['number']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['number']??''; ?></p>
             <div class="mb-3">
               <label for="date" class="form-label text-dark fw-bold">Date Of Birth</label>
               <input type="date" id="birthday" name="birthday" id="date" class="form-control d-block" value="<?php echo $old['birthday']??''; ?>">
             </div>
               <p class="text-danger"><?php echo $errors['birthday']??''; ?></p>
              <div class="mb-3">
              <label for="city" class="form-label text-dark fw-bold">City</label>
              <textarea class="form-control" id="city" rows="3" name="city" value="<?php echo $old['city']??''; ?>"></textarea>
             </div>
               <p class="text-danger"><?php echo $errors['city']??''; ?></p>
             <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-light" name="registration">Registration</button>
             </div>
             <h6 class="mt-5"><a class="text-danger" href="login.php">Old user? please login ....</a></h6>
           </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
  include('footer.php');
?>