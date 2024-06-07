 <?php
       error_reporting(E_ERROR | E_PARSE);
       require('sidebar.php'); 

       require_once('../class_libs/BRANDCLASS.php');
       $add_brand = new BRANDCLASS;

     
      if(isset($_POST['add_products'])){
          $brands_add = $add_brand->brand_add();
          
           if($brands_add['status'] == 'error'){
             $errors = $brands_add['message'];
         }
          if($brands_add['status'] == 'success'){
             $success = $brands_add['message'];
         }  
      
      }
       
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background: rgb(135,85,0); background: linear-gradient(141deg, rgba(135,85,0,1) 0%, rgba(2,1,0,1) 99%);">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <div class="d-flex justify-content-end my-3">
                <!-- Button trigger modal -->
                 <a href="brand.php" class="btn" style="background-color: #C28B37;">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                     </svg>
                 </a>
           </div>
      </div>
        
       <div>
          <?php
            if(isset($success)){
          ?>
          <div class="alert alert-success" role="alert" name="success">
            <?php print $success['success']; ?>
          </div>
          <?php
             header('Refresh:1,url=brand.php');
             }
          ?>  
      </div>
      <div class="container">
       <div class="row">
          <form class="col-9 mx-auto" method="post" enctype="multipart/form-data">
              <div class="form-floating my-3">
                      <input class="form-control" id="name" name="name" value="<?php echo $old['name']?? ''; ?>">
                      <label for="name">Brand Name</label>
                </div>
                <p class="text-white" style="font-size:15px;"> <?php echo $errors['name']??'' ?></p>
                  
                  <div class="form-floating my-3">
                      <input type="file" class="form-control" id="image" name="image">
                      <label for="image">Brand Image</label>
                 </div>
                 <p class="text-white" style="font-size:15px;"> <?php echo $errors['image']??'' ?></p>
                  
               
                 <div class="d-flex justify-content-center mt-3">
                     <button type="submit" class="btn btn-dark me-2" style="padding:10px 30px;" name="add_products">Submit</button> 
                    <button class="btn btn-light" style="padding:10px 30px;" name="Loggedout">Logout</button>
                 </div> 
          </form>
       </div>
      </div>    
        <canvas width="900" height="380"></canvas>
    </main>
  
<?php
   require('footer.php');    
?>