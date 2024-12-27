<?php
require_once 'classes/Booking.php';
require_once 'classes/Payment.php';
require_once 'classes/Car.php';

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
                                <th>Total Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Nominal Dibayar</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <?php
                                $car = $getCar->getCarById($booking['car_id']);
                                $payment = $getPayment->getPaymentById($booking['id']);
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($booking['no_booking']); ?></td>
                                    <td><?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?></td>
                                    <td><?php echo htmlspecialchars($booking['date_start']); ?></td>
                                    <td><?php echo htmlspecialchars($booking['date_end']); ?></td>
                                    <td><?php echo htmlspecialchars($booking['destination']); ?></td>
                                    <td>Rp <?php echo number_format($booking['total_harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo htmlspecialchars($payment['method']); ?></td>
                                    <td>Rp <?php echo $payment['amount'] !== null ? number_format($payment['amount'], 0, ',', '.') : '-'; ?></td>
                                    <td><?php echo htmlspecialchars($booking['status']); ?></td>
                                    <td><a href="?views=transaction&uuid=<?php echo htmlspecialchars($booking['uuid']); ?>" class="btn btn-primary btn-sm">Detail</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>