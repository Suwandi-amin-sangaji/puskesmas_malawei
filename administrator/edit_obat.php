<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
if (isset($_POST['submit'])) {
    $kode_obat = $_POST['kode_obat'];
    $nama_obat = $_POST['nama_obat'];
    $jenis_obat = $_POST['jenis_obat'];
    $dosis_aturan_obat = $_POST['dosis_aturan_obat'];
    $satuan = $_POST['satuan'];
    $sql = "UPDATE tb_obat SET kode_obat = '$kode_obat', nama_obat = '$nama_obat', jenis_obat = '$jenis_obat',  dosis_aturan_obat = '$dosis_aturan_obat', satuan = '$satuan' WHERE kode_obat = '$kode_obat'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil Di Update.');window.location='data_obat';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
$koneksi->close();
?>


<?php 
  include "../config/koneksi.php";
  $kode_obat = $_GET['kode_obat'];
  $query = "SELECT * FROM tb_obat WHERE kode_obat = '$kode_obat' LIMIT 1";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_array($result);
?>



<div class="content-wrapper container">
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Data Obat</h3>
                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="kode_obat">Kode Obat</label>
                                    <input type="text" id="kode_obat" hidden class="form-control" value="<?= $row['kode_obat']?>" name="kode_obat" maxlength="5"">
                                    <input type="text" id="kode_obat" class="form-control" value="<?= $row['kode_obat']?>" name="kode_obat" maxlength="5" oninput="checkInputLength()">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama_obat">Nama Obat</label>
                                    <input type="text" id="nama_obat" class="form-control" value="<?= $row['nama_obat']?>" name="nama_obat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="jenis_obat">Jenis Obat</label>
                                    <input type="text" id="jenis_obat" class="form-control" value="<?= $row['jenis_obat']?>" name="jenis_obat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="dosis_aturan_obat">Dosis/Aturan</label>
                                    <input type="text" id="dosis_aturan_obat" class="form-control" value="<?= $row['dosis_aturan_obat']?>" name="dosis_aturan_obat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" id="satuan" class="form-control" value="<?= $row['satuan']?>" name="satuan">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include "include/footer.php" ?>