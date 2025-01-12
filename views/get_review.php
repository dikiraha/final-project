<?php
require_once '../classes/Booking.php';
require_once '../classes/Review.php';

$uuid = $_POST['uuid'];
$getBooking = new Booking();
$booking = $getBooking->getBookingByUuid($uuid);

$modelReview = new Review();
$review = $modelReview->getById($booking['id']);

if ($booking) {
    $review = $modelReview->getById($booking['id']);
    echo json_encode([
        'grade' => $review['grade'],
        'description' => $review['description'],
    ]);
} else {
    echo json_encode(['error' => 'Data not found']);
}
