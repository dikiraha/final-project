<?php
require_once '../classes/User.php';
require_once '../classes/Profile.php';

$getUser = new User();
$getProfile = new Profile();

$uuid = $_GET['uuid'];
$user = $getUser->detail($uuid);
$profile = $getProfile->getByUserId($user['id']);
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail User</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=user_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-borderless table-striped table-hover" width="100">
                        <tbody>
                            <tr>
                                <td><b>Nama Lengkap</b></td>
                                <td>: <?php echo htmlspecialchars($user['name']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td>: <?php echo htmlspecialchars($user['email']); ?></td>
                            </tr>
                            <tr>
                                <td><b>No Handphone</b></td>
                                <td>: <?php echo htmlspecialchars($user['phone_number']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Role</b></td>
                                <td>: <?php echo htmlspecialchars($user['role']); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if ($profile): ?>
                        <h5 class="mt-4">Profile Information</h5>
                        <?php
                        function renderDocumentModal($type, $filePath)
                        {
                            if (empty($filePath)) {
                                echo "-";
                                return;
                            }

                            $fileName = htmlspecialchars($filePath);
                            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                            $modalId = $type . 'Modal';
                            $modalLabel = ucfirst($type) . ' Document';

                            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                echo "<button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#{$modalId}'>View</button>";
                                echo "<div class='modal fade' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='{$modalId}Label'>{$modalLabel}</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='../assets/uploads/{$type}/{$fileName}' alt='{$type}' class='img-fluid'>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            } elseif ($fileExtension === 'pdf') {
                                echo "<button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#{$modalId}'>View</button>";
                                echo "<div class='modal fade' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered modal-lg'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='{$modalId}Label'>{$modalLabel}</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <iframe src='../assets/uploads/{$type}/{$fileName}' width='100%' height='500px' frameborder='0'></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            } else {
                                echo "<p>Unsupported file type.</p>";
                            }
                        }
                        ?>
                        <table class="table table-borderless table-striped table-hover" width="100">
                            <tbody>
                                <tr>
                                    <td><b>Alamat</b></td>
                                    <td>: <?php echo htmlspecialchars($profile['address']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Jenis Kelamin</b></td>
                                    <td>: <?php echo htmlspecialchars($profile['gender']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>No Handphone</b></td>
                                    <td>: <?php echo htmlspecialchars($user['phone_number']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Photo Profile</b></td>
                                    <td>: <img src="../assets/uploads/photo_profile/<?php echo htmlspecialchars($profile['photo_profile']); ?>" alt="Profile Photo" width="100"></td>
                                </tr>
                                <tr>
                                    <td><b>KTP</b></td>
                                    <td>: <?php renderDocumentModal('ktp', $profile['ktp']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>SIM A</b></td>
                                    <td>: <?php renderDocumentModal('sim', $profile['sim']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>KK</b></td>
                                    <td>: <?php renderDocumentModal('kk', $profile['kk']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Buku Nikah</b></td>
                                    <td>: <?php renderDocumentModal('buku_nikah', $profile['buku_nikah']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Akte Kelahiran</b></td>
                                    <td>: <?php renderDocumentModal('akte', $profile['akte']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Ijazah Terakhir Min. SMA / Sederajat</b></td>
                                    <td>: <?php renderDocumentModal('ijazah', $profile['ijazah']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>ID Card Karyawan</b></td>
                                    <td>: <?php renderDocumentModal('id_card', $profile['id_card']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Surat Pengangkatan / Surat Kontrak</b></td>
                                    <td>: <?php renderDocumentModal('id_card', $profile['id_card']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Slip Gaji</b></td>
                                    <td>: <?php renderDocumentModal('slip_gaji', $profile['slip_gaji']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Slip Gaji</b></td>
                                    <td>: <?php renderDocumentModal('slip_gaji', $profile['slip_gaji']); ?></td>
                                </tr>
                                <tr>
                                    <td><b>BPJS Ketenagakerjaan</b></td>
                                    <td>: <?php renderDocumentModal('bpjs', $profile['bpjs']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No profile information available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>