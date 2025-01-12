<?php
if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];
    $reviewBooking = $getBooking->getBookingByUuid($uuid);
    if ($reviewBooking) {
        echo json_encode([
            'grade' => $reviewBooking['grade'],
            'description' => $reviewBooking['description']
        ]);
    } else {
        echo json_encode(['error' => 'Ulasan tidak ditemukan']);
    }
    exit;
}
