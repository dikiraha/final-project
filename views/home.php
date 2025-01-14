<?php
require_once 'classes/Car.php';
require_once 'classes/Booking.php';
require_once 'classes/Review.php';
require_once 'classes/User.php';
require_once 'classes/Profile.php';

$carModel = new Car();
$cars = $carModel->listActive();
$totalCars = $carModel->getTotalCars();
$totalKilometers = $carModel->getTotalKilometers();

$reviewModel = new Review();
$reviews = $reviewModel->list();
$totalReviews = $reviewModel->getTotalReviews();

$bookingModel = new Booking();
?>

<!-- Car categories Start -->
<div class="container-fluid categories pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize">Tipe <span class="text-primary">Kendaraan</span></h1>
            <h6><b>"Siapa Cepat, Dia Dapat" <i>(First-Pay-First-Serve)</i></b></h6>
        </div>
        <div class="categories-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($cars as $car): ?>
                <?php
                $booking = $bookingModel->getBookingsByCarId($car['id']);
                $statusCar = 'Tersedia';

                if ($booking && isset($booking['status'])) {
                    if ($booking['status'] == 'Disetujui' || $booking['status'] == 'Berjalan') {
                        $statusCar = 'Terbooking';
                    }
                }
                ?>
                <!-- MOBIL -->
                <div class="categories-item p-4">
                    <div class="categories-item-inner">
                        <div class="categories-img rounded-top">
                            <img src="./assets/uploads/car/<?php echo htmlspecialchars($car['photo']); ?>" class="img-fluid w-100 rounded-top car-image" style="height: 200px; object-fit: cover;" alt="<?php echo htmlspecialchars($car['merk']); ?>">
                        </div>
                        <div class="categories-content rounded-bottom p-4">
                            <h4><?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?></h4>
                            <div class="mb-4">
                                <h4 class="bg-white text-primary rounded-pill py-2 px-4 mb-0">
                                    IDR <?php echo number_format($car['harga'], 0, ',', '.'); ?>/hari
                                </h4>
                            </div>
                            <div class="row gy-2 gx-0 text-center mb-4">
                                <div class="col-6 border-end border-white">
                                    <i class="fa fa-users text-dark"></i>
                                    <span class="text-body ms-1"><?php echo htmlspecialchars($car['jumlah_kursi']); ?> Seat</span>
                                </div>
                                <div class="col-6 border-end border-white">
                                    <i class="fa fa-door-closed text-dark"></i>
                                    <span class="text-body ms-1"><?php echo htmlspecialchars($car['jumlah_pintu']); ?> Pintu</span>
                                </div>
                                <div class="col-6 border-end border-white">
                                    <i class="fa fa-car text-dark"></i>
                                    <span class="text-body ms-1"><?php echo htmlspecialchars($car['transmisi']); ?></span>
                                </div>
                                <div class="col-6 border-end border-white">
                                    <i class="fa fa-calendar text-dark"></i>
                                    <span class="text-body ms-1"><?php echo htmlspecialchars($car['tahun']); ?></span>
                                </div>
                            </div>
                            <a href="?views=booking&uuid=<?php echo urlencode($car['uuid']); ?>"
                                class="btn btn-primary rounded-pill d-flex justify-content-center py-3">Book Now</a>
                            <!-- <?php if ($statusCar == 'Tersedia'): ?>
                                <a href="?views=booking&uuid=<?php echo urlencode($car['uuid']); ?>"
                                    class="btn btn-primary rounded-pill d-flex justify-content-center py-3">Book Now</a>
                            <?php elseif ($statusCar == 'Terbooking'): ?>
                                <a class="btn btn-primary rounded-pill d-flex justify-content-center py-3"
                                    style="background-color: #b8b8b8; color: black;">Booked</a>
                            <?php endif; ?> -->
                        </div>
                    </div>
                </div>
                <!-- END MOBIL -->
            <?php endforeach; ?>
        </div>
        <div class="wow fadeInUp mt-3" data-wow-delay="0.1s">
            <div class="d-flex justify-content-center">
                <a href="?views=car" class="btn btn-primary">Lihat Semua Mobil</a>
            </div>
        </div>
    </div>
</div>
<!-- Car categories End -->

<!-- Features Start -->
<!-- <div class="container-fluid feature py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Fitur <span class="text-primary">Utama</span></h1>
            </p>
        </div>
        <div class="row g-4 align-items-center">
            <div class="col-xl-4">
                <div class="row gy-4 gx-0">
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <span class="fa fa-trophy fa-2x text-white"></span>
                            </div>
                            <div class="ms-4">
                                <h5 class="mb-3">Layanan Kelas Satu</h5>
                                <p class="mb-0">Nikmati pengalaman layanan premium dengan standar tertinggi untuk kenyamanan dan kemudahan Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <span class="fa fa-road fa-2x text-white"></span>
                            </div>
                            <div class="ms-4">
                                <h5 class="mb-3">Bantuan Jalan 24/7</h5>
                                <p class="mb-0">Kami siap membantu Anda kapan saja dan di mana saja, 24 jam sehari, 7 hari seminggu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                <img src="assets/web/img/features-img.png" class="img-fluid w-100" style="object-fit: cover;" alt="Img">
            </div>
            <div class="col-xl-4">
                <div class="row gy-4 gx-0">
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item justify-content-end">
                            <div class="text-end me-4">
                                <h5 class="mb-3">Kualitas Terbaik dengan Harga Minimal</h5>
                                <p class="mb-0">Dapatkan kualitas layanan terbaik tanpa harus menguras kantong Anda.</p>
                            </div>
                            <div class="feature-icon">
                                <span class="fa fa-tag fa-2x text-white"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item justify-content-end">
                            <div class="text-end me-4">
                                <h5 class="mb-3">Gratis Antar Jemput</h5>
                                <p class="mb-0">Nikmati kemudahan layanan gratis antar jemput untuk kebutuhan perjalanan Anda.</p>
                            </div>
                            <div class="feature-icon">
                                <span class="fa fa-map-pin fa-2x text-white"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Features End -->

<!-- Fact Counter -->
<div class="container-fluid counter bg-secondary py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="counter-item text-center">
                    <div class="counter-item-icon mx-auto">
                        <i class="fas fa-thumbs-up fa-2x text-white"></i>
                    </div>
                    <div class="counter-counting my-3">
                        <span class="text-white fs-2 fw-bold" data-toggle="counter-up"><?= $totalReviews ?></span>
                        <span class="h1 fw-bold text-white"></span>
                    </div>
                    <h4 class="text-white mb-0">Pelanggan Senang</h4>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="counter-item text-center">
                    <div class="counter-item-icon mx-auto">
                        <i class="fas fa-car-alt fa-2x text-white"></i>
                    </div>
                    <div class="counter-counting my-3">
                        <span class="text-white fs-2 fw-bold" data-toggle="counter-up"><?= $totalCars ?></span>
                        <span class="h1 fw-bold text-white"></span>
                    </div>
                    <h4 class="text-white mb-0">Jumlah Mobil</h4>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.7s">
                <div class="counter-item text-center">
                    <div class="counter-item-icon mx-auto">
                        <i class="fas fa-gauge-simple-high fa-2x text-white"></i>
                    </div>
                    <div class="counter-counting my-3">
                        <span class="text-white fs-2 fw-bold" data-toggle="counter-up"><?= number_format($totalKilometers) ?></span>
                        <span class="h1 fw-bold text-white"></span>
                    </div>
                    <h4 class="text-white mb-0">Total kilometer</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fact Counter -->

<!-- Services Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Layanan <span class="text-primary">Utama</span></h1>
        </div>
        <div class="row g-4">
            <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-3">Reservasi Telepon</h5>
                    <p class="mb-0">Bisa pesan layanan kami dengan mudah melalui telepon.</p>
                </div>
            </div> -->
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-money-bill-alt fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-3">Tarif Khusus</h5>
                    <p class="mb-0">Nikmati tarif spesial untuk layanan kami yang tidak akan menguras kantong Anda.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-road fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-3">Sewa Satu Arah</h5>
                    <p class="mb-0">Sewa langsung ke owner. Layanan fleksibel untuk perjalanan satu arah sesuai kebutuhan Anda.</p>
                </div>
            </div>
            <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-umbrella fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-3">Asuransi Jiwa</h5>
                    <p class="mb-0">Perjalanan Anda dilindungi dengan asuransi jiwa untuk keamanan ekstra.</p>
                </div>
            </div> -->
            <!-- <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-tag fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-3">Kualitas Terbaik dengan Harga Minimal</h5>
                    <p class="mb-0">Dapatkan kualitas layanan terbaik tanpa harus menguras kantong Anda.</p>
                </div>
            </div> -->
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-car-alt fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-3">Mobil Berkualitas</h5>
                    <p class="mb-0">Nikmati layanan transportasi berkualitas agar nyaman dan aman.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Car Steps Start -->
<div class="container-fluid steps py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize text-white mb-3">Proses<span class="text-primary"> Pemesanan</span></h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="steps-item p-4 mb-4">
                    <h4>Daftar dan Lengkapi Data Diri</h4>
                    <p class="mb-0">Membuat akun dan Lakukan upload data diri untuk persyaratan.</p>
                    <div class="setps-number">01.</div>
                </div>
            </div>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="steps-item p-4 mb-4">
                    <h4>Pilih Mobil</h4>
                    <p class="mb-0">Pilih mobil yang sesuai dengan kebutuhan dan preferensi Anda.</p>
                    <div class="setps-number">02.</div>
                </div>
            </div>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="steps-item p-4 mb-4">
                    <h4>Pembayaran</h4>
                    <p class="mb-0">Lakukan pembayaran untuk lepas kunci. </p>
                    <div class="setps-number">03.</div>
                </div>
            </div>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="steps-item p-4 mb-4">
                    <h4>Ambil Kunci</h4>
                    <p class="mb-0">Nikmati pengalaman berkendara yang nyaman bersama layanan kami.</p>
                    <div class="setps-number">04.</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Car Steps End -->

<!-- Testimonial Start -->
<div class="container-fluid testimonial pb-5 mt-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Ulasan<span class="text-primary"> Pengguna</span></h1>
            </p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($reviews as $review): ?>
                <?php
                $modelUser = new User();
                $user = $modelUser->getById($review['user_id']);

                $modelProfile = new Profile();
                $profile = $modelProfile->getByUserId($review['user_id']);

                $car = $carModel->getCarById($review['car_id']);

                $createdAt = new DateTime($review['created_at']);
                ?>
                <div class="testimonial-item">
                    <div class="testimonial-quote"><i class="fa fa-quote-right fa-2x"></i></div>
                    <div class="testimonial-inner p-4">
                        <img src="assets/uploads/photo_profile/<?php echo htmlspecialchars($profile['photo_profile']) ?>" class="img-fluid">
                        <div class="ms-4">
                            <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                            <p><?php echo htmlspecialchars($car['merk'] . " " . $car['tipe']); ?> (<?php echo $createdAt->format('d M Y'); ?>)</p>
                            <div class="d-flex text-primary">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star<?php echo $i <= $review['grade'] ? '' : ' text-body'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="border-top rounded-bottom p-4">
                        <p class="mb-0"><?php echo htmlspecialchars($review['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Testimonial End -->