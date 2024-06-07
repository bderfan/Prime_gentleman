<?php
    function db_connection(){
      $hostname = 'localhost';
      $username = 'root';
      $password = '';
      $database = 'prime_watch';


      $connection = mysqli_connect($hostname, $username, $password, $database);

      if(!$connection){
          die("Database error: ".mysqli_connect_error($connection));
      }

      return $connection;
      }
?>