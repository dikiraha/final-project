<?php
require_once 'classes/Booking.php';
require_once 'classes/Payment.php';
require_once 'classes/Car.php';
require_once 'classes/Setting.php';
require_once 'classes/User.php';
require_once 'classes/Profile.php';

$uuid = $_GET['uuid'];
$user_id = $_SESSION['user_id'];

$getBooking = new Booking();
$booking = $getBooking->getBookingByUuid($uuid);

if ($booking && $user_id == $booking['user_id']) {
    $getSetting = new Setting();
    $setting = $getSetting->list()[0];
    $address = $setting['address'];
    $phone_number_1 = $setting['phone_number_1'];
    $phone_number_2 = $setting['phone_number_2'];

    $getUser = new User();
    $user = $getUser->getById($booking['user_id']);
    $driver = $getUser->getById($booking['driver_id']);

    $getCar = new Car();
    $car = $getCar->getCarById($booking['car_id']);

    $getPayment = new Payment();
    $payment = $getPayment->getPaymentByBookingId($booking['id']);

    $getProfile = new Profile();
    $profile = $getProfile->getByUserId($booking['user_id']);

    $no = 1;
} else {
    include "views/error.php";
}
?>
<?php if ($booking && $user_id == $booking['user_id']): ?>
    <div class="container-fluid contact mb-3">
        <div class="container">
            <div class="text-center mx-auto pb-1 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize">Invoice <span class="text-primary">Pesanan</span></h1>
            </div>
            <div class="d-flex justify-content-between wow fadeInUp mb-3" data-wow-delay="0.1s">
                <a href="?views=home" class="btn btn-secondary"><i class="fa fa-arrow-left text-white"></i> Kembali ke beranda</a>
                <a href="?views=transaction_list" class="btn btn-success"><i class="fa fa-shopping-cart text-white"></i> Pesanan Saya</a>
            </div>

            <div class="row d-flex justify-content-center  g-5">
                <div class="col-8 wow fadeInUp" data-wow-delay="0.1s">
                    Harap lakukan pembayaran sebelum tanggal keberangkatan.
                    <br>Jika Cash, Pembayaran dapat dilakukan ditempat.
                    <br>Jika Trasfer, Pembayaran dapat dilakukan melalui transfer ke rekening
                    <br>
                    <b><?php echo htmlspecialchars($setting['bank']); ?></b> a/n <b><?php echo htmlspecialchars($setting['account_name']); ?></b>.
                    <b>No Rekening : <?php echo htmlspecialchars($setting['account_number']); ?></b>
                    <br>
                    <b>dan Kirim Bukti Pembayaran pada Pesanan Saya</b>
                    <div class="row g-5">
                        <div class="d-flex justify-content-between">
                            <button id="print-pdf" class="btn btn-primary"><i class="fa fa-file-pdf text-white"></i> Download PDF</button>
                            <?php if ($payment['method'] == 'Transfer'): ?>
                                <?php if (!empty($payment['evidence_file'])): ?>
                                    <button type="button"
                                        class="btn btn-info btn-view-evidence text-white"
                                        data-uuid="<?php echo urlencode($payment['uuid']); ?>"
                                        data-file="<?php echo htmlspecialchars($payment['evidence_file']); ?>"
                                        data-bs-toggle="modal" data-bs-target="#viewEvidenceModal">
                                        <i class="fa fa-circle-info text-white"></i> Lihat Bukti
                                    </button>
                                <?php else: ?>
                                    <button type="button"
                                        class="btn btn-success btn-evidence"
                                        data-uuid="<?php echo urlencode($payment['uuid']); ?>"
                                        data-bs-toggle="modal" data-bs-target="#evidenceModal">
                                        <i class="fa fa-money-bill-transfer text-white"></i> Kirim bukti transfer
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="card p-2" id="invoice">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <center>
                                            <img src="assets/img/drc.png" alt="" class="img-fluid">
                                        </center>
                                    </div>
                                    <div class="col-md-9">
                                        <center>
                                            <h4>Diana Rent Car</h4>
                                            <h6><?php echo htmlspecialchars($address); ?></h6>
                                            <h6>Telp. <?php echo htmlspecialchars($phone_number_1); ?> - <?php echo htmlspecialchars($phone_number_2); ?></h6>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <center>
                                    <h4><b>INVOICE</b></h4>
                                </center>
                                <div class="d-flex justify-content-end">
                                    <span>No : <?php echo htmlspecialchars($booking['no_booking']); ?></span>
                                </div>
                                <div class="containter">
                                    <table class="table table-borderless table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Nama Cust / <i>Name</i></td>
                                                <td>: <?php echo htmlspecialchars($user['name']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat / <i>Address</i></td>
                                                <td>: <?php echo htmlspecialchars($profile['address']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telepon, HP / <i>Phone</i></td>
                                                <td>: <?php echo htmlspecialchars($user['phone_number']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tujuan / <i>Destination</i></td>
                                                <td>: <?php echo htmlspecialchars($booking['destination']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kendaraan / <i>Vehicle Kind</i></td>
                                                <td>: <?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nopol / <i>Carriage Number</i></td>
                                                <td>: <?php echo htmlspecialchars($car['no_plat']); ?></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                if (($booking['is_driver']) == 0) {
                                                    $is_driver = "Tidak pakai driver";
                                                } else {
                                                    if (($booking['driver_id']) == null) {
                                                        $driver_id = " - (Menunggu Konfirmasi)";
                                                    } else {
                                                        $driver_id = " - " . ($driver['name']);
                                                    }
                                                    $is_driver = "Pakai driver" . $driver_id;
                                                }
                                                ?>
                                                <td>Supir / <i>Driver</i></td>
                                                <td>: <?php echo htmlspecialchars($is_driver); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body">
                                <center>
                                    <h4><b><u>WAKTU RENTAL / SEWA</u></b></h4>
                                </center>
                                <div class="containter">
                                    <table class="table table-borderless table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Keberangkatan / <i>Departure Date</i></td>
                                                <td>:
                                                    <?php
                                                    $date = new DateTime($booking['date_start']);
                                                    $formatter = new IntlDateFormatter(
                                                        'id_ID', // Locale untuk bahasa Indonesia
                                                        IntlDateFormatter::FULL,
                                                        IntlDateFormatter::SHORT
                                                    );
                                                    $formatter->setPattern('EEEE, dd MMMM yyyy \'jam\' HH:mm'); // Format khusus
                                                    echo $formatter->format($date);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kedatangan / <i>Arrival Date</i></td>
                                                <td>:
                                                    <?php
                                                    $date = new DateTime($booking['date_end']);
                                                    $formatter = new IntlDateFormatter(
                                                        'id_ID', // Locale untuk bahasa Indonesia
                                                        IntlDateFormatter::FULL,
                                                        IntlDateFormatter::SHORT
                                                    );
                                                    $formatter->setPattern('EEEE, dd MMMM yyyy \'jam\' HH:mm'); // Format khusus
                                                    echo $formatter->format($date);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga Sewa</td>
                                                <td>:
                                                    <?php
                                                    echo 'Rp ' . number_format($booking['total_harga'], 0, ',', '.');
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                if ($payment['method'] == 'Transfer' && $payment['evidence_file'] !== null) {
                                                    $status_transfer = '<b class="text-success">(SUDAH TRANSFER)</b>';
                                                } elseif ($payment['method'] == 'Transfer' && $payment['evidence_file'] == null) {
                                                    $status_transfer = '<b class="text-danger">(BELUM TRANSFER)</b>';
                                                } else {
                                                    $status_transfer = '<b class="text-danger">(BELUM BAYAR)</b>';
                                                }
                                                ?>
                                                <td>Uang Muka (Nominal Sudah Bayar)</td>
                                                <td>:
                                                    <?php
                                                    echo 'Rp ' . number_format($payment['amount'] ?? 0, 0, ',', '.') . " " . $status_transfer;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $sisa = $booking['total_harga'] - $payment['amount'];
                                                if ($sisa > 0) {
                                                    $kurang = 'text-danger';
                                                }
                                                ?>
                                                <td>Sisa</td>
                                                <td class="<?php echo $kurang; ?>">:
                                                    <?php
                                                    echo 'Rp ' . number_format($sisa ?? 0, 0, ',', '.');
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                if ($booking['total_harga'] == $payment['amount']) {
                                                    $status_pembayaran = '<b class="text-success">(LUNAS)</b>';
                                                } else {
                                                    $status_pembayaran = '<b class="text-danger">(BELUM LUNAS)</b>';
                                                }
                                                ?>
                                                <td>Total Biaya</td>
                                                <td>:
                                                    <?php
                                                    echo 'Rp ' . number_format($booking['total_harga'] ?? 0, 0, ',', '.') . " " . $status_pembayaran;
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <span><i>NB : Harga diatas tidak termasuk BBM, TOL, PARKIR, TICKET MASUK, DLL</i></span>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <span>Karawang,
                                            <?php
                                            $date = new DateTime($booking['created_at']);
                                            $formatter = new IntlDateFormatter(
                                                'id_ID', // Locale untuk bahasa Indonesia
                                                IntlDateFormatter::FULL,
                                                IntlDateFormatter::NONE
                                            );
                                            $formatter->setPattern('dd MMMM yyyy'); // Format khusus
                                            echo $formatter->format($date);
                                            ?>
                                        </span>
                                    </div>
                                    <table class="table table-borderless table-hover mt-3">
                                        <tr class="text-center">
                                            <td style="width: 50%;">Customer</td>
                                            <td style="width: 50%;">Owner</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 25px;"></td>
                                            <td style="height: 25px;"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td style="width: 50%;"><?php echo htmlspecialchars($user['name']); ?></td>
                                            <td style="width: 50%;"><?php echo htmlspecialchars($setting['owner']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transfer Modal -->
    <div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evidenceModalLabel">Kirim Bukti Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="backend/booking/evidence.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="uuid" id="modalUuid" value="">
                        <input type="hidden" name="views" value="transaction">
                        <div class="mb-3">
                            <label for="evidenceFile" class="form-label">Upload Bukti Transfer (PDF/Gambar)</label>
                            <input type="file" class="form-control" style="background-color: white;" id="evidenceFile" name="evidence_file" accept=".pdf,image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lihat Bukti Transfer -->
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
            const modalElement = document.getElementById('evidenceModal');
            const modalUuidInput = document.getElementById('modalUuid');
            const evidenceButtons = document.querySelectorAll('.btn-evidence');

            evidenceButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const uuid = button.getAttribute('data-uuid');
                    modalUuidInput.value = uuid;
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var viewEvidenceButtons = document.querySelectorAll('.btn-view-evidence');
            viewEvidenceButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var file = button.getAttribute('data-file');
                    var evidenceContent = document.getElementById('evidenceContent');
                    evidenceContent.innerHTML = '';

                    if (file.endsWith('.pdf')) {
                        evidenceContent.innerHTML = '<embed src="assets/uploads/evidence/' + file + '" type="application/pdf" width="100%" height="600px" />';
                    } else {
                        evidenceContent.innerHTML = '<img src="assets/uploads/evidence/' + file + '" class="img-fluid" />';
                    }
                });
            });

            var evidenceModal = document.getElementById('evidenceModal');
            evidenceModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var uuid = button.getAttribute('data-uuid');
                var modalUuidInput = document.getElementById('modalUuid');
                modalUuidInput.value = uuid;
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script>
        document.getElementById('print-pdf').addEventListener('click', function() {
            var invoiceContent = document.getElementById('invoice');

            var bookingNumber = "<?php echo htmlspecialchars($booking['no_booking']); ?>";

            html2pdf()
                .from(invoiceContent)
                .save('INVOICE-' + bookingNumber + '.pdf');
        });
    </script>
<?php endif; ?>