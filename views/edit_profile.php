<?php
require_once 'classes/User.php';
require_once 'classes/Profile.php';

$user_uuid = $_SESSION['user_uuid'];

$getUser = new User();
$user = $getUser->getByUuid($user_uuid);

$getProfile = new Profile();
$profile = $getProfile->getByUserId($user['id']);
?>

<div class="container-fluid car pb-5">
    <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
        <h1 class="display-5 text-capitalize">Edit <span class="text-primary">Profile</span></h1>
    </div>
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <a href="?views=home" class="btn btn-secondary"><i class="fa fa-arrow-left text-white"></i> Back</a>
    </div>

    <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-md-12 mb-4">
            <h4 style="display: inline;"><b>Lengkapi Data</h4>
            <h6 style="display: inline;" class="text-danger"> *pastikan data anda valid</h6>
            <div class="card p-2 shadow">
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-md-12">
                        <form action="backend/booking/store.php" method="POST">
                            <input type="hidden" name="uuid" id="uuid" value="<?php echo htmlspecialchars($user['uuid']); ?>">
                            <div class="row g-4 p-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                        <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" id="date_end" name="date_end" placeholder="Tanggal Pengembalian" required>
                                        <label for="date_end">Tanggal Pengembalian <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="destination" name="destination" placeholder="Tujuan Kota" required>
                                        <label for="destination">Destinasi <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <label class="form-label">Dengan Supir? <span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_driver" id="supir_ya" value="Iya" required>
                                        <label class="form-check-label" for="supir_ya">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_driver" id="supir_tidak" value="Tidak" required>
                                        <label class="form-check-label" for="supir_tidak">Tidak</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <select name="method" id="method" class="form-select" required onchange="toggleTypeSelect()">
                                            <option value="">-- Pilih --</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                        <label for="method">Metode Pembayaran <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6" id="type-container" style="display: none;" onchange="toggleAmountSelect()">
                                    <div class="form-floating">
                                        <select name="type" id="type" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="Lunas">Lunas</option>
                                            <option value="DP (Uang Muka)">DP (Uang Muka)</option>
                                        </select>
                                        <label for="type">Tipe Pembayaran <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" onclick="validateForm()">
                                        Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>