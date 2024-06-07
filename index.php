<?php
  include('header.php');
?>
 
   <main>
     <!=============================== Home Silder part ====================================>
       <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/banner.jpg" class="d-block" alt="banner" style="width:100%; height:600px;">
            </div>
            <div class="carousel-item">
              <img src="images/banner2.jpg" class="d-block" alt="banner2" style="width:100%; height:600px;">
            </div>
            <div class="carousel-item">
              <img src="images/banner.jpg" class="d-block" alt="banner" style="width:100%; height:600px;">
            </div>
          </div>
        </div>
       
    <!====================================== Company Owner ================================>
      <section id="Company_owner" class="py-5">
        <div class="container">
          <div class="row mt-3">
            <div class="col-12 text-center">
              <h1 class="fw-bold">Company Owner</h1>  
            </div>
            <div class="col-6 pt-5 ps-5">
              <div class="owner-img">
                <img src="images/owner.png" alt="owner" style="width:400px; height:400px;">
              </div>
            </div>
            <div class="col-6 py-5">
                <div class="pt-5">
                   <h4 id="text"></h4><h4 id="cursor"></h4>
                </div>
            </div>
          </div>
        </div>
      </section>
       
       
    <!================================== Brand Part ==================================>
   <section id="Brand">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">
               <div class="head text-center">
                   <h1 class="fw-bold text-danger">Our Watch Brands</h1>
               </div>
           </div>
       </div>
        <div class="row brand-slider mt-5">
            <div class="col-lg-4">
                <div class="brand">
                    <div class="brand-item">
                        <img src="images/Curren.jpeg" alt="Curren" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="brand">
                    <div class="brand-item">
                        <img src="images/Skmei.png" alt="Skmei" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="brand">
                        <div class="brand-item">
                       <img src="images/Megir.jpeg" alt="Megir" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="brand">
                        <div class="brand-item">
                        <img src="images/Binbond.png" alt="Binbond" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="brand">
                        <div class="brand-item">
                        <img src="images/Mreurio.png" alt="Mreurio" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
       
        <!================================== Products Part ==================================>
   <section id="Products">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">
               <div class="head text-center">
                   <h1 class="fw-bold text-danger">Our Some Products</h1>
               </div>
           </div>
       </div>
        <div class="row products-slider mt-5">
            <div class="col-lg-4">
                <div class="products">
                    <div class="products-item">
                        <img src="images/product1.jpg" alt="product1" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="products">
                    <div class="products-item">
                        <img src="images/product2.jpg" alt="product2" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="products">
                        <div class="products-item">
                       <img src="images/product3.jpg" alt="product3" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="products">
                        <div class="products-item">
                        <img src="images/product4.jpg" alt="product4" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="products">
                        <div class="products-item">
                        <img src="images/product5.jpg" alt="product5" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
             <div class="col-lg-4">
                <div class="products">
                        <div class="products-item">
                        <img src="images/product6.jpg" alt="product6" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
             <div class="col-lg-4">
                <div class="products">
                        <div class="products-item">
                        <img src="images/product7.jpg" alt="product7" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
             <div class="col-lg-4">
                <div class="products">
                        <div class="products-item">
                        <img src="images/product8.jpg" alt="product8" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
             <div class="col-lg-4">
                <div class="products">
                        <div class="products-item">
                        <img src="images/product9.jpg" alt="product9" style="width:100%; height:300px;">
                    </div>
                </div>
            </div>
             
        </div>
        <div class="row mt-5">
          <div class="col-6 mx-auto text-center">
            <h5 class="text-dark">To see more products and make order</h5>
            <h5 class="mb-3 text-dark"><i class="fa-solid fa-circle-chevron-down"></i></h5>
            <a href="login.php"><button type="button" class="btn btn-lg btn-warning rounded-4">Just click here</button></a>
          </div>
        </div>
    </div>
</section>
   </main>
      
<?php
   include('footer.php');    
?>