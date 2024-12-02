<?php
require_once '../classes/User.php';

$user = new User();
$id = $_GET['id'];

if ($user->delete($id)) {
    header('Location: index.php');
}
?>
