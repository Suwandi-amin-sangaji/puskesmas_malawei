<?php 
include "../config/koneksi.php";
isset($_GET['no_rekamedis']);
$no_rekamedis = $_GET['no_rekamedis'];
$sql= "DELETE FROM tb_pasien where no_rekamedis='$no_rekamedis'";
$query = mysqli_query($koneksi, $sql);

if($query){
    echo "<script>alert('Data berhasil Dihapus.');window.location='data_pasien';</script>";
}else{
    die("akses dilarang");
}
?>