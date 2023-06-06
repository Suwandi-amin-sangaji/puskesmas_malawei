<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Puskesmas</title>
    <link rel="icon" href="assets/assets/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- magnific popup CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        @media only screen and (max-width: 800px) {
            .navbar-brand {
                text-align: center;
            }

            .navbar-brand h3 {
                font-size: 10px;
            }

            .login {
                margin-left: 85px;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) {
            .navbar-brand {
                text-align: center;
            }

            .navbar-brand h3 {
                font-size: 20px;
            }

            .login {
                margin-left: 300px;
            }
        }
    </style>

</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.html">
                            <h3>Puskesmas Malawei</h3>
                        </a>
                        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> -->

                        <div class="collapse navbar-collapse main-menu-item justify-content-center" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.html"></a>
                                </li>

                            </ul>
                        </div>
                        <a class="btn btn-primary mr-2 login" href="login">Login</a>
                        <a class="btn btn-outline-primary" href="register">Register</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-xl-5">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h2>Puskesmas Malawei,</h2>
                            <h1>Kota Sorong</h1>
                            <p>Di Puskesmas Malawei, kami berkomitmen untuk memberikan perawatan terbaik dan menjamin kesejahteraan Anda. Tim tenaga medis kami yang terampil dan berdedikasi siap memberikan layanan medis superior dan perhatian personal kepada setiap pasien. </p>
                            <a href="register" class="btn_2">Daftar</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner_img">
                        <img src="assets/img/banner_img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->



    <!-- our depertment part start-->
    <!-- <section class="our_depertment section_padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-12">
                    <div class="depertment_content">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <h2>Our Depertment</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="assets/assets/img/icon/feature_2.svg"
                                                    alt=""></span>
                                            <h4>Better Future</h4>
                                            <p>Darkness multiply rule Which from without life creature blessed
                                                give moveth moveth seas make day which divided our have.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="assets/assets/img/icon/feature_2.svg"
                                                    alt=""></span>
                                            <h4>Better Future</h4>
                                            <p>Darkness multiply rule Which from without life creature blessed
                                                give moveth moveth seas make day which divided our have.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="assets/assets/img/icon/feature_2.svg"
                                                    alt=""></span>
                                            <h4>Better Future</h4>
                                            <p>Darkness multiply rule Which from without life creature blessed
                                                give moveth moveth seas make day which divided our have.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="assets/assets/img/icon/feature_2.svg"
                                                    alt=""></span>
                                            <h4>Better Future</h4>
                                            <p>Darkness multiply rule Which from without life creature blessed
                                                give moveth moveth seas make day which divided our have.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- our depertment part end -->
    <?php
    include "config/koneksi.php";

    // Mengambil data pengunjung dari tabel tb_pendaftaran
    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_pasien");
    $data = mysqli_fetch_assoc($query);
    $total_pengunjung = $data['total'];

    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS antrian FROM tbl_antrian");
    $data = mysqli_fetch_assoc($query);
    $total_antrian = $data['antrian'];


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
    <!-- our depertment part start-->
    <section class="our_depertment section_padding single_pepertment_page">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-12">
                    <div class="depertment_content">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <h2></h2>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="https://w7.pngwing.com/pngs/950/320/png-transparent-computer-icons-queue-group-miscellaneous-text-logo.png" alt=""></span>
                                            <h4>Antrian Hari Ini</h4>
                                            <p><?= $total_antrian ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="https://cdn.icon-icons.com/icons2/2267/PNG/512/crowd_patient_icon_140521.png" alt=""></span>
                                            <h4>Pasien</h4>
                                            <p><?= $total_pengunjung ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="https://cdn-icons-png.flaticon.com/512/97/97096.png" alt=""></span>
                                            <h4>Pasien Laki-laki</h4>
                                            <p><?= $total_laki ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Female_icon.svg/920px-Female_icon.svg.png" alt=""></span>
                                            <h4>Pasien Perempuan</h4>
                                            <p><?= $total_perempuan ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our depertment part end-->


    <!-- footer part start-->
    <footer class="footer-area">
        <div class="footer section_padding">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-2 col-md-4 col-sm-6 single-footer-widget">
                        <a href="http://sorongdev.com" target="_blank" class="footer_logo"> sorongdev.com </a>
                        <p></p>
                        <div class="social_logo">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"> <i class="ti-twitter"></i> </a>
                            <a href="#"><i class="ti-instagram"></i></a>
                            <a href="#"><i class="ti-skype"></i></a>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-xl-3 col-sm-6 col-md-6 single-footer-widget">
                        <h4>Profile Developer</h4>
                        <p>Suwandi Amin Sangaji</p>
                        <div class="form-wrap" id="mc_embed_signup">
                            <a href="https://github.com/Suwandi-amin-sangaji?tab=repositories">Github.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- footer part end-->

    <!-- jquery plugins here-->

    <script src="assets/js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="assets/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- owl carousel js -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!-- contact js -->
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/jquery.form.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/mail-script.js"></script>
    <script src="assets/js/contact.js"></script>
    <!-- custom js -->
    <script src="assets/js/custom.js"></script>
</body>

</html>