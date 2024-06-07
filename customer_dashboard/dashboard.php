 <?php
       require('sidebar.php'); 

       
      require_once('../class_libs/HOMECLASS.php');

      $home = new HOMECLASS;
      
        if(isset($_POST['remove_btn'])){
          $home->Removeproduct($_POST);
          //print_r($_POST);
        } 

   if(isset($_POST['goto_customer_details']) && (isset($_SESSION['BinbondcartList']) && $_SESSION['BinbondcartList']['customer_details']['status'] == 0)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
     $home->confirm_binbondcheckout($_POST);
      //print_r($_SESSION['cartList']);  
  } 

  if(isset($_POST['customer_details']) && (isset($_SESSION['BinbondcartList']) && $_SESSION['BinbondcartList']['customer_details']['status'] == 1)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
      $old = $_POST;
      $customer_details = $home->binbondcustomer_details($_POST);
      if($customer_details['status'] == 'error'){
        $errors = $customer_details['message'];
     }
      //print_r($_SESSION['cartList']);  
  } 


   if(isset($_POST['goto_customer_details']) && (isset($_SESSION['CurrencartList']) && $_SESSION['CurrencartList']['customer_details']['status'] == 0)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
     $home->confirm_currencheckout($_POST);
      //print_r($_SESSION['cartList']);  
  } 

  if(isset($_POST['customer_details']) && (isset($_SESSION['CurrencartList']) && $_SESSION['CurrencartList']['customer_details']['status'] == 1)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
      $old = $_POST;
      $customer_details = $home->currencustomer_details($_POST);
      if($customer_details['status'] == 'error'){
        $errors = $customer_details['message'];
     }
      //print_r($_SESSION['cartList']);  
  } 

    if(isset($_POST['goto_customer_details']) && (isset($_SESSION['MegircartList']) && $_SESSION['MegircartList']['customer_details']['status'] == 0)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
     $home->confirm_megircheckout($_POST);
      //print_r($_SESSION['cartList']);  
  } 

  if(isset($_POST['customer_details']) && (isset($_SESSION['MegircartList']) && $_SESSION['MegircartList']['customer_details']['status'] == 1)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
      $old = $_POST;
      $customer_details = $home->megircustomer_details($_POST);
      if($customer_details['status'] == 'error'){
        $errors = $customer_details['message'];
     }
      //print_r($_SESSION['cartList']);  
  } 


  if(isset($_POST['goto_customer_details']) && (isset($_SESSION['MreuriocartList']) && $_SESSION['MreuriocartList']['customer_details']['status'] == 0)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
     $home->confirm_mreuriocheckout($_POST);
      //print_r($_SESSION['cartList']);  
  } 

  if(isset($_POST['customer_details']) && (isset($_SESSION['MreuriocartList']) && $_SESSION['MreuriocartList']['customer_details']['status'] == 1)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
      $old = $_POST;
      $customer_details = $home->mreuriocustomer_details($_POST);
      if($customer_details['status'] == 'error'){
        $errors = $customer_details['message'];
     }
      //print_r($_SESSION['cartList']);  
  } 
  

  if(isset($_POST['goto_customer_details']) && (isset($_SESSION['SkmeicartList']) && $_SESSION['SkmeicartList']['customer_details']['status'] == 0)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
     $home->confirm_skmeicheckout($_POST);
      //print_r($_SESSION['cartList']);  
  } 

  if(isset($_POST['customer_details']) && (isset($_SESSION['SkmeicartList']) && $_SESSION['SkmeicartList']['customer_details']['status'] == 1)){
      //$home->Removeproduct($_POST);
      //print_r($_POST); 
      $old = $_POST;
      $customer_details = $home->skmeicustomer_details($_POST);
      if($customer_details['status'] == 'error'){
        $errors = $customer_details['message'];
     }
      //print_r($_SESSION['cartList']);  
  } 


  ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background: rgb(170,0,0); background: radial-gradient(circle, rgba(170,0,0,1) 0%, rgba(14,103,0,1) 100%);">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5 class="text-white fw-bold fs-1">Dashboard</h5>
      </div>
        
        
        <!================================ Binbond Watch lists ======================================>
       <div class="mx-auto">
             <?php
                if(isset($_SESSION['BinbondcartList'])){
             ?>
               <table class="table table-warning">
                 <tr>
                   <th>Product Details</th>
                   <th>Quantity</th>
                   <th>Price</th>
                   <th>Subtotal</th>
                 </tr> 
              <?php
                 if(count($_SESSION['BinbondcartList']['items']) > 0){
                     $total=0;
                     foreach($_SESSION['BinbondcartList']['items'] as $item){
              ?>
                  <tr>
                   <td>
                     <div class="d-flex gap-2">
                       <img src="../images/products_img/<?php echo $item['Image1']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image2']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image3']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <div class="text-start">
                         <h6><?php echo $item['Name']; ?><br><?php echo $item['SKU']; ?></h6> 
                         <form method="post">
                            <input type="hidden" name="remove_id" value="<?php echo $item['SKU'];?>">
                            <button type="submit" name="remove_btn" class="bg-transparent border-0 text-danger text-center">Delete</button>  
                         </form>
                       </div>
                     </div>     
                   </td> 
                    
                   <td><?php echo $item['Quantity']; ?></td> 
                   <td><?php echo $item['Price']; ?></td> 
                   <td><?php echo $subtotal=($item['Quantity']*$item['Price']); ?></td> 
                 </tr> 
              <?php
                    $total += $subtotal;
                     }
                 }else{
                     
              ?>
                 <tr>
                   <td colspan="4">No product available</td>  
                 </tr>   
              <?php
                 }   
              ?>
                 <tr>
                   <td></td>
                   <td></td>
                   <td class="fw-bold">Total:</td>  
                   <td><?php echo $total??0; ?></td>
                 </tr>
             
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr> 
               </table>
              <?php
               if(isset($total) && $total>0){
             ?>
              <form method="post">
             <?php  
                  if($_SESSION['BinbondcartList']['customer_details']['status'] > 0){
             ?>
              <div class="border border-light border-4 my-5 px-4">
                 <h3 class="text-center text-light my-2 fw-bold">Customer Information</h3>
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Name" name="name" value="<?php echo $old['name']??$_SESSION['authenticate']['name']?? ''; ?>">
                   <label for="Name">Name</label>
                 </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Phone_no" name="phone_no" value="<?php echo $old['phone_no']??$_SESSION['authenticate']['phone_number']?? ''; ?>">
                   <label for="Phone_no">Phone No.</label>
                  </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="City" name="city" value="<?php echo $old['city']??$_SESSION['authenticate']['city']?? ''; ?>">
                   <label for="Address">City</label>
                 </div>
             </div>
             <?php
              }
                 $CART = $_SESSION['BinbondcartList'];
                 $CART_status = $CART['customer_details']['status'] == 1 ? 'customer_details' : 'goto_customer_details';
             ?>
                 <div class="d-flex justify-content-center">
                    <button class="btn btn-dark my-5" type="submit" name="<?php echo $CART_status; ?>">Check out now</button>
                 </div>
            </form>
            <?php
                  }
                }
            ?>
        </div>
          
    
    
          
          
      <!================================ Curren Watch lists ======================================>
       <div class="mx-auto">
             <?php
                if(isset($_SESSION['CurrencartList'])){
             ?>
               <table class="table table-warning">
                 <tr>
                   <th>Product Details</th>
                   <th>Quantity</th>
                   <th>Price</th>
                   <th>Subtotal</th>
                 </tr> 
              <?php
                 if(count($_SESSION['CurrencartList']['items']) > 0){
                     $total=0;
                     foreach($_SESSION['CurrencartList']['items'] as $item){
              ?>
                  <tr>
                   <td>
                     <div class="d-flex gap-2">
                       <img src="../images/products_img/<?php echo $item['Image1']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image2']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image3']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <div class="text-start">
                         <h6><?php echo $item['Name']; ?><br><?php echo $item['SKU']; ?></h6> 
                         <form method="post">
                            <input type="hidden" name="remove_id" value="<?php echo $item['SKU'];?>">
                            <button type="submit" name="remove_btn" class="bg-transparent border-0 text-danger text-center">Delete</button>  
                         </form>
                       </div>
                     </div>     
                   </td> 
                    
                   <td><?php echo $item['Quantity']; ?></td> 
                   <td><?php echo $item['Price']; ?></td> 
                   <td><?php echo $subtotal=($item['Quantity']*$item['Price']); ?></td> 
                 </tr> 
              <?php
                    $total += $subtotal;
                     }
                 }else{
                     
              ?>
                 <tr>
                   <td colspan="4">No product available</td>  
                 </tr>   
              <?php
                 }   
              ?>
                 <tr>
                   <td></td>
                   <td></td>
                   <td class="fw-bold">Total:</td>  
                   <td><?php echo $total??0; ?></td>
                 </tr>
             
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr> 
               </table>
             
              <?php
               if(isset($total) && $total>0){
             ?>
              <form method="post">
             <?php  
                  if($_SESSION['CurrencartList']['customer_details']['status'] > 0){
             ?>
              <div class="border border-light border-4 my-5 px-4">
                 <h3 class="text-center text-light my-2 fw-bold">Customer Information</h3>
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Name" name="name" value="<?php echo $old['name']??$_SESSION['authenticate']['name']?? ''; ?>">
                   <label for="Name">Name</label>
                 </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Phone_no" name="phone_no" value="<?php echo $old['phone_no']??$_SESSION['authenticate']['phone_number']?? ''; ?>">
                   <label for="Phone_no">Phone No.</label>
                  </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="City" name="city" value="<?php echo $old['city']??$_SESSION['authenticate']['city']?? ''; ?>">
                   <label for="Address">City</label>
                 </div>
             </div>
             <?php
              }
                 $CART = $_SESSION['CurrencartList'];
                 $CART_status = $CART['customer_details']['status'] == 1 ? 'customer_details' : 'goto_customer_details';
             ?>
                 <div class="d-flex justify-content-center">
                    <button class="btn btn-dark my-5" type="submit" name="<?php echo $CART_status; ?>">Check out now</button>
                 </div>
            </form>
            <?php
                }
               }
            ?>
      </div>
        
        
        
        
        
     <!================================ Megir Watch lists ======================================>
       <div class="mx-auto">
             <?php
                if(isset($_SESSION['MegircartList'])){
             ?>
               <table class="table table-warning">
                 <tr>
                   <th>Product Details</th>
                   <th>Quantity</th>
                   <th>Price</th>
                   <th>Subtotal</th>
                 </tr> 
              <?php
                 if(count($_SESSION['MegircartList']['items']) > 0){
                     $total=0;
                     foreach($_SESSION['MegircartList']['items'] as $item){
              ?>
                  <tr>
                   <td>
                     <div class="d-flex gap-2">
                       <img src="../images/products_img/<?php echo $item['Image1']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image2']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image3']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <div class="text-start">
                         <h6><?php echo $item['Name']; ?><br><?php echo $item['SKU']; ?></h6> 
                         <form method="post">
                            <input type="hidden" name="remove_id" value="<?php echo $item['SKU'];?>">
                            <button type="submit" name="remove_btn" class="bg-transparent border-0 text-danger text-center">Delete</button>  
                         </form>
                       </div>
                     </div>     
                   </td> 
                    
                   <td><?php echo $item['Quantity']; ?></td> 
                   <td><?php echo $item['Price']; ?></td> 
                   <td><?php echo $subtotal=($item['Quantity']*$item['Price']); ?></td> 
                 </tr> 
              <?php
                    $total += $subtotal;
                     }
                 }else{
                     
              ?>
                 <tr>
                   <td colspan="4">No product available</td>  
                 </tr>   
              <?php
                 }   
              ?>
                 <tr>
                   <td></td>
                   <td></td>
                   <td class="fw-bold">Total:</td>  
                   <td><?php echo $total??0; ?></td>
                 </tr>
             
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr> 
               </table>
    
              <?php
               if(isset($total) && $total>0){
             ?>
              <form method="post">
             <?php  
                  if($_SESSION['MegircartList']['customer_details']['status'] > 0){
             ?>
              <div class="border border-light border-4 my-5 px-4">
                 <h3 class="text-center text-light my-2 fw-bold">Customer Information</h3>
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Name" name="name" value="<?php echo $old['name']??$_SESSION['authenticate']['name']?? ''; ?>">
                   <label for="Name">Name</label>
                 </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Phone_no" name="phone_no" value="<?php echo $old['phone_no']??$_SESSION['authenticate']['phone_number']?? ''; ?>">
                   <label for="Phone_no">Phone No.</label>
                  </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="City" name="city" value="<?php echo $old['city']??$_SESSION['authenticate']['city']?? ''; ?>">
                   <label for="Address">City</label>
                 </div>
             </div>
             <?php
              }
                 $CART = $_SESSION['MegircartList'];
                 $CART_status = $CART['customer_details']['status'] == 1 ? 'customer_details' : 'goto_customer_details';
             ?>
                 <div class="d-flex justify-content-center">
                    <button class="btn btn-dark my-5" type="submit" name="<?php echo $CART_status; ?>">Check out now</button>
                 </div>
            </form>
            <?php
                 }
               }
            ?>
      </div>
        
        
        
        
    <!================================ Mreurio Watch lists ======================================>
       <div class="mx-auto">
             <?php
                if(isset($_SESSION['MreuriocartList'])){
             ?>
               <table class="table table-warning">
                 <tr>
                   <th>Product Details</th>
                   <th>Quantity</th>
                   <th>Price</th>
                   <th>Subtotal</th>
                 </tr> 
              <?php
                 if(count($_SESSION['MreuriocartList']['items']) > 0){
                     $total=0;
                     foreach($_SESSION['MreuriocartList']['items'] as $item){
              ?>
                  <tr>
                   <td>
                     <div class="d-flex gap-2">
                       <img src="../images/products_img/<?php echo $item['Image1']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image2']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image3']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <div class="text-start">
                         <h6><?php echo $item['Name']; ?><br><?php echo $item['SKU']; ?></h6> 
                         <form method="post">
                            <input type="hidden" name="remove_id" value="<?php echo $item['SKU'];?>">
                            <button type="submit" name="remove_btn" class="bg-transparent border-0 text-danger text-center">Delete</button>  
                         </form>
                       </div>
                     </div>     
                   </td> 
                    
                   <td><?php echo $item['Quantity']; ?></td> 
                   <td><?php echo $item['Price']; ?></td> 
                   <td><?php echo $subtotal=($item['Quantity']*$item['Price']); ?></td> 
                 </tr> 
              <?php
                    $total += $subtotal;
                     }
                 }else{
                     
              ?>
                 <tr>
                   <td colspan="4">No product available</td>  
                 </tr>   
              <?php
                 }   
              ?>
                 <tr>
                   <td></td>
                   <td></td>
                   <td class="fw-bold">Total:</td>  
                   <td><?php echo $total??0; ?></td>
                 </tr>
             
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr> 
               </table>
            
              <?php
               if(isset($total) && $total>0){
             ?>
              <form method="post">
             <?php  
                  if($_SESSION['MreuriocartList']['customer_details']['status'] > 0){
             ?>
              <div class="border border-light border-4 my-5 px-4">
                 <h3 class="text-center text-light my-2 fw-bold">Customer Information</h3>
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Name" name="name" value="<?php echo $old['name']??$_SESSION['authenticate']['name']?? ''; ?>">
                   <label for="Name">Name</label>
                 </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Phone_no" name="phone_no" value="<?php echo $old['phone_no']??$_SESSION['authenticate']['phone_number']?? ''; ?>">
                   <label for="Phone_no">Phone No.</label>
                  </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="City" name="city" value="<?php echo $old['city']??$_SESSION['authenticate']['city']?? ''; ?>">
                   <label for="Address">City</label>
                 </div>
             </div>
             <?php
              }
                 $CART = $_SESSION['MreuriocartList'];
                 $CART_status = $CART['customer_details']['status'] == 1 ? 'customer_details' : 'goto_customer_details';
             ?>
                 <div class="d-flex justify-content-center">
                    <button class="btn btn-dark my-5" type="submit" name="<?php echo $CART_status; ?>">Check out now</button>
                 </div>
            </form>
            <?php
                 }
               }
            ?>
      </div>
        
        
        
        
     <!================================ Skmei Watch lists ======================================>
       <div class="mx-auto">
             <?php
                if(isset($_SESSION['SkmeicartList'])){
             ?>
               <table class="table table-warning">
                 <tr>
                   <th>Product Details</th>
                   <th>Quantity</th>
                   <th>Price</th>
                   <th>Subtotal</th>
                 </tr> 
              <?php
                 if(count($_SESSION['SkmeicartList']['items']) > 0){
                     $total=0;
                     foreach($_SESSION['SkmeicartList']['items'] as $item){
              ?>
                  <tr>
                   <td>
                     <div class="d-flex gap-2">
                       <img src="../images/products_img/<?php echo $item['Image1']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image2']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <img src="../images/products_img/<?php echo $item['Image3']; ?>" alt="<?php echo $item['Name']; ?>" style="height:100px; width:100px;">  
                       <div class="text-start">
                         <h6><?php echo $item['Name']; ?><br><?php echo $item['SKU']; ?></h6> 
                         <form method="post">
                            <input type="hidden" name="remove_id" value="<?php echo $item['SKU'];?>">
                            <button type="submit" name="remove_btn" class="bg-transparent border-0 text-danger text-center">Delete</button>  
                         </form>
                       </div>
                     </div>     
                   </td> 
                    
                   <td><?php echo $item['Quantity']; ?></td> 
                   <td><?php echo $item['Price']; ?></td> 
                   <td><?php echo $subtotal=($item['Quantity']*$item['Price']); ?></td> 
                 </tr> 
              <?php
                    $total += $subtotal;
                     }
                 }else{
                     
              ?>
                 <tr>
                   <td colspan="4">No product available</td>  
                 </tr>   
              <?php
                 }   
              ?>
                 <tr>
                   <td></td>
                   <td></td>
                   <td class="fw-bold">Total:</td>  
                   <td><?php echo $total??0; ?></td>
                 </tr>
             
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr> 
               </table>
             
              <?php
               if(isset($total) && $total>0){
             ?>
              <form method="post">
             <?php  
                  if($_SESSION['SkmeicartList']['customer_details']['status'] > 0){
             ?>
              <div class="border border-light border-4 my-5 px-4">
                 <h3 class="text-center text-light my-2 fw-bold">Customer Information</h3>
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Name" name="name" value="<?php echo $old['name']??$_SESSION['authenticate']['name']?? ''; ?>">
                   <label for="Name">Name</label>
                 </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="Phone_no" name="phone_no" value="<?php echo $old['phone_no']??$_SESSION['authenticate']['phone_number']?? ''; ?>">
                   <label for="Phone_no">Phone No.</label>
                  </div>
                   
                 <div class="form-floating my-3">
                   <input type="text" class="form-control" id="City" name="city" value="<?php echo $old['city']??$_SESSION['authenticate']['city']?? ''; ?>">
                   <label for="Address">City</label>
                 </div>
             </div>
             <?php
              }
                 $CART = $_SESSION['SkmeicartList'];
                 $CART_status = $CART['customer_details']['status'] == 1 ? 'customer_details' : 'goto_customer_details';
             ?>
                 <div class="d-flex justify-content-center">
                    <button class="btn btn-dark my-5" type="submit" name="<?php echo $CART_status; ?>">Check out now</button>
                 </div>
            </form>
            <?php
                 }
               }
            ?>
      </div>
        
        
        
        
           <form class="d-flex justify-content-center mt-3" method="post">
               <button class="btn btn-light my-5" style="padding:10px 30px;" name="Loggedout">Logout</button>
          </form>
      </div>    
        <canvas width="900" height="380"></canvas>
    </main>
  
<?php
   require('footer.php');    
?>