<?php 
include "../config/koneksi.php";
isset($_GET['id_poli']);
$id_poli = $_GET['id_poli'];
$sql= "DELETE FROM tb_poli where id_poli=$id_poli";
$query = mysqli_query($koneksi, $sql);

if($query){
    echo "<script>alert('Data berhasil Dihapus.');window.location='data_poli';</script>";
}else{
    die("akses dilarang");
}
?>