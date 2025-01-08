<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '../logs/php_errors.log');

require_once '../classes/Booking.php';
require_once '../classes/Car.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['uuid'])) {
        throw new Exception('UUID is required');
    }

    $uuid = $_GET['uuid'];

    $bookingModel = new Booking();
    $bookings = $bookingModel->getBookingsByStatusesAndUuid(['Disetujui', 'Berjalan'], $uuid);

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
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
