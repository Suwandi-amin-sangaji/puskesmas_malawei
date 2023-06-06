<?php 
include "../config/koneksi.php";
isset($_GET['kode_obat']);
$kode_obat = $_GET['kode_obat'];
$sql= "DELETE FROM tb_obat where kode_obat='$kode_obat'";
$query = mysqli_query($koneksi, $sql);

if($query){
    echo "<script>alert('Data berhasil Dihapus.');window.location='data_obat';</script>";
}else{
    die("akses dilarang");
}
?>