<?php

if (isset($_GET['views'])) {
    $views = $_GET['views'];
    switch ($views) {
        case 'user_list':
            include "./pages/user/list.php";
            break;
        case 'user_add':
            include "./pages/user/add.php";
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
            include "views/error.php";
    }
} else {
    include "./home.php";
}
