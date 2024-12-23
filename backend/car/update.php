<?php
require_once '../../classes/Car.php';
session_start();

$car = new Car();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid = $_POST['uuid'];
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $jumlah_kursi = $_POST['jumlah_kursi'];
    $jumlah_pintu = $_POST['jumlah_pintu'];
    $warna = $_POST['warna'];
    $no_plat = $_POST['no_plat'];
    $tahun = $_POST['tahun'];
    $km = $_POST['km'];
    $jenis_bensin = $_POST['jenis_bensin'];
    $harga = $_POST['harga'];
    $denda = $_POST['denda'];
    $transmisi = $_POST['transmisi'];

    // Ambil data mobil lama
    $existingCar = $car->edit($uuid);

    if (!$existingCar) {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Car not found!'
        ];
        header('Location: ../../admin/?views=car_list');
        exit;
    }

    // Upload photo jika ada
    $photoName = $existingCar['photo']; // Gunakan foto lama secara default
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/';
        $photoName = uniqid() . '-' . basename($_FILES['photo']['name']);
        $uploadPath = $uploadDir . $photoName;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Failed to upload photo. Please try again.'
            ];
            header('Location: ../../admin/?views=car_edit&uuid=' . urlencode($uuid));
            exit;
        }
    }

    // Data untuk update
    $updateData = [
        'merk' => $merk,
        'tipe' => $tipe,
        'jumlah_kursi' => $jumlah_kursi,
        'jumlah_pintu' => $jumlah_pintu,
        'warna' => $warna,
        'no_plat' => $no_plat,
        'tahun' => $tahun,
        'km' => $km,
        'jenis_bensin' => $jenis_bensin,
        'harga' => $harga,
        'denda' => $denda,
        'transmisi' => $transmisi,
        'photo' => $photoName,
        'updated_by' => $_SESSION['user_id'] ?? null
    ];

    // Lakukan update
    $isUpdated = $car->update($uuid, $updateData);

    if ($isUpdated) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Car updated successfully'
        ];
        header('Location: ../../admin/?views=car_list');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to update car. Please try again.'
        ];
        header('Location: ../../admin/?views=car_edit&uuid=' . urlencode($uuid));
        exit;
    }
}
