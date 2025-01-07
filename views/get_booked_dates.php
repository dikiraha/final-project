<?php
require_once '../classes/Booking.php';

$bookingModel = new Booking();
$bookings = $bookingModel->getBookingsByStatuses(['Disetujui', 'Berjalan']);

$bookedDates = [];
foreach ($bookings as $booking) {
    $start = new DateTime($booking['date_start']);
    $end = new DateTime($booking['date_end']);
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($start, $interval, $end->modify('+1 day'));

    foreach ($dateRange as $date) {
        $bookedDates[] = $date->format('Y-m-d');
    }
}

echo json_encode($bookedDates);
