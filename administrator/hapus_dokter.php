<?php 
include "../config/koneksi.php";
isset($_GET['kode_dokter']);
$kode_dokter = $_GET['kode_dokter'];
$sql= "DELETE FROM tb_dokter where kode_dokter='$kode_dokter'";
$query = mysqli_query($koneksi, $sql);

if($query){
    echo "<script>alert('Data berhasil Dihapus.');window.location='data_dokter';</script>";
}else{
    die("akses dilarang");
}
?>