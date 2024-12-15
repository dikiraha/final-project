<?php
require_once '../classes/User.php';

$user = new User();
$id = $_GET['uuid'];
$userData = $user->getById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];
    $user->update($id, $data);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>
    <form method="POST">
        <input type="text" name="name" value="<?= $user['name']; ?>" required>
        <input type="email" name="email" value="<?= $user['email']; ?>" required>
        <select name="role" required>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="driver" <?= $user['role'] === 'driver' ? 'selected' : ''; ?>>Driver</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>
        <button type="submit">Update User</button>
    </form>
</body>

</html>