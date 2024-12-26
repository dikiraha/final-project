<?php
require_once '../../classes/Car.php';
session_start();

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$car = new Car();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipe = $_POST['tipe'];
    $merk = $_POST['merk'];
    $jumlah_kursi = $_POST['jumlah_kursi'];
    $jumlah_pintu = $_POST['jumlah_pintu'];
    $warna = $_POST['warna'];
    $no_plat = $_POST['no_plat'];
    $tahun = $_POST['tahun'];

    $km = isset($_POST['km']) ? str_replace('.', '', $_POST['km']) : 0;

    $jenis_bensin = $_POST['jenis_bensin'];
    $harga = $_POST['harga'];
    $denda = $_POST['denda'];
    $transmisi = $_POST['transmisi'];
    $status = $_POST['status'];

    // Upload photo
    $photoName = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/uploads/car/';
        $photoName = uniqid() . '-' . basename($_FILES['photo']['name']);
        $uploadPath = $uploadDir . $photoName;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Failed to upload photo. Please try again.'
            ];
            header('Location: ../../admin/?views=car_create');
            exit;
        }
    }

    $uuid = Uuid::uuid4()->toString();

    $isCreated = $car->create([
        'uuid' => $uuid,
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
        'status' => $status,
        'photo' => $photoName,
        'created_by' => $_SESSION['user_id'] ?? null
    ]);

    if ($isCreated) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Create Successfully'
        ];
        header('Location: ../../admin/?views=car_list');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to create car. Please try again.'
        ];
        header('Location: ../../admin/?views=car_create');
        exit;
    }
}
