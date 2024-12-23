<?php
require_once '../../classes/Sk.php';
require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Guid\Guid;

session_start();

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];

    if (Guid::isValid($uuid)) {
        if (class_exists('Sk')) {
            $sk = new Sk();

            if (method_exists($sk, 'delete')) {
                // Panggil metode delete
                $deleted = $sk->delete($uuid);

                if ($deleted) {
                    $_SESSION['toastr'] = [
                        'type' => 'success',
                        'message' => 'Delete successfully'
                    ];
                } else {
                    $_SESSION['toastr'] = [
                        'type' => 'error',
                        'message' => 'Failed to delete'
                    ];
                }
            } else {
                $_SESSION['toastr'] = [
                    'type' => 'error',
                    'message' => 'Method delete not found in Sk class'
                ];
            }
        } else {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Class Sk not found'
            ];
        }
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Invalid UUID'
        ];
    }
} else {
    $_SESSION['toastr'] = [
        'type' => 'error',
        'message' => 'No UUID provided'
    ];
}

// Redirect back to the sk management page
header("Location: ../../admin/index.php?views=sk_list");
exit;
