<?php
require_once '../classes/User.php';
require_once '../classes/Profile.php';

$userModel = new User();
$profileModel = new Profile();

$users = $userModel->list();
$no = 1;
?>

<?php
pushInlineStyle("
    body {
        background-color: #f0f8ff;
    }
    h1 {
        color: blue;
    }
");

pushInlineScript('
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#userTable").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
');
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        <div class="col-12">
            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">List Users</h5>
                    <small class="text-body float-end">
                        <a href="?views=user_create" class="btn btn-primary btn-sm"><i class="ri-add-fill"></i>Create</a>
                    </small>
                </div>
                <div class="table-responsive" style="padding: 0 1.25rem 2rem 1.25rem;">
                    <table id="userTable" class="table table-bordered table-striped table-sm" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <?php
                                $profile = $profileModel->getByUserId($user['id']);
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-4">
                                                <?php if ($profile && $profile['photo_profile']): ?>
                                                    <img src="../assets/uploads/photo_profile/<?php echo htmlspecialchars($profile['photo_profile']) ?>" alt="Avatar" class="rounded-circle" />
                                                <?php else: ?>
                                                    <img src="../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-truncate"><?php echo htmlspecialchars($user['name']); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                                    <td>
                                        <a href="?views=user_detail&uuid=<?php echo urlencode($user['uuid']); ?>" class="btn btn-info btn-xs" data-toggle="tooltip"
                                            title="Detail">
                                            <i class="ri-information-line"></i>
                                        </a>

                                        <a href="index.php?views=user_edit&uuid=<?php echo urlencode($user['uuid']); ?>" class="btn btn-warning btn-xs" data-toggle="tooltip"
                                            title="Edit">
                                            <i class="ri-edit-box-line"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-delete-url="../backend/user/delete.php?uuid=<?php echo urlencode($user['uuid']); ?>" data-toggle="tooltip"
                                            title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a id="confirmDeleteButton" href="#" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');

    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const deleteUrl = button.getAttribute('data-delete-url');

        confirmDeleteButton.setAttribute('href', deleteUrl);
    });

    // Toastr
    <?php if (isset($_SESSION['success_message'])): ?>
        toastr.success("<?php echo $_SESSION['success_message']; ?>");
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        toastr.error("<?php echo $_SESSION['error_message']; ?>");
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
</script>