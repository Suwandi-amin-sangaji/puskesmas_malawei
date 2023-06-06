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
    $sql = "INSERT INTO tb_obat (kode_obat, nama_obat,jenis_obat,dosis_aturan_obat,satuan) VALUES ('$kode_obat', '$nama_obat','$jenis_obat','$dosis_aturan_obat','$satuan')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil Tambah.');window.location='data_obat';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
$koneksi->close();
?>


<div class="content-wrapper container">
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Data Obat</h3>
                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="kode_obat">Kode Obat</label>
                                    <input type="text" id="kode_obat" class="form-control" placeholder="Kode Obat" name="kode_obat" maxlength="5" oninput="checkInputLength()">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama_obat">Nama Obat</label>
                                    <input type="text" id="nama_obat" class="form-control" placeholder="Nama Obat" name="nama_obat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="jenis_obat">Jenis Obat</label>
                                    <input type="text" id="jenis_obat" class="form-control" placeholder="Jenis Obat" name="jenis_obat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="dosis_aturan_obat">Dosis/Aturan</label>
                                    <input type="text" id="dosis_aturan_obat" class="form-control" placeholder="Dosis/Aturan" name="dosis_aturan_obat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" id="satuan" class="form-control" placeholder="Satuan" name="satuan">
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

<script>
  function checkInputLength() {
    var input = document.getElementById("kode_obat");
    var value = input.value;
    
    if (value.length > 5) {
      alert("Kode Obat tidak boleh lebih dari 5 karakter!");
      input.value = value.slice(0, 5); // Truncate the input value to the first 5 characters
    }
  }
</script>
<?php include "include/footer.php" ?>