<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("location: login.php");
}

if (!isset($_GET['id_user'])) {
    header("location: data_pasien");
}

$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE id_user = '$id_user'");
$row = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .card {
            height: 310px;
            width: 500px;
            background-image: #7edea0;
            border-radius: 5px;
            color: blcak;
            margin: 20px;
            font-size: 16px;
            box-shadow: 2px 2px 20px #707070;
        }

        .card-back {
            height: 310px;
            width: 500px;
            background-image: #fff;
            border-radius: 5px;
            color: blcak;
            margin: 20px;
            font-size: 16px;
            box-shadow: 2px 2px 20px #707070;
        }

        .footer {
            height: 50px;
            width: 500px;
            background-color: #0b5726;
        }

        .footer p {
            font-size: 10px;
            text-align: center;
            margin-left: 15px;
            margin-right: 15px;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class='card'>
        <img style="position: absolute;padding-left: 20px;padding-top: 10px;" class="img-responsive img" alt="Responsive image" src="https://upload.wikimedia.org/wikipedia/commons/4/41/Lambang_Kota_Sorong.jpg" width="40px">
        <img style="position: absolute;padding-left: 430px;padding-top: 10px;" class="img-responsive img" alt="Responsive image" src="https://dinkespapuabarat.files.wordpress.com/2019/01/cropped-logo-kemenkes-2017-1-e1547242044126.png?w=240" width="50px">
        <p style="position: absolute; font-family: arial; font-size: 15px; padding-left: 150px; text-transform: uppercase; text-align: center;"><b>PEMERINTAH KOTA SORONG <br> DINAS KSEHATAN KOTA</b></p>
        <p style="padding-left: 190px; padding-top: 50px; color:green;"><b>KARTU BEROBAT</b></p>
        <div class="biodata">
            <table style="margin-top: 35px;padding-left: 50px; position: relative;font-family: arial;font-size: 11px;">
                <tr>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 50px; padding-bottom: 10px;">NO RM</td>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 30px; padding-bottom: 10px;">:</td>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 50px; padding-bottom: 10px; "><?= $row['no_rekamedis'] ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 50px; padding-bottom: 10px;">Nama Pasien</td>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 30px; padding-bottom: 10px;">:</td>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 50px; padding-bottom: 10px;"><?= $row['nama_pasien'] ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 50px; padding-bottom: 10px;">Alamat</td>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 30px; padding-bottom: 10px;">:</td>
                    <td style="font-weight: bold; font-size: 15px; padding-left: 50px; padding-bottom: 10px"><?= $row['alamat'] ?></td>
                </tr>
            </table>

            <div class="footer-front">
                <h4 style="margin-left: 80px; margin-top:90px;">TIAP BEROBAT HARAP KARTU DI BAWAH</h4>
            </div>
        </div>
    </div>
    </div>
<script >     
window.print();
</script>
</body>

</html>