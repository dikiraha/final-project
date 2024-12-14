<?php
require_once '../../classes/User.php';
session_start();

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Guid\Guid;
use Ramsey\Uuid\Guid\GuidInterface;

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];

    // Validating the UUID format
    if (Guid::isValid($uuid)) {
        $user = new User();

        // Call the delete method in the User class to remove the user from the database
        $deleted = $user->delete($uuid);

        if ($deleted) {
            $_SESSION['toastr'] = [
                'type' => 'success',
                'message' => 'Delete successfully'
            ];
        } else {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Failed'
            ];
        }
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Invalid UUID'
        ];
    }

    // Redirect back to the user management page
    header("Location: ../../admin/index.php?views=user_list");
    exit;
} else {
    $_SESSION['toastr'] = [
        'type' => 'error',
        'message' => 'Error'
    ];
    header("Location: ../../admin/index.php?views=user_list");
    exit;
}
