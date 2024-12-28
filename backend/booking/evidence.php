<?php
session_start();
require_once '../../classes/Booking.php';
require_once '../../classes/Payment.php';

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$booking = new Booking();
$payment = new Payment();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}
