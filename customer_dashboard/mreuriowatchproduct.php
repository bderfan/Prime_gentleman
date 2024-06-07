<?php
  require('header.php');

  require_once('../class_libs/HOMECLASS.php');
   $add_home = new HOMECLASS;

   $mreurio_products_index = $add_home->allMreurioProducts();
?>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    



<div class="container-fluid">
  <div class="row">
  
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0" style="background: rgb(58,160,180); background: linear-gradient(0deg, rgba(58,160,180,1) 0%, rgba(255,255,255,1) 100%);">
      <a class="d-flex justify-content-center text-black bg-transparent" href="../index.php"><img src="../images/logo.png" alt="logo" class="img-fluid" style="width:75px; height:50px;"></a>
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
         <li class="nav-item">
            <a class="nav-link <?php echo (str_contains($_SERVER['PHP_SELF'], 'dashboard/profile')) ? 'active': ''; ?> fw-bold" href="profile.php" style="font-size:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (str_contains($_SERVER['PHP_SELF'], 'dashboard/dashboard')) ? 'active': ''; ?> fw-bold" href="dashboard.php" style="font-size:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                 <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>
                 </svg>
                 Dashboard
            </a>
          </li>
             <li class="nav-item">
            <a class="nav-link <?php echo (str_contains($_SERVER['PHP_SELF'], 'dashboard/dashboard')) ? 'active': ''; ?> fw-bold" href="binbondwatchproduct.php" style="font-size:20px;">
                 <img src="../images/watchicon.png" style="width:20px; height:20px">
                 <img src="../images/Binbond.png" style="width:150px; height:75px;">
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (str_contains($_SERVER['PHP_SELF'], 'dashboard/dashboard')) ? 'active': ''; ?> fw-bold" href="currenwatchproduct.php" style="font-size:20px;">
                 <img src="../images/watchicon.png" style="width:20px; height:20px">
                 <img src="../images/Curren.jpeg" style="width:150px; height:75px;">
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (str_contains($_SERVER['PHP_SELF'], 'dashboard/dashboard')) ? 'active': ''; ?> fw-bold" href="megirwatchproduct.php" style="font-size:20px;">
                 <img src="../images/watchicon.png" style="width:20px; height:20px">
                 <img src="../images/Megir.jpeg" style="width:150px; height:75px;">
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (str_contains($_SERVER['PHP_SELF'], 'dashboard/dashboard')) ? 'active': ''; ?> fw-bold" href="mreuriowatchproduct.php" style="font-size:20px;">
                 <img src="../images/watchicon.png" style="width:20px; height:20px">
                 <img src="../images/Mreurio.png" style="width:150px; height:75px;">
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (str_contains($_SERVER['PHP_SELF'], 'dashboard/dashboard')) ? 'active': ''; ?> fw-bold" href="skmeiwatchproduct.php" style="font-size:20px;">
                 <img src="../images/watchicon.png" style="width:20px; height:20px">
                 <img src="../images/Skmei.png" style="width:150px; height:75px;">
            </a>
          </li>
          
        </ul>
      </div>
    </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background: rgb(255,0,0);
background: radial-gradient(circle, rgba(255,0,0,1) 0%, rgba(0,0,0,1) 100%);">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5 class="text-white fw-bold fs-1">Mreurio Watch Products</h5>
      </div>
      <div>
      <?php
        if(mysqli_num_rows($mreurio_products_index) > 0){
            while($mreurio_product_index = mysqli_fetch_assoc($mreurio_products_index)){
      ?>
      <div class="row my-5">
        <div class="col-12">
          <div class="card" style="width: 100%;">
            <div class="card-body">
              <h3 class="card-title">Product Name: <span class="fw-normal"><?php echo $mreurio_product_index['name']; ?></span></h3>
              <h4 class="mt-5 card-text">Product Brand: <span class="fw-normal"><?php echo $mreurio_product_index['brand']; ?></span></h4>
              <h4 class="mt-2 card-text">Product Model: <span class="fw-normal"><?php echo $mreurio_product_index['model']; ?></span></h4>
              <h5 class="mt-5">Product Details: <span class="fw-normal"><?php echo $mreurio_product_index['details']; ?></span></h5>
              <div class="row mt-5">
                <div class="col-4 text-center">
                  <div class="d-flex justify-content-center">
                    <img src="../images/products_img/<?php echo $mreurio_product_index['image1']; ?>" alt="<?php echo $mreurio_product_index['name']; ?>" style="width:100%; height: 300px;"> 
                  </div>
                </div>
                <div class="col-4 text-center">
                  <div class="d-flex justify-content-center">
                    <img src="../images/products_img/<?php echo $mreurio_product_index['image2']; ?>" alt="<?php echo $mreurio_product_index['name']; ?>" style="width:100%; height: 300px;"> 
                  </div>
                </div>
                <div class="col-4 text-center">
                  <div class="d-flex justify-content-center">
                    <img src="../images/products_img/<?php echo $mreurio_product_index['image3']; ?>" alt="<?php echo $mreurio_product_index['name']; ?>" style="width:100%; height: 300px;"> 
                  </div>
                </div>
              </div>
              <div class="mt-5 d-flex justify-content-center">
                <button class="btn btn-lg btn-danger">
                  <a class="text-light" href="mreurio_cart.php?id=<?php echo $mreurio_product_index['id']; ?>" style="text-decoration:none;">Add to Cart</a>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
            }
         }else{
      ?>
     <div class="row">
        <div class="col-12">
           <h3 class="text-center text-light">Sorry! no product is available right now</h3>
        </div>
      </div>
      <?php
        }
      ?>
          
          
      </div>  
      <div>
           <form class="d-flex justify-content-center mt-3" method="post">
               <button class="btn btn-light" style="padding:10px 30px;" name="Loggedout">Logout</button>
          </form>
      </div>    
        <canvas width="900" height="600"></canvas>
    </main>
  
<?php
   require('footer.php');    
?>