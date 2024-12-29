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
?>

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
                    <div class="card p-2">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <center>
                                        <img src="assets/img/drc.png" alt="" height="100">
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
                                                    $driver_id = " - (Akan diinfokan kembali)";
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
                                            <td>Uang Muka</td>
                                            <td>:
                                                <?php
                                                echo 'Rp ' . number_format($payment['amount'] ?? 0, 0, ',', '.');
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $sisa = $booking['total_harga'] - $payment['amount'];
                                            ?>
                                            <td>Sisa</td>
                                            <td>:
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
                                            $sisa = $booking['total_harga'] - $payment['amount'];
                                            ?>
                                            <td>Total Biaya</td>
                                            <td>:
                                                <?php
                                                echo 'Rp ' . number_format($booking['total_harga'] ?? 0, 0, ',', '.');
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
                                        <td style="height: 50px;"></td>
                                        <td style="height: 50px;"></td>
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