<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>
<?php
session_start();
include "../config/koneksi.php";
include "../function.php";
$noRekamMedis = generateNextRegistrationNumber();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $no_rekamedis = $_POST['no_rekamedis'];
  $no_ktp = $_POST['no_ktp'];
  $nama_pasien = $_POST['nama_pasien'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $status_pasien = $_POST['status_pasien'];
  $is_active = 1;

  // Mengonversi nilai jenis_kelamin menjadi 'Laki-laki' atau 'Perempuan'
  if ($jenis_kelamin == 'L') {
    $jenis_kelamin = 'Laki-laki';
  } else if ($jenis_kelamin == 'P') {
    $jenis_kelamin = 'Perempuan';
  }

  // Query INSERT untuk menambahkan data ke tabel tb_pasien
  $sql = "INSERT INTO tb_pasien (no_rekamedis, no_ktp, nama_pasien, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, status_pasien, is_active) VALUES ('$no_rekamedis', '$no_ktp', '$nama_pasien', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$status_pasien' ,'$is_active')";

  if (mysqli_query($koneksi, $sql)) {
    // Jika data berhasil ditambahkan, lakukan tindakan yang diinginkan, misalnya redirect ke halaman sukses atau menampilkan pesan sukses
    echo "<script>alert('Terima Kasih Telah Melengkapi Data Anda.');window.location='data_pasien';</script>";
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
            <div class="card">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-end">
                        <!-- Button trigger for basic modal -->
                        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#add">
                            Tambah Data
                        </button>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Rekamedis</th>
                                <th>Nama Pasien</th>
                                <th>Jenis kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Status Pasien</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";

                            $query = mysqli_query($koneksi, "SELECT * FROM tb_pasien");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                                $tgl = date('d-m-Y', strtotime($row['tanggal_lahir'])); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['no_rekamedis'] ?></td>
                                    <td><?= $row['nama_pasien'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['tempat_lahir'] ?></td>
                                    <td><?= $tgl  ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['status_pasien'] ?></td>
                                    <td>
                                    <a href="edit_pasien?no_rekamedis=<?= $row['no_rekamedis']; ?>" class="btn btn-success btn-sm block">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus_pasien?no_rekamedis=<?= $row['no_rekamedis']; ?>" class="btn btn-danger btn-sm block">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>


<!-- Add Modal -->
<div class="modal fade text-left modal-lg" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Basic Modal</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" data-parsley-validate action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">

                                <label for="first-name-column" class="form-label">No Pendaftaran</label>
                                <input type="number" id="first-name-column" class="form-control" value="<?= $noRekamMedis ?>" name="no_rekamedis" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="first-name-column" class="form-label">Nomor KTP</label>
                                <input type="number" id="no_ktp" class="form-control" placeholder="No. KTP" name="no_ktp" required>
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
                                <input type="text" id="last-name-column" class="form-control"  name="nama_pasien">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city-column" class="form-label">Jenis Kelamin</label>
                                <fieldset class="form-group">
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">--Jenis Kelamin--</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="country-floating" class="form-label">Tempat Lahir</label>
                                <input type="text" id="country-floating" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="company-column" class="form-label">Tanggal Lahr</label>
                                <input type="date" id="company-column" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="email-id-column" class="form-label">Status Pasien</label>
                                <fieldset class="form-group">
                                    <select class="form-select" id="status_pasien" name="status_pasien" required>
                                        <option value=""></option>
                                        <option value="umum">Umum</option>
                                        <option value="bpjs">BPJS</option>
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
    </div>
</div>




<?php include "include/footer.php" ?>