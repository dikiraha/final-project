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
            // Pastikan UUID tersedia sebelum memuat halaman edit
            if (isset($_GET['uuid'])) {
                $uuid = $_GET['uuid'];
                include "./pages/user/edit.php";
            } else {
                // Redirect atau tampilkan pesan error jika UUID tidak tersedia
                include "./pages/error.php";
            }
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
