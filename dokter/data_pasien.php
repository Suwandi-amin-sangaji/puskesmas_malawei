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
                            while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['no_rekamedis'] ?></td>
                                    <td><?= $row['nama_pasien'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['tempat_lahir'] ?></td>
                                    <td><?= $row['tanggal_lahir'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['status_pasien'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm block" data-bs-toggle="modal" data-bs-target="#default">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="hapus_poli.php?id_poli=<?= $row['id_poli']; ?>" class="btn btn-danger btn-sm block">
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