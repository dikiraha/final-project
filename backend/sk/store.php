<?php
require_once '../../classes/Sk.php';
session_start();

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$sk = new Sk();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $context = $_POST['context'];
    $content = $_POST['content'];

    $uuid = Uuid::uuid4()->toString();

    $isCreated = $sk->create([
        'uuid' => $uuid,
        'context' => $context,
        'content' => $content,
    ]);

    if ($isCreated) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Create Successfully'
        ];
        header('Location: ../../admin/?views=sk_list');
        exit;
    } else {
        $_SESSION['register_error'] = "Terjadi kesalahan saat mendaftar. Silakan coba lagi!";
        header('Location: ../../admin/?views=sk_create');
        exit;
    }
}
