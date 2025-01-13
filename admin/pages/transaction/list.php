<?php
require_once '../classes/Booking.php';
require_once '../classes/Car.php';
require_once '../classes/Payment.php';

$session_id = $_SESSION['user_id'];
$session_role = $_SESSION['user_role'];

$bookingModel = new Booking();
if ($session_role == 'admin') {
    $bookings = $bookingModel->list();
} elseif ($session_role == 'driver') {
    $bookings = $bookingModel->listDriver($session_id);
}


$carModel = new Car();

$paymentModel = new Payment();

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
            $("#transactionTable").DataTable({
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
                    <h5 class="mb-0">List Transactions</h5>
                    <?php
                    $user_role = $_SESSION['user_role'];
                    ?>
                    <?php if ($user_role == 'admin') : ?>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cetakLaporanModal">
                            <i class="ri ri-file-pdf-2-fill"></i>
                            &nbsp;Cetak Laporan
                        </button>
                    <?php endif; ?>
                </div>
                <div class="table-responsive" style="padding: 0 1.25rem 2rem 1.25rem;">
                    <table id="transactionTable" class="table table-bordered table-striped table-sm" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Detail</th>
                                <th>Status</th>
                                <th>No. Booking</th>
                                <th>Merk</th>
                                <th>No Plat</th>
                                <th>Harga Sewa</th>
                                <th>Denda</th>
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
                            <?php foreach ($bookings as $booking): ?>
                                <?php
                                $car = $carModel->getCarById($booking['car_id']);
                                $payment = $paymentModel->getPaymentByBookingId($booking['id']);
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td>
                                        <a href="?views=transaction_detail&uuid=<?php echo htmlspecialchars($booking['uuid']); ?>" class="btn btn-primary btn-sm no-wrap">
                                            Lihat Detail<?php if ($booking['status'] !== 'Selesai' && $booking['status'] !== 'Ditolak'): ?> dan Konfirmasi <?php endif; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if ($booking['status'] == 'Belum Bayar' || $booking['status'] == 'Menunggu Konfirmasi') {
                                            $color = 'warning';
                                        } else if ($booking['status'] == 'Disetujui' || $booking['status'] == 'Berjalan') {
                                            $color = 'info';
                                        } else if ($booking['status'] == 'Ditolak') {
                                            $color = 'danger';
                                        } else if ($booking['status'] == 'Selesai') {
                                            $color = 'success';
                                        }
                                        ?>
                                        <span class="badge bg-<?php echo $color; ?>"><?php echo htmlspecialchars($booking['status']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($booking['no_booking']); ?></td>
                                    <td><?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?></td>
                                    <td><?php echo htmlspecialchars($car['no_plat']); ?></td>
                                    <td><?php echo $booking['total_harga'] !== null ? formatRupiah($booking['total_harga']) : 'Rp. 0'; ?></td>
                                    <td><?php echo $booking['total_denda'] !== null ? formatRupiah($booking['total_denda']) : 'Rp. 0'; ?></td>
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

<!-- Modal Pilihan Cetak Laporan -->
<div class="modal fade" id="cetakLaporanModal" tabindex="-1" aria-labelledby="cetakLaporanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLaporanLabel">Cetak Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cetakLaporanForm" method="POST" action="../backend/booking/report.php">
                    <div class="mb-3">
                        <label for="jenisLaporan" class="form-label">Pilih Jenis Laporan</label>
                        <select class="form-select" id="jenisLaporan" name="jenis_laporan" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="mb-3" id="bulanPicker" style="display: none;">
                        <label for="bulan" class="form-label">Pilih Bulan</label>
                        <input type="month" id="bulan" name="bulan" class="form-control">
                    </div>
                    <div class="mb-3" id="tahunPicker" style="display: none;">
                        <label for="tahun" class="form-label">Pilih Tahun</label>
                        <input type="number" id="tahun" name="tahun" class="form-control" placeholder="YYYY">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                    </div>
                </form>
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

<script>
    const jenisLaporan = document.getElementById('jenisLaporan');
    const bulanPicker = document.getElementById('bulanPicker');
    const bulanInput = document.getElementById('bulan');
    const tahunPicker = document.getElementById('tahunPicker');
    const tahunInput = document.getElementById('tahun');

    jenisLaporan.addEventListener('change', function() {
        if (this.value === 'bulanan') {
            bulanPicker.style.display = 'block';
            bulanInput.required = true;
            tahunPicker.style.display = 'none';
            tahunInput.required = false;
        } else if (this.value === 'tahunan') {
            bulanPicker.style.display = 'none';
            bulanInput.required = false;
            tahunPicker.style.display = 'block';
            tahunInput.required = true;
        } else {
            bulanPicker.style.display = 'none';
            bulanInput.required = false;
            tahunPicker.style.display = 'none';
            tahunInput.required = false;
        }
    });
</script>