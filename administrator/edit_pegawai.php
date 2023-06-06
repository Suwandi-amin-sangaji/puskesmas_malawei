<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";

if (isset($_POST['submit'])) {
    $id_pegawai = $_POST['id_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $npwp = $_POST['npwp'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jabatan = $_POST['jabatan'];
    $bidang = $_POST['bidang'];

    // Mengonversi nilai jenis_kelamin menjadi 'Laki-laki' atau 'Perempuan'
    if ($jenis_kelamin == 'L') {
        $jenis_kelamin = 'Laki-laki';
    } else if ($jenis_kelamin == 'P') {
        $jenis_kelamin = 'Perempuan';
    }
    $sql = "UPDATE tb_pegawai SET nama_pegawai = '$nama_pegawai', npwp = '$npwp',jenis_kelamin = '$jenis_kelamin', tanggal_lahir = '$tanggal_lahir', tempat_lahir = '$tempat_lahir', bidang = '$bidang', jabatan= '$jabatan' WHERE id_pegawai = '$id_pegawai'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data Pegawai Berhasil Di Update !!!');window.location='data_pegawai';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

$koneksi->close();
?>


<?php
include "../config/koneksi.php";
$id_pegawai = $_GET['id_pegawai'];
$query = "SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai' LIMIT 1";
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
                                    <label for="first-name-column" class="form-label">Nama Pegawai</label>
                                    <input type="hidden" id="id_pegawai" class="form-control" name="id_pegawai" value="<?= $row['id_pegawai'] ?>" required>
                                    <input type="text" id="nama_pegawai" class="form-control" value="<?= $row['nama_pegawai'] ?>" name="nama_pegawai" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column" class="form-label">No NPWP</label>
                                    <input type="number" id="npwp" class="form-control" value="<?= $row['npwp'] ?>" name="npwp">
                                </div>
                            </div>
                            <script>
                                const inputNpwp = document.getElementById('npwp');

                                inputNpwp.addEventListener('input', function() {
                                    const maxLength = 15;
                                    if (this.value.length > maxLength) {
                                        this.value = this.value.slice(0, maxLength);
                                    }
                                });
                            </script>
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
                                    <label for="city-column" class="form-label">Jabatan</label>
                                    <select class="form-select" id="jabatan" name="jabatan" required>
                                        <option value="Admin" <?php if ($row['jabatan'] == 'Admin') echo 'selected'; ?>>Admin</option>
                                        <option value="Apotekter" <?php if ($row['jabatan'] == 'Apotekter') echo 'selected'; ?>>Apotekter</option>
                                        <option value="Dokter" <?php if ($row['jabatan'] == 'Dokter') echo 'selected'; ?>>Dokter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column" class="form-label">Bidang</label>
                                    <select class="form-select" id="bidang" name="bidang" required>
                                        <option value="Admin" <?php if ($row['bidang'] == 'Admin') echo 'selected'; ?>>Admin</option>
                                        <option value="Apotekter" <?php if ($row['bidang'] == 'Apotekter') echo 'selected'; ?>>Apotekter</option>
                                        <option value="Dokter" <?php if ($row['bidang'] == 'Dokter') echo 'selected'; ?>>Dokter</option>
                                    </select>
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