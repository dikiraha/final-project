<?php
require_once '../../classes/Booking.php';
require_once '../../classes/Review.php';

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$modelBooking = new Booking();
$booking = $modelBooking->getBookingByUuid($_POST['uuid']);

$modelReview = new Review();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid = Uuid::uuid4()->toString();

    $reviewCreate = $modelReview->create([
        'uuid' => $uuid,
        'booking_id' => $booking['id'],
        'car_id' => $booking['car_id'],
        'user_id' => $booking['user_id'],
        'grade' => $_POST['grade'],
        'description' => $_POST['description'],
    ]);

    if ($reviewCreate) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Terima kasih telah review'
        ];
        header('Location: ../../index.php?views=transaction_list');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to create booking. Please try again.'
        ];
        header('Location: ../../index.php?views=transaction_list');
        exit;
    }
}
