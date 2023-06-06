<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
if (isset($_POST['submit'])) {
    $kode_dokter = $_POST['kode_dokter'];
    $hari = implode(",", $_POST['hari']);
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $id_poli = $_POST['id_poli'];
    $sql = "UPDATE tb_jadwal_dokter SET kode_dokter = '$kode_dokter', hari = '$hari', jam_mulai = '$jam_mulai',  jam_selesai = '$jam_selesai', id_poli = '$id_poli' WHERE kode_dokter = '$kode_dokter'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil Di Update.');window.location='jadwal_dokter';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
$koneksi->close();
?>


<?php
include "../config/koneksi.php";
$kode_dokter = $_GET['kode_dokter'];
$query = "SELECT * FROM tb_jadwal_dokter
INNER JOIN tb_poli ON tb_poli.id_poli = tb_jadwal_dokter.id_poli
 WHERE kode_dokter = '$kode_dokter' LIMIT 1";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
?>

<div class="content-wrapper container">
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Data Obat</h3>
                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="kode_dokter">Kode Dokter</label>
                                    <input type="text" id="kode_dokter" hidden class="form-control" value="<?= $row['kode_dokter'] ?>" name="kode_dokter" maxlength="5"">
                                    <input type=" text" id="kode_dokter" class="form-control" value="<?= $row['kode_dokter'] ?>" name="kode_dokter" maxlength="5">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="hari">Hari</label>
                                <div class="form-group">
                                    <select class="choices form-select multiple-remove" multiple="multiple" name="hari[]">
                                        <optgroup label="Hari">
                                            <?php
                                            $selected_hari = explode(",", $row['hari']); // Assuming the values are stored as comma-separated string in the 'hari' column of the database

                                            $hari_options = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");

                                            foreach ($hari_options as $hari) {
                                                $selected = (in_array($hari, $selected_hari)) ? "selected" : "";
                                                echo "<option value='" . $hari . "' " . $selected . ">" . $hari . "</option>";
                                            }
                                            ?>
                                        </optgroup>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="text" id="jam_mulai" class="form-control" value="<?= $row['jam_mulai'] ?>" name="jam_mulai">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selsai</label>
                                    <input type="text" id="jam_selesai" class="form-control" value="<?= $row['jam_selesai'] ?>" name="jam_selesai">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="id_poli">Nama Poli</label>
                                    <select class="form-control" name="id_poli" id="id_poli" required>
                                        <option value="<?php echo $row['id_poli'] ?>" <?php echo $selected ?>><?php echo $row['nama_poli']; ?></option>
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

<?php include "include/footer.php" ?>