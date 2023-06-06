<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
if (isset($_POST['submit'])) {
    $no_registrasi = $_POST['no_registrasi'];
    $no_rekamedis = $_POST['no_rekamedis'];
    $id_user = $_POST['id_user'];
    $id_poli = $_POST['id_poli'];
    $kode_dokter = $_POST['kode_dokter'];
    $hasil_periksa = $_POST['hasil_periksa'];
    $nama_obat = $_POST['nama_obat'];
    $status_periksa = $_POST['status_periksa'];

    // Query INSERT untuk menambahkan data ke tabel tb_periksa
    $sql = "INSERT INTO `tb_periksa`(`no_registrasi`, `no_rekamedis`, `id_user`, `id_poli`, `kode_dokter`, `hasil_periksa`, `nama_obat`, `status_periksa`) VALUES ('$no_registrasi', '$no_rekamedis', '$id_user', '$id_poli','$kode_dokter', '$hasil_periksa', '$nama_obat', '$status_periksa')";

    if (mysqli_query($koneksi, $sql)) {
        // Jika data berhasil ditambahkan, tampilkan pesan sukses menggunakan JavaScript
        echo "<script>alert('Pemeriksaan Selesai');</script>";
        // Lakukan redirect ke halaman sukses atau halaman lain yang diinginkan setelah pesan alert ditampilkan
        header("Location: pemeriksaan");
        exit();
    } else {
        // Jika terjadi kesalahan saat menambahkan data, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

$koneksi->close();
?>


<div class="content-wrapper container">
    <!-- <div class="page-heading">
    <h3>PUSKESMAS ADMIN</h3>
  </div> -->
    <div class="page-content">
        <section class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Pasien</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        include "../config/koneksi.php";
                        session_start();
                        $no_registrasi = $_GET['no_registrasi'];
                        $query = mysqli_query($koneksi, "SELECT * FROM tb_pendaftaran 
                         INNER JOIN tb_pasien ON tb_pasien.no_rekamedis = tb_pendaftaran.no_rekamedis WHERE no_registrasi='$no_registrasi' ");
                        $row = mysqli_fetch_assoc($query);
                        ?>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">No KTP</label>
                                    
                                    <input type="text" id="last-name-column" class="form-control" value="<?= $row['no_ktp']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Nama Pasien</label>
                                    <input type="text" id="last-name-column" class="form-control" value="<?= $row['nama_pasien']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column">Jenis kelamin</label>
                                    <input type="text" id="city-column" class="form-control" value="<?= $row['jenis_kelamin']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Tempat Lahir</label>
                                    <input type="text" id="country-floating" class="form-control" value="<?= $row['tempat_lahir']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Tanggal Lahir</label>
                                    <input type="text" id="company-column" class="form-control" value="<?= $row['tanggal_lahir']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Alamat</label>
                                    <input type="email" id="email-id-column" class="form-control" value="<?= $row['alamat']; ?>" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tindakan</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        include "../config/koneksi.php";
                        session_start();
                        $no_registrasi = $_GET['no_registrasi'];
                        $query = mysqli_query($koneksi, "SELECT * FROM tb_pendaftaran 
                        INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pendaftaran.user_id
                        INNER JOIN tb_dokter ON tb_dokter.kode_dokter = tb_pendaftaran.kode_dokter  
                        INNER JOIN tb_poli ON tb_poli.id_poli = tb_pendaftaran.id_poli
                        WHERE no_registrasi='$no_registrasi'
                        ");
                        $row = mysqli_fetch_assoc($query);
                        ?>
                        <form class="form" method="POST" action="">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Nomor Registrasi</label>
                                        <input type="hidden" class="form-control" name="id_user" value="<?= $row['id_user']; ?>">
                                        <input type="hidden" name="no_registrasi" value="<?= $row['no_registrasi']; ?>">
                                        <input type="text" id="first-name-column" class="form-control" name="no_registrasi" value="<?= $row['no_registrasi']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">

                                        <label for="first-name-column">Nomor Rekamedis</label>
                                        <input type="text" id="first-name-column" class="form-control" name="no_rekamedis" value="<?= $row['no_rekamedis']; ?>" readonly>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label>Nomor BPJS</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="first-name" class="form-control" value="<?php echo $row['no_bpjs'] != "" ? $row['no_bpjs'] : "-"; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Poli</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="hidden" id="id-poli" name="id_poli" value="<?= $row['id_poli']; ?>">
                                    <input type="email" id="email-id" class="form-control" value="<?= $row['nama_poli']; ?>" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label>Nama Dokter</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" name="kode_dokter" class="form-control" hidden value="<?= $row['kode_dokter']; ?>" readonly>
                                    <input type="email" id="email-id" class="form-control" value="<?= $row['nama_dokter']; ?>" readonly>
                                </div>


                                <div class="col-md-4">
                                    <label>Hasil Periksa</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea class="form-control" value="" rows="3" name="hasil_periksa"><?= $row['hasil_periksa'] ?></textarea>
                                </div>

                                <div class="col-md-4">
                                    <label>Nama Obat</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea class="form-control" value="" rows="3" name="nama_obat"><?= $row['nama_obat'] ?></textarea>
                                </div>

                                <div class="col-md-4">
                                    <label>Status Periksa</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <fieldset class="form-group">
                                        <select class="form-select" id="status_periksa" name="status_periksa" required>
                                            <option value="Sudah Diperiksa">-</option>
                                            <option value="Sudah Diperiksa">Sudah Diperiksa</option>
                                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">SIMPAN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>






<?php include "include/footer.php" ?>