<?php
  include('header.php'); 
  
  if(isset($_SESSION['authenticate'])){
     header('Location:customer_dashboard/profile.php');
  }


   if(isset($_POST['login'])){
    $old = $_POST;
    require('authenticate.php'); 
    $login = login();
    if($login['status'] == 'error'){
        $errors = $login['message'];
    }
    //print_r($old);
  }
?>

<main>
  <section id="Login">
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <form class="p-5 bg-warning" style="box-shadow: rgba(255, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(255, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(255, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(255, 0, 0, 0.06) 0px 2px 1px, rgba(255, 0, 0, 0.09) 0px 4px 2px, rgba(255, 0, 0, 0.09) 0px 8px 4px, rgba(255, 0, 0, 0.09) 0px 16px 8px, rgba(255, 0, 0, 0.09) 0px 32px 16px;" method="post">
              <h1 class="text-center text-dark mb-5">Login Page</h1>
              <div class="d-flex justify-content-center">
                <img src="images/watch.jpeg" alt="watch" style="border-radius:50%; border:3px solid #fff; width:250px; height:250px;">
              </div>
              <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label text-dark fw-bold">Email address</label>
               <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $old['email']??''; ?>">
             </div>
               <p class="text-white fw-bold"><?php echo $errors['email']??''; ?></p>
             <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label text-dark fw-bold">Password</label>
               <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $old['password']??''; ?>">
             </div>
               <p class="text-white fw-bold"><?php echo $errors['password']??''; ?></p>
              <div class="form-check">
                 <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember_check" <?php echo $_COOKIE['remember_check']?? ''?>>
                 <label class="form-check-label text-white" for="flexCheckDefault">
                   Remember me
                 </label>
             </div>
             <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-light" name="login">Login</button>
             </div>
             <h6 class="mt-5"><a class="text-danger" href="registration.php">New user? please register ....</a></h6>
           </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
  include('footer.php');
?>