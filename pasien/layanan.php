<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<div class="content-wrapper container">
  <div class="page-content">
    <section class="row">
      <div class="col-12 col-lg-12">
        <div class="row">
          <div class="col-6 col-lg-6 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                    <div class="stats-icon green mb-2">
                      <i class="iconly-boldAdd-User"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <a href="#" onclick="showForm()">
                      <h6 class="text-muted font-semibold">Pendaftaran Berobat</h6>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-6 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                    <div class="stats-icon red mb-2">
                      <i class="fa fa-address-card"></i>
                    </div>
                  </div>
                  <!-- <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold" style="margin-left:30px;">Nomor Antrian</h6>
                   
                    <p id="antrian" class="display-1 fw-bold text-success" style="margin-left:55px;"></p>
                    <a  href="cetak/cetak_antrian"  class="btn btn-primary">
                        Cetak Nomor Antrian
                    </a>
                  </div> -->
                  <?php if($row['is_active'] != 1) : ?>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold" style="margin-left:30px;">Nomor Antrian</h6>
                    <p id="antrian" class="display-1 fw-bold text-success" style="margin-left:55px;"></p>
                    <a  href="cetak/cetak_antrian"  class="btn btn-primary"> Cetak Nomor Antrian </a>
                  </div>
                    <?php else : ?>
                   <script>alert('Pasien belum Terdaftar. Harap Lengkapi Pendaftaran terlebih dahulu.');window.location='index'</script>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>
</div>



<!-- Pendaftaran -->
<?php
session_start();
include "../function.php";
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $no_registrasi = generateNomorRegistrasi($koneksi);
  $no_rawat = generateNomorRawat($koneksi);
  $no_rekamedis = $_POST['no_rekamedis'];
  $id_user = $_SESSION['id_user'];
  $tanggal_daftar = date('Y-m-d');
  $id_poli = $_POST['id_poli'];
  $kode_dokter = $_POST['kode_dokter'];
  $nama_penanggung_jawab = $_POST['nama_penanggung_jawab'];
  $hubungan_dengan_penanggung_jawab = $_POST['hubungan_dengan_penanggung_jawab'];
  $alamat_penanggung_jawab = $_POST['alamat_penanggung_jawab'];
  $no_bpjs = $_POST['no_bpjs'];
  $status_pasien = $_POST['status_pasien'];

  // Query INSERT untuk menambahkan data ke tabel tb_pendaftaran
  $sql = "INSERT INTO tb_pendaftaran (no_registrasi, no_rawat, no_rekamedis, user_id, tanggal_daftar, id_poli, kode_dokter, nama_penanggung_jawab, hubungan_dengan_penanggung_jawab, alamat_penanggung_jawab, no_bpjs, status_pasien) VALUES ('$no_registrasi', '$no_rawat', '$no_rekamedis', '$id_user', '$tanggal_daftar', '$id_poli', '$kode_dokter', '$nama_penanggung_jawab', '$hubungan_dengan_penanggung_jawab', '$alamat_penanggung_jawab', '$no_bpjs', '$status_pasien')";

  if (mysqli_query($koneksi, $sql)) {
    // Get the last inserted ID in tb_pendaftaran
    $last_insert_id = mysqli_insert_id($koneksi);
    
    // Insert data into the tbl_antrian table
    $tanggal_antrian = gmdate("Y-m-d", time() + 60 * 60 * 7);
    $status_antrian = '0'; // Set the initial status as '0' (Belum Diproses)
    $updated_date = date('Y-m-d H:i:s');
    $sql_antrian = "INSERT INTO tbl_antrian (no_registrasi, id_user, tanggal, no_antrian, status, updated_date) VALUES ('$no_registrasi', '$id_user', '$tanggal_antrian', '$last_insert_id', '$status_antrian', '$updated_date')";
    if (mysqli_query($koneksi, $sql_antrian)) {
      echo "<script>alert('Berhasil mendaftar !!! silahkan cetak nomor antrian anda');window.location='layanan';</script>";
      exit();
    } else {
      echo "Error: " . $sql_antrian . "<br>" . mysqli_error($koneksi);
    }
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
  }
}

$koneksi->close();
?>


<div class="content-wrapper container" id="formContainer" style="display: none;">
  <div class="page-content">
    <section class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Pendaftaran</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <?php
              include "../config/koneksi.php";
              $id_user = $_SESSION['id_user'];
              $query = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE id_user = '$id_user'");
              $row = mysqli_fetch_assoc($query);
              ?>
              <form class="form" data-parsley-validate action="" method="POST">
                <div class="row">
                  <!-- <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="first-name-column" class="form-label">No Registrasi</label>
                      <input type="number" id="first-name-column" class="form-control" value="" name="no_registrasi" required readonly>
                    </div>
                  </div> -->
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="first-name-column" class="form-label">No Rekamedis</label>
                      <input type="number" id="first-name-column" class="form-control" value="<?= $row['no_rekamedis'] ?>" name="no_rekamedis" required readonly>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="first-name-column" class="form-label">Nomor KTP</label>
                      <input type="number" id="first-name-column" class="form-control" value="<?= $row['no_ktp'] ?>" required disabled>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="last-name-column" class="form-label">Nama Pasien</label>
                      <input type="text" id="last-name-column" class="form-control" value="<?= $row['nama_pasien'] ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="city-column" class="form-label">Jenis Kelamin</label>
                      <fieldset class="form-group">
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required disabled>
                          <option value=""></option>
                          <option value="L" <?php if ($row['jenis_kelamin'] == "Laki-laki") echo "selected"; ?>>Laki-laki</option>
                          <option value="P" <?php if ($row['jenis_kelamin'] == "Perempuan") echo "selected"; ?>>Perempuan</option>
                        </select>
                      </fieldset>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="country-floating" class="form-label">Tempat Lahir</label>
                      <input type="text" id="country-floating" class="form-control" name="tempat_lahir" value="<?= $row['tempat_lahir'] ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="company-column" class="form-label">Tanggal Lahr</label>
                      <input type="date" id="company-column" class="form-control" name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="email-id-column" class="form-label">Status Pasien</label>
                      <fieldset class="form-group">
                        <select class="form-select" id="status_pasien" name="status_pasien" required onchange="toggleBPJSInput()">
                          <option value="umum">Umum</option>
                          <option value="bpjs">BPJS</option>
                        </select>
                      </fieldset>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory" id="no-bpjs-input" style="display: none;">
                      <label for="no-bpjs-column" class="form-label">No BPJS</label>
                      <input type="text" class="form-control" id="no_bpjs" name="no_bpjs">
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea class="form-control" placeholder="Masukkan Alamat lengkap" id="alamat" name="alamat" rows="3"><?= $row['alamat'] ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="country-floating" class="form-label">Nama Penanggung Jawab</label>
                      <input type="text" id="country-floating" class="form-control" name="nama_penanggung_jawab">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="country-floating" class="form-label">Hubungan Dengan Penanggung Jawab</label>
                      <fieldset class="form-group">
                        <select class="form-select" id="hubungan_dengan_penanggung_jawab" name="hubungan_dengan_penanggung_jawab">
                          <option value="Saudara Kandung">Saudara Kandung</option>
                          <option value="Orang Tua">Orang Tua</option>
                        </select>
                      </fieldset>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat penanggung Jawab</label>
                        <textarea class="form-control" placeholder="Masukkan Alamat lengkap" id="alamat_penanggung_jawab" name="alamat_penanggung_jawab" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-12">
                    <label>Poli:</label>
                    <select class="form-control" name="id_poli" id="id_poli" required>
                      <option value="">--Poli--</option>
                      <?php
                      $poli = mysqli_query($koneksi, "select * from tb_poli");
                      while ($f = mysqli_fetch_array($poli)) {
                      ?>
                        <option value="<?php echo $f['id_poli'] ?>"><?php echo $f['nama_poli']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-12 col-12 mt-3 mb-3">
                    <div class="form-group">
                      <label>Dokter</label>
                      <select class="form-control" name="kode_dokter" id="kode_dokter" required>

                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                      <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Daftar</button>
                      <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to retrieve and display the current number of queue
    function showQueue() {
      $.ajax({
        url: 'get_antrian.php', // Ubah sesuai dengan path ke file PHP yang menampilkan data antrian
        method: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#antrian').html(response);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }

    // Load the initial number of queue on page load
    showQueue();

    // Handle the click event on the "Ambil Nomor Antrian" button
    $('#insert').on('click', function() {
      $.ajax({
        url: 'insert.php', // Ubah sesuai dengan path ke file PHP yang melakukan proses pengambilan nomor antrian
        method: 'POST',
        dataType: 'html',
        success: function(response) {
          showQueue(); // Refresh the displayed number of queue
          alert('Nomor antrian Anda: ' + response);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>

<?php include "include/footer.php" ?>