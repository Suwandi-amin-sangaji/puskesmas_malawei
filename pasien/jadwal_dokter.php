<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>


<div class="content-wrapper container">
  <div class="page-content">
    <section class="row">
      <?php
      include "../config/koneksi.php";
      $query = mysqli_query($koneksi, "SELECT * FROM tb_jadwal_dokter 
                INNER JOIN tb_dokter ON tb_dokter.kode_dokter = tb_jadwal_dokter.kode_dokter
                INNER JOIN tb_poli ON tb_poli.id_poli = tb_jadwal_dokter.id_poli");

      while ($row = mysqli_fetch_assoc($query)) {
        // $jamMulai = date('H:i', strtotime($row['jam_mulai']));
        // $jamSelesai = date('H:i', strtotime($row['jam_selesai']));
      ?>
        <div class="col-12 col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-4 d-flex justify-content-start">
                  <div class="stats-icon purple mb-2">
                    <i class="fa fa-user"></i>
                  </div>
                </div>
                <div class="col-8">
                  <h6 class="text-muted font-semibold">Poli <?php echo $row['nama_poli']; ?></h6>
                  <p class="font-extrabold mb-0">Nama Dokter: <?php echo $row['nama_dokter']; ?></p>
                  <p class="font-extrabold mb-0">Jam Mulai: <?php echo $row['jam_mulai']; ?> WIT</p>
                  <p class="font-extrabold mb-0">Jam Selesai: <?= $row['jam_selesai']; ?> WIT</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </section>
  </div>
</div>




<?php include "include/footer.php" ?>