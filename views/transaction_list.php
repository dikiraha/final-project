<?php
require_once 'classes/Booking.php';
require_once 'classes/Payment.php';
require_once 'classes/Car.php';
require_once 'classes/Review.php';

$getBooking = new Booking();
$getPayment = new Payment();
$getCar = new Car();

$user_id = $_SESSION['user_id'];
$bookings = $getBooking->getBookingsByUserId($user_id);
$no = 1;
?>

<div class="container-fluid contact mb-3">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize">List <span class="text-primary">Pesanan</span></h1>
        </div>
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <a href="?views=home" class="btn btn-secondary"><i class="fa fa-arrow-left text-white"></i> Back</a>
        </div>
        <div class="row g-5 pt-3">
            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row table-responsive">
                    <table class="table table-bordered table-striped" id="transactionListTable" width="100%">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Nomor Booking</th>
                                <th>Mobil</th>
                                <th>Tanggal Pengambilan</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Destinasi</th>
                                <!-- <th>Total Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Nominal Dibayar</th> -->
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <?php
                                $car = $getCar->getCarById($booking['car_id']);
                                $payment = $getPayment->getPaymentByBookingId($booking['id']);
                                ?>
                                <tr>
                                    <td class="text-center align-content-center"><?php echo $no++; ?></td>
                                    <td class="align-content-center"><?php echo htmlspecialchars($booking['no_booking']); ?></td>
                                    <td class="align-content-center"><?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?></td>
                                    <td class="align-content-center"><?php echo htmlspecialchars($booking['date_start']); ?></td>
                                    <td class="align-content-center"><?php echo htmlspecialchars($booking['date_end']); ?></td>
                                    <td class="align-content-center"><?php echo htmlspecialchars($booking['destination']); ?></td>
                                    <!-- <td>Rp <?php echo number_format($booking['total_harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo htmlspecialchars($payment['method']); ?></td>
                                    <td>Rp <?php echo $payment['amount'] !== null ? number_format($payment['amount'], 0, ',', '.') : '-'; ?></td> -->
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
                                    <td class="align-content-center"><span class="badge bg-<?php echo $color; ?>"><?php echo htmlspecialchars($booking['status']); ?></span></td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <?php
                                            $modelReview = new Review();
                                            $review = $modelReview->getById($booking['id']);
                                            ?>
                                            <a href="?views=transaction&uuid=<?php echo htmlspecialchars($booking['uuid']); ?>" class="btn btn-primary btn-sm mx-1 d-flex align-items-center justify-content-center m-3">Detail</a>
                                            <?php if ($booking['status'] == 'Selesai'): ?>
                                                <?php if (!$review): ?>
                                                    <button type="button" class="btn btn-secondary btn-sm mx-1 d-flex align-items-center justify-content-center m-3" data-bs-toggle="modal" data-bs-target="#reviewModal" data-uuid="<?php echo htmlspecialchars($booking['uuid']); ?>">
                                                        Beri Review
                                                    </button>
                                                <?php else: ?>
                                                    <!-- <button type="button" class="btn btn-secondary btn-sm mx-1 d-flex align-items-center justify-content-center m-3" data-bs-toggle="modal" data-bs-target="#showReviewModal" data-uuid="<?php echo htmlspecialchars($booking['uuid']); ?>">
                                                        Lihat Review
                                                    </button> -->
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($payment['method'] == 'Transfer'): ?>
                                                <?php if (!empty($payment['evidence_file'])): ?>
                                                    <button type="button"
                                                        class="btn btn-info btn-sm mx-1 d-flex align-items-center justify-content-center m-3 btn-view-evidence"
                                                        data-uuid="<?php echo urlencode($payment['uuid']); ?>"
                                                        data-file="<?php echo htmlspecialchars($payment['evidence_file']); ?>"
                                                        data-bs-toggle="modal" data-bs-target="#viewEvidenceModal">
                                                        Lihat Bukti
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button"
                                                        class="btn btn-success btn-sm mx-1 d-flex align-items-center justify-content-center m-3 btn-evidence"
                                                        data-uuid="<?php echo urlencode($payment['uuid']); ?>"
                                                        data-bs-toggle="modal" data-bs-target="#evidenceModal">
                                                        Kirim bukti transfer
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
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

<!-- Modal Bukti -->
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

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Review Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="backend/booking/review.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="uuid" id="reviewUuid" value="">
                    <div class="mb-3">
                        <label for="grade" class="form-label">Grade (1-5)</label>
                        <input type="number" class="form-control" id="grade" name="grade" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var reviewModal = document.getElementById('reviewModal');
        reviewModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var uuid = button.getAttribute('data-uuid');
            var modalUuidInput = document.getElementById('reviewUuid');
            modalUuidInput.value = uuid;
        });
    });
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var showReviewModal = document.getElementById('showReviewModal');
        showReviewModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var uuid = button.getAttribute('data-uuid');
            // var modalUuidInput = document.getElementById('reviewUuid');
            // modalUuidInput.value = uuid;

            // Fetch existing review data
            fetch('../backend/booking/get_review.php?uuid=' + uuid)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('grade').value = data.grade;
                        document.getElementById('description').value = data.description;
                    } else {
                        document.getElementById('grade').value = '';
                        document.getElementById('description').value = '';
                    }
                })
                .catch(error => console.error('Error fetching review data:', error));
        });
    });
</script> -->