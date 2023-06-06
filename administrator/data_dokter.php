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
                        <a href="add_dokter" class="btn btn-outline-primary block">
                            <i class="bi bi-plus"></i>
                            Tambah Data
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Dokter</th>
                                <th>Nama Dokter</th>
                                <th>Jenis kelamin</th>
                                <th>NID</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>POLI</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";

                            $query = mysqli_query($koneksi, "SELECT * FROM tb_dokter INNER JOIN tb_poli ON tb_poli.id_poli = tb_dokter.id_poli");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                                $tgl = date('d-m-Y', strtotime($row['tgl_lahir'])); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['kode_dokter'] ?></td>
                                    <td><?= $row['nama_dokter'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['nomor_induk_dokter'] ?></td>
                                    <td><?= $row['tempat_lahir'] ?></td>
                                    <td><?= $tgl ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['nama_poli'] ?></td>
                                    <td>
                                        <a href="edit_dokter.php?kode_dokter=<?= $row['kode_dokter']; ?>" class="btn btn-success btn-sm block">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="hapus_dokter.php?kode_dokter=<?= $row['kode_dokter']; ?>" class="btn btn-danger btn-sm block">
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