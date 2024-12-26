<?php
require_once '../classes/Car.php';

$getCar = new Car();
$uuid = $_GET['uuid'];
$car = $getCar->edit($uuid);
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Car</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=car_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <form action="../backend/car/update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="uuid" value="<?php echo htmlspecialchars($car['uuid']); ?>">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" />
                            <?php if (!empty($car['photo'])): ?>
                                <img src="./../assets/uploads/car/<?php echo htmlspecialchars($car['photo']); ?>" alt="Car Photo" width="100" height="100" class="mt-3" />
                            <?php endif; ?>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk"
                                value="<?php echo htmlspecialchars($car['merk']); ?>" />
                            <label for="merk">Merk</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Tipe"
                                value="<?php echo htmlspecialchars($car['tipe']); ?>" />
                            <label for="tipe">Tipe</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="jumlah_kursi" name="jumlah_kursi"
                                placeholder="Jumlah Kursi" value="<?php echo htmlspecialchars($car['jumlah_kursi']); ?>" />
                            <label for="jumlah_kursi">Jumlah Kursi</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="jumlah_pintu" name="jumlah_pintu"
                                placeholder="Jumlah Pintu" value="<?php echo htmlspecialchars($car['jumlah_pintu']); ?>" />
                            <label for="jumlah_pintu">Jumlah Pintu</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="warna" name="warna" placeholder="Warna"
                                value="<?php echo htmlspecialchars($car['warna']); ?>" />
                            <label for="warna">Warna</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="no_plat" name="no_plat" placeholder="Nomor Plat"
                                value="<?php echo htmlspecialchars($car['no_plat']); ?>" />
                            <label for="no_plat">Nomor Plat</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun"
                                value="<?php echo htmlspecialchars($car['tahun']); ?>" />
                            <label for="tahun">Tahun</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="km" name="km" placeholder="KM"
                                value="<?php echo htmlspecialchars($car['km']); ?>" />
                            <label for="km">KM</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="jenis_bensin" name="jenis_bensin"
                                placeholder="Jenis Bensin" value="<?php echo htmlspecialchars($car['jenis_bensin']); ?>" />
                            <label for="jenis_bensin">Jenis Bensin</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga"
                                value="<?php echo htmlspecialchars($car['harga']); ?>" />
                            <label for="harga">Harga</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="denda" name="denda" placeholder="Denda"
                                value="<?php echo htmlspecialchars($car['denda']); ?>" />
                            <label for="denda">Denda</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="transmisi" name="transmisi" aria-label="Transmisi">
                                <option value="" disabled>-- Pilih --</option>
                                <option value="Automatic" <?php echo ($car['transmisi'] === 'Automatic') ? 'selected' : ''; ?>>Automatic</option>
                                <option value="Manual" <?php echo ($car['transmisi'] === 'Manual') ? 'selected' : ''; ?>>Manual</option>
                            </select>
                            <label for="transmisi">Transmisi</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="status" name="status" aria-label="Transmisi">
                                <option value="" disabled>-- Pilih --</option>
                                <option value="Active" <?php echo ($car['status'] === 'Active') ? 'selected' : ''; ?>>Active</option>
                                <option value="Not Active" <?php echo ($car['status'] === 'Not Active') ? 'selected' : ''; ?>>Not Active</option>
                            </select>
                            <label for="status">Status</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>