<?php
require_once '../../classes/User.php';
session_start();

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];

    $existingUser = $user->getByEmail($email);
    if ($existingUser) {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Email sudah digunakan'
        ];
        header('Location: ../../admin/?views=user_create');
        exit;
    }

    $uuid = Uuid::uuid4()->toString();
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Buat pengguna baru
    $isCreated = $user->create([
        'uuid' => $uuid,
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
        'phone_number' => $phone_number,
        'role' => $role,
    ]);

    if ($isCreated) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Create Successfully'
        ];
        header('Location: ../../admin/?views=user_list');
        exit;
    } else {
        $_SESSION['register_error'] = "Terjadi kesalahan saat mendaftar. Silakan coba lagi!";
        header('Location: ../../admin/?views=user_create');
        exit;
    }
}
