<?php
require_once '../../classes/Setting.php';
session_start();

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Guid\Guid;

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];

    if (Guid::isValid($uuid)) {
        $setting = new Setting();

        $deleted = $setting->delete($uuid);

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

    header("Location: ../../admin/index.php?views=setting_list");
    exit;
} else {
    $_SESSION['toastr'] = [
        'type' => 'error',
        'message' => 'Error'
    ];
    header("Location: ../../admin/index.php?views=setting_list");
    exit;
}
