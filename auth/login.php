<?php
require_once '../classes/User.php';

session_start();
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
        $_SESSION['user_role'] = $userData['role'];

        // Redirect based on role
        if ($userData['role'] === 'admin' || $userData['role'] === 'driver') {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../index.php');
        }
        exit;
    } else {
        echo "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>