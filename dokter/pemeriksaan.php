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
                                <th>Status Pasien</th>
                                <th>No BPJS</th>
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
                                    <td><?= $row['status_pasien'] ?></td>
                                    <td><?php echo $row['no_bpjs'] != "" ? $row['no_bpjs'] : "-"; ?></td>
                                    <td><?= $row['nama_pasien'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td>
                                        <a href="diagnosa?no_registrasi=<?= $row['no_registrasi']; ?>" class="btn btn-success btn-sm" onclick="checkStatus(event)">
                                            <i class="fa fa-stethoscope" aria-hidden="true"></i>
                                        </a>

                                        <a href="detail?no_registrasi=<?= $row['no_registrasi']; ?>" class="btn btn-primary btn-sm">
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


<?php include "include/footer.php" ?>