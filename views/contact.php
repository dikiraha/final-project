<?php
require_once 'classes/Setting.php';

$settingModel = new Setting();
$setting = $settingModel->list()[0]; // Assuming there's only one row in the table
$address = $setting['address'];
$email = $setting['email'];
$phone_number_1 = $setting['phone_number_1'];
$phone_number_2 = $setting['phone_number_2'];
$facebook = $setting['facebook'];
$instagram = $setting['instagram'];
$twitter = $setting['twitter'];
$tiktok = $setting['tiktok'];
?>
<!-- Contact Start -->
<div class="container-fluid contact">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize">Hubungi <span class="text-primary">Kami</span></h1>
        </div>
        <div class="row g-5">
            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-5">
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="contact-add-item p-4">
                            <div class="contact-icon mb-4">
                                <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                            <div>
                                <h4>Alamat</h4>
                                <p class="mb-0"><?php echo htmlspecialchars($address); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="contact-add-item p-4">
                            <div class="contact-icon mb-4">
                                <i class="fas fa-envelope fa-2x text-white"></i>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <p class="mb-0"><?php echo htmlspecialchars($email); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="contact-add-item p-4">
                            <div class="contact-icon mb-4">
                                <i class="fa fa-phone-alt fa-2x text-white"></i>
                            </div>
                            <div>
                                <h4>Telepon</h4>
                                <p class="mb-0"><?php echo htmlspecialchars($phone_number_1); ?></p>
                                <p class="mb-0"><?php echo htmlspecialchars($phone_number_2); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-secondary p-5 rounded">
                    <h4 class="text-primary mb-4">Kirim Pesan Anda</h4>
                    <form>
                        <div class="row g-4">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="phone" class="form-control" id="phone" placeholder="Phone">
                                    <label for="phone">Nomor Handphone</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="project" placeholder="Project">
                                    <label for="project">Project Anda</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 160px"></textarea>
                                    <label for="message">Pesan</label>
                                </div>

                            </div>
                            <div class="col-12">
                                <button class="btn btn-light w-100 py-3">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="col-12 col-xl-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="p-5 bg-light rounded">
                    <div class="bg-white rounded p-4 mb-4">
                        <h4 class="mb-3">Our Branch 01</h4>
                        <div class="d-flex align-items-center flex-shrink-0 mb-3">
                            <p class="mb-0 text-dark me-2">Address:</p><i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <p class="mb-0">123 Street New York.USA</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-dark me-2">Telephone:</p><i class="fa fa-phone-alt text-primary me-2"></i>
                            <p class="mb-0">(+012) 3456 7890</p>
                        </div>
                    </div>
                    <div class="bg-white rounded p-4 mb-4">
                        <h4 class="mb-3">Our Branch 02</h4>
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 text-dark me-2">Address:</p><i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <p class="mb-0">123 Street New York.USA</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-dark me-2">Telephone:</p><i class="fa fa-phone-alt text-primary me-2"></i>
                            <p class="mb-0">(+012) 3456 7890</p>
                        </div>
                    </div>
                    <div class="bg-white rounded p-4 mb-0">
                        <h4 class="mb-3">Our Branch 03</h4>
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 text-dark me-2">Address:</p><i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <p class="mb-0">123 Street New York.USA</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-dark me-2">Telephone:</p><i class="fa fa-phone-alt text-primary me-2"></i>
                            <p class="mb-0">(+012) 3456 7890</p>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-12">
                <div class="rounded">
                    <iframe class="rounded w-100"
                        style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d246.89397624138218!2d107.3309477606346!3d-6.290652288126301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1734975946401!5m2!1sid!2sid"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Contact End -->