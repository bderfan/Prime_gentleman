<?php
error_reporting(E_ERROR | E_PARSE);
require_once('DATABASECLASS.php');
 
class BRANDCLASS extends DATABASECLASS{
  
   
    
    public function brand_index(){
         $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM brand";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           return $result;
    }
    
    
    public function brand_add(){
      $name = $_POST['name'];
     
        
        
      
      $tmp_name = $_FILES['image']['tmp_name'];
      $real_name = $_FILES['image']['name'];
      $img_size = $_FILES['image']['size'];
      
        
     
        
        
     
       $errors = [];
        if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
       
        
        
        $connection = $this->connection;
        $sku_sql_view = "SELECT * FROM brand";
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
        
        
    
        
               
        
        
         $get_image_extension = strtolower(pathinfo($real_name, PATHINFO_EXTENSION));
        //echo $get_image_extension;
        
        if(!$tmp_name){
            $errors['image'] = 'Please upload brands image...';
        }else{
           $new_image = time().$real_name;
           $target_extension = ['jpg', 'jpeg', 'png', 'gif']; 
       
        
           $dir_path = '../images/brands_img';
    
           if(!file_exists($dir_path)){
               mkdir($dir_path);
           }
        
           move_uploaded_file($tmp_name, $dir_path.'/'.$new_image);    
        }     
        
        
    
        
       
           if(count($errors) > 0){
             return[
                'status' => 'error',
                'message' => $errors
             ]; 
          }
          
           $success = []; 
           
    
    
        
           $insert_products_query = "INSERT INTO brand(name, image)VALUES('$name', '$new_image')";
        
           $result = $connection->query($insert_products_query);
           
           if($connection->error){
               die('Table Error:'.$connection->error);
           }
            
        
          $success['success'] = 'Brnad saved successfully!';
               
          return[
           'status' => 'success',
           'message' => $success
          ]; 
           
    }
    
    
    public function brand_edit(){
      $update_brand_id = $_POST['update_brand_id'];   
      $name = $_POST['name'];
    
      
        
      $tmp_name = $_FILES['image']['tmp_name'];
      $real_name = $_FILES['image']['name'];
      $img_size = $_FILES['image']['size'];
      
       
        
        
     
		$errors = [];
		
		if(strlen($name) == 0){
              $errors['name'] = 'Please insert name ...'; 
          }else{
            if(strlen($name) < 5 ){
              $errors['name'] = 'Minimum 5 characters required ...'; 
            }
        }
        
       
        
        $connection = $this->connection;
        
         $sku_sql_view = "SELECT * FROM brand WHERE id='$update_brand_id'";
            
        #print_r($sku_sql_view);
		
		$result = $connection->query($sku_sql_view);
		
		if($connection->error){
			   die('Table Error: '.$connection->error);
		}
       
        
        
       
        
		
		$getEditData = $result->fetch_assoc();
		$path = $getEditData['image'];
        
       
        
       
        
	
			$getImageExtension = strtolower(pathinfo($real_name, PATHINFO_EXTENSION ));
        
            if(!$tmp_name){
                $errors['image'] = 'Please upload brands image...';
            }else{
               $new_img = time().$real_name;
			
			   $targeted_extension = ['jpg', 'jpeg', 'png', 'gif'];
			
            
			   
			   $dir = 'images/products_img';
			   if(!file_exists('../'.$dir)){
			   	mkdir('../'.$dir);
			   }
			
			   if($path && file_exists('../'.$path)){
			   	unlink('../'.$path);
			   }
			
			   $path = $dir.'/'.$new_img;
		
			   move_uploaded_file($tmp_name, '../'.$path);
         
            }
			
			
        
        
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors
			];
		}
        
        
        
		
        $success = [];
		
		
        
        
		$sql_update = "UPDATE brand SET name='$NAME', image='$new_img' WHERE id='$update_brand_id'";
		
		$result = $connection->query($sql_update);
        
		
		if($connection->error){
			die('Table Error: '.$connection->error);
		}
        #print_r($result);
       
        $success['success'] = 'Brand updated successfully!';
		
		return [
				'status' => 'success',
				'message' => $success
		];
    }
    
    

    
     public function targetbrandData($id){
           
           #$sku = $_GET['sku'];
        
           $connection = $this->connection;
           //print_r($Connection);
    
           $view_products_query = "SELECT * FROM brand WHERE id='$id'";
    
           $result = $connection->query($view_products_query);
    
           if($connection->error){
               die('Table Error:'.$connection->error);
           }   
     
           if($result->num_rows == 0){
               header('Location:newbrand.php');
           }
        
        
           return $result->fetch_assoc();
     
           
 }
    
    
    

}



?>