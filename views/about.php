<?php
require_once 'classes/Setting.php';

$getSetting = new Setting();
$setting = $getSetting->list()[0];
// $owner = $setting['owner'];
// $photo = $setting['photo'];
// $about_company = $setting['about_company'];
// $history_company = $setting['history_company'];
// $visi = $setting['visi'];
// $misi = $setting['misi'];
?>
<!-- About Start -->
<div class="container-fluid overflow-hidden about py-3">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-item">
                    <div class="pb-5">
                        <h1 class="display-5 text-capitalize">Tentang <span class="text-primary">Kami</span></h1>
                        <p class="mb-0"><?php echo $setting['about_company']; ?></p>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="about-item-inner border p-4">
                                <div class="about-icon mb-4">
                                    <img src="assets/web/img/about-icon-1.png" class="img-fluid w-50 h-50" alt="Icon" style="filter: brightness(0) invert(1);">
                                </div>
                                <h5 class="mb-3">Visi Kami</h5>
                                <p class="mb-0"><?php echo $setting['visi']; ?></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-item-inner border p-4">
                                <div class="about-icon mb-4">
                                    <img src="assets/web/img/about-icon-2.png" class="img-fluid h-50 w-50" alt="Icon" style="filter: brightness(0) invert(1);">
                                </div>
                                <h5 class="mb-3">Misi Kami</h5>
                                <p class="mb-0"><?php echo $setting['misi']; ?></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-item my-4"><?php echo $setting['history_company']; ?></p>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="text-center rounded bg-secondary p-4">
                                <?php
                                $currentYear = date("Y");
                                $establishedYear = 2016;
                                $yearsInBusiness = $currentYear - $establishedYear;
                                ?>
                                <h1 class="display-6 text-white"><?php echo $yearsInBusiness; ?></h1>
                                <h5 class="text-light mb-0">Tahun Pengalaman</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center">
                                <img src="assets/uploads/owner/<?php echo htmlspecialchars($photo); ?>" class="img-fluid rounded-circle border border-4 border-secondary" style="width: 100px; height: 100px;" alt="Image">
                                <div class="ms-4">
                                    <h4><?php echo htmlspecialchars($owner); ?></h4>
                                    <p class="mb-0">Pendiri Diana Rent Car</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="about-img">
                    <div class="img-1">
                        <img src="assets/web/img/about-img.jpg" class="img-fluid rounded h-100 w-100" alt="">
                    </div>
                    <div class="img-2">
                        <img src="assets/web/img/about-img-1.jpg" class="img-fluid rounded w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Banner Start -->
<!-- <div class="container-fluid banner pb-5 wow zoomInDown" data-wow-delay="0.1s">
    <div class="container pb-5">
        <div class="banner-item rounded">
            <img src="assets/web/img/banner-1.jpg" class="img-fluid rounded w-100" alt="">
            <div class="banner-content">
                <h2 class="text-primary">Sewa Mobil Anda</h2>
                <h1 class="text-white">Tertarik untuk Menyewa?</h1>
                <p class="text-white">Jangan ragu dan kirimkan pesan kepada kami.</p>
                <div class="banner-btn">
                    <a href="#" class="btn btn-secondary rounded-pill py-3 px-4 px-md-5 me-2">WhatsApp</a>
                    <a href="#" class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Banner End -->