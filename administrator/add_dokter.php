<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
if (isset($_POST['submit'])) {
    $kode_dokter = $_POST['kode_dokter'];
    $nama_dokter = $_POST['nama_dokter'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_induk_dokter = $_POST['nomor_induk_dokter'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $id_poli = $_POST['id_poli'];
    $sql = "INSERT INTO tb_dokter (kode_dokter, nama_dokter,jenis_kelamin,nomor_induk_dokter,tempat_lahir,tgl_lahir,alamat,id_poli) VALUES ('$kode_dokter', '$nama_dokter','$jenis_kelamin','$nomor_induk_dokter','$tempat_lahir','$tgl_lahir','$alamat','$id_poli')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data Dokter Berhasil Tambah !!!');window.location='data_dokter';</script>";
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
                    <h3>Tambah Data Dokter</h3>
                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="kode_obat">Kode Dokter</label>
                                    <input type="text" id="kode_dokter" class="form-control" placeholder="Kode Dokter" name="kode_dokter" maxlength="5" oninput="checkInputLength()">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama_dokter">Nama Dokter</label>
                                    <input type="text" id="nama_dokter" class="form-control" placeholder="Nama Dokter" name="nama_dokter">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="basicSelect" name="jenis_kelamin">
                                            <option>--Jenis Kelamin--</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nomor_induk_dokter">Nomor Induk Dokter</label>
                                    <input type="text" id="nomor_induk_dokter" class="form-control" placeholder="nomor induk dokter" name="nomor_induk_dokter">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" class="form-control" placeholder="tempat_lahir" name="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" class="form-control" placeholder="tanggal lahir" name="tgl_lahir">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" placeholder="alamat" name="alamat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Poli:</label>
                                    <select class="form-control" name="id_poli" id="id_poli" required>
                                        <option value="">--Poli--</option>
                                        <?php
                                        include "../config/koneksi.php";
                                        $poli = mysqli_query($koneksi, "select * from tb_poli");
                                        while ($f = mysqli_fetch_array($poli)) {
                                        ?>
                                            <option value="<?php echo $f['id_poli'] ?>"><?php echo $f['nama_poli']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
        var input = document.getElementById("kode_dokter");
        var value = input.value;

        if (value.length > 5) {
            alert("Kode Obat tidak boleh lebih dari 5 karakter!");
            input.value = value.slice(0, 5); // Truncate the input value to the first 5 characters
        }
    }
</script>
<?php include "include/footer.php" ?>