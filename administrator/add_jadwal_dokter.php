<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
// Include the database connection file
include "../config/koneksi.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $kode_dokter = $_POST['kode_dokter'];
    $hari = implode(",", $_POST['hari']);
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $id_poli = $_POST['id_poli'];

    // Create the SQL query
    $query = "INSERT INTO `tb_jadwal_dokter`(`kode_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `id_poli`) 
              VALUES ('$kode_dokter', '$hari', '$jam_mulai', '$jam_selesai', '$id_poli')";

    // Execute the query
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jadwal Dokter Behasil Di simpan.');window.location='jadwal_dokter';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>


<div class="content-wrapper container">
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Data Dokter</h3>
                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama_dokter">Nama Dokter</label>
                                    <select class="form-control" name="kode_dokter" id="kode_dokter" required>
                                        <option value="">--Pilih Dokter--</option>
                                        <?php
                                        include "../config/koneksi.php";
                                        $poli = mysqli_query($koneksi, "select * from tb_dokter");
                                        while ($f = mysqli_fetch_array($poli)) {
                                        ?>
                                            <option value="<?php echo $f['kode_dokter'] ?>"><?php echo $f['nama_dokter']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">

                                <label for="hari">Hari</label>
                                <div class="form-group">
                                    <select class="choices form-select multiple-remove" multiple="multiple" name="hari[]">
                                        <optgroup label="Hari">
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </optgroup>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nomor_induk_dokter">Jam Mulai</label>
                                    <input type="time" id="jam_mulai" class="form-control" placeholder="nomor induk dokter" name="jam_mulai">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type="time" id="jam_selesai" class="form-control" placeholder="jam_selesai" name="jam_selesai">
                                </div>
                            </div>
                           
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Poli:</label>
                                    <select class="form-control" name="id_poli" id="id_poli" required>
                                        <option value="">--Poli--</option>
                                        <?php
                                        include "../config/koneksi.php";
                                        $poli = mysqli_query($koneksi, "select * from tb_poli");
                                        while ($f = mysqli_fetch_array($poli)) {
                                        ?>
                                            <option value="<?php echo $f['id_poli'] ?>"><?php echo $f['nama_poli']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function checkInputLength() {
        var input = document.getElementById("kode_dokter");
        var value = input.value;

        if (value.length > 5) {
            alert("Kode Obat tidak boleh lebih dari 5 karakter!");
            input.value = value.slice(0, 5); // Truncate the input value to the first 5 characters
        }
    }
</script>
<?php include "include/footer.php" ?>