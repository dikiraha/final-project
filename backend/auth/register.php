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

    // Periksa apakah email sudah ada
    $existingUser = $user->getByEmail($email);
    if ($existingUser) {
        $_SESSION['register_error'] = "Email sudah digunakan!";
        header('Location: ../../auth/register.php');
        exit;
    }

    $uuid = Uuid::uuid4()->toString();
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $role = 'user';

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
        // Simpan informasi sesi
        $userData = $user->getByEmail($email);
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_role'] = $userData['role'];

        // Redirect ke halaman utama
        header('Location: ../../index.php');
        exit;
    } else {
        $_SESSION['register_error'] = "Terjadi kesalahan saat mendaftar. Silakan coba lagi!";
        header('Location: ../../auth/register.php');
        exit;
    }
}
