<?php
session_start();
require_once '../classes/User.php';

$user = new User();
$users = $user->getAll();

if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'driver')) {
    header('Location: ../auth/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Master Users</title>
</head>

<body>
    <h1>Master Users</h1>
    <a href="create.php">Add User</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['role']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $user['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?= $user['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>