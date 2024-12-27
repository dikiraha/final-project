<?php
require_once '../classes/Setting.php';

$getSetting = new Setting();

$settings = $getSetting->list();
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
            $("#settingsTable").DataTable({
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
                    <h5 class="mb-0">List Settings</h5>
                    <?php if (empty($settings)): ?>
                        <small class="text-body float-end">
                            <a href="?views=setting_create" class="btn btn-primary btn-sm"><i class="ri-add-fill"></i>Create</a>
                        </small>
                    <?php endif; ?>
                </div>
                <div class="table-responsive" style="padding: 0 1.25rem 2rem 1.25rem;">
                    <table id="settingsTable" class="table table-bordered table-striped table-sm" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Owner</th>
                                <th>Bank</th>
                                <th>Account Number</th>
                                <th>Email</th>
                                <th>Phone Number 1</th>
                                <th>Phone Number 2</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($settings as $setting): ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($setting['owner']); ?></td>
                                    <td><?php echo htmlspecialchars($setting['bank']); ?></td>
                                    <td><?php echo htmlspecialchars($setting['account_number']); ?></td>
                                    <td><?php echo htmlspecialchars($setting['email']); ?></td>
                                    <td><?php echo htmlspecialchars($setting['phone_number_1']); ?></td>
                                    <td><?php echo htmlspecialchars($setting['phone_number_2']); ?></td>
                                    <td>
                                        <a href="?views=setting_detail&uuid=<?php echo urlencode($setting['uuid']); ?>" class="btn btn-info btn-xs" data-toggle="tooltip"
                                            title="Detail">
                                            <i class="ri-information-line"></i>
                                        </a>

                                        <a href="?views=setting_edit&uuid=<?php echo urlencode($setting['uuid']); ?>" class="btn btn-warning btn-xs" data-toggle="tooltip"
                                            title="Edit">
                                            <i class="ri-edit-box-line"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-delete-url="../backend/setting/delete.php?uuid=<?php echo urlencode($setting['uuid']); ?>" data-toggle="tooltip"
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