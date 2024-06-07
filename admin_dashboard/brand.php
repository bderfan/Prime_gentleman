 <?php
       error_reporting(E_ERROR | E_PARSE);
       require('sidebar.php'); 

       require_once('../class_libs/BRANDCLASS.php');
       $add_brand = new BRANDCLASS;

     
       $brands_index = $add_brand->brand_index();
     
  ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background: rgb(135,85,0); background: linear-gradient(141deg, rgba(135,85,0,1) 0%, rgba(2,1,0,1) 99%);">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5 class="text-white fw-bold fs-1">Brand</h5>
          <div class="d-flex justify-content-end my-3">
                <!-- Button trigger modal -->
                 <a href="newbrand.php" class="btn" style="background-color: #C28B37;">
                     Create Brand
                 </a>
           </div>
      </div>
    
        <div class="row">
          <div class="col-12 mx-auto">
              <form class="table-responsive" method="post">
          
                  <table class="table table-light">
                     <thead>
                       <tr>
                         <th>SL</th>
                         <th>Name</th>
                         <th>Image</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <tbody>
                      
                    <?php
                        if(mysqli_num_rows($brands_index) > 0){
                          while($brand_index = mysqli_fetch_assoc($brands_index)){
                          $x = $brand_index['id'];
                      ?>
                       <tr>
                         <td><?php echo $x; ?></td>
                         <td><?php echo $brand_index['name']; ?></td>
                         <td><img src="../images/brands_img/<?php echo $brand_index['image']; ?>" style="width:100px; height:100px; "></td>
                          <td>
                              <a href="updatebrand.php?id=<?php echo $brand_index['id']; ?>" name="edit_brand" class="btn btn-danger btn-sm me-2">Edit</a>
                             <button class="btn btn-dark btn-sm mt-2" onclick="if(!confirm('Do you want to delete <?php echo $brand_index['name'];?> brand?')){
                               return event.preventDefault();                                              
                             }else{
                               deleteProduct(<?php echo $brand_index['id']?>);                                              
                             }">
                             Delete
                          </button>
                         </td>
                       </tr>
                      <?php
                             $x++;
                          }
                        }
                      ?>
                     </tbody>
                   </table>
                 <div class="d-flex justify-content-center mt-3">
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