<?php
require_once '../classes/User.php'; // Pastikan path ini sesuai

$userModel = new User();
$users = $userModel->list(); // Ambil data user dari fungsi list()
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        <!-- Data Tables -->
        <div class="col-12">
            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Basic Layout</h5>
                    <small class="text-body float-end">
                        <a href="?views=user_add" class="btn btn-primary btn-sm"><i class="ri-add-fill"></i>Add</a>
                    </small>
                </div>
                <div class="table-responsive">
                    <table id="userTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Option</th>
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
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm">
                                            <i class="ri-information-line"></i> Detail
                                        </a>
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
    </div>
</div>