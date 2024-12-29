<?php
require_once '../classes/Booking.php';
require_once '../classes/Payment.php';
require_once '../classes/Car.php';
require_once '../classes/User.php';
require_once '../classes/Profile.php';

$bookingModel = new Booking();
$booking = $bookingModel->getBookingByUuid($_GET['uuid']);

$carModel = new Car();
$car = $carModel->getCarById($booking['car_id']);

$paymentModel = new Payment();
$payment = $paymentModel->getPaymentByBookingId($booking['id']);

$userModel = new User();
$user = $userModel->getById($booking['user_id']);

$profileModel = new Profile();
$profile = $profileModel->getByUserId($user['id']);

$uuid = $_GET['uuid'];
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Booking</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=transaction_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-borderless table-striped table-hover" width="100">
                        <tbody>
                            <tr>
                                <td><b>No. Booking</b></td>
                                <td>: <?php echo htmlspecialchars($booking['no_booking']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Mobil</b></td>
                                <td>: <?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Nama Client</b></td>
                                <td>: <?php echo htmlspecialchars($user['name']); ?></td>
                            </tr>
                            <tr>
                                <?php
                                if ($booking['is_driver'] == 1) {
                                    if ($booking['driver_id'] == null) {
                                        $nama_driver = ' - <span class="badge bg-warning">Menunggu Konfirmasi</span>';
                                    } else {
                                        $getDriver = $userModel->getById($booking['driver_id']);
                                        $nama_driver = ' - ' . $getDriver['name'];
                                    }
                                    $driver = 'Pakai Driver' . $nama_driver;
                                } else {
                                    $driver = 'Tidak Pakai Driver';
                                }
                                ?>
                                <td><b>Driver</b></td>
                                <td>: <?php echo $driver; ?></td>
                            </tr>
                            <?php
                            $date_start = $booking['date_start'];
                            $date_end = $booking['date_end'];

                            $startDate = new DateTime($date_start);
                            $endDate = new DateTime($date_end);

                            $interval = $startDate->diff($endDate);

                            $sewa = $interval->days . ' Hari ' . $interval->h . ' Jam';
                            ?>
                            <tr>
                                <td><b>Tanggal Pengambilan</b></td>
                                <td>: <?php echo htmlspecialchars($date_start); ?></td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Pengembalian</b></td>
                                <td>: <?php echo htmlspecialchars($date_end); ?></td>
                            </tr>
                            <tr>
                                <td><b>Jangka Sewa</b></td>
                                <td>: <?php echo htmlspecialchars($sewa); ?></td>
                            </tr>
                            <tr>
                                <td><b>Destinasi</b></td>
                                <td>: <?php echo htmlspecialchars($booking['destination']); ?></td>
                            </tr>
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
                            <tr>
                                <td><b>Total Harga</b></td>
                                <td>: <?php echo formatRupiah($booking['total_harga']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Metode Pembayaran</b></td>
                                <td>: <?php echo htmlspecialchars($payment['method']); ?></td>
                            </tr>
                            <?php if ($payment['method'] === 'Transfer'): ?>
                                <tr>
                                    <td><b>Tipe Pembayaran</b></td>
                                    <td>: <?php echo htmlspecialchars($payment['type'] ?? ''); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td><b>Bayar</b></td>
                                <td>: <?php echo formatRupiah($payment['amount'] ?? '0'); ?></td>
                            </tr>
                            <tr>
                                <td><b>Sisa Bayar</b></td>
                                <td>: <?php echo formatRupiah($booking['total_harga'] - $payment['amount'] ?? ''); ?></td>
                            </tr>
                            <?php if ($payment['method'] === 'Transfer'): ?>
                                <tr>
                                    <td><b>Bukti Pembayaran</b></td>
                                    <td>:
                                        <button type="button"
                                            class="btn btn-info btn-sm mx-1 btn-view-evidence"
                                            data-uuid="<?php echo urlencode($payment['uuid']); ?>"
                                            data-file="<?php echo htmlspecialchars($payment['evidence_file']); ?>"
                                            data-bs-toggle="modal" data-bs-target="#viewEvidenceModal">
                                            Lihat Bukti
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <?php if ($profile): ?>
                        <h5 class="mt-4">Persyaratan Lepas Kunci</h5>
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
                    <?php if ($booking['status'] !== 'Selesai' && $booking['status'] !== 'Ditolak'): ?>
                        <h5 class="mt-4">Konfirmasi Pesanan</h5>
                        <div class="row">
                            <form action="../backend/booking/update.php" method="POST">
                                <input type="hidden" name="uuid" value="<?php echo htmlspecialchars($booking['uuid']); ?>">
                                <div class="col-md-12">
                                    <?php
                                    $amount = $payment['amount'];
                                    $total_harga = $booking['total_harga'];

                                    $sisa = $total_harga - $amount;
                                    ?>

                                    <?php if ($sisa > 0): ?>
                                        <div class="form-floating form-floating-outline mb-3">
                                            <input type="text" class="form-control" id="remaining_amount_display" name="remaining_amount_display" placeholder="Sisa Pembayaran" oninput="formatAmount(this)" required />
                                            <input type="hidden" id="remaining_amount" name="remaining_amount" />
                                            <label for="remaining_amount_display">Sisa Pembayaran <span class="text-danger">*</span></label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline mb-3">
                                        <select name="status" class="form-select" id="status" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Disetujui" <?php echo ($booking['status'] == 'Disetujui') ? 'selected' : ''; ?>>Disetujui</option>
                                            <option value="Ditolak" <?php echo ($booking['status'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                            <option value="Berjalan" <?php echo ($booking['status'] == 'Berjalan') ? 'selected' : ''; ?>>Berjalan</option>
                                            <option value="Selesai" <?php echo ($booking['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                        </select>
                                        <label for="status">Status Booking <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <?php if ($booking['status'] == 'Berjalan'): ?>
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" class="form-control" id="km_before" name="km_before" value="<?php echo htmlspecialchars(number_format($car['km'], 0, ',', '.')); ?>" readonly />
                                        <label for="km_before">Total KM Mobil Sebelumnya <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" class="form-control" id="km_display" name="km_display" placeholder="Total KM Mobil" oninput="formatKm(this)" required />
                                        <input type="hidden" id="km" name="km" />
                                        <label for="km_display">Total KM Mobil <span class="text-danger">*</span></label>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $drivers = $userModel->getDrivers();
                                ?>
                                <?php if ($booking['is_driver'] == 1 && $booking['driver_id'] == null): ?>
                                    <div class="col-md-12">
                                        <div class="form-floating form-floating-outline mb-3">
                                            <select name="driver_id" class="form-select" id="driver_id" required>
                                                <option value="">-- Pilih --</option>
                                                <?php foreach ($drivers as $driver): ?>
                                                    <option value="<?php echo htmlspecialchars($driver['id']); ?>" <?php echo ($driver['id'] == $booking['driver_id']) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($driver['name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="driver_id">Nama Driver <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="viewEvidenceModal" tabindex="-1" aria-labelledby="viewEvidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEvidenceModalLabel">Lihat Bukti Transfer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <center>
                    <div id="evidenceContent"></div>
                </center>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var viewEvidenceButtons = document.querySelectorAll('.btn-view-evidence');
        viewEvidenceButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var file = button.getAttribute('data-file');
                var evidenceContent = document.getElementById('evidenceContent');
                evidenceContent.innerHTML = '';

                if (file.endsWith('.pdf')) {
                    evidenceContent.innerHTML = '<embed src="../assets/uploads/evidence/' + file + '" type="application/pdf" width="100%" height="600px" />';
                } else {
                    evidenceContent.innerHTML = '<img src="../assets/uploads/evidence/' + file + '" class="img-fluid" />';
                }
            });
        });

    });
</script>
<script>
    function formatAmount(input) {
        let value = input.value.replace(/\D/g, '');
        let formattedValue = new Intl.NumberFormat('id-ID').format(value);
        input.value = formattedValue;
        document.getElementById('remaining_amount').value = value;
    }

    function formatKm(input) {
        let value = input.value.replace(/\D/g, '');
        let formattedValue = new Intl.NumberFormat('id-ID').format(value);
        input.value = formattedValue;
        document.getElementById('km').value = value;
    }
</script>