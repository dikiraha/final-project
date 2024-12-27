<?php
require_once 'classes/Car.php';
require_once 'classes/Setting.php';

$getCar = new Car();
$getsetting = new Setting();

$uuid = $_GET['uuid'];
$car = $getCar->getDetail($uuid);
$setting = $getsetting->getFirstSetting();
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
            <h4><b>Detail Kendaraan</b></h4>
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

    <!-- <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-md-12 mb-4">
            <h4><b>Review Kendaraan</b></h4>
            <h3 style="display: inline;"><b>4,8</b></h3>
            <h6 style="display: inline;">/5</h6>
            <h6 style="display: inline;">dari 100 review</h6>
            <div class="card p-2 shadow">
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-md-3">
                        <div class="categories-img rounded-top text-center">
                            <img src="./assets/uploads/car/<?php echo htmlspecialchars($car['photo']); ?>" class="img-fluid rounded-top car-image" style="height: 200px; object-fit: cover;" alt="<?php echo htmlspecialchars($car['merk']); ?>">
                        </div>
                    </div>

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
    </div> -->

    <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-md-12 mb-4">
            <h4 class="text-danger"><b><u>*Syarat Lepas Kunci</b></u></h4>
            <div class="card p-2 shadow">
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-md-12">
                        <?php echo htmlspecialchars($setting['agreement_1']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-md-12 mb-4">
            <h4 style="display: inline;"><b>Penyewaan</h4>
            <h6 style="display: inline;" class="text-danger"> *pastikan sudah login</h6>
            <div class="card p-2 shadow">
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-md-12">
                        <form action="../backend/booking/store.php" method="POST">
                            <div class="row g-4 p-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" id="date_start" name="date_start" placeholder="Tanggal Pengambilan" min="07:00" max="22:00" required>
                                        <label for="date_start">Tanggal Pengambilan <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" id="date_end" name="date_end" placeholder="Tanggal Pengembalian" min="07:00" max="22:00" required>
                                        <label for="date_end">Tanggal Pengembalian <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
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
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Nominal DP">
                                        <label for="amount">Nominal DP <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12" id="transfer-container" style="display: none;">
                                    <div class="form-floating">
                                        <h5>Transfer</h5>
                                        <h5>No : <?php echo htmlspecialchars($setting['account_number']); ?></h5>
                                        <h5>Bank : <?php echo htmlspecialchars($setting['bank']); ?></h5>
                                        <h5>A/N : <?php echo htmlspecialchars($setting['account_name']); ?></h5>
                                        <h6 class="text-danger"><b>*Screenshot bukti pembayaran, akan ada form input bukti pembayaran setelah submit form ini</b></h6>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="d-flex justify-content-end">
                                        <span>
                                            <h3 class="text-success"><b>Total Harga : <span id="total_harga">0</span></b></h3>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3">Booking dan Pembayaran</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

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
    function calculateTotalPrice() {
        var dateStart = document.getElementById('date_start').value;
        var dateEnd = document.getElementById('date_end').value;
        var hargaPerHari = <?php echo $car['harga']; ?>;
        var supirCharge = 150000;
        var isDriver = document.querySelector('input[name="is_driver"]:checked').value;

        if (dateStart && dateEnd) {
            var start = new Date(dateStart);
            var end = new Date(dateEnd);
            var timeDiff = end - start;
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (daysDiff > 0) {
                var totalPrice = daysDiff * hargaPerHari;
                if (isDriver === 'Iya') {
                    totalPrice += supirCharge;
                }
                document.getElementById('total_harga').innerText = totalPrice.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
            } else {
                document.getElementById('total_harga').innerText = '0';
            }
        }
    }

    document.getElementById('date_start').addEventListener('input', calculateTotalPrice);
    document.getElementById('date_end').addEventListener('input', calculateTotalPrice);
    document.querySelectorAll('input[name="is_driver"]').forEach(function(elem) {
        elem.addEventListener('change', calculateTotalPrice);
    });
</script>