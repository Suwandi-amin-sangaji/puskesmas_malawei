<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
if (isset($_POST['submit'])) {
    $kode_dokter = $_POST['kode_dokter'];
    $nama_dokter = $_POST['nama_dokter'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_induk_dokter = $_POST['nomor_induk_dokter'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $id_poli = $_POST['id_poli'];
    $sql = "UPDATE tb_dokter SET kode_dokter = '$kode_dokter', nama_dokter='$nama_dokter',jenis_kelamin='$jenis_kelamin',nomor_induk_dokter='$nomor_induk_dokter',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir',alamat='$alamat',id_poli='$id_poli' WHERE kode_dokter = '$kode_dokter'";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data Dokter Berhasil Di Update !!!');window.location='data_dokter';</script>";
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
$query = "SELECT * FROM tb_dokter WHERE kode_dokter = '$kode_dokter' LIMIT 1";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
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
                                    <label for="kode_obat">Kode Dokter</label>
                                    <input type="text" id="kode_dokter" class="form-control" value="<?= $row['kode_dokter'] ?>" name="kode_dokter" maxlength="5" oninput="checkInputLength()">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama_dokter">Nama Dokter</label>
                                    <input type="text" id="nama_dokter" class="form-control" value="<?= $row['nama_dokter'] ?>" name="nama_dokter">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                        <option value="<?php echo $row['jenis_kelamin'] ?>" <?php echo $selected ?>><?php echo $row['jenis_kelamin']; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nomor_induk_dokter">Nomor Induk Dokter</label>
                                    <input type="text" id="nomor_induk_dokter" class="form-control" value="<?= $row['nomor_induk_dokter'] ?>" name="nomor_induk_dokter">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" class="form-control" value="<?= $row['tempat_lahir'] ?>" name="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" class="form-control" value="<?= $row['tgl_lahir'] ?>" name="tgl_lahir">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" value="<?= $row['alamat'] ?>" name="alamat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="id_poli">Jenis kelamin</label>
                                    <select class="form-control" name="id_poli" id="id_poli" required>
                                        <?php
                                        include "../config/koneksi.php";
                                        $poli = mysqli_query($koneksi, "select * from tb_poli");
                                        while ($row = mysqli_fetch_array($poli)) {
                                            $selected = ($row['id_poli'] == $data['id_poli']) ? 'selected' : ''; // Menandai opsi yang dipilih
                                        ?>
                                            <option value="<?php echo $row['id_poli'] ?>" <?php echo $selected ?>><?php echo $row['nama_poli']; ?></option>
                                        <?php } ?>
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