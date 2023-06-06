<?php
session_start();
include "../config/koneksi.php";

if (isset($_SESSION['no_registrasi'])) {
    $no_registrasi = $_SESSION['no_registrasi'];

    // Cek apakah nomor antrian sudah ada dalam session
    if (!isset($_SESSION['no_antrian'])) {
        // Jika nomor antrian belum disimpan dalam session, ambil nomor antrian dari database
        $sql_antrian = "SELECT no_antrian FROM tbl_antrian WHERE no_registrasi = '$no_registrasi'";
        $result_antrian = mysqli_query($koneksi, $sql_antrian);
        $row_antrian = mysqli_fetch_assoc($result_antrian);
        $nomor_antrian = $row_antrian['no_antrian'];

        $_SESSION['no_antrian'] = $nomor_antrian; // Simpan nomor antrian dalam session
    } else {
        $nomor_antrian = $_SESSION['no_antrian']; // Ambil nomor antrian dari session
    }
} else {
    $no_registrasi = "Belum Mendaftar";
    $nomor_antrian = "Belum Mendaftar";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <style>
        .card {
            height: 200px;
            width: 500px;
            background-color: #7edea0;
            border-radius: 5px;
            color: black;
            margin: auto;
            font-size: 16px;
            box-shadow: 2px 2px 20px #707070;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>

<body>

    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">PUSKESMAS MALAWEI</h2>
                <h3 class="card-text text-center">NOMOR ANTRIAN</h3>
                <h1 class="text-center"><span id="antrian"></h1></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <script type="text/javascript">
        window.print();
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to retrieve and display the current number of queue
    function showQueue() {
      $.ajax({
        url: '../get_antrian.php', // Ubah sesuai dengan path ke file PHP yang menampilkan data antrian
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
</body>

</html>