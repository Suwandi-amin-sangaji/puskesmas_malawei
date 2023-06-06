<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";

if (isset($_POST['submit'])) {
    $no_ktp = $_POST['no_ktp'];
    $nama_pasien = $_POST['nama_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $alamat = $_POST['alamat'];
    $status_pasien = $_POST['status_pasien'];

    $no_rekamedis = $_POST['no_rekamedis']; // Tambahkan variabel ini untuk menggunakan dalam kondisi WHERE

    $sql = "UPDATE tb_pasien SET no_rekamedis = '$no_rekamedis', no_ktp = '$no_ktp', nama_pasien = '$nama_pasien', jenis_kelamin = '$jenis_kelamin', tanggal_lahir = '$tanggal_lahir', tempat_lahir = '$tempat_lahir', alamat = '$alamat', status_pasien = '$status_pasien' WHERE no_rekamedis = '$no_rekamedis'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data Pasien Berhasil Di Update !!!');window.location='data_pasien';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

$koneksi->close();
?>


<?php
include "../config/koneksi.php";
$no_rekamedis = $_GET['no_rekamedis'];
$query = "SELECT * FROM tb_pasien WHERE no_rekamedis = '$no_rekamedis' LIMIT 1";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
?>


<div class="content-wrapper container">
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Data Dokter</h3>
                </div>

                <div class="card-body">
                    <form class="form" data-parsley-validate action="" method="POST">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">

                                    <label for="first-name-column" class="form-label">No Pendaftaran</label>
                                    <input type="number" id="first-name-column" class="form-control" value="<?= $row['no_rekamedis'] ?>" name="no_rekamedis" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">
                                    <label for="first-name-column" class="form-label">Nomor KTP</label>
                                    <input type="number" id="no_ktp" class="form-control" value="<?= $row['no_ktp'] ?>" name="no_ktp" required>
                                </div>
                            </div>
                            <script>
                                const inputNoKTP = document.getElementById('no_ktp');

                                inputNoKTP.addEventListener('input', function() {
                                    const maxLength = 16;
                                    if (this.value.length > maxLength) {
                                        this.value = this.value.slice(0, maxLength);
                                    }
                                });
                            </script>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column" class="form-label">Nama Pasien</label>
                                    <input type="text" id="last-name-column" class="form-control" value="<?= $row['nama_pasien'] ?>" name="nama_pasien">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="Laki-laki" <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                        </select>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating" class="form-label">Tempat Lahir</label>
                                    <input type="text" id="country-floating" class="form-control" name="tempat_lahir" value="<?= $row['tempat_lahir'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column" class="form-label">Tanggal Lahr</label>
                                    <input type="date" id="company-column" class="form-control" name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" rows="3" name="alamat"><?= $row['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">
                                    <label for="email-id-column" class="form-label">Status Pasien</label>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="status_pasien" name="status_pasien" required>
                                            <option value=""></option>
                                            <option value="umum" <?php if ($row['status_pasien'] == 'umum') echo 'selected'; ?>>Umum</option>
                                            <option value="bpjs" <?php if ($row['status_pasien'] == 'bpjs') echo 'selected'; ?>>BPJS</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>

                        </div>
                        <div class="row">
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