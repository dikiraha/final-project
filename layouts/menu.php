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
        case 'login':
            include "views/auth/login.php";
            break;
        case 'edit_profile':
            include "views/edit_profile.php";
            break;
        case 'car':
            include "views/car.php";
            break;
        case 'booking':
            include "views/booking.php";
            break;
        case 'transaction':
            include "views/transaction.php";
            break;
        case 'transaction_list':
            include "views/transaction_list.php";
            break;
        case 'review':
            include "views/review.php";
            break;
        default:
            include "views/error.php";
    }
} else {
    include "views/home.php";
}
