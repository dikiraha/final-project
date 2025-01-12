<?php
session_start();
require_once '../../classes/Booking.php';
require_once '../../classes/Payment.php';

$bookingModel = new Booking();
$paymentModel = new Payment();

$payment = $paymentModel->getDetail($_POST['uuid']);
$booking = $bookingModel->getBookingById($payment['booking_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid = $_POST['uuid'];

    if (isset($_FILES['evidence_file']) && $_FILES['evidence_file']['error'] == 0) {
        $file = $_FILES['evidence_file'];
        $fileName = $uuid . '_' . basename($file['name']);
        $targetDir = '../../assets/uploads/evidence/';
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $data = [
                'uuid' => $uuid,
                'evidence_file' => $fileName,
            ];

            $update = [
                'status' => 'Menunggu Konfirmasi'
            ];

            $updateStatusBooking = $bookingModel->updateStatus($booking['uuid'], $update);
            $isUpdated = $paymentModel->updateEvidence($data);

            if ($isUpdated && $updateStatusBooking) {
                if ($_POST['views'] == 'transaction') {
                    $_SESSION['toastr'] = [
                        'type' => 'success',
                        'message' => 'Bukti transfer berhasil dikirim'
                    ];
                    header('Location: ../../?views=transaction&uuid=' . $booking['uuid']);
                    exit;
                } else {
                    $_SESSION['toastr'] = [
                        'type' => 'success',
                        'message' => 'Bukti transfer berhasil dikirim'
                    ];
                    header('Location: ../../?views=transaction_list');
                    exit;
                }
            } else {
                if ($_POST['views'] == 'transaction') {
                    $_SESSION['toastr'] = [
                        'type' => 'error',
                        'message' => 'Gagal menyimpan bukti transfer'
                    ];
                    header('Location: ../../?views=transaction&uuid=' . $booking['uuid']);
                    exit;
                } else {
                    $_SESSION['toastr'] = [
                        'type' => 'error',
                        'message' => 'Gagal menyimpan bukti transfer'
                    ];
                    header('Location: ../../?views=transaction_list');
                    exit;
                }
            }
        } else {
            if ($_POST['views'] == 'transaction') {
                $_SESSION['toastr'] = [
                    'type' => 'error',
                    'message' => 'Gagal mengunggah bukti transfer'
                ];
                header('Location: ../../?views=transaction&uuid=' . $booking['uuid']);
                exit;
            } else {
                $_SESSION['toastr'] = [
                    'type' => 'error',
                    'message' => 'Gagal mengunggah bukti transfer'
                ];
                header('Location: ../../?views=transaction_list');
                exit;
            }
        }
    } else {
        if ($_POST['views'] == 'transaction') {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Tidak ada file yang diunggah atau terjadi kesalahan'
            ];
            header('Location: ../../?views=transaction&uuid=' . $booking['uuid']);
            exit;
        } else {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Tidak ada file yang diunggah atau terjadi kesalahan'
            ];
            header('Location: ../../?views=transaction_list');
            exit;
        }
    }
}
