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
        case 'sk_list':
            include "./pages/sk/list.php";
            break;
        case 'sk_create':
            include "./pages/sk/create.php";
            break;
        case 'about':
            include "views/about.php";
            break;
        case 'contact':
            include "views/contact.php";
            break;
        case 'login':
            include "views/auth/login.php";
            break;
        default:
            include "./pages/error.php";
    }
} else {
    include "./home.php";
}
