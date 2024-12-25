<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Diana Rent Car</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Diana Rent Car, Sewa Mobil, Rental Mobil, Jasa Supir, Sewa Mobil dan Jasa Supir Karawang, Sewa Mobil Murah" name="keywords">
    <meta content="Diana Rent Car merupakan Usaha dibidang Sewa Mobil dan Jasa Supir Karawang" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/web/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/web/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/drc.png" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/web/css/bootstrap.min.css" rel="stylesheet">

    <!-- Materio CSS -->
    <!-- <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" /> -->

    <!-- Template Stylesheet -->
    <link href="assets/web/css/style.css" rel="stylesheet">

    <style>
        /* Navbar dengan gradasi warna dan pemisah */
        .nav-bar {
            background: linear-gradient(to bottom, #ffffff, #f0f0f0);
            /* Gradasi warna dari putih ke abu muda */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Efek bayangan untuk pemisah */
        }

        /* Menambahkan border bawah agar lebih jelas */
        .navbar {
            border-bottom: 2px solid #ddd;
            /* Border bawah yang tipis untuk pemisah */
        }
    </style>
    <!-- Tempat untuk CSS tambahan -->
    <?php
    if (isset($_GET['views']) == 'home') {
    }
    ?>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Start Navbar -->
    <?php require("./layouts/navbar.php") ?>
    <!-- End Navbar -->

    <?php
    require("./function/menu.php")
    ?>

    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">About</h4>
                            <p class="mb-3">Kami menyediakan layanan penyewaan mobil berkualitas dan jasa supir profesional untuk memenuhi kebutuhan perjalanan Anda. Dengan armada yang terawat dan layanan terbaik, kami siap menemani perjalanan Anda dengan nyaman dan aman.</p>
                        </div>
                        <!-- <div class="position-relative">
                            <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Masukkan email Anda">
                            <button type="button" class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Berlangganan</button>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <a href="?views=about"><i class="fas fa-angle-right me-2"></i> About</a>
                        <a href="?views=contact"><i class="fas fa-angle-right me-2"></i> Contact</a>
                        <!-- <a href="#"><i class="fas fa-angle-right me-2"></i> Cars</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Car Types</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Team</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a> -->
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Jam Operasional</h4>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Senin - Jumat:</h6>
                            <p class="text-white mb-0">07.00 - 21.00 WIB</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Sabtu - Minggu:</h6>
                            <p class="text-white mb-0">06:00 - 22:00 WIB</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Tanggal Merah:</h6>
                            <p class="text-white mb-0">06:00 - 22:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Info Kontak</h4>
                        <a href="https://maps.app.goo.gl/hHdMvZpLid1f6yETA" target="_blank"><i class="fa fa-map-marker-alt me-2"></i> Perum de Palumbon Residence Blok E No. 18 Jl. Manunggal VII RT. 04/12, Kel. Palumbonsari, Kec. Karawang Timur, Kab. Karawang</a>
                        <a href="mailto:cs@dianarentcar.my.id"><i class="fas fa-envelope me-2"></i> cs@dianarentcar.my.id</a>
                        <a href="wa.me/628561344499"><i class="fab fa-whatsapp me-2"></i> +628561344499</a>
                        <a href="tel:+62895369715444"><i class="fas fa-phone me-2"></i> +62895369715444</a>
                        <div class="d-flex">
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href="https://www.facebook.com/groups/1244100965622454/user/100009793860190/" target="_blank"><i class="fab fa-facebook-f text-white"></i></a>
                            <!-- <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i class="fab fa-twitter text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i class="fab fa-instagram text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-0" href=""><i class="fab fa-linkedin-in text-white"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>Diana Rent Car</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                    Designed By <a class="border-bottom text-white" href="#">Kelompok 2</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/web/lib/wow/wow.min.js"></script>
    <script src="assets/web/lib/easing/easing.min.js"></script>
    <script src="assets/web/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/web/lib/counterup/counterup.min.js"></script>
    <script src="assets/web/lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="assets/web/js/main.js"></script>
</body>

</html>