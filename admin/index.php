<?php
session_start();

if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'driver')) {
    header('Location: ../auth/login.php');
    exit;
}
?>

<?php
// Array untuk menyimpan stack CSS, JS, inline style, dan script
$cssStack = [];
$jsStack = [];
$inlineStyles = [];
$inlineScripts = [];

// Fungsi untuk menambahkan CSS ke stack
function pushCss($css)
{
    global $cssStack;
    $cssStack[] = $css;
}

// Fungsi untuk menambahkan JavaScript ke stack
function pushJs($js)
{
    global $jsStack;
    $jsStack[] = $js;
}

// Fungsi untuk menambahkan kode inline CSS
function pushInlineStyle($style)
{
    global $inlineStyles;
    $inlineStyles[] = $style;
}

// Fungsi untuk menambahkan kode inline JavaScript
function pushInlineScript($script)
{
    global $inlineScripts;
    $inlineScripts[] = $script; // Menyimpan script ke dalam stack
}

// Include file konten spesifik
$page = $_GET['page'] ?? 'home';
$contentFile = $page . '.php';
?>

<!doctype html>

<html
    lang="en"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Diana Rent Car &mdash; <?php echo isset($title) ? $title : 'Admin'; ?></title>


    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/drc.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icon -->
    <link rel="stylesheet" href="../assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href=".././assets/vendor/fonts/materialdesignicons.css">
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>

    <?php
    // Render stack CSS
    foreach ($cssStack as $css) {
        echo "<link rel='stylesheet' href='$css'>\n";
    }

    // Render inline styles
    if (!empty($inlineStyles)) {
        echo "<style>\n";
        foreach ($inlineStyles as $style) {
            echo "$style\n";
        }
        echo "</style>\n";
    }
    ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php require("./layouts/sidebar.php") ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php require("./layouts/navbar.php") ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <?php require("./layouts/menu.php") ?>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php require("./layouts/footer.php") ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
    // Render stack JavaScript
    foreach ($jsStack as $js) {
        echo "<script src='$js'></script>\n";
    }

    // Render inline scripts
    if (!empty($inlineScripts)) {
        foreach ($inlineScripts as $script) {
            echo $script . "\n"; // Tampilkan script langsung
        }
    }
    ?>
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