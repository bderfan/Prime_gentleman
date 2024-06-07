<?php
  include('header.php'); 
  
  if(isset($_SESSION['authenticate'])){
     header('Location:admin_dashboard/dashboard.php');
  }


   if(isset($_POST['admin_login'])){
    $old = $_POST;
    require('authenticate.php'); 
    $admin_login = admin_login();
    if($admin_login['status'] == 'error'){
        $errors = $admin_login['message'];
    }
    //print_r($old);
  }
?>
<main>
  <section id="Login">
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <form class="p-5 bg-warning" style="background: rgb(136,35,0); background: radial-gradient(circle, rgba(136,35,0,1) 0%, rgba(0,0,0,1) 100%);" method="post">
              <h1 class="text-center text-light mb-5">Admin Login Page</h1>
              <div class="d-flex justify-content-center">
                <img src="images/admin.jpg" alt="admin" style="border-radius:50%; border:3px solid #fff; width:250px; height:250px;">
              </div>
              <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label text-light fw-bold">User Name</label>
               <input type="user_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_name" value="<?php echo $old['user_name']??''; ?>">
             </div>
               <p class="text-warning fw-bold"><?php echo $errors['user_name']??''; ?></p>
             <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label text-light fw-bold">Password</label>
               <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $old['password']??''; ?>">
             </div>
               <p class="text-warning fw-bold"><?php echo $errors['password']??''; ?></p>
              <div class="form-check">
                 <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember_check" <?php echo $_COOKIE['remember_check']?? ''?>>
                 <label class="form-check-label text-white" for="flexCheckDefault">
                   Remember me
                 </label>
             </div>
             <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-light" name="admin_login">Login</button>
             </div>
             <h6 class="mt-5"><a class="text-danger" href="admin_registration.php">New admin? please register ....</a></h6>
           </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
  include('footer.php');
?>