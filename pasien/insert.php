<?php
session_start();
include "../config/koneksi.php";

// Check if the registration number exists in the session
if (isset($_SESSION['no_registrasi'])) {
  $no_registrasi = $_SESSION['no_registrasi'];
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // Fetch the id_user from the session or any other source
  // Replace 'id_user' with the actual field name or source of the user ID
  $id_user = $_SESSION['id_user'];

  // Get the last queue number based on the date
  $query = mysqli_query($koneksi, "SELECT MAX(no_antrian) AS max_antrian FROM tbl_antrian WHERE tanggal = '$tanggal'");
  $data = mysqli_fetch_assoc($query);
  $no_antrian = $data['max_antrian'] + 1;

  // Insert data into the tb_antrian table
  $insert = mysqli_query($koneksi, "INSERT INTO tbl_antrian (id_user, no_registrasi, tanggal, no_antrian, status, updated_date) 
                                    VALUES ('$id_user', '$no_registrasi', '$tanggal', '$no_antrian', 'Belum Diproses', NOW())");

  if ($insert) {
    echo $no_antrian; // Send the queue number as a response to AJAX
  } else {
    echo "Failed to retrieve the queue number. Please try again.";
  }
} else {
  echo "Registration number is not available. Please register first.";
}
?>
