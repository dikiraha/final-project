<?php
session_start();
require_once '../../classes/Booking.php';
require_once '../../classes/Payment.php';

$uuid = $_POST['uuid'];

$bookingModel = new Booking();
$booking = $bookingModel->getBookingByUuid($uuid);

$paymentModel = new Payment();
$payment = $paymentModel->getPaymentByBookingId($booking['id']);
if ($booking['total_harga'] !== $payment['amount']) {
    $newAmount = $payment['amount'] + intval($_POST['remaining_amount']);
} else {
    $newAmount = $payment['amount'];
}

$total_denda = 0;
$timezone = new DateTimeZone('Asia/Jakarta'); // Set the desired timezone
$now = new DateTime('now', $timezone);
$date_end = new DateTime($booking['date_end'], $timezone);

if ($now > $date_end) {
    $interval = $now->diff($date_end);
    $hours_overdue = $interval->h + ($interval->days * 24);
    $total_denda = $booking['denda_mobil'] * $hours_overdue;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateBooking = [
        'driver_id' => $_POST['driver_id'],
        'status' => $_POST['status'],
        'total_denda' => $total_denda,
    ];

    $updatePayment = [
        'amount' => $newAmount,
    ];

    $updateBooking = $bookingModel->update($uuid, $updateBooking);
    $updatePayment = $paymentModel->update($payment['uuid'], $updatePayment);

    if ($updateBooking && $updatePayment) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Update Successfully'
        ];
        header('Location: ../../admin/?views=transaction_list');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to update profile'
        ];
        header('Location: ../../admin/?views=transaction_list');
        exit;
    }
}
