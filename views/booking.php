<?php
require_once 'classes/Car.php';
require_once 'classes/Setting.php';
require_once 'classes/Profile.php';

$getCar = new Car();
$getsetting = new Setting();

$uuid = $_GET['uuid'];
$car = $getCar->getDetail($uuid);
$setting = $getsetting->getFirstSetting();

$profile = null;
if (isset($_SESSION['user_id'])) {
    $getProfile = new Profile();
    $profile = $getProfile->getByUserId($_SESSION['user_id']);
}
?>

<div class="container-fluid car pb-5">
    <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
        <h1 class="display-5 text-capitalize">Booking <span class="text-primary">Kendaraan</span></h1>
    </div>
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <a href="?views=home" class="btn btn-secondary"><i class="fa fa-arrow-left text-white"></i> Back</a>
    </div>
    <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-md-12 mb-4">
            <h3 style="display: inline;"><b>Detail Kendaraan</b></h3>
            <div class="card p-2 shadow">
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-md-3">
                        <div class="categories-img rounded-top text-center">
                            <img src="./assets/uploads/car/<?php echo htmlspecialchars($car['photo']); ?>" class="img-fluid rounded-top car-image" style="height: 200px; object-fit: cover;" alt="<?php echo htmlspecialchars($car['merk']); ?>">
                        </div>
                    </div>
                    <?php
                    function formatRupiah($angka)
                    {
                        return 'Rp ' . number_format($angka, 0, ',', '.');
                    }

                    function formatKm($angka)
                    {
                        return number_format($angka, 0, ',', '.') . ' KM';
                    }
                    ?>
                    <div class="col-md-9">
                        <div class="form-group">
                            <b><?php echo htmlspecialchars($car['merk']); ?> <?php echo htmlspecialchars($car['tipe']); ?> <?php echo htmlspecialchars($car['tahun']); ?></b>
                            <br>
                            <?php echo htmlspecialchars($car['no_plat']); ?>
                        </div>
                        <hr>
                        <div class="form-group">
                            <i class="fa fa-users text-dark"></i> 1 - <?php echo htmlspecialchars($car['jumlah_kursi']); ?> Penumpang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-door-closed text-dark"></i> <?php echo htmlspecialchars($car['jumlah_pintu']); ?> Pintu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-tachometer text-dark"></i> <?php echo formatKm($car['km']); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa-solid fa-gas-pump text-dark"></i> <?php echo htmlspecialchars($car['jenis_bensin']); ?>
                        </div>
                        <hr>
                        <div class="form-group">
                            <b>
                                Harga : <?php echo formatRupiah($car['harga']); ?>/Hari <br>
                                Denda : <?php echo formatRupiah($car['denda']); ?>/Jam
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-md-12 mb-4">
            <h3 style="display: inline;" class="text-danger"><b><u>Syarat Lepas Kunci</b></u></h3>
            <h6 style="display: inline;" class="text-danger"> *pastikan sudah login dan melengkapi data persyaratan</h6>
            <div class="card p-2 shadow">
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-md-12">
                        <?php echo $setting['agreement_1']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-md-12 mb-4">
            <h3 style="display: inline;"><b>Penyewaan</h3>
            <div class="card p-2 shadow">
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-md-12">
                        <form action="backend/booking/store.php" method="POST">
                            <input type="hidden" name="car_id" id="car_id" value="<?php echo htmlspecialchars($car['id']); ?>">
                            <input type="hidden" name="car_uuid" id="car_uuid" value="<?php echo htmlspecialchars($car['uuid']); ?>">
                            <input type="hidden" name="harga_mobil" id="harga_mobil" value="<?php echo htmlspecialchars($car['harga']); ?>">
                            <input type="hidden" name="denda_mobil" id="denda_mobil" value="<?php echo htmlspecialchars($car['denda']); ?>">
                            <div class="row g-4 p-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" id="date_start" name="date_start" placeholder="Tanggal Pengambilan" required>
                                        <label for="date_start">Tanggal Pengambilan <span class="text-danger">*</span></label>
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
                                <div class="col-lg-12 col-xl-6" id="amount-container" style="display: none;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Nominal DP" oninput="formatAmount(this)">
                                        <label for="amount">Nominal DP <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <input type="hidden" id="amount_hidden" name="amount_hidden">
                                <div class="col-lg-12 col-xl-12" id="transfer-container" style="display: none;">
                                    <div class="form-floating">
                                        <h5>Transfer</h5>
                                        <h5>No. Rek. : <?php echo htmlspecialchars($setting['account_number']); ?></h5>
                                        <h5>Bank : <?php echo htmlspecialchars($setting['bank']); ?></h5>
                                        <h5>A/N : <?php echo htmlspecialchars($setting['account_name']); ?></h5>
                                        <h6 class="text-danger"><b>*Screenshot bukti pembayaran, akan ada form input bukti pembayaran setelah submit form ini</b></h6>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="d-flex justify-content-end">
                                        <span>
                                            <h3 class="text-success"><b>Total Harga : <span id="total_harga_display">0</span></b></h3>
                                        </span>
                                    </div>
                                </div>
                                <input type="hidden" name="total_harga" id="total_harga" value="0">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary w-100 py-3" onclick="validateForm()">
                                        Booking dan Pembayaran
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

<!-- Modal -->
<div class="modal fade" id="agreementModal" tabindex="-1" aria-labelledby="agreementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agreementModalLabel">Persyaratan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $setting['agreement_2']; ?>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="is_agree" name="is_agree" required>
                    <label class="form-check-label" for="is_agree">
                        Saya setuju dengan ketentuan yang diberikan
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmAgreement">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var form = document.querySelector('form');
        var isValid = form.checkValidity();

        // Check if the user is logged in
        var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

        // Check if the profile is complete
        var isProfile = <?php echo isset($profile) && $profile ? 'true' : 'false'; ?>;

        if (!isLoggedIn) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Anda harus login terlebih dahulu.',
                showCancelButton: true,
                confirmButtonText: 'Login',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'auth/login.php';
                }
            });
            return;
        }

        if (!isProfile) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Anda harus lengkapi data diri terlebih dahulu.',
                showCancelButton: true,
                confirmButtonText: 'Edit Profile',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?views=edit_profile';
                }
            });
            return;
        }

        if (isValid) {
            var modal = new bootstrap.Modal(document.getElementById('agreementModal'));
            modal.show();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mohon isi semua data.'
            });
        }
    }

    document.getElementById('confirmAgreement').addEventListener('click', function() {
        var isAgreeChecked = document.getElementById('is_agree').checked;
        if (isAgreeChecked) {
            document.querySelector('form').submit();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anda harus menyetujui ketentuan yang diberikan.'
            });
        }
    });
</script>

<script>
    document.getElementById('date_start').addEventListener('input', function(e) {
        var time = new Date(e.target.value).getHours();
        if (time < 7 || time > 22) {
            e.target.setCustomValidity('Mohon pilih waktu dari jam 07:00 sampai 22:00.');
        } else {
            e.target.setCustomValidity('');
        }
    });

    document.getElementById('date_end').addEventListener('input', function(e) {
        var time = new Date(e.target.value).getHours();
        if (time < 7 || time > 22) {
            e.target.setCustomValidity('Mohon pilih waktu dari jam 07:00 sampai 22:00.');
        } else {
            e.target.setCustomValidity('');
        }
    });
</script>

<script>
    function toggleTypeSelect() {
        var method = document.getElementById('method').value;
        var typeContainer = document.getElementById('type-container');
        var transferContainer = document.getElementById('transfer-container');
        var typeSelect = document.getElementById('type');

        if (method === 'Transfer') {
            typeContainer.style.display = 'block';
            transferContainer.style.display = 'block';
            typeSelect.setAttribute('required', 'required');
        } else {
            typeContainer.style.display = 'none';
            transferContainer.style.display = 'none';
            typeSelect.removeAttribute('required');
        }
    }

    function toggleAmountSelect() {
        var type = document.getElementById('type').value;
        var amountContainer = document.getElementById('amount-container');
        var amountSelect = document.getElementById('amount');

        if (type === 'DP (Uang Muka)') {
            amountContainer.style.display = 'block';
            amountSelect.setAttribute('required', 'required');
        } else {
            amountContainer.style.display = 'none';
            amountSelect.removeAttribute('required');
        }
    }
</script>

<script>
    function formatAmount(input) {
        let value = input.value.replace(/\D/g, '');

        input.value = new Intl.NumberFormat('id-ID').format(value);

        document.getElementById('amount_hidden').value = value;
    }
</script>

<script>
    function calculateTotalPrice() {
        var dateStart = document.getElementById('date_start').value;
        var dateEnd = document.getElementById('date_end').value;
        var hargaPerHari = <?php echo $car['harga']; ?>;
        var supirChargePerDay = 150000;
        var isDriver = document.querySelector('input[name="is_driver"]:checked').value;

        if (dateStart && dateEnd) {
            var start = new Date(dateStart);
            var end = new Date(dateEnd);
            var timeDiff = end - start;
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (daysDiff > 0) {
                var totalPrice = daysDiff * hargaPerHari;
                if (isDriver === 'Iya') {
                    totalPrice += daysDiff * supirChargePerDay;
                }
                document.getElementById('total_harga_display').innerText = totalPrice.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                document.getElementById('total_harga').value = totalPrice;
            } else {
                document.getElementById('total_harga_display').innerText = '0';
                document.getElementById('total_harga').value = '0';
            }
        }
    }

    document.getElementById('date_start').addEventListener('input', calculateTotalPrice);
    document.getElementById('date_end').addEventListener('input', calculateTotalPrice);
    document.querySelectorAll('input[name="is_driver"]').forEach(function(elem) {
        elem.addEventListener('change', calculateTotalPrice);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var now = new Date();
        var year = now.getFullYear();
        var month = (now.getMonth() + 1).toString().padStart(2, '0');
        var day = now.getDate().toString().padStart(2, '0');
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');

        var currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        document.getElementById('date_start').setAttribute('min', currentDateTime);
        document.getElementById('date_end').setAttribute('min', currentDateTime);

        function validateTimeRange(event) {
            var dateTime = new Date(event.target.value);
            var hours = dateTime.getHours();
            var minutes = dateTime.getMinutes();

            if ((hours > 22 || (hours === 22 && minutes > 0)) || (hours < 7)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Waktu harus antara 07:00 sampai 22:00.'
                });
                event.target.value = '';
            }
        }

        document.getElementById('date_start').addEventListener('change', validateTimeRange);
        document.getElementById('date_end').addEventListener('change', validateTimeRange);
    });
</script>