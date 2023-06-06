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
                        <a href="add_jadwal_dokter" class="btn btn-outline-primary block">
                            <i class="bi bi-plus"></i>
                            Tambah Jadwal Prakterk Dokter
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>POLI</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";

                            $query = mysqli_query($koneksi, "SELECT * FROM tb_dokter 
                            INNER JOIN tb_jadwal_dokter ON tb_jadwal_dokter.kode_dokter = tb_dokter.kode_dokter
                            INNER JOIN tb_poli ON tb_poli.id_poli = tb_jadwal_dokter.id_poli
                            ");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_dokter'] ?></td>
                                    <td><?= $row['hari'] ?></td>
                                    <td><?= $row['jam_mulai'] ?></td>
                                    <td><?= $row['jam_selesai'] ?></td>
                                    <td><?= $row['nama_poli'] ?></td>
                                    <td>
                                        <a href="edit_jadwal_dokter.php?kode_dokter=<?= $row['kode_dokter']; ?>" class="btn btn-success btn-sm block">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="hapus_jadwal_dokter.php?kode_dokter=<?= $row['kode_dokter']; ?>" class="btn btn-danger btn-sm block">
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





<?php include "include/footer.php" ?>