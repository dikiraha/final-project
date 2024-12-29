<?php
session_start();
require_once '../../classes/Booking.php';
require_once '../../classes/Payment.php';
require_once '../../classes/Car.php';
require_once '../../classes/User.php';

$uuid = $_POST['uuid'];

$bookingModel = new Booking();
$booking = $bookingModel->getBookingByUuid($uuid);
$getDriver = $booking['driver_id'];
if ($getDriver == null) {
    $driver_id = $_POST['driver_id'];
} else {
    $driver_id = $getDriver;
}

$paymentModel = new Payment();
$payment = $paymentModel->getPaymentByBookingId($booking['id']);
if ($booking['total_harga'] !== $payment['amount']) {
    $newAmount = $payment['amount'] + intval($_POST['remaining_amount']);
} else {
    $newAmount = $payment['amount'];
}

$carModel = new Car();
$car = $carModel->getCarById($booking['car_id']);

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
        'driver_id' => $driver_id,
        'status' => $_POST['status'],
        'total_denda' => $total_denda,
    ];

    $updatePayment = [
        'amount' => $newAmount,
    ];

    if ($_POST['status'] == 'Selesai') {
        $updateCar = [
            'km' => $_POST['km'],
        ];

        $updateCar = $carModel->update($car['uuid'], $updateCar);
    }

    $updateBooking = $bookingModel->update($uuid, $updateBooking);
    $updatePayment = $paymentModel->update($payment['uuid'], $updatePayment);

    if ($updateBooking && $updatePayment) {
        $modelUser = new User();
        $user = $modelUser->getById($booking['user_id']);
        $nomor = $user['phone_number'];

        $token = "BtPvgC8xZUwYc8rQSeGBfxK8XKppEnSdDU8HKuZdfBqB9fDMUx";
        $isi = "Booking sudah dikonfirmasi Admin nih\n";
        $isi .= "\nNo Booking : " . $booking['no_booking'];
        $isi .= "\nStatus : " . $_POST['status'];
        $message = sprintf("----------DIANA RENT CAR----------%c$isi%c--------------------------------------- ", 10, 10);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $token . '&number=' . $nomor . '&message=' . $message,
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Update Successfully'
        ];
        header('Location: ../../admin/?views=transaction_list');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to create car. Please try again.'
        ];
        header('Location: ../../admin/?views=transaction_list');
        exit;
    }
}
