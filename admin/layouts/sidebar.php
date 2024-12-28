<?php
$home = false;
$transaction_list = false;
$report_list = false;
$user_list = false;
$user_create = false;
$user_edit = false;
$user_detail = false;
$car_list = false;
$setting_list = false;

if (isset($_GET['views'])) {
    $views = $_GET['views'];
    switch ($views) {
        case 'home':
            $home = true;
            break;
        case 'transaction_list':
            $transaction_list = true;
            break;
        case 'transaction_detail':
            $transaction_detail = true;
            break;
        case 'report_list':
            $report_list = true;
            break;
        case 'user_list':
            $user_list = true;
            break;
        case 'user_create':
            $user_create = true;
            break;
        case 'user_edit':
            $user_edit = true;
            break;
        case 'user_detail':
            $user_detail = true;
            break;
        case 'car_list':
            $car_list = true;
            break;
        case 'car_create':
            $car_create = true;
            break;
        case 'car_edit':
            $car_edit = true;
            break;
        case 'setting_list':
            $setting_list = true;
            break;
        case 'setting_create':
            $setting_create = true;
            break;
        case 'setting_edit':
            $setting_edit = true;
            break;
        case 'setting_detail':
            $setting_detail = true;
            break;
        default:
            $home = false;
    }
} else {
    $home = true;
}
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-semibold ms-2">DIANA RENT CAR</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="menu-toggle-icon d-xl-block align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item <?= $home ? 'active' : '' ?>">
            <a href="./index.php" class="menu-link">
                <i class="menu-icon tf-icons ri-home-smile-line"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Apps -->
        <li class="menu-header mt-7">
            <span class="menu-header-text">Apps &amp; Pages</span>
        </li>
        <li class="menu-item <?= $transaction_list || $transaction_detail ? 'active' : '' ?>">
            <a
                href="?views=transaction_list"
                class="menu-link">
                <i class="menu-icon tf-icons ri-coupon-line"></i>
                <div data-i18n="Transaksi">Transaksi</div>
                <?php
                require_once '../classes/Booking.php';

                $bookingModel = new Booking();

                $totalBookings = $bookingModel->getTotalBookings();
                ?>
                <div class="badge bg-danger fs-tiny rounded-pill ms-auto"><?php echo htmlspecialchars($totalBookings); ?></div>
            </a>
        </li>

        <li class="menu-item <?= $report_list ? 'active' : '' ?>">
            <a
                href="?views=report_list"
                class="menu-link">
                <i class="menu-icon tf-icons ri-file-copy-2-line"></i>
                <div data-i18n="Laporan">Laporan</div>
                <!-- <div class="badge bg-danger fs-tiny rounded-pill ms-auto">1</div>   -->
            </a>
        </li>

        <!-- Master -->
        <li class="menu-header mt-7"><span class="menu-header-text">Master</span></li>

        <li class="menu-item <?= $car_list || $car_create || $car_edit ? 'active' : '' ?>">
            <a href="?views=car_list" class="menu-link">
                <i class="menu-icon tf-icons ri-roadster-fill"></i>
                <div data-i18n="Data Mobil">Data Mobil</div>
            </a>
        </li>

        <li class="menu-item <?= $setting_list || $setting_create || $setting_edit || $setting_detail ? 'active' : '' ?>">
            <a href="?views=setting_list" class="menu-link">
                <i class="menu-icon tf-icons ri-settings-3-line"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
        </li>

        <li class="menu-item <?= $user_list || $user_create || $user_edit || $user_detail ? 'active' : '' ?>">
            <a href="?views=user_list" class="menu-link">
                <i class="menu-icon tf-icons ri-group-line"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
    </ul>
</aside>