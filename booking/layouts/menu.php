<?php

if (isset($_GET['views'])) {
    $views = $_GET['views'];
    switch ($views) {
        case 'home':
            include "views/home.php";
            break;
        default:
            include "views/error.php";
    }
} else {
    include "views/home.php";
}
