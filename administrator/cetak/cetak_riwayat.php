<?php
include('../../config/koneksi.php');
require '../vendor/autoload.php';
// // // reference the Dompdf namespace
use Dompdf\Dompdf;
// // // instantiate and use the dompdf class
$dompdf = new Dompdf();
$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
  // Buat query untuk menampilkan semua data transaksi
  $query = "SELECT * FROM tb_pengeluaran_obat
     INNER JOIN tb_pendaftaran ON tb_pendaftaran.id_pendaftaran = tb_pengeluaran_obat.id_pendaftaran
     INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pendaftaran.user_id
     INNER JOIN tb_periksa ON tb_periksa.id_user = tb_pasien.id_user";
  $label = "Semua Data Transaksi";
} else { // Jika terisi
  // Buat query untuk menampilkan data transaksi sesuai periode tanggal
  $query = "SELECT * FROM tb_pengeluaran_obat  
    INNER JOIN tb_pendaftaran ON tb_pendaftaran.id_pendaftaran = tb_pengeluaran_obat.id_pendaftaran 
    INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pendaftaran.user_id
    INNER JOIN tb_periksa ON tb_periksa.id_user = tb_pasien.id_user
    WHERE (tgl_serah_obat BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
  $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
  $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
  $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
}
$label = empty($tgl_awal) && empty($tgl_akhir) ? "Semua Data Riwayat" : 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
// Header styles
$headerStyles = "
<style>
    .judul {
        margin-bottom: 0px;
        font-size: 16px;
        font-weight: bold;
    }
</style>
";

// Header content
$header = "
<div style='position: relative;'>
    <div style='position: absolute; top: 10px; left: 20px;'>
    <img class='img-responsive img' alt='Responsive image' src='../../assets/img/kes.jpeg' width='50px'>
    <img class='img-responsive img' alt='Responsive image' src='../../assets/img/sorong.png' width='50px'>
    </div>
    <div style='position: absolute; top: 10px; right: 30px;'>
   
    <img class='img-responsive img' alt='Responsive image' src='../../assets/img/logo.jpeg' width='50px'>    
    </div>
    <div style='text-align: center;'>
    <p style='font-family: Arial; font-size: 15px; text-transform: uppercase; margin-bottom: 5px;'><b>PEMERINTAH KOTA SORONG</b></p>
    <p style='font-family: Arial; font-size: 15px; text-transform: uppercase; margin-bottom: 5px;'><b>DINAS KESEHATAN KOTA SORONG</b></p>
    <p style='font-family: Arial; font-size: 10px; margin-bottom: 0;'><b>Malawei, Kecamatan Sorong Manoi, Kota Sorong, Papua Bar. 98412</b></p>
</div>

</div>
<hr style='border: 0.5px solid black; margin: 10px 5px 30px 5px;'>
";


// Table header
$tableHeader = "
<table border='1' width='100%'>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Pasien</th>
        <th>Kode Obat</th>
        <th>Nama Obat</th>
        <th>Dosis/Aturan</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>
";

// Table content
$tableContent = "";
$no = 1;

// Fetch data and populate table rows
$sql = mysqli_query($koneksi, $query); // Execute the query
$row = mysqli_num_rows($sql); // Get the number of rows from the query result

if ($row > 0) { // If there are rows (data exists)
  while ($data = mysqli_fetch_array($sql)) { // Fetch all data from the query result
    $tgl = date('d-m-Y', strtotime($data['tgl_serah_obat'])); // Convert the date format to dd-mm-yyyy
    $tableContent .= "<tr>
             <td>" . $no . "</td>
             <td>" . $tgl . "</td>
             <td>" . $data['nama_pasien'] . "</td>
             <td>" . $data['kode_obat'] . "</td>
             <td>" . $data['nama_obat'] . "</td>
             <td>" . $data['dosis_aturan_obat'] . "</td>
             <td>" . $data['jumlah'] . "</td>
             <td>" . $data['keterangan'] . "</td>
             </tr>";
    $no++;
  }
} else { // If there are no rows (no data)
  $tableContent .= "<tr><td colspan='8'>Data tidak ada</td></tr>";
}

// Close the table
$tableClose = "</table>";

// Combine all the content
$html = $headerStyles . $header . $tableHeader . $tableContent . $tableClose;

// Rest of the code for creating and outputting the PDF
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream("data Riwayat.pdf", array("Attachment" => 0));
