<?php
require_once __DIR__ . '/../classes/Setting.php';

$settingModel = new Setting();
$setting = $settingModel->list()[0]; // Assuming there's only one row in the table
$about_footer = $setting['about_footer'];
$address = $setting['address'];
$email = $setting['email'];
$phone_number_1 = $setting['phone_number_1'];
$phone_number_2 = $setting['phone_number_2'];
$facebook = $setting['facebook'];
$instagram = $setting['instagram'];
$twitter = $setting['twitter'];
$tiktok = $setting['tiktok'];
?>
<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-6">
                <div class="footer-item d-flex flex-column">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">About</h4>
                        <p class="mb-3"><?php echo htmlspecialchars($about_footer); ?></p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <a href="?views=about"><i class="fas fa-angle-right me-2"></i> About</a>
                    <a href="?views=contact"><i class="fas fa-angle-right me-2"></i> Contact</a>
                </div>
            </div> -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Jam Operasional</h4>
                    <div class="mb-3">
                        <h6 class="text-muted mb-0">Senin - Jumat:</h6>
                        <p class="text-white mb-0">07.00 - 21.00 WIB</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-0">Sabtu - Minggu:</h6>
                        <p class="text-white mb-0">06:00 - 22:00 WIB</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-0">Tanggal Merah:</h6>
                        <p class="text-white mb-0">06:00 - 22:00 WIB</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Info Kontak</h4>
                    <a href="https://maps.app.goo.gl/hHdMvZpLid1f6yETA" target="_blank"><i class="fa fa-map-marker-alt me-2"></i> <?php echo htmlspecialchars($address); ?></a>
                    <a href="mailto:<?php echo htmlspecialchars($email); ?>"><i class="fas fa-envelope me-2"></i> <?php echo htmlspecialchars($email); ?></a>
                    <?php
                    $phone_number_1_62 = ltrim($phone_number_1, '0');
                    $phone_number = '62' . $phone_number_1_62;
                    ?>
                    <a href="https://wa.me/<?php echo htmlspecialchars($phone_number); ?>" target="_blank"><i class="fab fa-whatsapp me-2"></i> <?php echo htmlspecialchars($phone_number_1); ?></a>
                    <a href="tel:<?php echo htmlspecialchars($phone_number_2); ?>"><i class="fas fa-phone me-2"></i> <?php echo htmlspecialchars($phone_number_2); ?></a>
                    <div class="d-flex">
                        <?php if (!empty($facebook)): ?>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href="<?php echo htmlspecialchars($facebook); ?>" target="_blank"><i class="fab fa-facebook-f text-white"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($twitter)): ?>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href="<?php echo htmlspecialchars($twitter); ?>" target="_blank"><i class="fab fa-twitter text-white"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($instagram)): ?>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href="<?php echo htmlspecialchars($instagram); ?>" target="_blank"><i class="fab fa-instagram text-white"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($tiktok)): ?>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-0" href="<?php echo htmlspecialchars($tiktok); ?>" target="_blank"><i class="fab fa-tiktok text-white"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="text-body"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>Diana Rent Car</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end text-body">
                Designed By <a class="border-bottom text-white" href="#">Kelompok 2</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->