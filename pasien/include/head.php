<?php 
 session_start();
 include "../config/koneksi.php";
 if (!isset($_SESSION['id_user'])) {
  
  echo "<script>alert('Anda Harus Login');window.location='../login';</script>";
   exit();

 }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <link rel="stylesheet" href="assets/css/main/app.css">
  <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">

  <link rel="stylesheet" href="assets/css/shared/iconly.css">

<!-- DataTable -->
  <link rel="stylesheet" href="assets/css/pages/fontawesome.css">
  <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="assets/css/pages/datatables.css">


  <link rel="stylesheet" href="assets/extensions/choices.js/public/assets/styles/choices.css">

</head>

<body>