<?php
session_start();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  require_once "../config/koneksi.php";

  // Get the current date
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // SQL statement to retrieve the number of queues from the "tb_antrian" table based on the current date
  $query = mysqli_query($koneksi, "SELECT COUNT(id) AS jumlah FROM tbl_antrian WHERE tanggal = '$tanggal'")
            or die('Ada kesalahan pada query tampil data: ' . mysqli_error($koneksi));

  // Fetch the data from the query result
  $data = mysqli_fetch_assoc($query);

  // Retrieve the number of queues
  $jumlah_antrian = $data['jumlah'];

  // Return the number of queues as the response
  echo number_format($jumlah_antrian, 0, '', '.');
}
?>
