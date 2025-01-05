<?php
require_once '../classes/Setting.php';

$getSetting = new Setting();

if (!isset($_GET['uuid'])) {
    header('Location: ?views=setting_list');
    exit();
}

$uuid = $_GET['uuid'];
$setting = $getSetting->edit($uuid);

if (!$setting) {
    header('Location: ?views=setting_list');
    exit();
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Setting</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=setting_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="owner" class="form-label">Owner</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['owner']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo Owner</label>
                        <?php if (!empty($setting['photo'])): ?>
                            <p class="form-control-plaintext">
                                <img src="./../assets/uploads/owner/<?php echo htmlspecialchars($setting['photo']); ?>" alt="Owner Photo" width="100">
                            </p>
                        <?php else: ?>
                            <p class="form-control-plaintext">No photo available</p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="bank" class="form-label">Nama Bank</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['bank']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Nomor Rekening</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['account_number']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="account_name" class="form-label">Nama Rekening</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['account_name']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['address']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['email']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number_1" class="form-label">Nomor Handphone 1</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['phone_number_1']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number_2" class="form-label">Nomor Handphone 2</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['phone_number_2'] ?? ''); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="agreement_1" class="form-label">Syarat Lepas Kunci</label>
                        <div class="form-control-plaintext"><?php echo htmlspecialchars_decode($setting['agreement_1']); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="agreement_2" class="form-label">Poin Ketentuan</label>
                        <div class="form-control-plaintext"><?php echo htmlspecialchars_decode($setting['agreement_2']); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="visi" class="form-label">Visi</label>
                        <div class="form-control-plaintext"><?php echo htmlspecialchars_decode($setting['visi']); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="misi" class="form-label">Misi</label>
                        <div class="form-control-plaintext"><?php echo htmlspecialchars_decode($setting['misi']); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="about_company" class="form-label">About Company</label>
                        <div class="form-control-plaintext"><?php echo htmlspecialchars_decode($setting['about_company']); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="history_company" class="form-label">History Company</label>
                        <div class="form-control-plaintext"><?php echo htmlspecialchars_decode($setting['history_company']); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="about_footer" class="form-label">About Footer</label>
                        <div class="form-control-plaintext"><?php echo htmlspecialchars_decode($setting['about_footer']); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="facebook" class="form-label">Link Facebook</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['facebook'] ?? ''); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="instagram" class="form-label">Link Instagram</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['instagram'] ?? ''); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="twitter" class="form-label">Link Twitter</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['twitter'] ?? ''); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="tiktok" class="form-label">Link Tiktok</label>
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($setting['tiktok'] ?? ''); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>