<?php
session_start();
require_once '../../classes/Booking.php';
require_once '../../classes/Payment.php';

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$booking = new Booking();
$payment = new Payment();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingUuid = Uuid::uuid4()->toString();
    $paymentUuid = Uuid::uuid4()->toString();

    $currentYear = date('y');
    $currentMonth = date('m');

    $lastNoBooking = $booking->getNoBooking();

    if (!empty($lastNoBooking)) {
        $lastBookingNumber = $lastNoBooking[0]['no_booking'];
        $lastSequence = (int)substr($lastBookingNumber, -3);
        $newSequence = str_pad($lastSequence + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newSequence = '001';
    }

    $no_booking = "DRC/BOOK/$currentYear$currentMonth$newSequence";

    if ($_POST['is_driver'] == 'Iya') {
        $is_driver = 1;
    } else {
        $is_driver = 0;
    }

    $car_id = $_POST['car_id'];
    $user_id = $_SESSION['user_id'];
    $is_driver = $is_driver;
    $driver_id = null;
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $destination = $_POST['destination'];
    $total_harga = $_POST['total_harga'];
    $harga_mobil = $_POST['harga_mobil'];
    $denda_mobil = $_POST['denda_mobil'];
    $status = 'Belum Bayar';

    $bookingCreate = $booking->create([
        'uuid' => $bookingUuid,
        'no_booking' => $no_booking,
        'car_id' => $car_id,
        'user_id' => $user_id,
        'is_driver' => $is_driver,
        'driver_id' => $driver_id,
        'date_start' => $date_start,
        'date_end' => $date_end,
        'destination' => $destination,
        'total_harga' => $total_harga,
        'harga_mobil' => $harga_mobil,
        'denda_mobil' => $denda_mobil,
        'status' => $status,
    ]);

    $booking_id = $booking->getBookingByUuid($bookingUuid);

    if ($_POST['method'] == 'Transfer') {
        $amount = $_POST['amount_hidden'];
        $type = $_POST['type'];
    } else {
        $amount = null;
        $type = null;
    }

    $paymentCreate = $payment->create([
        'uuid' => $paymentUuid,
        'booking_id' => $booking_id['id'],
        'user_id' => $user_id,
        'car_id' => $car_id,
        'method' => $_POST['method'],
        'type' => $type,
        'amount' => $amount,
        'evidence' => null,
    ]);

    if ($bookingCreate) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Booking created successfully'
        ];
        header('Location: ../../index.php?views=transaction&uuid=' . $bookingUuid);
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to create booking. Please try again.'
        ];
        header('Location: ../../index.php?views=booking&uuid=' . $_POST['car_uuid']);
        exit;
    }
}
