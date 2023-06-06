<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<?php
include "../config/koneksi.php";
// Ambil data dari form
if (isset($_POST['submit'])) {
    $newPassword = md5($_POST['password']);
    $confirmPassword = md5($_POST['password-confirm']);

    // Validasi password baru dan konfirmasi password
    if ($newPassword != $confirmPassword) {
        echo "<script>alert('Password baru dan konfirmasi password tidak cocok.');window.location='setting';</script>";
        exit;
    }

    // Update password di tabel tb_users
    $userId = $_SESSION['id_user'];

    // Escape input untuk mencegah SQL injection
    $newPassword = mysqli_real_escape_string($koneksi, $newPassword);

    // Update password pengguna
    $query = "UPDATE tb_users SET password='$newPassword' WHERE id_user='$userId'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Password Berhasil Di ubah.');window.location='index';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
}
?>


<div class="content-wrapper container">
    <!-- <div class="page-heading">
    <h3>PUSKESMAS ADMIN</h3>
  </div> -->
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Ganti Password</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" data-parsley-validate action="" method="POST">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label for="password" class="form-label">Pasword Baru</label>
                                        <input type="text" id="password" class="form-control" placeholder="Password Baru" name="password" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password-confirm" class="form-label">Confirm Password</label>
                                        <input type="password" id="password-confirm" class="form-control" placeholder="Confirm Password" name="password-confirm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>





<?php include "include/footer.php" ?>