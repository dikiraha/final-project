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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/web/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/web/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/drc.png" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/web/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/web/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <style>
        .nav-bar {
            background: linear-gradient(to bottom, #ffffff, #f0f0f0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            border-bottom: 2px solid #ddd;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <?php require("./layouts/navbar.php") ?>
    <!-- Navbar End -->

    <!-- Content Start -->
    <?php require("./layouts/menu.php") ?>
    <!-- Content End -->

    <!-- Footer Start -->
    <?php require("./layouts/footer.php") ?>
    <!-- Footer End -->

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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Javascript -->
    <script src="assets/web/js/main.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#transactionListTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });
        });
    </script>

    <script>
        <?php
        // Check if there's a Toastr message set in session
        if (isset($_SESSION['toastr'])):
            $type = $_SESSION['toastr']['type']; // success, error, info, warning
            $message = $_SESSION['toastr']['message'];
            unset($_SESSION['toastr']);
        ?>
            toastr.<?php echo $type; ?>("<?php echo $message; ?>");
        <?php endif; ?>
    </script>
</body>

</html>