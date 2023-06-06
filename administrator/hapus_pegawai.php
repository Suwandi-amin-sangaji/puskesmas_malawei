<?php 
include "../config/koneksi.php";
isset($_GET['id_pegawai']);
$id_pegawai = $_GET['id_pegawai'];
$sql= "DELETE FROM tb_pegawai where id_pegawai='$id_pegawai'";
$query = mysqli_query($koneksi, $sql);

if($query){
    echo "<script>alert('Data berhasil Dihapus.');window.location='data_pegawai';</script>";
}else{
    die("akses dilarang");
}
?>