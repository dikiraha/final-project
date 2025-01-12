<?php
session_start();
require_once '../../classes/Booking.php';
require_once '../../classes/Payment.php';
require_once '../../classes/Car.php';
require_once '../../classes/User.php';
require_once '../../classes/Setting.php';

$getSetting = new Setting();
$setting = $getSetting->list()[0];

$uuid = $_POST['uuid'];

$bookingModel = new Booking();
$booking = $bookingModel->getBookingByUuid($uuid);

if ($booking['driver_id']) {
    $driver_id = $booking['driver_id'];
} else {
    $getDriver = $_POST['driver_id'];
    if ($getDriver == null) {
        $driver_id = null;
    } else {
        $driver_id = $getDriver;
    }
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
        'note' => $_POST['note'],
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

    $start = new DateTime($booking['date_start']);
    $end = new DateTime($booking['date_end']);
    $interval = $start->diff($end);
    $duration = $interval->days;

    if ($updateBooking && $updatePayment) {
        $modelUser = new User();
        $user = $modelUser->getById($booking['user_id']);
        $nomor = $user['phone_number'];

        $token = "BtPvgC8xZUwYc8rQSeGBfxK8XKppEnSdDU8HKuZdfBqB9fDMUx";

        $isi = "\n📢 *Pemberitahuan Penyewaan Mobil*\n";
        $isi .= "\n*Status* : " . $_POST['status'];
        $isi .= "\n*Note* : " . $_POST['note'];

        $isi .= "\n\n🎫 *No Booking* : " . $booking['no_booking'];
        $isi .= "\n👤 *Nama Penyewa* : " . $user['name'];
        $isi .= "\n🚗 *Mobil yang Disewa* : " . $car['merk'] . " " . $car['tipe'];
        $isi .= "\n🛣️ *Kota Tujuan* : " . $booking['destination'];
        $isi .= "\n📅 *Tanggal Sewa* : " . $booking['date_start'];
        $isi .= "\n📅 *Tanggal Kembali* : " . $booking['date_end'];
        $isi .= "\n⏱️ *Durasi Sewa* : " . $duration . " Hari";
        $isi .= "\n💲 *Harga Mobil* : " . "Rp "  . number_format($booking['total_harga'], 0, ',', '.');
        $isi .= "\n💲 *Metode Pembayaran* : " . $payment['method'];
        $isi .= "\n💲 *Total Pembayaran* : " . "Rp "  . number_format($newAmount, 0, ',', '.');

        if ($_POST['status'] == 'Disetujui') {
            $isi .= "\n\n📍 *Alamat Pengambilan* : " . $setting['address'];
            $isi .= "\n📍 *Link Google Maps* : " . "https://maps.app.goo.gl/eGcdaWs1zR2NhZQB7";

            if ($booking['total_harga'] != $payment['amount']) {
                $isi .= "\n\n*Harap lakukan pelunasan pada alamat diatas";
            }
        }
        $message = sprintf("----------DIANA RENT CAR----------%c$isi%c-------------------------------------- ", 10, 10);

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

        if ($getDriver && $driver_id != null) {
            $driver = $modelUser->getById($driver_id);
            $phone_number_driver = $driver['phone_number'];

            $token = "BtPvgC8xZUwYc8rQSeGBfxK8XKppEnSdDU8HKuZdfBqB9fDMUx";

            $isi = "\n📢 *Pemberitahuan Jasa Driver*\n";
            $isi .= "\n*Note* : Harap persiapkan diri anda untuk perjalanan";

            $isi .= "\n\n🎫 *No Booking* : " . $booking['no_booking'];
            $isi .= "\n👤 *Nama Penyewa* : " . $user['name'];
            $isi .= "\n🚗 *Mobil yang Disewa* : " . $car['merk'] . " " . $car['tipe'];
            $isi .= "\n🛣️ *Kota Tujuan* : " . $booking['destination'];
            $isi .= "\n📅 *Tanggal Sewa* : " . $booking['date_start'];
            $isi .= "\n📅 *Tanggal Kembali* : " . $booking['date_end'];
            $isi .= "\n⏱️ *Durasi Sewa* : " . $duration . " Hari";
            $isi .= "\n\n*Harap datang ke Diana Rent Car 1 jam sebelum jam tanggal sewa";
            $message = sprintf("----------DIANA RENT CAR----------%c$isi%c-------------------------------------- ", 10, 10);

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
                CURLOPT_POSTFIELDS => 'token=' . $token . '&number=' . $phone_number_driver . '&message=' . $message,
            ));

            $response = curl_exec($curl);
            curl_close($curl);
        }

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
