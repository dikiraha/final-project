<?php
require_once 'classes/Car.php';

$carModel = new Car();
$cars = $carModel->list();
?>

<div class="container-fluid car pb-5">
    <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
        <h1 class="display-5 text-capitalize">Tipe <span class="text-primary">Kendaraan</span></h1>
    </div>
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <a href="?views=home" class="btn btn-secondary"><i class="fa fa-arrow-left text-white"></i> Back</a>
    </div>
    <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <?php foreach ($cars as $car): ?>
            <div class="col-md-3 mb-4">
                <div class="card p-2" style="border: 1px solid black;">
                    <div class="categories-img rounded-top">
                        <img src="./assets/uploads/car/<?php echo htmlspecialchars($car['photo']); ?>" class="img-fluid w-100 rounded-top car-image" style="height: 200px; object-fit: cover;" alt="<?php echo htmlspecialchars($car['merk']); ?>">
                    </div>
                    <div class="card-body">
                        <h4 class="text-center"><?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?></h4>
                        <div class="mb-4">
                            <h4 class="bg-white text-center text-primary rounded-pill py-2 px-4 mb-0">
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
                        <a href="?views=booking&uuid=<?php echo urlencode($car['uuid']); ?>" class="btn btn-primary rounded-pill d-flex justify-content-center py-3">Book Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>