 <?php
       error_reporting(E_ERROR | E_PARSE);
       require('sidebar.php'); 

       require_once('../class_libs/PRODUCTCLASS.php');
       $add_product = new PRODUCTCLASS;

     
       $products_index = $add_product->Curren_index();

        if(isset($_POST['DeletedID'])){
           $dlt_product = $add_product->Delete_Curren_Product();
            if($dlt_product['status'] == 'success'){
               $success = $dlt_product['message'];
           }
       }

       if(isset($_POST['statusID'])){
            $updt_product = $add_product->Curren_Product_status();
             if($updt_product['status'] == 'success'){
                $success = $updt_product['message'];
            }
        }
     
  ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background: rgb(135,85,0); background: linear-gradient(141deg, rgba(135,85,0,1) 0%, rgba(2,1,0,1) 99%);">
       <div>
          <?php
            if(isset($success)){
          ?>
          <div class="alert alert-success" role="alert" name="success">
            <?php print $success['success']; ?>
          </div>
          <?php
             header('Refresh:1,url=curren_watch.php');
             }
          ?>  
      </div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5 class="text-white fw-bold fs-1">Curren Watch</h5>
          <div class="d-flex justify-content-end my-3">
                <!-- Button trigger modal -->
                 <a href="currenwatchproducts%20.php" class="btn" style="background-color: #C28B37;">
                     Create Product
                 </a>
           </div>
      </div>
    
        <div class="row">
          <div class="col-12 mx-auto">
              <div class="table-responsive">
          
                  <table class="table table-light">
                     <thead>
                       <tr>
                         <th>SL</th>
                         <th>Name</th>
                         <th>Model</th>
                         <th>Brand</th>
                         <th>Sku</th>
                         <th>Image1</th>
                         <th>Image2</th>
                         <th>Image3</th>
                         <th>Details</th>
                         <th>Price</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <tbody>
                      <?php
                        if(mysqli_num_rows($products_index) > 0){
                          while($product_index = mysqli_fetch_assoc($products_index)){
                          $x = $product_index['id'];
                      ?>
                      <tr>
                         <td><?php echo $x; ?></td>
                         <td><?php echo $product_index['name']; ?></td>
                         <td><?php echo $product_index['model']; ?></td>
                         <td><?php echo $product_index['brand']; ?></td>
                         <td><?php echo $product_index['sku']; ?></td>
                         <td><img src="../images/products_img/<?php echo $product_index['image1']; ?>" style="width:100px; height:100px; "></td>
                         <td><img src="../images/products_img/<?php echo $product_index['image2']; ?>" style="width:100px; height:100px; "></td>
                         <td><img src="../images/products_img/<?php echo $product_index['image3']; ?>" style="width:100px; height:100px; "></td>
                         <td><?php echo $product_index['details']; ?></td>
                         <td><?php echo $product_index['price']; ?></td>
                          <td>
                              <button class="rounded-4 btn <?php echo ($product_index['status'] == 1 ? 'btn-success' : 'btn-warning'); ?> btn-sm me-2 mb-2" onclick="if(!confirm('Do you want to <?php echo ($product_index['status'] == 1? 'non-active': 'active'); ?> <?php echo preg_replace('/[^a-zA-Z 0-9]+/', ' ', $product_index['name']); ?> product')){
                              return event.preventDefault();                                                  
                              }else{
                                statusproduct(<?php echo $product_index['id']; ?>);                            
                              }">
                              <?php
                                if($product_index['status'] == 1){
                              ?>
                                <p>Make Deactive</p>
                              <?php
                                  }else{
                              ?>
                                <p>Make Active</p>
                              <?php
                                  } 
                               ?>
                              </button>
                              <a href="update_cureen_products.php?sku=<?php echo $product_index['sku']; ?>" name="edit_product" class="rounded-4 btn btn-danger btn-sm me-2">Edit</a>
                             <button class="rounded-4 btn btn-dark btn-sm mt-2" onclick="if(!confirm('Do you want to delete <?php echo preg_replace('/[^a-zA-Z 0-9]+/', ' ', $product_index['name']);?> product?')){
                               return event.preventDefault();                                              
                             }else{
                               deleteProduct(<?php echo $product_index['id']?>);                                              
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
                 <form method="post">
                     <div class="d-flex justify-content-center mt-3">
                       <button class="btn btn-light" style="padding:10px 30px;" name="Loggedout">Logout</button>
                    </div> 
                 </form>
              </div>
              
              <form class="d-none" id="Deletedform" method="post">
               <input type="hidden" id="DeletedID" name="DeletedID">
             </form>
              
             <form class="d-none" id="statusform" method="post">
               <input type="hidden" id="statusID" name="statusID">
             </form>
          </div>
        </div> 
        <canvas width="900" height="380"></canvas>
    </main>
  
<?php
   require('footer.php');    
?>

<script>
  function deleteProduct(x){
      document.querySelector('#DeletedID').value = x;
      document.querySelector('#Deletedform').submit();
  }
    
  function statusproduct(x){
      document.querySelector('#statusID').value = x;
      document.querySelector('#statusform').submit();
  } 
</script>