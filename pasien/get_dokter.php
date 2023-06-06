<?php 
include "../config/koneksi.php";
$id_poli = $_POST['id_poli'];
$tampil=mysqli_query($koneksi,"SELECT * FROM tb_dokter WHERE id_poli='$id_poli'");
$jml=mysqli_num_rows($tampil);
 
if($jml > 0){    
    while($r=mysqli_fetch_array($tampil)){
        ?>
        <option value="<?php echo $r['kode_dokter'] ?>"><?php echo $r['nama_dokter'] ?></option>
        <?php        
    }
}else{
    echo "<option selected>- Data dokter Tidak Ada, Pilih Yang Lain -</option>";
}
 
?>
