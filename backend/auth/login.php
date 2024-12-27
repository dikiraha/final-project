<?php
require_once '../../classes/User.php';

session_start();

// Jika sudah login, redirect berdasarkan peran
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'driver') {
        header('Location: ../admin/index.php');
    } else {
        header('Location: ../index.php');
    }
    exit;
}

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userData = $user->getByEmail($email);

    if ($userData && password_verify($password, $userData['password'])) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_uuid'] = $userData['uuid'];
        $_SESSION['user_role'] = $userData['role'];
        $_SESSION['user_name'] = $userData['name'];

        // Redirect berdasarkan role
        if ($userData['role'] === 'admin' || $userData['role'] === 'driver') {
            header('Location: ../../admin/index.php');
        } else {
            header('Location: ../../index.php');
        }
        exit;
    } else {
        $_SESSION['login_error'] = $userData ? "Password salah!" : "Email tidak ditemukan!";
        header('Location: ../../auth/login.php');
        exit;
    }
}
