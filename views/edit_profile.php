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
                        <form action="backend/user/update_profile.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="uuid" id="uuid" value="<?php echo htmlspecialchars($user['uuid']); ?>">
                            <div class="row g-4 p-3">
                                <div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
                                        <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number'] ?? ''); ?>" maxlength="15" required>
                                        <label for="phone_number">No Handphone <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="form-floating">
                                        <textarea name="address" id="address" class="form-control" required><?php echo htmlspecialchars($profile['address'] ?? ''); ?></textarea>
                                        <label for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="laki-laki" value="Laki-laki" <?php echo (isset($profile['gender']) && $profile['gender'] === 'Laki-laki') ? 'checked' : ''; ?> required>
                                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan" <?php echo (isset($profile['gender']) && $profile['gender'] === 'Perempuan') ? 'checked' : ''; ?> required>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="photo_profile">Photo Profile <?php echo empty($profile['photo_profile']) ? '<span class="text-danger">*</span>' : ''; ?></label>
                                        <input type="file" class="form-control" style="background-color: white;" id="photo_profile" name="photo_profile" accept="image/*" <?php echo empty($profile['photo_profile']) ? 'required' : ''; ?>>
                                        <span>Format file: gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['photo_profile'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/photo_profile/<?php echo htmlspecialchars($profile['photo_profile']); ?>">
                                                View Photo Profile
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="ktp">KTP <?php echo empty($profile['photo_profile']) ? '<span class="text-danger">*</span>' : ''; ?></label>
                                        <input type="file" class="form-control" style="background-color: white;" id="ktp" name="ktp" accept="image/*,.pdf" <?php echo empty($profile['ktp']) ? 'required' : ''; ?>>
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['ktp'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/ktp/<?php echo htmlspecialchars($profile['ktp']); ?>">
                                                View KTP
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="sim">SIM A <?php echo empty($profile['sim']) ? '<span class="text-danger">*</span>' : ''; ?></label>
                                        <input type="file" class="form-control" style="background-color: white;" id="sim" name="sim" accept="image/*,.pdf" <?php echo empty($profile['sim']) ? 'required' : ''; ?>>
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['sim'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/sim/<?php echo htmlspecialchars($profile['sim']); ?>">
                                                View SIM A
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="kk">Kartu Keluarga <?php echo empty($profile['kk']) ? '<span class="text-danger">*</span>' : ''; ?></label>
                                        <input type="file" class="form-control" style="background-color: white;" id="kk" name="kk" accept="image/*,.pdf" <?php echo empty($profile['kk']) ? 'required' : ''; ?>>
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['kk'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/kk/<?php echo htmlspecialchars($profile['kk']); ?>">
                                                View Kartu Keluarga
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="buku_nikah">Buku Nikah</label>
                                        <input type="file" class="form-control" style="background-color: white;" id="buku_nikah" name="buku_nikah" accept="image/*,.pdf">
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['buku_nikah'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/buku_nikah/<?php echo htmlspecialchars($profile['buku_nikah']); ?>">
                                                View Buku Nikah
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="akte">Akte Kelahiran <?php echo empty($profile['akte']) ? '<span class="text-danger">*</span>' : ''; ?></label>
                                        <input type="file" class="form-control" style="background-color: white;" id="akte" name="akte" accept="image/*,.pdf" <?php echo empty($profile['akte']) ? 'required' : ''; ?>>
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['akte'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/akte/<?php echo htmlspecialchars($profile['akte']); ?>">
                                                View Akte Kelahiran
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="ijazah">Ijazah Terakhir Min. SMA / Sederajat <?php echo empty($profile['ijazah']) ? '<span class="text-danger">*</span>' : ''; ?></label>
                                        <input type="file" class="form-control" style="background-color: white;" id="ijazah" name="ijazah" accept="image/*,.pdf" <?php echo empty($profile['ijazah']) ? 'required' : ''; ?>>
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['ijazah'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/ijazah/<?php echo htmlspecialchars($profile['ijazah']); ?>">
                                                View Ijazah
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="id_card">ID Card Karyawan</label>
                                        <input type="file" class="form-control" style="background-color: white;" id="id_card" name="id_card" accept="image/*,.pdf">
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['id_card'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/id_card/<?php echo htmlspecialchars($profile['id_card']); ?>">
                                                View ID Card Karyawan
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="surat_keterangan">Surat Pengangkatan / Surat Kontrak</label>
                                        <input type="file" class="form-control" style="background-color: white;" id="surat_keterangan" name="surat_keterangan" accept="image/*,.pdf">
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['surat_keterangan'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/surat_keterangan/<?php echo htmlspecialchars($profile['surat_keterangan']); ?>">
                                                View Kartu Keluarga
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="slip_gaji">Slip Gaji Terakhir</label>
                                        <input type="file" class="form-control" style="background-color: white;" id="slip_gaji" name="slip_gaji" accept="image/*,.pdf">
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['slip_gaji'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/slip_gaji/<?php echo htmlspecialchars($profile['slip_gaji']); ?>">
                                                View Kartu Keluarga
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="bpjs">BPJS Ketenagakerjaan</label>
                                        <input type="file" class="form-control" style="background-color: white;" id="bpjs" name="bpjs" accept="image/*,.pdf">
                                        <span>Format file : .pdf atau gambar (.jpg, .png, .jpeg, dll)</span>
                                        <br>
                                        <?php if (!empty($profile['bpjs'])): ?>
                                            <button type="button" class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="assets/uploads/bpjs/<?php echo htmlspecialchars($profile['bpjs']); ?>">
                                                View BPJS Ketenagakerjaan
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="********">
                                        <label for="new_password">Password Baru</label>
                                    </div>
                                    <span>*Kosongkan jika tidak ingin dirubah</span>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
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

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <center>
                    <div id="fileContent">
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="image" src="" alt="Image for cropping">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="cropButton">Crop</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewModal = document.getElementById('viewModal');
        const fileContent = document.getElementById('fileContent');

        viewModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const filePath = button.getAttribute('data-file');

            if (filePath.endsWith('.pdf')) {
                fileContent.innerHTML = `
                <iframe src="${filePath}" width="100%" height="500px" frameborder="0"></iframe>
            `;
            } else if (/\.(jpg|jpeg|png|gif)$/i.test(filePath)) {
                fileContent.innerHTML = `
                <img src="${filePath}" class="img-fluid" style="height: 500px;" alt="File Image">
            `;
            } else {
                fileContent.innerHTML = '<p>Unsupported file format</p>';
            }
        });
    });
</script>

<script>
    function autoResizeTextarea(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(function(textarea) {
            autoResizeTextarea(textarea);
            textarea.addEventListener('input', function() {
                autoResizeTextarea(textarea);
            });
        });
    });

    const address = document.querySelector('#address');
    address.addEventListener('input', function() {
        autoResizeTextarea(this);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photo_profile');
        const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
        const image = document.getElementById('image');
        let cropper;

        photoInput.addEventListener('change', function(event) {
            const files = event.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    cropModal.show();
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        });

        document.getElementById('cropButton').addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            });
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const croppedImage = new File([blob], photoInput.files[0].name, {
                    type: 'image/jpeg'
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedImage);
                photoInput.files = dataTransfer.files;
                cropModal.hide();
            }, 'image/jpeg');
        });
    });
</script>

<script>
    <?php if (isset($_SESSION['success_message'])): ?>
        toastr.success("<?php echo $_SESSION['success_message']; ?>");
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        toastr.error("<?php echo $_SESSION['error_message']; ?>");
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
</script>