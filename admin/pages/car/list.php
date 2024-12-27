<?php
require_once '../classes/Car.php';

$carModel = new Car();
$cars = $carModel->list();
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
                    <table id="carTable" class="table table-bordered table-striped table-sm" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>No Plat</th>
                                <th>Tahun</th>
                                <th>KM</th>
                                <th>Harga</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            function formatRupiah($angka)
                            {
                                return 'Rp ' . number_format($angka, 0, ',', '.');
                            }

                            function formatKm($angka)
                            {
                                return number_format($angka, 0, ',', '.') . ' KM';
                            }
                            ?>
                            <?php foreach ($cars as $car): ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center">
                                        <img src="./../assets/uploads/car/<?php echo htmlspecialchars($car['photo']); ?>" alt="Car Photo" width="50" height="50" />
                                    </td>
                                    <td><?php echo htmlspecialchars($car['merk']); ?></td>
                                    <td><?php echo htmlspecialchars($car['tipe']); ?></td>
                                    <td><?php echo htmlspecialchars($car['no_plat']); ?></td>
                                    <td><?php echo htmlspecialchars($car['tahun']); ?></td>
                                    <td><?php echo formatKm($car['km']); ?></td>
                                    <td><?php echo formatRupiah($car['harga']); ?></td>
                                    <td><?php echo formatRupiah($car['denda']); ?></td>
                                    <td>
                                        <?php if ($car['status'] === 'Active'): ?>
                                            <span class="badge bg-success"><?php echo htmlspecialchars($car['status']); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><?php echo htmlspecialchars($car['status']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-xs btn-detail"
                                            data-uuid="<?php echo urlencode($car['uuid']); ?>">
                                            <i class="ri-information-line"></i>
                                        </a>
                                        <a href="index.php?views=car_edit&uuid=<?php echo urlencode($car['uuid']); ?>" class="btn btn-warning btn-xs">
                                            <i class="ri-edit-box-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-delete-url="../backend/car/delete.php?uuid=<?php echo urlencode($car['uuid']); ?>">
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
                Apakah Anda yakin ingin menghapus mobil ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a id="confirmDeleteButton" href="#" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Konten detail akan diisi melalui JavaScript -->
                <div id="detailContent"></div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.btn-detail');

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const uuid = this.getAttribute('data-uuid');
                const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                const detailContent = document.getElementById('detailContent');

                // Tampilkan loading sebelum data dimuat
                detailContent.innerHTML = '<p>Loading...</p>';

                // Ambil data dari server (gunakan AJAX)
                fetch(`./../backend/car/detail.php?uuid=${uuid}`)
                    .then(response => response.json())
                    .then(data => {
                        // Isi modal dengan data
                        detailContent.innerHTML = `
                            <p><strong>Merk:</strong> ${data.merk}</p>
                            <p><strong>Tipe:</strong> ${data.tipe}</p>
                            <p><strong>Jumlah Kursi:</strong> ${data.jumlah_kursi}</p>
                            <p><strong>Jumlah Pintu:</strong> ${data.jumlah_pintu}</p>
                            <p><strong>Warna:</strong> ${data.warna}</p>
                            <p><strong>No Plat:</strong> ${data.no_plat}</p>
                            <p><strong>Tahun:</strong> ${data.tahun}</p>
                            <p><strong>KM:</strong> ${data.km}</p>
                            <p><strong>Jenis Bensin:</strong> ${data.jenis_bensin}</p>
                            <p><strong>Harga:</strong> ${data.harga}</p>
                            <p><strong>Denda:</strong> ${data.denda}</p>
                            <p><strong>Transmisi:</strong> ${data.transmisi}</p>
                            <img src="./../assets/uploads/car/${data.photo}" alt="Car Photo" width="100">
                        `;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        detailContent.innerHTML = '<p>Error loading data.</p>';
                    });

                // Tampilkan modal
                detailModal.show();
            });
        });
    });
</script>