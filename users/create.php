<?php
require_once '../classes/User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'role' => $_POST['role'],
    ];
    $user->create($data);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
</head>

<body>
    <h1>Add User</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="user">User</option>
            <option value="driver">Driver</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Create User</button>
    </form>
</body>

</html>