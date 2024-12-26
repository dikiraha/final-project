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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required />
                                    <label for="photo">Photo <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="merk" name="merk" placeholder="Contoh : Toyota" required />
                                    <label for="merk">Merk <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Contoh : Avanza" required />
                                    <label for="tipe">Tipe <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="number" class="form-control" id="jumlah_kursi" name="jumlah_kursi" placeholder="Contoh : 4" required />
                                    <label for="jumlah_kursi">Jumlah Kursi <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="number" class="form-control" id="jumlah_pintu" name="jumlah_pintu" placeholder="Contoh : 4" required />
                                    <label for="jumlah_pintu">Jumlah Pintu <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="warna" name="warna" placeholder="Contoh : Putih" required />
                                    <label for="warna">Warna <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="no_plat" name="no_plat" placeholder="Contoh : T 1234 TT" required />
                                    <label for="no_plat">Nomor Plat <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Contoh : 2024" maxlength="4" required />
                                    <label for="tahun">Tahun <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="km" name="km" placeholder="Total KM" required oninput="formatWithDots(this)" />
                                    <label for="km">KM <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="jenis_bensin" name="jenis_bensin" placeholder="Jenis Bensin" required />
                                    <label for="jenis_bensin">Jenis Bensin <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required />
                                    <label for="harga">Harga <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="number" class="form-control" id="denda" name="denda" placeholder="Denda" required />
                                    <label for="denda">Denda <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <select class="form-select" id="transmisi" name="transmisi" aria-label="Transmisi" required>
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <option value="Automatic">Automatic</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                    <label for="transmisi">Transmisi <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <select class="form-select" id="status" name="status" aria-label="Status" required>
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <option value="Active">Active</option>
                                        <option value="Not Active">Not Active</option>
                                    </select>
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function formatWithDots(input) {
        // Hapus semua titik dari input
        let value = input.value.replace(/\./g, '');

        // Tambahkan titik setiap 3 angka
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Setel nilai input kembali ke format dengan titik
        input.value = value;
    }
</script>