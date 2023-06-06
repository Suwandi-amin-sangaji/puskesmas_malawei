<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>
<?php
include "../config/koneksi.php";

// Mengambil data pengunjung dari tabel tb_pendaftaran
$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_pasien");
$data = mysqli_fetch_assoc($query);
$total_pengunjung = $data['total'];


// Mengambil data pengunjung laki-laki dari tabel tb_pendaftaran
$query_laki = mysqli_query($koneksi, "SELECT COUNT(*) AS total_laki FROM tb_pasien WHERE jenis_kelamin = 'Laki-Laki'");
$data_laki = mysqli_fetch_assoc($query_laki);
$total_laki = $data_laki['total_laki'];

// Mengambil data pengunjung perempuan dari tabel tb_pendaftaran
$query_perempuan = mysqli_query($koneksi, "SELECT COUNT(*) AS total_perempuan FROM tb_pasien WHERE jenis_kelamin = 'Perempuan'");
$data_perempuan = mysqli_fetch_assoc($query_perempuan);
$total_perempuan = $data_perempuan['total_perempuan'];

// Menampilkan data pada masing-masing card
?>

<div class="content-wrapper container">
  <div class="page-content">
    <section class="row">
      <div class="col-12 col-lg-9">
        <div class="row">
          <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                    <div class="stats-icon purple mb-2">
                      <i class="fa fa-users"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Pasien</h6>
                    <h6 class="font-extrabold mb-0"><?php echo $total_pengunjung; ?></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                    <div class="stats-icon blue mb-2">
                      <i class="fa fa-male"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Laki-laki</h6>
                    <h6 class="font-extrabold mb-0"><?php echo $total_laki; ?></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                    <div class="stats-icon green mb-2">
                      <i class="fa fa-female"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Perempuan</h6>
                    <h6 class="font-extrabold mb-0"><?php echo $total_perempuan; ?></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <canvas id="myChart" width="200" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-12 col-lg-3">
        <div class="card">
          <div class="card-body py-5 px-5">

            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl">
                <img src="assets/images/faces/1.jpg" alt="Face 1">
              </div>
              <div class="ms-3 name">
                <h5 class="font-bold"><?= $_SESSION['nama'] ?></h5>
                <h6 class="text-muted mb-0"><?= $_SESSION['email'] ?></h6>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h4>Pendaftaran Hari ini</h4>
          </div>
          <div class="card-body">
            <div id="chartpie"></div>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>


<?php
// Load file koneksi.php
include "../config/koneksi.php";

// Query untuk mengambil data jumlah pengunjung laki-laki dan perempuan dari tabel tb_pendaftaran dan tb_pasien
$query = "SELECT tb_pasien.jenis_kelamin, COUNT(tb_pendaftaran.user_id) AS total_visit
          FROM tb_pendaftaran
          INNER JOIN tb_pasien ON tb_pasien.id_user = tb_pendaftaran.user_id
          GROUP BY tb_pasien.jenis_kelamin";

$result = mysqli_query($koneksi, $query);

// Mengambil data dari hasil query
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Menutup koneksi database
mysqli_close($koneksi);
?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0"></script>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    var options = {
      chart: {
        height: 350,
        type: 'pie',
        toolbar: {
          show: true
        }
      },
      series: <?php echo json_encode(array_column($data, 'total_visit')); ?>,
      labels: <?php echo json_encode(array_column($data, 'jenis_kelamin')); ?>,
      colors: ['#6A58AE', '#E75480'],
      legend: {
        position: 'bottom'
      },
      dataLabels: {
        enabled: false
      },
      tooltip: {
        enabled: true
      }
    }

    var chart = new ApexCharts(document.querySelector("#chartpie"), options);

    chart.render();
  });
</script>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
include('../config/koneksi.php');
$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

for ($bulan = 1; $bulan < 13; $bulan++) {
  $query = mysqli_query($koneksi, "SELECT COUNT(tanggal_daftar) as jumlah from tb_pendaftaran where MONTH(tanggal_daftar)='$bulan'");
  $row = $query->fetch_array();
  $jumlah_produk[] = $row['jumlah'];
}
?>


<script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($label); ?>,
      datasets: [{
        label: 'Grafik Pendafataran Pasien Perbulan',
        data: <?php echo json_encode($jumlah_produk); ?>,
        backgroundColor: '#435EBE',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    }
  });
</script>

</body>

</html>


<?php include "include/footer.php" ?>