<?php

if (isset($_GET['views'])) {
    $views = $_GET['views'];
    switch ($views) {
        case 'home':
            include "views/home.php";
            break;
        case 'about':
            include "views/about.php";
            break;
        case 'contact':
            include "views/contact.php";
            break;
        default:
            include "page/error.php";
    }
} else {
    include "page/index.php";
}
