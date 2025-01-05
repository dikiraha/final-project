<?php
require_once '../../classes/User.php';
session_start();

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $name = trim($_POST['name']);
    $phone_number = trim($_POST['phone_number']);

    // Inisialisasi pesan error
    $errors = [];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Validasi password (minimal 8 karakter, ada huruf besar, kecil, dan angka)
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $errors[] = "Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.";
    }

    // Validasi nama (tidak boleh kosong)
    if (empty($name)) {
        $errors[] = "Nama tidak boleh kosong.";
    }

    // Validasi nomor telepon Indonesia
    if (!preg_match('/^08\d{8,11}$/', $phone_number)) {
        $errors[] = "Nomor telepon harus dimulai dengan 08 dan memiliki panjang 10-13 digit.";
    }

    // Cek apakah ada error
    if (!empty($errors)) {
        $_SESSION['register_error'] = implode('<br>', $errors);
        header('Location: ../../auth/register.php');
        exit;
    }

    // Cek apakah email sudah digunakan
    $existingUser = $user->getByEmail($email);
    if ($existingUser) {
        $_SESSION['register_error'] = "Email sudah digunakan!";
        header('Location: ../../auth/register.php');
        exit;
    }

    // Generate UUID dan hash password
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
        $_SESSION['user_uuid'] = $userData['uuid'];
        $_SESSION['user_role'] = $userData['role'];
        $_SESSION['user_name'] = $userData['name'];

        // Redirect ke halaman utama
        header('Location: ../../index.php');
        exit;
    } else {
        $_SESSION['register_error'] = "Terjadi kesalahan saat mendaftar. Silakan coba lagi!";
        header('Location: ../../auth/register.php');
        exit;
    }
}
