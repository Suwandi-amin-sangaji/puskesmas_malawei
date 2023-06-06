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
                <div class="card-body">
                    <?php
                    session_start();
                    $id_user = $_SESSION['id_user'];
                    $query = mysqli_query($koneksi, "SELECT * FROM tb_pasien 
                    
                    WHERE id_user = '$id_user'");
                    $row = mysqli_fetch_assoc($query);
                    ?>
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Nomor Rekamedis</label>
                                    <input type="text" id="first-name-column" class="form-control" value="<?= $row['no_rekamedis'];?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">No KTP</label>
                                    <input type="text" id="last-name-column" class="form-control" value="<?= $row['no_ktp'];?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Nama Lengkap</label>
                                    <input type="text" id="last-name-column" class="form-control" value="<?= $row['nama_pasien'];?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column">Jenis kelamin</label>
                                    <input type="text" id="city-column" class="form-control" value="<?= $row['jenis_kelamin'];?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Tempat Lahir</label>
                                    <input type="text" id="country-floating" class="form-control" value="<?= $row['tempat_lahir'];?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Tanggal Lahir</label>
                                    <input type="text" id="company-column" class="form-control" value="<?= $row['tanggal_lahir'];?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Alamat</label>
                                    <input type="email" id="email-id-column" class="form-control" value="<?= $row['alamat'];?>">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <a href="data_pasien" class="btn btn-danger me-1 mb-1">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>






<?php include "include/footer.php" ?>