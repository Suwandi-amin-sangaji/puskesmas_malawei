<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>
<?php
session_start();
include "../config/koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

  // Query INSERT untuk menambahkan data ke tabel tb_pasien
  $sql = "INSERT INTO tb_pegawai (nama_pegawai, npwp , jenis_kelamin, tempat_lahir, tanggal_lahir, jabatan, bidang) VALUES ('$nama_pegawai', '$npwp', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$jabatan', '$bidang')";

  if (mysqli_query($koneksi, $sql)) {
    // Jika data berhasil ditambahkan, lakukan tindakan yang diinginkan, misalnya redirect ke halaman sukses atau menampilkan pesan sukses
    echo "<script>alert('Berhasil di simpan.');window.location='data_pegawai';</script>";
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
                                <th>Nama Pegawai</th>
                                <th>Npwp</th>
                                <th>Jenis kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jabatan</th>
                                <th>Bidang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";

                            $query = mysqli_query($koneksi, "SELECT * FROM tb_pegawai");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                                $tgl = date('d-m-Y', strtotime($row['tanggal_lahir'])); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_pegawai'] ?></td>
                                    <td><?= $row['npwp'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['tempat_lahir'] ?></td>
                                    <td><?= $tgl  ?></td>
                                    <td><?= $row['jabatan'] ?></td>
                                    <td><?= $row['bidang'] ?></td>
                                    <td>
                                    <a href="edit_pegawai?id_pegawai=<?= $row['id_pegawai']; ?>" class="btn btn-success btn-sm block">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus_pegawai?id_pegawai=<?= $row['id_pegawai']; ?>" class="btn btn-danger btn-sm block">
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
                <h5 class="modal-title" id="myModalLabel1">Tambah Data</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" data-parsley-validate action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="first-name-column" class="form-label">Nama Pegawai</label>
                                <input type="text" id="nama_pegawai" class="form-control" placeholder="Nama Pegawai" name="nama_pegawai" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="last-name-column" class="form-label">No NPWP</label>
                                <input type="number" id="npwp" class="form-control"  name="npwp">
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
                            <div class="form-group mandatory">
                                <label for="email-id-column" class="form-label">Jabatan</label>
                                <fieldset class="form-group">
                                    <select class="form-select" id="jabatan" name="jabatan" required>
                                        <option value=""></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Apoteker">Apoteker</option>
                                        <option value="Dokter">Dokter</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mandatory">
                                <label for="email-id-column" class="form-label">Bidang</label>
                                <fieldset class="form-group">
                                    <select class="form-select" id="bidang" name="bidang" required>
                                        <option value=""></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Apoteker">Apoteker</option>
                                        <option value="Dokter">Dokter</option>
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