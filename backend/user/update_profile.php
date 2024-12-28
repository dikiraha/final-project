<?php
session_start();

require_once '../../classes/User.php';
require_once '../../classes/Profile.php';
require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$user_uuid = $_SESSION['user_uuid'];
$user_id = $_SESSION['user_id'];

$getUser = new User();
$getProfile = new Profile(); // Pastikan kelas Profile didefinisikan dan memiliki metode update.
$user = $getUser->detail($user_uuid);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid = Uuid::uuid4()->toString();

    $uploadedFiles = ['photo_profile', 'ktp', 'sim', 'kk', 'buku_nikah', 'akte', 'ijazah', 'id_card', 'surat_keterangan', 'slip_gaji', 'bpjs'];
    $fileNames = [];

    foreach ($uploadedFiles as $fileKey) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $fileTmpName = $_FILES[$fileKey]['tmp_name'];
            $fileName = $uuid . '_' . basename($_FILES[$fileKey]['name']);
            $targetDir = '../../assets/uploads/' . $fileKey . '/';

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // Buat folder jika belum ada
            }

            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($fileTmpName, $targetFile)) {
                $fileNames[$fileKey] = $fileName;
            } else {
                $_SESSION['toastr'] = [
                    'type' => 'error',
                    'message' => "Failed to upload $fileKey"
                ];
                header('Location: ../../admin/?views=setting_create');
                exit;
            }
        } else {
            $fileNames[$fileKey] = null;
        }
    }

    $oldPassword = $user['password'];
    $password = $_POST['new_password'];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashedPassword = $oldPassword;
    }

    $dataUser = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone_number' => $_POST['phone_number'],
        'role' => $user['role'],
        'password' => $hashedPassword,
        'ktp' => $fileNames['ktp'],
    ];

    $dataProfile = [
        'uuid' => $uuid,
        'user_id' => $user_id,
        'user_uuid' => $user_uuid,
        'address' => $_POST['address'],
        'gender' => $_POST['gender'],
        'photo_profile' => $fileNames['photo_profile'] ?? null,
        'ktp' => $fileNames['ktp'],
        'sim' => $fileNames['sim'],
        'kk' => $fileNames['kk'],
        'buku_nikah' => $fileNames['buku_nikah'] ?? null,
        'akte' => $fileNames['akte'],
        'ijazah' => $fileNames['ijazah'],
        'id_card' => $fileNames['id_card'] ?? null,
        'surat_keterangan' => $fileNames['surat_keterangan'] ?? null,
        'slip_gaji' => $fileNames['slip_gaji'] ?? null,
        'bpjs' => $fileNames['bpjs'] ?? null,
    ];

    $updateUser = $getUser->update($uuid, $dataUser);
    $updateProfile = $getProfile->saveOrUpdate($dataProfile);

    // var_dump($dataProfile, $updateUser, $updateProfile);

    if ($updateUser && $updateProfile) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Profile updated successfully'
        ];
        header('Location: ../../index.php?views=edit_profile');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to update profile'
        ];
        header('Location: ../../index.php?views=edit_profile');
        exit;
    }
}
