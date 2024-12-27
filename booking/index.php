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
    <link href="../assets/web/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/web/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/drc.png" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/web/css/bootstrap.min.css" rel="stylesheet">

    <!-- Materio CSS -->
    <!-- <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" /> -->

    <!-- Template Stylesheet -->
    <link href="../assets/web/css/style.css" rel="stylesheet">

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


    <!-- Content Start -->
    <?php require("./layouts/menu.php") ?>
    <!-- Content End -->

    <!-- Footer Start -->
    <?php require(__DIR__ . '/../layouts/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/web/lib/wow/wow.min.js"></script>
    <script src="../assets/web/lib/easing/easing.min.js"></script>
    <script src="../assets/web/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/web/lib/counterup/counterup.min.js"></script>
    <script src="../assets/web/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/web/js/main.js"></script>
</body>

</html>