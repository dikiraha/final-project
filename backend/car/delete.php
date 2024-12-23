<?php
require_once '../../classes/Car.php';
session_start();

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];

    // Validasi UUID sederhana
    if (preg_match('/^[0-9a-fA-F-]{36}$/', $uuid)) {
        $car = new Car();

        // Panggil metode delete di class Car untuk menghapus data mobil dari database
        $deleted = $car->delete($uuid);

        if ($deleted) {
            $_SESSION['toastr'] = [
                'type' => 'success',
                'message' => 'Car deleted successfully'
            ];
        } else {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Failed to delete car'
            ];
        }
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Invalid UUID format'
        ];
    }

    // Redirect ke halaman daftar mobil
    header("Location: ../../admin/index.php?views=car_list");
    exit;
} else {
    $_SESSION['toastr'] = [
        'type' => 'error',
        'message' => 'No UUID provided'
    ];
    header("Location: ../../admin/index.php?views=car_list");
    exit;
}
