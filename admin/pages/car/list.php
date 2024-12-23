<?php
require_once '../classes/Car.php'; // Pastikan path ini sesuai

$carModel = new Car();
$cars = $carModel->list(); // Ambil data mobil dari fungsi list()
$no = 1;
?>

<?php
// Tambahkan file CSS dan JS untuk halaman ini
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
            $("#carTable").DataTable({
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
        <!-- Data Tables -->
        <div class="col-12">
            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">List Cars</h5>
                    <small class="text-body float-end">
                        <a href="?views=car_create" class="btn btn-primary btn-sm"><i class="ri-add-fill"></i>Create</a>
                    </small>
                </div>
                <div class="table-responsive" style="padding: 0 1.25rem 2rem 1.25rem;">
                    <table id="carTable" class="table table-bordered table-sm" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Merk</th>
                                <th>Jumlah Kursi</th>
                                <th>Jumlah Pintu</th>
                                <th>Warna</th>
                                <th>No Plat</th>
                                <th>Tahun</th>
                                <th>KM</th>
                                <th>Jenis Bensin</th>
                                <th>Harga</th>
                                <th>Denda</th>
                                <th>Transmisi</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cars as $car): ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td>
                                        <img src="./../assets/uploads/car/<?php echo htmlspecialchars($car['photo']); ?>" alt="Car Photo" width="50" height="50" />
                                    </td>
                                    <td><?php echo htmlspecialchars($car['merk']); ?></td>
                                    <td><?php echo htmlspecialchars($car['jumlah_kursi']); ?></td>
                                    <td><?php echo htmlspecialchars($car['jumlah_pintu']); ?></td>
                                    <td><?php echo htmlspecialchars($car['warna']); ?></td>
                                    <td><?php echo htmlspecialchars($car['no_plat']); ?></td>
                                    <td><?php echo htmlspecialchars($car['tahun']); ?></td>
                                    <td><?php echo htmlspecialchars($car['km']); ?></td>
                                    <td><?php echo htmlspecialchars($car['jenis_bensin']); ?></td>
                                    <td><?php echo htmlspecialchars($car['harga']); ?></td>
                                    <td><?php echo htmlspecialchars($car['denda']); ?></td>
                                    <td><?php echo htmlspecialchars($car['transmisi']); ?></td>
                                    <td>
                                        <a href="?views=car_detail/<?php echo urlencode($car['uuid']); ?>" class="btn btn-info btn-sm">
                                            <i class="ri-information-line"></i> Detail
                                        </a>
                                        <a href="index.php?views=car_edit&uuid=<?php echo urlencode($car['uuid']); ?>" class="btn btn-warning btn-sm">
                                            <i class="ri-edit-box-line"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-delete-url="../backend/car/delete.php?uuid=<?php echo urlencode($car['uuid']); ?>">
                                            <i class="ri-delete-bin-line"></i> Delete
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
                Apakah Anda yakin ingin menghapus mobil ini? Tindakan ini tidak dapat dibatalkan.
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

    // Toastr messages
    <?php if (isset($_SESSION['success_message'])): ?>
        toastr.success("<?php echo $_SESSION['success_message']; ?>");
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        toastr.error("<?php echo $_SESSION['error_message']; ?>");
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
</script>