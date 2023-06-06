<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

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
                        session_start();
                        $id_user = $_SESSION['id_user'];
                        $query = mysqli_query($koneksi, "SELECT * FROM tb_pasien 
                         INNER JOIN tb_pendaftaran ON tb_pendaftaran.user_id = tb_pasien.id_user 
                         WHERE tb_pasien.id_user = '$id_user'");
                        $row = mysqli_fetch_assoc($query);
                        ?>
                        <form class="form">
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
                        <h4 class="card-title">Rekamedis</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        include "../config/koneksi.php";
                        session_start();
                        $no_registrasi = $_GET['no_registrasi'];
                        $query = mysqli_query($koneksi, "SELECT * FROM tb_periksa
                        INNER JOIN tb_pendaftaran ON tb_pendaftaran.user_id = tb_periksa.id_user
                        INNER JOIN tb_dokter ON tb_dokter.kode_dokter = tb_pendaftaran.kode_dokter
                        INNER JOIN tb_poli ON tb_poli.id_poli = tb_dokter.id_poli
                        WHERE tb_periksa.no_registrasi = '$no_registrasi'");
                        if (mysqli_num_rows($query) > 0) {
                            $row = mysqli_fetch_assoc($query);
                        } else {
                            // Handle case when no records are found
                            // echo "Pasien belum melakukan pemeriksaan.";
                            if ($row['status_periksa'] === 'Sudah Diperiksa'){
                            echo "<div class='col-auto' >
                                    <i class='fa fa-check text-success mb-3' style='font-size: 90px;'></i>
                                </div>";
                            }else {
                                echo "<div class='col-auto text-center'>
                                        <i class='fa fa-times text-danger mb-3' style='font-size: 90px;'></i>
                                      <p> BELUM DI PERIKSA</p>
                                    </div>";
                            }
                            exit;   
                        }
                        ?>
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
                                <textarea  class="form-control" rows="3" readonly><?= $row['hasil_periksa'] ?></textarea>
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
                                        <p><?= $row['status_periksa']?></p>
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






<?php include "include/footer.php" ?>