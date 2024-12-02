<?php
session_start();

if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'driver')) {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Welcome to Admin Dashboard</h1>
    <p>Role: <?= $_SESSION['user_role']; ?></p>
    <a href="../auth/logout.php">Logout</a>
</body>

</html>