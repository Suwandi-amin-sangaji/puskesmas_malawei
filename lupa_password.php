<?php
include "config/koneksi.php";

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Cek apakah email ada dalam database
    $query = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE email = '$email'");
    if (mysqli_num_rows($query) > 0) {
        // Update password baru
        $hashedPassword = md5($password);
        mysqli_query($koneksi, "UPDATE tb_users SET password = '$hashedPassword' WHERE email = '$email'");

        // Redirect ke halaman sukses
        echo "<script>alert('Password Berhasil Di Ubah.');window.location='login';</script>";
        exit();
    } else {
        // Email tidak ditemukan
        $error = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ganti Password</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Ganti Password</h2>
        <form method="POST" action=" " class="mt-4">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password Baru:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Ganti Password</button>
        </form>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger mt-4"><?php echo $error; ?></div>
        <?php } ?>
    </div>

    <!-- Tambahkan script JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
