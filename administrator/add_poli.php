<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
if (isset($_POST['submit'])) {
    $nama_poli = $_POST['nama_poli'];
    $ruang_poli = $_POST['ruang_poli'];
    $sql = "INSERT INTO tb_poli (nama_poli, ruang_poli) VALUES ('$nama_poli', '$ruang_poli')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil Tambah.');window.location='data_poli';</script>";
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
                    <h3>Tambah Data Poli</h3>
                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama_poli">Nama Poli</label>
                                    <input type="text" id="nama_poli" class="form-control" placeholder="Nama Poli" name="nama_poli">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="ruang_poli">Ruang Poli</label>
                                    <input type="text" id="ruang_poli" class="form-control" placeholder="Ruang Poli" name="ruang_poli">
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