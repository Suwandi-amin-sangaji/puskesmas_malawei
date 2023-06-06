<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

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
                        <!-- <a href="add_poli" class="btn btn-outline-primary block">
                            <i class="bi bi-plus"></i>
                            Tambah Data
                        </a> -->
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Registrasi</th>
                                <th>Nomor Rekamedis</th>
                                <th>No KTP</th>
                                <th>Nama Pasien</th>
                                <th>Jenis kelamin</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_pendaftaran INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pendaftaran.user_id");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['no_registrasi'] ?></td>
                                    <td><?= $row['no_rekamedis'] ?></td>
                                    <td><?= $row['no_ktp'] ?></td>
                                    <td><?= $row['nama_pasien'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td>
                                        <a href="detail_periksa?no_registrasi=<?= $row['no_registrasi']; ?>" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i>
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

<?php
// Load file koneksi.php
include "../config/koneksi.php";
$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
    // Buat query untuk menampilkan semua data transaksi
    $query = "SELECT * FROM tb_pengeluaran_obat 
                    INNER JOIN tb_pendaftaran ON tb_pendaftaran.id_pendaftaran = tb_pengeluaran_obat.id_pendaftaran
                    INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pendaftaran.user_id
                    INNER JOIN tb_periksa ON tb_periksa.id_user = tb_pasien.id_user";
    $url_cetak = "cetak/cetak_riwayat";
    // $label = "Semua Data Riwayat";
} else { // Jika terisi
    // Buat query untuk menampilkan data transaksi sesuai periode tanggal
    $query = "SELECT * FROM tb_pengeluaran_obat 
                    INNER JOIN tb_pendaftaran ON tb_pendaftaran.id_pendaftaran = tb_pengeluaran_obat.id_pendaftaran 
                    INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pendaftaran.user_id
                    INNER JOIN tb_periksa ON tb_periksa.id_user = tb_pasien.id_user
                    WHERE (tgl_serah_obat BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
    $url_cetak = "cetak/cetak_riwayat?tgl_awal=" . $tgl_awal . "&tgl_akhir=" . $tgl_akhir . "&filter=true";
    $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
    $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
    $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
}
?>



<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Riwayat Berobat</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-end">
                        <!-- Button trigger for basic modal -->
                        <button type="submit" class="btn btn-success" style="margin-right:5px;" data-bs-toggle="modal" data-bs-target="#filter">
                          <i class="fa fa-filter"></i>
                        </button>
                        <a class="btn btn-danger" target="_blank" href="<?php echo $url_cetak ?>"><i class="fa fa-file-pdf"></i></a>
                    </div>
                    <?php echo $label ?><br />

                    <!--login form Modal -->
                    <div class="modal fade text-left" id="filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Filter Tanggal cetak</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="pemeriksaan" method="GET">
                                    <div class="modal-body">
                                        <label>Tanggal Awal</label>
                                        <div class="form-group">
                                            <input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal">
                                        </div>
                                        <label>Tanggal Akhir </label>
                                        <div class="form-group">
                                            <input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>
                                        <?php
                                        if (isset($_GET['filter'])) { // Jika user mengisi filter tanggal atau kelas, maka munculkan tombol untuk reset filter
                                            echo '<a href="pemeriksaan" class="btn btn-default">RESET</a>';
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pasien</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Dosis/Aturan</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";
                            $no = 1;
                            $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
                            $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
                            if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                                    $tgl = date('d-m-Y', strtotime($data['tgl_serah_obat'])); // Ubah format tanggal jadi dd-mm-yyyy
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . $tgl . "</td>";
                                    echo "<td>" . $data['nama_pasien'] . "</td>";
                                    echo "<td>" . $data['kode_obat'] . "</td>";
                                    echo "<td>" . $data['nama_obat'] . "</td>";
                                    echo "<td>" . $data['dosis_aturan_obat'] . "</td>";
                                    echo "<td>" . $data['jumlah'] . "</td>";
                                    echo "<td>" . $data['keterangan'] . "</td>";
                                    echo "<td>
                                            <a class='btn btn-success' href='edit_obat?kode_obat=" . $data['kode_obat'] . "'><i class='fa fa-edit'></i></a>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else { // Jika data tidak ada
                                echo "<tr><td colspan='9' class='text-center'>Data tidak ada</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>


<?php include "include/footer.php" ?>