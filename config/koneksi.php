<?php
  $servername = "localhost";
  $username = "root"; 
  $password = "root";
  $database = "db_puskesmas_malawei";
 
  // Create connection
  $koneksi = new mysqli($servername, $username, $password, $database); 
  // Check connection  
//   if ($koneksi->connect_error) 
//   {      
//      die("Failed to connect: " . $koneksi->connect_error);
//   }  
//    echo "Connected successfully";  
?>