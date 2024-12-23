<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Car</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=car_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <form action="../backend/car/store.php" method="POST" enctype="multipart/form-data">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" />
                            <label for="photo">Photo</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk" />
                            <label for="merk">Merk</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Tipe" />
                            <label for="tipe">Tipe</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="jumlah_kursi" name="jumlah_kursi" placeholder="Jumlah Kursi" />
                            <label for="jumlah_kursi">Jumlah Kursi</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="jumlah_pintu" name="jumlah_pintu" placeholder="Jumlah Pintu" />
                            <label for="jumlah_pintu">Jumlah Pintu</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="warna" name="warna" placeholder="Warna" />
                            <label for="warna">Warna</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="no_plat" name="no_plat" placeholder="Nomor Plat" />
                            <label for="no_plat">Nomor Plat</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" />
                            <label for="tahun">Tahun</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="km" name="km" placeholder="KM" />
                            <label for="km">KM</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="jenis_bensin" name="jenis_bensin" placeholder="Jenis Bensin" />
                            <label for="jenis_bensin">Jenis Bensin</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" />
                            <label for="harga">Harga</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="number" class="form-control" id="denda" name="denda" placeholder="Denda" />
                            <label for="denda">Denda</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="transmisi" name="transmisi" aria-label="Transmisi">
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                            </select>
                            <label for="transmisi">Transmisi</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>