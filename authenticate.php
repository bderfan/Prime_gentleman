<!DOCTYPE html>
<html>
<head>
  <title>Authentication page</title>
</head>
<body>

<div>
     
<?php
#Post method
  require('database.php');
     


     
function login(){
          
          $email = $_POST['email'];
          $password = $_POST['password'];
          $remember = isset($_POST['remember_check'])? true:false;
     
          $errors = [];
    
         
           
           

           $connection = db_connection();
           $sql_view = "SELECT * FROM customer_registration WHERE email='$email' and password='$password'";
    
           $result = mysqli_query($connection, $sql_view);
           //print_r($result);
          
           if(mysqli_error($connection)){
               die('Table error:'.mysqli_error($connection));
           }
    
           
    
           if(strlen($email) == 0){
               $errors['email'] = 'Empty Email';
           }else{
              if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                      $errors['email'] = 'Invalid Email';
               
                }else if(strlen($password) == 0){
                   $errors['password'] = 'Empty Password';
                }else{
                    if($result->num_rows == 0){
                        $errors['password'] = "Email/password doesn't match";
                    } 
                } 
           }
           
            
 
           if(count($errors) > 0){
                return[
                   'status' => 'error',
                   'message' => $errors
               ];
           }       
    
           $_SESSION['authenticate']= mysqli_fetch_assoc($result);
           //print_r($_SESSION['authenticate']);
           //return true;
           
          
           if($remember){
                setcookie('email',$email, time()+(60), '/');
                setcookie('password',$password, time()+(60), '/');
            }else{
                setcookie('email','', 0, '/');
                setcookie('password','', 0, '/');
           }
                
           header('Location:customer_dashboard/profile.php');    
           
           
              
}
   
   
     
function New_user(){
          $name = $_POST['name'];
          $phone_no = $_POST['number'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $confirm_password = $_POST['confirm_password'];
          $date_of_birth = $_POST['birthday'];
          $city = $_POST['city'];
     
          $errors = [];

          if(strlen($name) == 0){
              $errors['name'] = 'Please insert your name ...';
          }else{
               if(strlen($name) > 50 || str_word_count($name) < 2){
                   $errors['name'] = 'Your name can not exceed 50 characters and not less than 2 words ...'; 
               }
          }
         
          if(strlen($phone_no) == 0){
              $errors['number'] = 'Please give your phone number ...';
          }else{
              if(strlen($phone_no) > 30){
                  $errors['number'] = 'Your digit of input phone number can not exceed 30 digits ...';
              }
          }
          
          if(strlen($email) == 0){
              $errors['email'] = 'Please input email address ...';
          }else{
              if(strlen($email) > 50){
                  $errors['email'] = 'Your email address can not exceed 50 characters ...';
              }
          }
          if(strlen($password) == 0){
              $errors['password'] = 'Please insert password ...';
          }else{
               if(strlen($password) >100){
                   $errors['password'] = 'Your password can not exceed 100 characters ...';
               } 
          }
          if(strlen($confirm_password) == 0){
              $errors['confirm_password'] = 'Your confirm password field can not be empty ...';
          }
          if($password != $confirm_password){
              $errors['confirm_password'] = 'Password is not matched ...';
          }
          if(strlen($city) == 0){
              $errors['city'] = 'Please give your city ...';
          }else{
                if(strlen($city) > 30){
                     $errors['city'] = 'Can not more than 30 characters';
                 }
          }

          if(strlen($date_of_birth) == 0){
              $errors['birthday'] = 'Please give your birth of date ...';
          }else{
                 if(strlen($date_of_birth) > 30){
                     $errors['birthday'] = 'Can not more than 30 characters';
                 }
          }
       
          
        
           
           if(count($errors) > 0){
                return[
                   'status' => 'error',
                   'message' => $errors
               ];
           }
    
           $success = [];
           $Connection = db_connection();
           //print_r($Connection);
    
           $insert_query = "INSERT INTO customer_registration(name, email, password, phone_number, date_of_birth, city) VALUES('$name','$email','$password','$phone_no','$date_of_birth','$city')";
    
           $result = mysqli_query($Connection,$insert_query);
    
           if(mysqli_error($Connection)){
               die('Table Error:'.mysqli_error($Connection));
           }else{
               $success['sucess'] = 'Data Saved Successfully!';
           }
            
           return[
               'status' => 'success',
               'message' => $success
           ];
    
          
           
              
}

     
function update_user(){
          $name = $_POST['Name'];
          $Password = $_POST['Password'];
          $Phone_no = $_POST['Phone_no'];
          $Birthday = $_POST['Birthday'];
          $City = $_POST['City'];
          $email = $_SESSION['authenticate']['email'];
          
    
         
    
          $errors = [];
    
    
          $tmp_name = $_FILES['img_upload']['tmp_name'];
          $real_name = $_FILES['img_upload']['name'];
          $img_size = $_FILES['img_upload']['size'];
          
          
         
          if($tmp_name){
              $get_image_extension = strtolower(pathinfo($real_name, PATHINFO_EXTENSION));
              //echo $get_image_extension;

              $target_extension = ['jpg', 'jpeg', 'png', 'gif'];
    
              if(!in_array($get_image_extension, $target_extension)){
                  $errors['img_upload'] = 'File format should be jpg/jpeg/png/gif';
              }
              if($img_size > 1048576){
                  $errors['img_upload'] = 'File size can not be larger than 1Mb';
              }
          }
          
          
          if(count($errors) > 0){
                return[
                   'status' => 'error',
                   'message' => $errors
               ];
           }  
    
          
              
           $success = [];
           $connection = db_connection();

           $customer_view = "SELECT * FROM customer_registration WHERE email='$email'";  
           
           $result = mysqli_query($connection, $customer_view);
         
           if(mysqli_error($connection)){
               die('Table Error:'.mysqli_error($connection));
           }
    
           $customerdata = mysqli_fetch_assoc($result);
           $path = $customerdata['image'];
    
          if($tmp_name){
              $dir_path = '../images/profile_image';
    
              if(!file_exists($dir_path)){
                  mkdir($dir_path);
              }
              $new_image = time().$_SESSION['authenticate']['name'].'.'.$get_image_extension;
              
              if($path){
                  if(file_exists($dir_path.'/'.$path)){
                      unlink($dir_path.'/'.$path);
                  }
              }
              move_uploaded_file($tmp_name, $dir_path.'/'.$new_image);
              
              $path = $new_image;
          }
          
            
           //print_r($Connection);
    
         
    
           $update_customerdata = "UPDATE customer_registration SET name='$name', password='$Password', phone_number='$Phone_no', image='$path', date_of_birth='$Birthday', city='$City' WHERE email='$email'";
    
    
           $result = mysqli_query($connection, $update_customerdata);
         
            if(mysqli_error($connection)){
               die('Table Error:'.mysqli_error($connection));
           } 
           
           
           $customerdata_view = "SELECT * FROM customer_registration WHERE email='$email'";  
           
           $result = mysqli_query($connection, $customerdata_view);
         
           if(mysqli_error($connection)){
               die('Table Error:'.mysqli_error($connection));
           }
    
           $_SESSION['authenticate'] = mysqli_fetch_assoc($result);

    
          $success['success'] = 'Data updated successfully!';
                
            
           
            return[
               'status' => 'success',
               'message' => $success
           ];
    
            
              
           
}



function admin_login(){
          
          $user_name = $_POST['user_name'];
          $password = $_POST['password'];
          $remember = isset($_POST['remember_check'])? true:false;
     
          $errors = [];
    
         
          

           $connection = db_connection();
           $sql_view = "SELECT * FROM admin_registration WHERE user_name='$user_name' and password='$password'";
    
           $result = mysqli_query($connection, $sql_view);
           //print_r($result);
          
           if(mysqli_error($connection)){
               die('Table error:'.mysqli_error($connection));
           }
    
           
    
           if(strlen($user_name) == 0){
               $errors['user_name'] = 'Empty User Name';
           }else{
                  if(strlen($password) == 0){
                     $errors['password'] = 'Empty Password';
                  }else{
                    if($result->num_rows == 0){
                        $errors['password'] = "User name/password doesn't match";
                    }   
                  }
             
           }
           
           
           if(count($errors) > 0){
                return[
                   'status' => 'error',
                   'message' => $errors
               ];
           }       
    
           $_SESSION['authenticate']= mysqli_fetch_assoc($result);
           //print_r($_SESSION['authenticate']);
           //return true;
           
          
           if($remember){
                setcookie('user_name',$user_name, time()+(60), '/');
                setcookie('password',$password, time()+(60), '/');
            }else{
                setcookie('user_name','', 0, '/');
                setcookie('password','', 0, '/');
           }
                
           header('Location:admin_dashboard/dashboard.php');    
           
           
              
}
   
   
     
function New_admin(){
          $user_name = $_POST['user_name'];
          $password = $_POST['password'];
          $confirm_password = $_POST['confirm_password'];
        
          $errors = [];

          
         
          
          if(strlen($user_name) == 0){
              $errors['user_name'] = 'Please input user name ...';
          }else{
              if(strlen($user_name) > 30){
                  $errors['user_name'] = 'Your user name can not exceed 30 characters ...';
              }
          }
          if(strlen($password) == 0){
              $errors['password'] = 'Please insert password ...';
          }else{
               if(strlen($password) >100){
                   $errors['password'] = 'Your password can not exceed 100 characters ...';
               } 
          }
          if(strlen($confirm_password) == 0){
              $errors['confirm_password'] = 'Your confirm password field can not be empty ...';
          }else{
              if($password != $confirm_password){
                  $errors['confirm_password'] = 'Password is not matched ...';
              }    
          }
          
          
        
           
           if(count($errors) > 0){
                return[
                   'status' => 'error',
                   'message' => $errors
               ];
           }
    
           $success = [];
           $Connection = db_connection();
           //print_r($Connection);
    
           $insert_query = "INSERT INTO admin_registration(user_name, password) VALUES('$user_name','$password')";
    
           $result = mysqli_query($Connection,$insert_query);
    
           if(mysqli_error($Connection)){
               die('Table Error:'.mysqli_error($Connection));
           }else{
               $success['sucess'] = 'Data Saved Successfully!';
           }
            
           return[
               'status' => 'success',
               'message' => $success
           ];
    
          
           
              
} 

     
?>
     
     
 </div>
</body>
</html>