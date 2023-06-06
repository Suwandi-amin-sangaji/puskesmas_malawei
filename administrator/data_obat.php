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
                        <a href="add_obat" class="btn btn-outline-primary block">
                            <i class="bi bi-plus"></i>
                            Tambah Obat
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Dosis Aturan Obat</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../config/koneksi.php";

                            $query = mysqli_query($koneksi, "SELECT * FROM tb_obat");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['kode_obat'] ?></td>
                                    <td><?= $row['nama_obat'] ?></td>
                                    <td><?= $row['jenis_obat'] ?></td>
                                    <td><?= $row['dosis_aturan_obat'] ?></td>
                                    <td><?= $row['satuan'] ?></td>
                                    <td>
                                        <!-- Tombol untuk membuka modal -->
                                        <a href="edit_obat?kode_obat=<?= $row['kode_obat']; ?>" class="btn btn-success btn-sm block">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="hapus_obat?kode_obat=<?= $row['kode_obat']; ?>" class="btn btn-danger btn-sm block">
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