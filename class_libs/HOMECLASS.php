<?php
error_reporting(E_ERROR | E_PARSE);
require_once('DATABASECLASS.php');
 
class HOMECLASS extends DATABASECLASS{
    
     public function profiles(){
         $connection = $this->connection;
         
         $view_profiles_query = "SELECT * FROM customer_registration";
    
           $result = $connection->query($view_profiles_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
     }
    
     public function allBinbondProducts(){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM binbondwatchproduct WHERE status= '1'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
     
           
   }
    
     
    public function BinbondProductsCard($x){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM binbondwatchproduct WHERE id='$x'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           
          return $result->fetch_assoc();
 }
    
    
    public function BinbondCart($y){
           $Product_id = $_POST['prdct_id'];
           #print_r($y);
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM binbondwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }  
        
           $product = $result->fetch_assoc();
        
           if($_SESSION['BinbondcartList']){
               if(count($_SESSION['BinbondcartList']['items']) > 0){
                   if(isset($_SESSION['BinbondcartList']['items'][$product['id']])){
                        $_SESSION['BinbondcartList']['items'][$product['id']]['Quantity'] = $_SESSION['BinbondcartList']['items'][$product['id']]['Quantity'] + $y['quantity'];
                   }else{
                       $_SESSION['BinbondcartList']['items'][$product['id']] = [
                                    'Name' => $product['name'],
                                    'SKU' => $product['sku'],
                                    'Price' => $product['price'],
                                    'Image1' => $product['image1'],
                                    'Image2' => $product['image2'],
                                    'Image3' => $product['image3'],
                                    'Quantity' => $y['quantity'],
                                ];
                       
                   }  
               }
           }else{
               $_SESSION['BinbondcartList'] = [
                       'product_id' => $product['id'],
                       'customer_details' => [
                          'Name' => '',
                          'Phone Number' => '',
                          'City' => '',
                          'status' => 0,
                        ],
                        'payment_details' => [
                          // cash on delivery / cash payment
					          'payment_policy' => 'cod',
					          'sender_number' => null,
					          'transaction_id' => null,
				          // bkash/nagad/rocket
					          'payment_method' => null,
					          'status' => 0,
                        ],
                        'items' => [
                            $product['id'] => [
                                'id' => $product['id'],
                                'Name' => $product['name'],
                                'SKU' => $product['sku'],
                                'Price' => $product['price'],
                                'Image1' => $product['image1'],
                                'Image2' => $product['image2'],
                                'Image3' => $product['image3'],
                                'Quantity' => $y['quantity'],
                            ]
                        ],
               ];  
           }
          
           #print_r($_SESSION['cartList']);
           
           
           header('Location:dashboard.php?id='.$product['id']);
           
           
           #print_r($cartList);
          # return true;
          
 }
    
    
    public function allCurrenProducts(){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM currenwatchproduct WHERE status= '1'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
     
           
   }
    
    
    public function CurrenProductsCard($x){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM currenwatchproduct WHERE id='$x'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           
          return $result->fetch_assoc();
 }
    
    
    public function CurrenCart($y){
           $Product_id = $_POST['prdct_id'];
           #print_r($y);
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM currenwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }  
        
           $product = $result->fetch_assoc();
        
           if($_SESSION['CurrencartList']){
               if(count($_SESSION['CurrencartList']['items']) > 0){
                   if(isset($_SESSION['CurrencartList']['items'][$product['id']])){
                        $_SESSION['CurrencartList']['items'][$product['id']]['Quantity'] = $_SESSION['CurrencartList']['items'][$product['id']]['Quantity'] + $y['quantity'];
                   }else{
                       $_SESSION['CurrencartList']['items'][$product['id']] = [
                                    'Name' => $product['name'],
                                    'SKU' => $product['sku'],
                                    'Price' => $product['price'],
                                    'Image1' => $product['image1'],
                                    'Image2' => $product['image2'],
                                    'Image3' => $product['image3'],
                                    'Quantity' => $y['quantity'],
                                ];
                       
                   }  
               }
           }else{
               $_SESSION['CurrencartList'] = [
                       'product_id' => $product['id'],
                       'customer_details' => [
                          'Name' => '',
                          'Phone Number' => '',
                          'City' => '',
                          'status' => 0,
                        ],
                        'payment_details' => [
                          // cash on delivery / cash payment
					          'payment_policy' => 'cod',
					          'sender_number' => null,
					          'transaction_id' => null,
				          // bkash/nagad/rocket
					          'payment_method' => null,
					          'status' => 0,
                        ],
                        'items' => [
                            $product['id'] => [
                                'id' => $product['id'],
                                'Name' => $product['name'],
                                'SKU' => $product['sku'],
                                'Price' => $product['price'],
                                'Image1' => $product['image1'],
                                'Image2' => $product['image2'],
                                'Image3' => $product['image3'],
                                'Quantity' => $y['quantity'],
                            ]
                        ],
               ];  
           }
          
           #print_r($_SESSION['cartList']);
           
           
           header('Location:dashboard.php?id='.$product['id']);
           
           
           #print_r($cartList);
          # return true;
          
 }
    
    
     public function allMegirProducts(){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM megirwatchproduct WHERE status= '1'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
     
           
   }
    
    
    public function MegirProductsCard($x){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM megirwatchproduct WHERE id='$x'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           
          return $result->fetch_assoc();
 }
    
    
    public function MegirCart($y){
           $Product_id = $_POST['prdct_id'];
           #print_r($y);
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM megirwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }  
        
           $product = $result->fetch_assoc();
        
           if($_SESSION['MegircartList']){
               if(count($_SESSION['MegircartList']['items']) > 0){
                   if(isset($_SESSION['MegircartList']['items'][$product['id']])){
                        $_SESSION['MegircartList']['items'][$product['id']]['Quantity'] = $_SESSION['MegircartList']['items'][$product['id']]['Quantity'] + $y['quantity'];
                   }else{
                       $_SESSION['MegircartList']['items'][$product['id']] = [
                                    'Name' => $product['name'],
                                    'SKU' => $product['sku'],
                                    'Price' => $product['price'],
                                    'Image1' => $product['image1'],
                                    'Image2' => $product['image2'],
                                    'Image3' => $product['image3'],
                                    'Quantity' => $y['quantity'],
                                ];
                       
                   }  
               }
           }else{
               $_SESSION['MegircartList'] = [
                       'product_id' => $product['id'],
                       'customer_details' => [
                          'Name' => '',
                          'Phone Number' => '',
                          'City' => '',
                          'status' => 0,
                        ],
                        'payment_details' => [
                          // cash on delivery / cash payment
					          'payment_policy' => 'cod',
					          'sender_number' => null,
					          'transaction_id' => null,
				          // bkash/nagad/rocket
					          'payment_method' => null,
					          'status' => 0,
                        ],
                        'items' => [
                            $product['id'] => [
                                'id' => $product['id'],
                                'Name' => $product['name'],
                                'SKU' => $product['sku'],
                                'Price' => $product['price'],
                                'Image1' => $product['image1'],
                                'Image2' => $product['image2'],
                                'Image3' => $product['image3'],
                                'Quantity' => $y['quantity'],
                            ]
                        ],
               ];  
           }
          
           #print_r($_SESSION['cartList']);
           
           
           header('Location:dashboard.php?id='.$product['id']);
           
           
           #print_r($cartList);
          # return true;
          
 }
    
    
      public function allMreurioProducts(){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM mreuriowatchproduct WHERE status= '1'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
     
           
   }
    
    
    public function MreurioProductsCard($x){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM mreuriowatchproduct WHERE id='$x'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           
          return $result->fetch_assoc();
 }
    
    
    public function MreurioCart($y){
           $Product_id = $_POST['prdct_id'];
           #print_r($y);
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM mreuriowatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }  
        
           $product = $result->fetch_assoc();
        
           if($_SESSION['MreuriocartList']){
               if(count($_SESSION['MreuriocartList']['items']) > 0){
                   if(isset($_SESSION['MreuriocartList']['items'][$product['id']])){
                        $_SESSION['MreuriocartList']['items'][$product['id']]['Quantity'] = $_SESSION['MreuriocartList']['items'][$product['id']]['Quantity'] + $y['quantity'];
                   }else{
                       $_SESSION['MreuriocartList']['items'][$product['id']] = [
                                    'Name' => $product['name'],
                                    'SKU' => $product['sku'],
                                    'Price' => $product['price'],
                                    'Image1' => $product['image1'],
                                    'Image2' => $product['image2'],
                                    'Image3' => $product['image3'],
                                    'Quantity' => $y['quantity'],
                                ];
                       
                   }  
               }
           }else{
               $_SESSION['MreuriocartList'] = [
                       'product_id' => $product['id'],
                       'customer_details' => [
                          'Name' => '',
                          'Phone Number' => '',
                          'City' => '',
                          'status' => 0,
                        ],
                        'payment_details' => [
                          // cash on delivery / cash payment
					          'payment_policy' => 'cod',
					          'sender_number' => null,
					          'transaction_id' => null,
				          // bkash/nagad/rocket
					          'payment_method' => null,
					          'status' => 0,
                        ],
                        'items' => [
                            $product['id'] => [
                                'id' => $product['id'],
                                'Name' => $product['name'],
                                'SKU' => $product['sku'],
                                'Price' => $product['price'],
                                'Image1' => $product['image1'],
                                'Image2' => $product['image2'],
                                'Image3' => $product['image3'],
                                'Quantity' => $y['quantity'],
                            ]
                        ],
               ];  
           }
          
           #print_r($_SESSION['cartList']);
           
           
           header('Location:dashboard.php?id='.$product['id']);
           
           
           #print_r($cartList);
          # return true;
          
 } 
    
    
      public function allSkmeiProducts(){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM skmeiwatchproduct WHERE status= '1'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
     
           
   }
    
    
      public function SkmeiProductsCard($x){
           
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM skmeiwatchproduct WHERE id='$x'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           
          return $result->fetch_assoc();
 }
    
    
    public function SkmeiCart($y){
           $Product_id = $_POST['prdct_id'];
           #print_r($y);
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM skmeiwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }  
        
           $product = $result->fetch_assoc();
        
           if($_SESSION['SkmeicartList']){
               if(count($_SESSION['SkmeicartList']['items']) > 0){
                   if(isset($_SESSION['SkmeicartList']['items'][$product['id']])){
                        $_SESSION['SkmeicartList']['items'][$product['id']]['Quantity'] = $_SESSION['SkmeicartList']['items'][$product['id']]['Quantity'] + $y['quantity'];
                   }else{
                       $_SESSION['SkmeicartList']['items'][$product['id']] = [
                                    'Name' => $product['name'],
                                    'SKU' => $product['sku'],
                                    'Price' => $product['price'],
                                    'Image1' => $product['image1'],
                                    'Image2' => $product['image2'],
                                    'Image3' => $product['image3'],
                                    'Quantity' => $y['quantity'],
                                ];
                       
                   }  
               }
           }else{
               $_SESSION['SkmeicartList'] = [
                       'product_id' => $product['id'],
                       'customer_details' => [
                          'Name' => '',
                          'Phone Number' => '',
                          'City' => '',
                          'status' => 0,
                        ],
                        'payment_details' => [
                          // cash on delivery / cash payment
					          'payment_policy' => 'cod',
					          'sender_number' => null,
					          'transaction_id' => null,
				          // bkash/nagad/rocket
					          'payment_method' => null,
					          'status' => 0,
                        ],
                        'items' => [
                            $product['id'] => [
                                'id' => $product['id'],
                                'Name' => $product['name'],
                                'SKU' => $product['sku'],
                                'Price' => $product['price'],
                                'Image1' => $product['image1'],
                                'Image2' => $product['image2'],
                                'Image3' => $product['image3'],
                                'Quantity' => $y['quantity'],
                            ]
                        ],
               ];  
           }
          
           #print_r($_SESSION['cartList']);
           
           
           header('Location:dashboard.php?id='.$product['id']);
           
           
           #print_r($cartList);
          # return true;
          
 } 
    
   
     public function confirm_binbondcheckout($g){
        
         $_SESSION['BinbondcartList']['customer_details']['status'] = 1;
    }
    
    
     public function binbondcustomer_details($t){
          $name = $_SESSION['authenticate']['name'];
          $phone_no = $_SESSION['authenticate']['phone_number'];
          $city = $_SESSION['authenticate']['city'];
     
         
        
        $_SESSION['BinbondcartList']['customer_details'] = [
                  'Name' => $name,
                  'Phone Number' => $phone_no,
                  'City' => $city,
                  'status' => 2,
        ];
    }

    
    public function confirm_currencheckout($g){
        
         $_SESSION['CurrencartList']['customer_details']['status'] = 1;
    }
    
    
     public function currencustomer_details($t){
          $name = $_SESSION['authenticate']['name'];
          $phone_no = $_SESSION['authenticate']['phone_number'];
          $city = $_SESSION['authenticate']['city'];
     
         
        
        $_SESSION['CurrencartList']['customer_details'] = [
                  'Name' => $name,
                  'Phone Number' => $phone_no,
                  'City' => $city,
                  'status' => 2,
        ];
    }
    
    
    public function confirm_megircheckout($g){
        
         $_SESSION['MegircartList']['customer_details']['status'] = 1;
    }
    
    
     public function megircustomer_details($t){
          $name = $_SESSION['authenticate']['name'];
          $phone_no = $_SESSION['authenticate']['phone_number'];
          $city = $_SESSION['authenticate']['city'];
     
         
        
        $_SESSION['MegircartList']['customer_details'] = [
                  'Name' => $name,
                  'Phone Number' => $phone_no,
                  'City' => $city,
                  'status' => 2,
        ];
    }
    
    
    public function confirm_mreuriocheckout($g){
        
         $_SESSION['MreuriocartList']['customer_details']['status'] = 1;
    }
    
    
     public function mreuriocustomer_details($t){
          $name = $_SESSION['authenticate']['name'];
          $phone_no = $_SESSION['authenticate']['phone_number'];
          $city = $_SESSION['authenticate']['city'];
     
         
        
        $_SESSION['MreuriocartList']['customer_details'] = [
                  'Name' => $name,
                  'Phone Number' => $phone_no,
                  'City' => $city,
                  'status' => 2,
        ];
    }
    
    
    
    public function confirm_skmeicheckout($g){
        
         $_SESSION['SkmeicartList']['customer_details']['status'] = 1;
    }
    
    
     public function skmeicustomer_details($t){
          $name = $_SESSION['authenticate']['name'];
          $phone_no = $_SESSION['authenticate']['phone_number'];
          $city = $_SESSION['authenticate']['city'];
     
         
        
        $_SESSION['SkmeicartList']['customer_details'] = [
                  'Name' => $name,
                  'Phone Number' => $phone_no,
                  'City' => $city,
                  'status' => 2,
        ];
    }


}



?>