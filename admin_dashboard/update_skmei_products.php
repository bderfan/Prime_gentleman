 <?php
       error_reporting(E_ERROR | E_PARSE);
       require('sidebar.php'); 

       require_once('../class_libs/PRODUCTCLASS.php');
       $add_product = new PRODUCTCLASS;

     
      if(isset($_POST['edit_products'])){
          $products_edit = $add_product->Skmei_Product_edit();
          
           if($products_edit['status'] == 'error'){
             $errors = $products_edit['message'];
         }
          if($products_edit['status'] == 'success'){
             $success = $products_edit['message'];
         }  
      
      }


    $targetdata = $add_product->targetskmeiData($_GET['sku']);
       
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background: rgb(135,85,0); background: linear-gradient(141deg, rgba(135,85,0,1) 0%, rgba(2,1,0,1) 99%);">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <div class="d-flex justify-content-end my-3">
                <!-- Button trigger modal -->
                 <a href="skmei_watch.php" class="btn" style="background-color: #C28B37;">
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
             header('Refresh:1,url=skmei_watch.php');
             }
          ?>  
      </div>
      <div class="container">
       <div class="row">
            <form class="col-9 mx-auto" method="post" enctype="multipart/form-data">
              <input type="hidden" name="update_product_id" value="<?php echo $targetdata['id']?? ''; ?>">
               <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="name">Name</label>
                      <input class="form-control" id="name" name="name" value="<?php echo $old['name']??$targetdata['name']?? ''; ?>">
                </div>
                <p class="text-white" style="font-size:15px;"> <?php echo $errors['name']??'' ?></p>
                <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="name">Model</label>
                      <input class="form-control" id="model" name="model" value="<?php echo $old['model']??$targetdata['model']?? ''; ?>">
                </div>
                <p class="text-white" style="font-size:15px;"> <?php echo $errors['model']??'' ?></p>
                  
                <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="name">Brand</label>
                      <input class="form-control" id="brand" name="brand" value="<?php echo $old['brand']??$targetdata['brand']?? ''; ?>">
                </div>
                <p class="text-white" style="font-size:15px;"> <?php echo $errors['brand']??'' ?></p>
                 
               <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="sku">SKU</label>
                      <input class="form-control" id="sku" name="sku" value="<?php echo $old['sku']??$targetdata['sku']?? ''; ?>">
                </div>
                <p class="text-white" style="font-size:15px;"> <?php echo $errors['sku']??'' ?></p>
               
                <div class="my-3">
                     <div class="d-flex justify-content-center">
                          <img src="../images/products_img/<?php echo $targetdata['image1']??''; ?>" style="width:200px;">
                     </div>
                 </div>
                  <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="image1">Image1</label>
                      <input type="file" class="form-control" id="image1" name="image1">
                 </div>
                 <p class="text-white" style="font-size:15px;"> <?php echo $errors['image1']??'' ?></p>
                  
                  <div class="my-3">
                     <div class="d-flex justify-content-center">
                        <img src="../images/products_img/<?php echo $targetdata['image2']??''; ?>" style="width:200px;"> 
                     </div>
                 </div>
                  <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="image2">Image2</label>
                      <input type="file" class="form-control" id="image2" name="image2">
                 </div>
                 <p class="text-white" style="font-size:15px;"> <?php echo $errors['image2']??'' ?></p>
                  
                  <div class="my-3">
                      <div class="d-flex justify-content-center">
                         <img src="../images/products_img/<?php echo $targetdata['image3']??''; ?>" style="width:200px;">
                      </div>
                 </div>
                  <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="image3">Image3</label>
                      <input type="file" class="form-control" id="image3" name="image3">
                 </div>
                 <p class="text-white" style="font-size:15px;"> <?php echo $errors['image3']??'' ?></p>
                  
                 <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="price">Price</label>
                      <input class="form-control" id="price" name="price" value="<?php echo $old['price']??$targetdata['price']?? ''; ?>">
                </div>
                <p class="text-white" style="font-size:15px;"> <?php echo $errors['price']??'' ?></p>
               
                  <div class="my-3">
                      <label class="fw-bold text-white mb-2" for="details1">Details</label>
                      <textarea id="details1" name="details1"><?php echo $old['details1']??$targetdata['details']?? ''; ?></textarea>
                  </div>
                  <p class="text-white" style="font-size:15px;"> <?php echo $errors['details1']??'' ?></p>
                  
               
                 <div class="d-flex justify-content-center mt-3">
                     <button type="submit" class="btn btn-dark me-2" style="padding:10px 30px;" name="edit_products">Update</button> 
                    <button class="btn btn-light" style="padding:10px 30px;" name="Loggedout">Logout</button>
                 </div> 
          </form>
       </div>
      </div>    
        <canvas width="900" height="380"></canvas>
    </main>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>


<script>
    ClassicEditor
        .create( document.querySelector( '#details1' ) )
        .then( editor => {
             editor.ui.view.editable.element.style.height = '500px';
         } )
        .catch( error => {
            console.error( error );
        } );
</script>

<?php
   require('footer.php');    
?>