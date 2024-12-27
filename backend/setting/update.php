<?php
require_once '../../classes/Setting.php';
session_start();

require_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$getSetting = new Setting();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $uuid = Uuid::uuid4()->toString();

    $data = [
        'uuid' => $uuid,
        'owner' => $_POST['owner'],
        'bank' => $_POST['bank'],
        'account_number' => $_POST['account_number'],
        'account_name' => $_POST['account_name'],
        'address' => $_POST['address'],
        'email' => $_POST['email'],
        'phone_number_1' => $_POST['phone_number_1'],
        'phone_number_2' => $_POST['phone_number_2'],
        'agreement_1' => $_POST['agreement_1'],
        'agreement_2' => $_POST['agreement_2'],
        'visi' => $_POST['visi'],
        'misi' => $_POST['misi'],
        'about_company' => $_POST['about_company'],
        'history_company' => $_POST['history_company'],
        'about_footer' => $_POST['about_footer'],
        'facebook' => $_POST['facebook'],
        'instagram' => $_POST['instagram'],
        'twitter' => $_POST['twitter'],
        'tiktok' => $_POST['tiktok'],
    ];

    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo'];
        $photoName = $uuid . '_' . basename($photo['name']);
        $targetDir = '../../assets/uploads/owner/';
        $targetFile = $targetDir . $photoName;

        if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
            $data['photo'] = $photoName;
        } else {
            $_SESSION['toastr'] = [
                'type' => 'error',
                'message' => 'Failed to upload photo'
            ];
            header('Location: ../../admin/?views=setting_edit&id=' . $id);
            exit;
        }
    }

    $isUpdated = $getSetting->update($id, $data);

    if ($isUpdated) {
        $_SESSION['toastr'] = [
            'type' => 'success',
            'message' => 'Update Successfully'
        ];
        header('Location: ../../admin/?views=setting_list');
        exit;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to update setting'
        ];
        header('Location: ../../admin/?views=setting_edit&id=' . $id);
        exit;
    }
}
