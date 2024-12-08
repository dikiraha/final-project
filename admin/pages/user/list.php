<?php
require_once '../classes/User.php'; // Pastikan path ini sesuai

$userModel = new User();
$users = $userModel->list(); // Ambil data user dari fungsi list()
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        <!-- Data Tables -->
        <div class="col-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="?views=user_add" class="btn btn-primary btn-sm"><i class="ri-add-fill"></i>Add</a>
            </div>

            <div class="card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-truncate">User</th>
                                <th class="text-truncate">Email</th>
                                <th class="text-truncate">Role</th>
                                <th class="text-truncate">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-4">
                                                <img src="../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-truncate"><?php echo htmlspecialchars($user['name']); ?></h6>
                                                <small class="text-truncate">@<?php echo strtolower(str_replace(' ', '', $user['name'])); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-truncate"><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td class="text-truncate">
                                        <div class="d-flex align-items-center">
                                            <i class="ri-vip-crown-line ri-22px text-primary me-2"></i>
                                            <span><?php echo htmlspecialchars($user['role']); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm">
                                            <i class="ri-edit-box-line"></i> Edit
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm">
                                            <i class="ri-delete-bin-line"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Data Tables -->
    </div>
</div>