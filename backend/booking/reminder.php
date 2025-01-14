<?php
session_start();
require_once '../../classes/Booking.php';
require_once '../../classes/Payment.php';
require_once '../../classes/Car.php';
require_once '../../classes/User.php';

$bookingModel = new Booking();
$paymentModel = new Payment();
$carModel = new Car();
$userModel = new User();

$bookingOnProgress = $bookingModel->getBookingOnProgress();

$timezone = new DateTimeZone('Asia/Jakarta');

$now = new DateTime('now', $timezone);

$bookingLate = [];

foreach ($bookingOnProgress as $booking) {
    $dateEnd = new DateTime($booking['date_end'], $timezone);

    if ($dateEnd < $now) {
        $interval = $dateEnd->diff($now);

        $lateMinutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

        if ($lateMinutes <= 60) {
            $lateHours = 1;
        } else {
            $lateHours = ceil($lateMinutes / 60);
        }

        $booking['late_hours'] = $lateHours;

        $bookingLate[] = $booking;
    }
}

foreach ($bookingLate as $booking) {
    $user = $userModel->getById($booking['user_id']);

    $nomor = $user['phone_number'];
    $token = "BtPvgC8xZUwYc8rQSeGBfxK8XKppEnSdDU8HKuZdfBqB9fDMUx";

    $no_booking = $booking['no_booking'];
    $dataCar = $carModel->getCarById($booking['car_id']);
    $destination = $booking['destination'];
    $total_harga = $booking['total_harga'];
    $start = new DateTime($booking['date_start']);
    $end = new DateTime($booking['date_end']);
    $interval = $start->diff($end);
    $duration = $interval->days;
    $total_denda = $booking['denda_mobil'] * $lateHours;

    $isi = "";
    $isi .= "\n📢 *Pemberitahuan Telat Pengembalian Penyewaan Mobil*\n";
    $isi .= "\n🎫 *No Booking* : " . $no_booking;
    $isi .= "\n👤 *Nama Penyewa* : " . $user['name'];
    $isi .= "\n🚗 *Mobil yang Disewa* : " . $dataCar['merk'] . " " . $dataCar['tipe'];
    $isi .= "\n🛣️ *Kota Tujuan* : " . $destination;
    $isi .= "\n📅 *Tanggal Sewa* : " . $booking['date_start'];
    $isi .= "\n📅 *Tanggal Kembali* : " . $booking['date_end'];
    $isi .= "\n⏱️ *Durasi Sewa* : " . $duration . " Hari";
    $isi .= "\n💲 *Denda Perjam* : " . "Rp "  . number_format($booking['denda_mobil'], 0, ',', '.');
    $isi .= "\n⏱️ *Waktu Telat* : " . $lateHours . " Jam";
    $isi .= "\n💲 *Total Denda* : " . "Rp "  . number_format($total_denda, 0, ',', '.');
    $isi .= "\n\n*Mohon kembalikan kendaraan agar total denda tidak bertambah.*";

    $message = sprintf("----------DIANA RENT CAR----------%c$isi%c-------------------------------------- ", 10, 10);
    $message = urlencode($message);

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
}

if ($bookingLate && $response) {
    echo json_encode(['message' => 'Reminder sukses dikirim']);
} else {
    echo json_encode(['message' => 'Tidak ada reminder']);
}