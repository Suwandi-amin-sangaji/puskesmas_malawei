<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
session_start();
$no_registrasi = $_GET['no_registrasi'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_periksa
                        INNER JOIN tb_pendaftaran ON tb_pendaftaran.user_id = tb_periksa.id_user
                        INNER JOIN tb_dokter ON tb_dokter.kode_dokter = tb_pendaftaran.kode_dokter
                        INNER JOIN tb_poli ON tb_poli.id_poli = tb_dokter.id_poli
                        INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pasien.id_user 
                        WHERE tb_periksa.no_registrasi = '$no_registrasi'");
if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
} else {
    // Handle case when no records are found
    // echo "Pasien belum melakukan pemeriksaan.";
    if ($row['status_periksa'] === 'Sudah Diperiksa') {
        echo "<div class='col-auto' >
                                    <i class='fa fa-check text-success mb-3' style='font-size: 90px;'></i>
                                </div>";
    } else {
        echo "<div class='col-auto text-center'>
                                        <i class='fa fa-times text-danger mb-3' style='font-size: 90px;'></i>
                                      <p> BELUM DI PERIKSA</p>
                                    </div>";
    }
    exit;
}
?>

<?php

function generateNomorTerimaObat($koneksi)
{
    global $koneksi;
    // Mendapatkan nomor terima obat terakhir dari database
    $query_last_number = mysqli_query($koneksi, "SELECT MAX(id) AS last_id FROM tb_pengeluaran_obat");
    $row_last_number = mysqli_fetch_assoc($query_last_number);
    $last_number = $row_last_number['last_id'];

    // Membuat nomor terima obat baru
    $new_number = $last_number + 1;
    $nomor_terima_obat = 'TRM' . str_pad($new_number, 5, '0', STR_PAD_LEFT); // Format nomor terima obat: TRM000001

    return $nomor_terima_obat;
}
?>

<?php
// Mendapatkan nomor terima obat terakhir dari database
$query_last_number = mysqli_query($koneksi, "SELECT MAX(id) AS last_id FROM tb_pengeluaran_obat");
$row_last_number = mysqli_fetch_assoc($query_last_number);
$last_number = $row_last_number['last_id'];

// Membuat nomor terima obat baru
$new_number = $last_number + 1;
$nomor_terima_obat = 'TRM' . str_pad($new_number, 5, '0', STR_PAD_LEFT); // Format nomor terima obat: TRM000001

// Menampilkan input nomor terima obat
?>


<?php
// Pastikan form telah disubmit
if (isset($_POST['submit'])) {
    // Ambil nilai dari form
    $no_terima_obat = generateNomorTerimaObat($koneksi);
    $nama_pasien = $_POST['nama_pasien'];
    $kode_obat = $_POST['kode_obat'];
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $nama_obat = $_POST['nama_obat'];
    $jenis_obat = $_POST['jenis_obat'];
    $dosis_aturan_obat = $_POST['dosis_aturan_obat'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];
    $keterangan = $_POST['keterangan'];
    $tgl_serah_obat = date('Y-m-d');

    // Query SQL untuk menyimpan data ke tabel
    $query = "INSERT INTO tb_pengeluaran_obat (no_terima_obat, nama_pasien, kode_obat, id_pendaftaran, nama_obat, jenis_obat, dosis_aturan_obat, jumlah, satuan, keterangan, tgl_serah_obat) 
                  VALUES ('$no_terima_obat', '$nama_pasien', '$kode_obat', '$id_pendaftaran',  '$nama_obat', '$jenis_obat', '$dosis_aturan_obat', '$jumlah', '$satuan', '$keterangan', '$tgl_serah_obat')";

    // // Eksekusi query
    // if(mysqli_query($koneksi, $query)){
    //     echo "<script>alert('Data berhasil Disimpan.');window.location='pemeriksaan';</script>";
    // } else{
    //     echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    // }
    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Data berhasil disimpan
        echo "<script>alert('Data berhasil Disimpan.');window.location='pemeriksaan';</script>";

        // Kurangi jumlah obat di tb_obat
        $query_obat = "UPDATE tb_obat SET stok = stok - $jumlah WHERE kode_obat = '$kode_obat'";
        if (mysqli_query($koneksi, $query_obat)) {
            // Jumlah obat berhasil dikurangi
        } else {
            // Terjadi kesalahan saat mengurangi jumlah obat
            echo "Terjadi kesalahan saat mengurangi jumlah obat: " . mysqli_error($koneksi);
        }
    } else {
        // Terjadi kesalahan saat menyimpan data
        echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
}
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
                        <h4 class="card-title">Input Pengeluaran Obat</h4>
                    </div>
                    <div class="card-body">

                        <form class="form" method="POST" action="">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">No Terima Obat</label>
                                        <input type="hidden" id="last-name-column" name="no_registrasi" value="<?= $row['no_registrasi']; ?>" class="form-control">
                                        <input type="hidden" id="last-name-column" name="id_pendaftaran" value="<?= $row['id_pendaftaran']; ?>" class="form-control">
                                        <input type="text" id="last-name-column" class="form-control" name="no_terima_obat" value="<?= $nomor_terima_obat; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Nama Pasien</label>
                                        <input type="text" id="last-name-column" class="form-control" name="nama_pasien" value="<?= $row['nama_pasien']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nama-obat">Nama Obat</label>
                                        <select id="nama_obat" name="nama_obat" class="form-control" onchange="populateObatData()">
                                            <option value="">Pilih Obat</option>
                                            <?php
                                            $query_obat = mysqli_query($koneksi, "SELECT * FROM tb_obat");
                                            while ($row_obat = mysqli_fetch_assoc($query_obat)) {
                                                echo '<option value="' . $row_obat['nama_obat'] . '">' . $row_obat['nama_obat'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="country-floating">Kode Obat</label>
                                        <input type="text" id="kode_obat" name="kode_obat" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="company-column">Jenis Obat</label>
                                        <input type="text" id="jenis_obat" name="jenis_obat" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="company-column">Dosis Aturan Obat</label>
                                        <input type="text" id="dosis_aturan_obat" name="dosis_aturan_obat" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" id="jumlah" class="form-control" name="jumlah">
                                    </div>
                                </div>
                                <div class=" col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea type="text" id="keterangan" name="keterangan" class="form-control" "></textarea>
                                    </div>
                                </div>
                                <div class=" col-12 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class=" col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Rekamedis</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Tanggal Berobat</label>
                                    <input type="text" id="first-name-column" class="form-control" value="<?= $row['tanggal_daftar']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Nomor Registrasi</label>
                                    <input type="text" id="first-name-column" class="form-control" value="<?= $row['no_registrasi']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Nomor Rekamedis</label>
                                    <input type="text" id="first-name-column" class="form-control" value="<?= $row['no_rekamedis']; ?>" readonly>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label>Nomor BPJS</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="first-name" class="form-control" value="<?= !empty($row['no_bpjs']) ? $row['no_bpjs'] : '-'; ?>" readonly>
                            </div>

                            <div class="col-md-4">
                                <label>Poli</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="email" id="email-id" class="form-control" value="<?= $row['nama_poli']; ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label>Nama Dokter</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="email" id="email-id" class="form-control" value="<?= $row['nama_dokter']; ?>" readonly>
                            </div>


                            <div class="col-md-4">
                                <label>Hasil Periksa</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea class="form-control" rows="3" readonly><?= $row['hasil_periksa'] ?></textarea>
                                    </div>


                                    <div class="col-md-4">
                                        <label>Nama Obat</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="email" id="email-id" class="form-control" value="<?= $row['nama_obat'] ?>" readonly>
                                    </div>


                                    <div class="col-md-4">
                                        <label>Status Periksa</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <?php if ($row['status_periksa'] === 'Sudah Diperiksa') : ?>
                                            <div class="col-auto text-center">
                                                <i class="fa fa-check text-success mb-3" style="font-size: 90px;"></i>
                                                <p><?= $row['status_periksa'] ?></p>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-auto">
                                                <i class="fa fa-times text-danger mb-3" style="font-size: 90px;"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="riwayat" class="btn btn-danger me-1 mb-1">Kembali</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<script>
    function populateObatData() {
        var obatSelect = document.getElementById('nama_obat');
        var selectedObat = obatSelect.value;

        <?php
        $query_obat = mysqli_query($koneksi, "SELECT * FROM tb_obat");
        while ($row_obat = mysqli_fetch_assoc($query_obat)) {
            echo 'if (selectedObat === "' . $row_obat['nama_obat'] . '") {' . PHP_EOL;
            echo 'document.getElementById("kode_obat").value = "' . $row_obat['kode_obat'] . '";' . PHP_EOL;
            echo 'document.getElementById("jenis_obat").value = "' . $row_obat['jenis_obat'] . '";' . PHP_EOL;
            echo 'document.getElementById("dosis_aturan_obat").value = "' . $row_obat['dosis_aturan_obat'] . '";' . PHP_EOL;
            echo '}' . PHP_EOL;
        }
        ?>
    }
</script>





<?php include "include/footer.php" ?>