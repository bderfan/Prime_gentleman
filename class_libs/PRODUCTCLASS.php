<?php
error_reporting(E_ERROR | E_PARSE);
require_once('DATABASECLASS.php');
 
class PRODUCTCLASS extends DATABASECLASS{
  
   
    
    public function Skmei_index(){
         $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM skmeiwatchproduct";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
    }
    
    
    public function Skmei_Product_add(){
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details1 = $_POST['details1'];
        
        
      
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
       $errors = [];
        if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
        if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
             
         
        
        $connection = $this->connection;
        $sku_sql_view = "SELECT * FROM skmeiwatchproduct WHERE sku='$sku'";
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU doesnot exists';
        }
        
       
         if(strlen($details1) == 0){
             $errors['details1'] = 'Please insert details ...'; 
         }else{
              if(strlen($details1) < 10 || strlen($details1) > 1000){
                 $errors['details1'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
       
        
               
        
        
         $get_image_extension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name1){
            $errors['image1'] = 'Please upload products image ...';
        }else{
            $new_image1 = time().$real_name1;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
           
       
        
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
            
            move_uploaded_file($tmp_name1, $dir_path.'/'.$new_image1); 
             
        }
       
        
        
        
        
          $get_image_extension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name2){
            $errors['image2'] = 'Please upload products image ...';
        }else{
            $new_image2 = time().$real_name2;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
          
        
        
            
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
        
            move_uploaded_file($tmp_name2, $dir_path.'/'.$new_image2); 
        }
       
        
        
        
        
        
        
          $get_image_extension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
         if(!$tmp_name3){
            $errors['image3'] = 'Please upload products image ...';
        }else{
             $new_image3 = time().$real_name3;
             $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
       
           
        
        
             $dir_path = '../images/products_img';
    
             if(!file_exists($dir_path)){
                 mkdir($dir_path);
             }
        
            move_uploaded_file($tmp_name3, $dir_path.'/'.$new_image3); 
         }
       
        
        
        
        
        
        
       
           if(count($errors) > 0){
             return[
                'status' => 'error',
                'message' => $errors
             ]; 
          }
          
           $success = []; 
           
    
            $NAME = $connection->real_escape_string($name);    
           $DETAILS1 = $connection->real_escape_string($details1);
        
           $insert_products_query = "INSERT INTO skmeiwatchproduct(name, model, brand, sku, image1, image2, image3, details, price)VALUES('$NAME', '$model','$brand','$sku','$new_image1','$new_image2','$new_image3','$DETAILS1','$price')";
        
           $result = $connection->query($insert_products_query);
           
           if($connection->error){
               die('Table Error:'.$connection->error);
           }
            
        
          $success['success'] = 'Product saved successfully!';
               
          return[
           'status' => 'success',
           'message' => $success
          ]; 
           
    }
    
    
    public function Skmei_Product_edit(){
      $Update_product_id = $_POST['update_product_id'];   
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details1 = $_POST['details1'];
      
      
        
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
		$errors = [];
		
		if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
        
          if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
        
        $connection = $this->connection;
        
         $sku_sql_view = "SELECT * FROM skmeiwatchproduct WHERE id!='$Update_product_id' and sku='$sku'";
            
        #print_r($sku_sql_view);
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        #print_r($result);
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU already exists';
        }
        
        
         if(strlen($details1) == 0){
             $errors['details1'] = 'Please insert details ...'; 
         }else{
              if(strlen($details1) < 10 || strlen($details1) > 1000){
                 $errors['details1'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
		
       
        
		
		$getEditData = $result->fetch_assoc();
		$path1 = $getEditData['image1'];
        $path2 = $getEditData['image2'];
        $path3 = $getEditData['image3'];
       
        
       
        
	
			$getImageExtension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION ));
        
          if(!$tmp_name1){
              $errors['image1'] = 'Please upload products image...';
          }else{
              $new_img1 = time().$real_name1;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
            
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			  
			  if($path1 && file_exists('../'.$path1)){
			  	unlink('../'.$path1);
			  }
			
			  $path1 = $dir.'/'.$new_img1;
		
			  move_uploaded_file($tmp_name1, '../'.$path1);
          }
			

        
       
			$getImageExtension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION ));
			
        
            if(!$tmp_name2){
              $errors['image2'] = 'Please upload products image...';
            }else{
              $new_img2 = time().$real_name2;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
           
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			
			  if($path2 && file_exists('../'.$path2)){
			  	unlink('../'.$path2);
			  }
			
			  $path2 = $dir.'/'.$new_img2;
		
			  move_uploaded_file($tmp_name2, '../'.$path2);  
            }
			
			
			
		
        
        
			$getImageExtension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION ));
        
            if(!$tmp_name3){
              $errors['image3'] = 'Please upload products image...';
            }else{
                $new_img3 = time().$real_name3;
			
			    $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
			
			    $dir = 'images/products_img';
			    if(!file_exists('../'.$dir)){
			    	mkdir('../'.$dir);
			    }
			
			    if($path3 && file_exists('../'.$path3)){
			    	unlink('../'.$path3);
			    }
			
			    $path3 = $dir.'/'.$new_img3;
		
			    move_uploaded_file($tmp_name3, '../'.$path3);    
            }
			
			
			
			
		
        
     
			
		
        
        
        
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors
			];
		}
        
        
        
		
        $success = [];
		
		$slug = str_replace('', '-',strtolower($name));
		
        $NAME = $connection->real_escape_string($name);
        $DETAILS1 = $connection->real_escape_string($details1);
        
        
		$sql_update = "UPDATE skmeiwatchproduct SET name='$NAME', model='$model', brand='$brand', sku='$sku', image1='$new_img1',image2='$new_img2',image3='$new_img3', details='$DETAILS1', price='$price' WHERE id='$Update_product_id'";
		
		$result = $connection->query($sql_update);
        
		
		if($connection->error){
			die('Table Error: '.$connection->error);
		}
        #print_r($result);
       
        $success['success'] = 'Product updated successfully!';
		
		return [
				'status' => 'success',
				'message' => $success
		];
    }
    
    
    public function Delete_Skmei_Product(){
           $Product_id = $_POST['DeletedID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM skmeiwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_product_query);
           print_r($result);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $Delete_product = "DELETE FROM skmeiwatchproduct WHERE id='$Product_id'";
    
               $result = $connection->query($Delete_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               if(file_exists('../images/products_img/'.$getData['image'])){
                   unlink('../images/products_img/'.$getData['image']);
               }
               
               $success['success'] = 'Deleted successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
    public function Skmei_Product_status(){
           $status_id = $_POST['statusID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM skmeiwatchproduct WHERE id='$status_id'";
    
           $result = $connection->query($view_product_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           $getdata = $result->fetch_assoc();
           $status = $getdata['status'] == 0? 1: 0;       
        
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $update_product = "UPDATE skmeiwatchproduct SET status ='$status' WHERE id='$status_id'";
    
               $result = $connection->query($update_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               
               $success['success'] = 'Status updated successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
     public function Binbond_Product_edit(){
      $Update_product_id = $_POST['update_product_id'];   
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details2 = $_POST['details2'];
      
      
        
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
      
		
		$errors = [];
		
		if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
         
         
         if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
        $connection = $this->connection;
        
         $sku_sql_view = "SELECT * FROM binbondwatchproduct WHERE id!='$Update_product_id' and sku='$sku'";
            
        #print_r($sku_sql_view);
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        #print_r($result);
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU already exists';
        }
        
        
         if(strlen($details2) == 0){
             $errors['details2'] = 'Please insert details ...'; 
         }else{
              if(strlen($details2) < 10 || strlen($details2) > 1000){
                 $errors['details2'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
		
       
        
		
		$getEditData = $result->fetch_assoc();
		$path1 = $getEditData['image1'];
        $path2 = $getEditData['image2'];
        $path3 = $getEditData['image3'];
       
       
        
	
			$getImageExtension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION ));
			
			if(!$tmp_name1){
                $errors['image1'] = 'Please upload products image...';
                
            }else{
                $new_img1 = time().$real_name1;
			
			    $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
            
			
			    $dir = 'images/products_img';
			    if(!file_exists('../'.$dir)){
				    mkdir('../'.$dir);
			    }
			
			    if($path1 && file_exists('../'.$path1)){
			    	unlink('../'.$path1);
			    }
			
			    $path1 = $dir.'/'.$new_img1;
		
			    move_uploaded_file($tmp_name1, '../'.$path1);
            }
			
			
		    $getImageExtension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION ));
         
         
            if(!$tmp_name2){
                $errors['image2'] = 'Please upload products image...';
            }else{
                
			
			     $new_img2 = time().$real_name2;
			
			     $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
           
			
			     $dir = 'images/products_img';
			     if(!file_exists('../'.$dir)){
			     	mkdir('../'.$dir);
			     }
			
			     if($path2 && file_exists('../'.$path2)){
			     	unlink('../'.$path2);
			     }
			
			     $path2 = $dir.'/'.$new_img2;
		
			     move_uploaded_file($tmp_name2, '../'.$path2);
			     
            }
            
          $getImageExtension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION ));
			
		  if(!$tmp_name3){
                $errors['image3'] = 'Please upload products image...';
                
            }else{
               
			  
			  
			  $new_img3 = time().$real_name3;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
				  mkdir('../'.$dir);
			  }
			  
			  if($path3 && file_exists('../'.$path3)){
			  	unlink('../'.$path3);
			  }
			
			  $path3 = $dir.'/'.$new_img3;
		
			  move_uploaded_file($tmp_name3, '../'.$path3);
			  
          }
        
       
			
		
        
     
			
			
		
        
        
        
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors
			];
		}
        
        
        
		
        $success = [];
		
		$slug = str_replace('', '-',strtolower($name));
		
        $NAME = $connection->real_escape_string($name);
        $DETAILS2 = $connection->real_escape_string($details2);
        
        
		$sql_update = "UPDATE binbondwatchproduct SET name='$NAME', model='$model', brand='$brand', sku='$sku', image1='$new_img1',image2='$new_img2',image3='$new_img3', details='$DETAILS2', price='$price' WHERE id='$Update_product_id'";
		
		$result = $connection->query($sql_update);
        
		
		if($connection->error){
			die('Table Error: '.$connection->error);
		}
        #print_r($result);
       
        $success['success'] = 'Product updated successfully!';
		
		return [
				'status' => 'success',
				'message' => $success
		];
    }
    
    
     public function Binbond_index(){
         $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM binbondwatchproduct";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
    }
    
    
    public function Binbond_Product_add(){
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details2 = $_POST['details2'];
        
     
      
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
     
       $errors = [];
        if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
        
        
       
         if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
             
        
        
        $connection = $this->connection;
        $sku_sql_view = "SELECT * FROM binbondwatchproduct WHERE sku='$sku'";
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU doesnot exists';
        }
        
       
         if(strlen($details2) == 0){
             $errors['details2'] = 'Please insert details ...'; 
         }else{
              if(strlen($details2) < 10 || strlen($details2) > 1000){
                 $errors['details2'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
       
        
               
        
        
         $get_image_extension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name1){
            $errors['image1'] = 'Please upload products image...';
        }else{
            $new_image1 = time().$real_name1;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
     
        
            $dir_path = '../images/products_img';
    
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
        
            move_uploaded_file($tmp_name1, $dir_path.'/'.$new_image1);  
        }
       

         
        
          $get_image_extension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name2){
            $errors['image2'] = 'Please upload products image...';
        }else{
           $new_image2 = time().$real_name2;
           $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
        
        
           $dir_path = '../images/products_img';
    
           if(!file_exists($dir_path)){
               mkdir($dir_path);
           }
        
           move_uploaded_file($tmp_name2, $dir_path.'/'.$new_image2);  
        }
        
        
    
        
          $get_image_extension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
         if(!$tmp_name3){
            $errors['image3'] = 'Please upload products image...';
        }else{
             $new_image3 = time().$real_name3;
             $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
             $dir_path = '../images/products_img';
    
             if(!file_exists($dir_path)){
                 mkdir($dir_path);
             }
             
             move_uploaded_file($tmp_name3, $dir_path.'/'.$new_image3); 
         }
       
        
        
        
        
        
         
        
       
           if(count($errors) > 0){
             return[
                'status' => 'error',
                'message' => $errors
             ]; 
          }
          
           $success = []; 
           
    
            $NAME = $connection->real_escape_string($name);
        
           $DETAILS2 = $connection->real_escape_string($details2);
        
           $insert_products_query = "INSERT INTO binbondwatchproduct(name, model, brand, sku, image1, image2, image3, details, price)VALUES('$NAME', '$model','$brand','$sku','$new_image1','$new_image2','$new_image3','$DETAILS2','$price')";
        
           $result = $connection->query($insert_products_query);
           
           if($connection->error){
               die('Table Error:'.$connection->error);
           }
            
        
          $success['success'] = 'Product saved successfully!';
               
          return[
           'status' => 'success',
           'message' => $success
          ]; 
           
    }
    
    
    public function Delete_Binbond_Product(){
           $Product_id = $_POST['DeletedID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM binbondwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_product_query);
           print_r($result);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $Delete_product = "DELETE FROM binbondwatchproduct WHERE id='$Product_id'";
    
               $result = $connection->query($Delete_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               if(file_exists('../images/products_img/'.$getData['image'])){
                   unlink('../images/products_img/'.$getData['image']);
               }
               
               $success['success'] = 'Deleted successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    public function Binbond_Product_status(){
           $status_id = $_POST['statusID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM binbondwatchproduct WHERE id='$status_id'";
    
           $result = $connection->query($view_product_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           $getdata = $result->fetch_assoc();
           $status = $getdata['status'] == 0? 1: 0;       
        
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $update_product = "UPDATE binbondwatchproduct SET status ='$status' WHERE id='$status_id'";
    
               $result = $connection->query($update_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               
               $success['success'] = 'Status updated successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
     
     public function Curren_index(){
         $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM currenwatchproduct";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
    }
    
    
    public function Curren_Product_add(){
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details3 = $_POST['details3'];
        
        
      
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
       $errors = [];
        if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
        
         if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
         
        
        $connection = $this->connection;
        $sku_sql_view = "SELECT * FROM currenwatchproduct WHERE sku='$sku'";
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU doesnot exists';
        }
        
       
         if(strlen($details3) == 0){
             $errors['details3'] = 'Please insert details ...'; 
         }else{
              if(strlen($details3) < 10 || strlen($details3) > 1000){
                 $errors['details3'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
       
        
               
        
        
         $get_image_extension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name1){
            $errors['image1'] = 'Please upload products image ...';
        }else{
            $new_image1 = time().$real_name1;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
           
       
        
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
            
            move_uploaded_file($tmp_name1, $dir_path.'/'.$new_image1); 
             
        }
       
        
        
        
        
          $get_image_extension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name2){
            $errors['image2'] = 'Please upload products image ...';
        }else{
            $new_image2 = time().$real_name2;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
          
        
        
            
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
        
            move_uploaded_file($tmp_name2, $dir_path.'/'.$new_image2); 
        }
       
        
        
        
        
        
        
          $get_image_extension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
         if(!$tmp_name3){
            $errors['image3'] = 'Please upload products image ...';
        }else{
             $new_image3 = time().$real_name3;
             $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
       
           
        
        
             $dir_path = '../images/products_img';
    
             if(!file_exists($dir_path)){
                 mkdir($dir_path);
             }
        
            move_uploaded_file($tmp_name3, $dir_path.'/'.$new_image3); 
         }
       
        
        
        
        
        
        
       
           if(count($errors) > 0){
             return[
                'status' => 'error',
                'message' => $errors
             ]; 
          }
          
           $success = []; 
           
    
            $NAME = $connection->real_escape_string($name);    
           $DETAILS3 = $connection->real_escape_string($details3);
        
           $insert_products_query = "INSERT INTO currenwatchproduct(name, model, brand, sku, image1, image2, image3, details, price)VALUES('$NAME', '$model','$brand','$sku','$new_image1','$new_image2','$new_image3','$DETAILS3','$price')";
        
           $result = $connection->query($insert_products_query);
           
           if($connection->error){
               die('Table Error:'.$connection->error);
           }
            
        
          $success['success'] = 'Product saved successfully!';
               
          return[
           'status' => 'success',
           'message' => $success
          ]; 
           
    }
    
    
    
    public function Curren_Product_edit(){
      $Update_product_id = $_POST['update_product_id'];   
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details3 = $_POST['details3'];
      
      
        
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
		$errors = [];
		
		if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
        
         if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
        
        $connection = $this->connection;
        
         $sku_sql_view = "SELECT * FROM currenwatchproduct WHERE id!='$Update_product_id' and sku='$sku'";
            
        #print_r($sku_sql_view);
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        #print_r($result);
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU already exists';
        }
        
        
         if(strlen($details3) == 0){
             $errors['details3'] = 'Please insert details ...'; 
         }else{
              if(strlen($details3) < 10 || strlen($details3) > 1000){
                 $errors['details3'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
		
       
        
		
		$getEditData = $result->fetch_assoc();
		$path1 = $getEditData['image1'];
        $path2 = $getEditData['image2'];
        $path3 = $getEditData['image3'];
       
        
       
        
	
			$getImageExtension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION ));
        
          if(!$tmp_name1){
              $errors['image1'] = 'Please upload products image...';
          }else{
              $new_img1 = time().$real_name1;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
            
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			  
			  if($path1 && file_exists('../'.$path1)){
			  	unlink('../'.$path1);
			  }
			
			  $path1 = $dir.'/'.$new_img1;
		
			  move_uploaded_file($tmp_name1, '../'.$path1);
          }
			

        
       
			$getImageExtension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION ));
			
        
            if(!$tmp_name2){
              $errors['image2'] = 'Please upload products image...';
            }else{
              $new_img2 = time().$real_name2;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
           
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			
			  if($path2 && file_exists('../'.$path2)){
			  	unlink('../'.$path2);
			  }
			
			  $path2 = $dir.'/'.$new_img2;
		
			  move_uploaded_file($tmp_name2, '../'.$path2);  
            }
			
			
			
		
        
        
			$getImageExtension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION ));
        
            if(!$tmp_name3){
              $errors['image3'] = 'Please upload products image...';
            }else{
                $new_img3 = time().$real_name3;
			
			    $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
			
			    $dir = 'images/products_img';
			    if(!file_exists('../'.$dir)){
			    	mkdir('../'.$dir);
			    }
			
			    if($path3 && file_exists('../'.$path3)){
			    	unlink('../'.$path3);
			    }
			
			    $path3 = $dir.'/'.$new_img3;
		
			    move_uploaded_file($tmp_name3, '../'.$path3);    
            }
			
			
			
			
		
        
     
			
		
        
        
        
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors
			];
		}
        
        
        
		
        $success = [];
		
		$slug = str_replace('', '-',strtolower($name));
		
        $NAME = $connection->real_escape_string($name);
        $DETAILS3 = $connection->real_escape_string($details3);
        
        
		$sql_update = "UPDATE currenwatchproduct SET name='$NAME', model='$model', brand='$brand', sku='$sku', image1='$new_img1',image2='$new_img2',image3='$new_img3', details='$DETAILS3', price='$price' WHERE id='$Update_product_id'";
		
		$result = $connection->query($sql_update);
        
		
		if($connection->error){
			die('Table Error: '.$connection->error);
		}
        #print_r($result);
       
        $success['success'] = 'Product updated successfully!';
		
		return [
				'status' => 'success',
				'message' => $success
		];
    }
    
    
    public function Delete_Curren_Product(){
           $Product_id = $_POST['DeletedID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM currenwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_product_query);
           print_r($result);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $Delete_product = "DELETE FROM currenwatchproduct WHERE id='$Product_id'";
    
               $result = $connection->query($Delete_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               if(file_exists('../images/products_img/'.$getData['image'])){
                   unlink('../images/products_img/'.$getData['image']);
               }
               
               $success['success'] = 'Deleted successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
     public function Curren_Product_status(){
           $status_id = $_POST['statusID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM currenwatchproduct WHERE id='$status_id'";
    
           $result = $connection->query($view_product_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           $getdata = $result->fetch_assoc();
           $status = $getdata['status'] == 0? 1: 0;       
        
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $update_product = "UPDATE currenwatchproduct SET status ='$status' WHERE id='$status_id'";
    
               $result = $connection->query($update_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               
               $success['success'] = 'Status updated successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
    
    public function Megir_index(){
         $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM megirwatchproduct";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
    }
    
    
    public function Megir_Product_add(){
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details4 = $_POST['details4'];
        
        
      
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
       $errors = [];
        if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
       
        if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
        
        $connection = $this->connection;
        $sku_sql_view = "SELECT * FROM megirwatchproduct WHERE sku='$sku'";
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU doesnot exists';
        }
        
       
         if(strlen($details4) == 0){
             $errors['details4'] = 'Please insert details ...'; 
         }else{
              if(strlen($details4) < 10 || strlen($details4) > 1000){
                 $errors['details4'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
       
        
               
        
        
         $get_image_extension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name1){
            $errors['image1'] = 'Please upload products image ...';
        }else{
            $new_image1 = time().$real_name1;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
           
       
        
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
            
            move_uploaded_file($tmp_name1, $dir_path.'/'.$new_image1); 
             
        }
       
        
        
        
        
          $get_image_extension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name2){
            $errors['image2'] = 'Please upload products image ...';
        }else{
            $new_image2 = time().$real_name2;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
          
        
        
            
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
        
            move_uploaded_file($tmp_name2, $dir_path.'/'.$new_image2); 
        }
       
        
        
        
        
        
        
          $get_image_extension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
         if(!$tmp_name3){
            $errors['image3'] = 'Please upload products image ...';
        }else{
             $new_image3 = time().$real_name3;
             $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
       
           
        
        
             $dir_path = '../images/products_img';
    
             if(!file_exists($dir_path)){
                 mkdir($dir_path);
             }
        
            move_uploaded_file($tmp_name3, $dir_path.'/'.$new_image3); 
         }
       
        
        
        
        
        
        
       
           if(count($errors) > 0){
             return[
                'status' => 'error',
                'message' => $errors
             ]; 
          }
          
           $success = []; 
           
    
            $NAME = $connection->real_escape_string($name);    
           $DETAILS4 = $connection->real_escape_string($details4);
        
           $insert_products_query = "INSERT INTO megirwatchproduct(name, model, brand, sku, image1, image2, image3, details, price)VALUES('$NAME', '$model','$brand','$sku','$new_image1','$new_image2','$new_image3','$DETAILS4','$price')";
        
           $result = $connection->query($insert_products_query);
           
           if($connection->error){
               die('Table Error:'.$connection->error);
           }
            
        
          $success['success'] = 'Product saved successfully!';
               
          return[
           'status' => 'success',
           'message' => $success
          ]; 
           
    }
    
    
    public function Megir_Product_edit(){
      $Update_product_id = $_POST['update_product_id'];   
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details4 = $_POST['details4'];
      
      
        
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
		$errors = [];
		
		if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
        
        
         if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
        $connection = $this->connection;
        
         $sku_sql_view = "SELECT * FROM megirwatchproduct WHERE id!='$Update_product_id' and sku='$sku'";
            
        #print_r($sku_sql_view);
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        #print_r($result);
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU already exists';
        }
        
        
         if(strlen($details4) == 0){
             $errors['details4'] = 'Please insert details ...'; 
         }else{
              if(strlen($details4) < 10 || strlen($details4) > 1000){
                 $errors['details4'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
		
       
        
		
		$getEditData = $result->fetch_assoc();
		$path1 = $getEditData['image1'];
        $path2 = $getEditData['image2'];
        $path3 = $getEditData['image3'];
       
        
       
        
	
			$getImageExtension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION ));
        
          if(!$tmp_name1){
              $errors['image1'] = 'Please upload products image...';
          }else{
              $new_img1 = time().$real_name1;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
            
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			  
			  if($path1 && file_exists('../'.$path1)){
			  	unlink('../'.$path1);
			  }
			
			  $path1 = $dir.'/'.$new_img1;
		
			  move_uploaded_file($tmp_name1, '../'.$path1);
          }
			

        
       
			$getImageExtension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION ));
			
        
            if(!$tmp_name2){
              $errors['image2'] = 'Please upload products image...';
            }else{
              $new_img2 = time().$real_name2;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
           
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			
			  if($path2 && file_exists('../'.$path2)){
			  	unlink('../'.$path2);
			  }
			
			  $path2 = $dir.'/'.$new_img2;
		
			  move_uploaded_file($tmp_name2, '../'.$path2);  
            }
			
			
			
		
        
        
			$getImageExtension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION ));
        
            if(!$tmp_name3){
              $errors['image3'] = 'Please upload products image...';
            }else{
                $new_img3 = time().$real_name3;
			
			    $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
			
			    $dir = 'images/products_img';
			    if(!file_exists('../'.$dir)){
			    	mkdir('../'.$dir);
			    }
			
			    if($path3 && file_exists('../'.$path3)){
			    	unlink('../'.$path3);
			    }
			
			    $path3 = $dir.'/'.$new_img3;
		
			    move_uploaded_file($tmp_name3, '../'.$path3);    
            }
			
			
			
			
		
        
     
			
		
        
        
        
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors
			];
		}
        
        
        
		
        $success = [];
		
		$slug = str_replace('', '-',strtolower($name));
		
        $NAME = $connection->real_escape_string($name);
        $DETAILS4 = $connection->real_escape_string($details4);
        
        
		$sql_update = "UPDATE megirwatchproduct SET name='$NAME', model='$model', brand='$brand', sku='$sku', image1='$new_img1',image2='$new_img2',image3='$new_img3', details='$DETAILS4', price='$price' WHERE id='$Update_product_id'";
		
		$result = $connection->query($sql_update);
        
		
		if($connection->error){
			die('Table Error: '.$connection->error);
		}
        #print_r($result);
       
        $success['success'] = 'Product updated successfully!';
		
		return [
				'status' => 'success',
				'message' => $success
		];
    }
    
    
    
    public function Delete_Megir_Product(){
           $Product_id = $_POST['DeletedID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM megirwatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_product_query);
           print_r($result);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $Delete_product = "DELETE FROM megirwatchproduct WHERE id='$Product_id'";
    
               $result = $connection->query($Delete_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               if(file_exists('../images/products_img/'.$getData['image'])){
                   unlink('../images/products_img/'.$getData['image']);
               }
               
               $success['success'] = 'Deleted successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
     public function Megir_Product_status(){
           $status_id = $_POST['statusID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM megirwatchproduct WHERE id='$status_id'";
    
           $result = $connection->query($view_product_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           $getdata = $result->fetch_assoc();
           $status = $getdata['status'] == 0? 1: 0;       
        
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $update_product = "UPDATE megirwatchproduct SET status ='$status' WHERE id='$status_id'";
    
               $result = $connection->query($update_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               
               $success['success'] = 'Status updated successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
    public function Mreurio_index(){
         $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM mreuriowatchproduct";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
    }
    
    
    public function Mreurio_Product_add(){
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details5 = $_POST['details5'];
        
        
      
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
       $errors = [];
        if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
    
        if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
         
        
        $connection = $this->connection;
        $sku_sql_view = "SELECT * FROM mreuriowatchproduct WHERE sku='$sku'";
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU doesnot exists';
        }
        
       
         if(strlen($details5) == 0){
             $errors['details5'] = 'Please insert details ...'; 
         }else{
              if(strlen($details5) < 10 || strlen($details5) > 1000){
                 $errors['details5'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
       
        
               
        
        
         $get_image_extension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name1){
            $errors['image1'] = 'Please upload products image ...';
        }else{
            $new_image1 = time().$real_name1;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
           
       
        
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
            
            move_uploaded_file($tmp_name1, $dir_path.'/'.$new_image1); 
             
        }
       
        
        
        
        
          $get_image_extension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name2){
            $errors['image2'] = 'Please upload products image ...';
        }else{
            $new_image2 = time().$real_name2;
            $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
        
          
        
        
            
            $dir_path = '../images/products_img';
        
            if(!file_exists($dir_path)){
                mkdir($dir_path);
            }
        
            move_uploaded_file($tmp_name2, $dir_path.'/'.$new_image2); 
        }
       
        
        
        
        
        
        
          $get_image_extension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
         if(!$tmp_name3){
            $errors['image3'] = 'Please upload products image ...';
        }else{
             $new_image3 = time().$real_name3;
             $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
       
           
        
        
             $dir_path = '../images/products_img';
    
             if(!file_exists($dir_path)){
                 mkdir($dir_path);
             }
        
            move_uploaded_file($tmp_name3, $dir_path.'/'.$new_image3); 
         }
       
        
        
        
        
        
        
       
           if(count($errors) > 0){
             return[
                'status' => 'error',
                'message' => $errors
             ]; 
          }
          
           $success = []; 
           
    
            $NAME = $connection->real_escape_string($name);    
           $DETAILS5 = $connection->real_escape_string($details5);
        
           $insert_products_query = "INSERT INTO mreuriowatchproduct(name, model, brand, sku, image1, image2, image3, details, price)VALUES('$NAME', '$model','$brand','$sku','$new_image1','$new_image2','$new_image3','$DETAILS5','$price')";
        
           $result = $connection->query($insert_products_query);
           
           if($connection->error){
               die('Table Error:'.$connection->error);
           }
            
        
          $success['success'] = 'Product saved successfully!';
               
          return[
           'status' => 'success',
           'message' => $success
          ]; 
           
    }
    
    
    public function Mreurio_Product_edit(){
      $Update_product_id = $_POST['update_product_id'];   
      $name = $_POST['name'];
      $model = $_POST['model'];
      $brand = $_POST['brand'];
      $sku = $_POST['sku'];
      $price = $_POST['price'];
      $details5 = $_POST['details5'];
      
      
        
      $tmp_name1 = $_FILES['image1']['tmp_name'];
      $real_name1 = $_FILES['image1']['name'];
      $img_size1 = $_FILES['image1']['size'];
      
        
      $tmp_name2 = $_FILES['image2']['tmp_name'];
      $real_name2 = $_FILES['image2']['name'];
      $img_size2 = $_FILES['image2']['size'];
        
        
      $tmp_name3 = $_FILES['image3']['tmp_name'];
      $real_name3 = $_FILES['image3']['name'];
      $img_size3 = $_FILES['image3']['size'];
        
        
     
		$errors = [];
		
		if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
        if(strlen($brand) == 0){
              $errors['brand'] = 'Please insert brand ...'; 
          }else{
            if(strlen($brand) < 5){
              $errors['$brand'] = 'Minimum 5 characters required ...'; 
            }    
        }
        
         if(strlen($model) == 0){
              $errors['model'] = 'Please insert model ...'; 
          }else{
              if(strlen($model) < 5){
                  $errors['model'] = 'Minimum 5 characters required ...'; 
              }
         }
        
         if(strlen($sku) < 5){
              $errors['sku'] = 'Please insert sku ...'; 
          }else{
             if(strlen($sku) < 8 || strlen($sku) > 16){
                 $errors['sku'] = '8-16 characters required ...'; 
             }
         }
        
         if(strlen($price) == 0){
              $errors['price'] = 'Please insert product price ...'; 
          }else{
              if(strlen($price) > 50){
                 $errors['price'] = 'character exceeds ...'; 
             }
         }
        $connection = $this->connection;
        
         $sku_sql_view = "SELECT * FROM mreuriowatchproduct WHERE id!='$Update_product_id' and sku='$sku'";
            
        #print_r($sku_sql_view);
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        #print_r($result);
        if($result->num_rows > 0){
            $errors['sku'] = 'SKU already exists';
        }
        
        
         if(strlen($details5) == 0){
             $errors['details5'] = 'Please insert details ...'; 
         }else{
              if(strlen($details5) < 10 || strlen($details5) > 1000){
                 $errors['details5'] = 'Details should be in between 10-1000  characters ...'; 
              }
         }
		
       
        
		
		$getEditData = $result->fetch_assoc();
		$path1 = $getEditData['image1'];
        $path2 = $getEditData['image2'];
        $path3 = $getEditData['image3'];
       
        
       
        
	
			$getImageExtension1 = strtolower(pathinfo($real_name1, PATHINFO_EXTENSION ));
        
          if(!$tmp_name1){
              $errors['image1'] = 'Please upload products image...';
          }else{
              $new_img1 = time().$real_name1;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
            
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			  
			  if($path1 && file_exists('../'.$path1)){
			  	unlink('../'.$path1);
			  }
			
			  $path1 = $dir.'/'.$new_img1;
		
			  move_uploaded_file($tmp_name1, '../'.$path1);
          }
			

        
       
			$getImageExtension2 = strtolower(pathinfo($real_name2, PATHINFO_EXTENSION ));
			
        
            if(!$tmp_name2){
              $errors['image2'] = 'Please upload products image...';
            }else{
              $new_img2 = time().$real_name2;
			
			  $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
           
			
			  $dir = 'images/products_img';
			  if(!file_exists('../'.$dir)){
			  	mkdir('../'.$dir);
			  }
			
			  if($path2 && file_exists('../'.$path2)){
			  	unlink('../'.$path2);
			  }
			
			  $path2 = $dir.'/'.$new_img2;
		
			  move_uploaded_file($tmp_name2, '../'.$path2);  
            }
			
			
			
		
        
        
			$getImageExtension3 = strtolower(pathinfo($real_name3, PATHINFO_EXTENSION ));
        
            if(!$tmp_name3){
              $errors['image3'] = 'Please upload products image...';
            }else{
                $new_img3 = time().$real_name3;
			
			    $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
			
			    $dir = 'images/products_img';
			    if(!file_exists('../'.$dir)){
			    	mkdir('../'.$dir);
			    }
			
			    if($path3 && file_exists('../'.$path3)){
			    	unlink('../'.$path3);
			    }
			
			    $path3 = $dir.'/'.$new_img3;
		
			    move_uploaded_file($tmp_name3, '../'.$path3);    
            }
			
			
			
			
		
        
     
			
		
        
        
        
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors
			];
		}
        
        
        
		
        $success = [];
		
		$slug = str_replace('', '-',strtolower($name));
		
        $NAME = $connection->real_escape_string($name);
        $DETAILS5 = $connection->real_escape_string($details5);
        
        
		$sql_update = "UPDATE mreuriowatchproduct SET name='$NAME', model='$model', brand='$brand', sku='$sku', image1='$new_img1',image2='$new_img2',image3='$new_img3', details='$DETAILS5', price='$price' WHERE id='$Update_product_id'";
		
		$result = $connection->query($sql_update);
        
		
		if($connection->error){
			die('Table Error: '.$connection->error);
		}
        #print_r($result);
       
        $success['success'] = 'Product updated successfully!';
		
		return [
				'status' => 'success',
				'message' => $success
		];
    }
    
         
    public function Delete_Mreurio_Product(){
           $Product_id = $_POST['DeletedID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM mreuriowatchproduct WHERE id='$Product_id'";
    
           $result = $connection->query($view_product_query);
           print_r($result);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $Delete_product = "DELETE FROM mreuriowatchproduct WHERE id='$Product_id'";
    
               $result = $connection->query($Delete_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               if(file_exists('../images/products_img/'.$getData['image'])){
                   unlink('../images/products_img/'.$getData['image']);
               }
               
               $success['success'] = 'Deleted successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
    
     public function Mreurio_Product_status(){
           $status_id = $_POST['statusID'];
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_product_query = "SELECT * FROM mreuriowatchproduct WHERE id='$status_id'";
    
           $result = $connection->query($view_product_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           $getdata = $result->fetch_assoc();
           $status = $getdata['status'] == 0? 1: 0;       
        
           if($result->num_rows == 1){
               $getData = $result->fetch_assoc();
               $update_product = "UPDATE mreuriowatchproduct SET status ='$status' WHERE id='$status_id'";
    
               $result = $connection->query($update_product);
    
               if($connection->error){
                   die('Table Error:'.$connection->error);
               }   
               
               
               $success['success'] = 'Status updated successfully!';
     
               return[
                   'status' => 'success',
                   'message' => $success
               ];
     
           }
     
           
 }
    
    
    
     public function targetskmeiData($sku){
           
           #$sku = $_GET['sku'];
        
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM skmeiwatchproduct WHERE sku='$sku'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 0){
               header('Location:skmeiwatchproduct.php');
           }
        
        
           return $result->fetch_assoc();
     
           
 }
    
    
     public function targetbinbondData($sku){
           
           #$sku = $_GET['sku'];
        
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM binbondwatchproduct WHERE sku='$sku'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 0){
               header('Location:binbondwatchproduct.php');
           }
        
        
           return $result->fetch_assoc();
     
           
 }
    
    
    
    public function targetcurrenData($sku){
           
           #$sku = $_GET['sku'];
        
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM currenwatchproduct WHERE sku='$sku'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 0){
               header('Location:currenwatchproducts.php');
           }
        
        
           return $result->fetch_assoc();
     
           
 }
    
    
     public function targetmegirData($sku){
           
           #$sku = $_GET['sku'];
        
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM megirwatchproduct WHERE sku='$sku'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 0){
               header('Location:megirwatchproducts.php');
           }
        
        
           return $result->fetch_assoc();
     
           
 }
    
    
     public function targetmreurioData($sku){
           
           #$sku = $_GET['sku'];
        
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM mreuriowatchproduct WHERE sku='$sku'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 0){
               header('Location:mreuriowatchproducts.php');
           }
        
        
           return $result->fetch_assoc();
     
           
 }
    

}



?>