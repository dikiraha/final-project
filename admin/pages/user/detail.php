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
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($user['name']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">No. Handphone</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($user['phone_number']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($user['role']); ?></p>
                    </div>

                    <?php if ($profile): ?>
                        <h5 class="mt-4">Profile Information</h5>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($profile['address']); ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($profile['gender']); ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="photo_profile" class="form-label">Photo Profile</label>
                            <p class="form-control-plaintext">
                                <img src="../uploads/<?php echo htmlspecialchars($profile['photo_profile']); ?>" alt="Profile Photo" width="100">
                            </p>
                        </div>

                        <div class="mb-3">
                            <label for="ktp" class="form-label">KTP</label>
                            <p class="form-control-plaintext">
                                <?php
                                $ktpFile = htmlspecialchars($profile['ktp']);
                                $fileExtension = pathinfo($ktpFile, PATHINFO_EXTENSION);
                                if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#ktpModalImage">View KTP</button>

                            <div class="modal fade" id="ktpModalImage" tabindex="-1" aria-labelledby="ktpModalImageLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ktpModalImageLabel">KTP Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="../assets/uploads/ktp/<?php echo $ktpFile; ?>" alt="KTP" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif (strtolower($fileExtension) === 'pdf'): ?>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#ktpModalPDF">View KTP</button>

                            <div class="modal fade" id="ktpModalPDF" tabindex="-1" aria-labelledby="ktpModalPDFLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ktpModalPDFLabel">KTP PDF</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="../assets/uploads/ktp/<?php echo $ktpFile; ?>" width="100%" height="500px" frameborder="0"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <p>Unsupported file type.</p>
                        <?php endif; ?>
                        </p>
                        </div>

                        <!-- Add other fields similarly -->

                    <?php else: ?>
                        <p>No profile information available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>