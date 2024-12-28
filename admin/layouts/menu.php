<?php

if (isset($_GET['views'])) {
    $views = $_GET['views'];
    switch ($views) {
        case 'user_list':
            include "./pages/user/list.php";
            break;
        case 'user_create':
            include "./pages/user/create.php";
            break;
        case 'user_edit':
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/user/edit.php";
            } else {
                include "./pages/error.php";
            }
            break;
        case 'user_detail':
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/user/detail.php";
            } else {
                include "./pages/error.php";
            }
            break;
        case 'car_list':
            include "./pages/car/list.php";
            break;
        case 'car_create':
            include "./pages/car/create.php";
            break;
        case 'car_edit':
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/car/edit.php";
            } else {
                include "./pages/error.php";
            }
            break;
        case 'setting_list':
            include "./pages/setting/list.php";
            break;
        case 'setting_create':
            include "./pages/setting/create.php";
            break;
        case 'setting_edit':
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/setting/edit.php";
            } else {
                include "./pages/error.php";
            }
            break;
        case 'setting_detail':
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/setting/detail.php";
            } else {
                include "./pages/error.php";
            }
            break;
        case 'transaction_list':
            include "./pages/transaction/list.php";
            break;
        case 'transaction_edit':
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/transaction/edit.php";
            } else {
                include "./pages/error.php";
            }
            break;
        case 'transaction_detail':
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/transaction/detail.php";
            } else {
                include "./pages/error.php";
            }
            break;
        default:
            include "./pages/error.php";
    }
} else {
    include "./home.php";
}
