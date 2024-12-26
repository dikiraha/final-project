<?php
require_once '../../classes/User.php';
session_start();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $uuid = $_POST['uuid']; // UUID pengguna yang akan diupdate
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];
    $password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : null;

    // Cek apakah email sudah digunakan oleh pengguna lain
    $existingUser = $user->getByEmail($email);
    if ($existingUser && $existingUser['uuid'] !== $uuid) {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Email sudah digunakan oleh pengguna lain'
        ];
        header('Location: ../../admin/?views=user_edit&uuid=' . urlencode($uuid));
        exit;
    }

    // Data untuk update
    $updateData = [
        'name' => $name,
        'email' => $email,
        'phone_number' => $phone_number,
        'role' => $role,
    ];

    // Jika password diisi, hash password dan tambahkan ke data update
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $updateData['password'] = $hashedPassword;
    }

    // Lakukan update
    $isUpdated = $user->update($uuid, $updateData);

    if ($isUpdated) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Update Successfully'
        ];
        header('Location: ../../admin/?views=user_list');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Terjadi kesalahan saat mengupdate data'
        ];
        header('Location: ../../admin/?views=user_edit&uuid=' . urlencode($uuid));
        exit;
    }
} else {
    // Jika metode tidak POST, redirect ke daftar pengguna
    header('Location: ../../admin/?views=user_list');
    exit;
}
