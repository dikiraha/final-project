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
                    <h5 class="mb-0">Edit Setting</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=setting_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <form action="../backend/setting/update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($setting['id']); ?>">

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner" value="<?php echo htmlspecialchars($setting['owner']); ?>" onkeyup="formatFullName(this)" required />
                            <label for="owner">Owner <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" placeholder="Photo Owner" />
                            <label for="photo">Photo Owner</label>
                            <small class="form-text text-muted">Leave blank if you don't want to change the photo.</small>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank" value="<?php echo htmlspecialchars($setting['bank']); ?>" required />
                            <label for="bank">Nama Bank <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo htmlspecialchars($setting['account_number']); ?>" required />
                            <label for="account_number">Nomor Rekening <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Number" value="<?php echo htmlspecialchars($setting['account_name']); ?>" required />
                            <label for="account_name">Nama Rekening <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="address" name="address" placeholder="Address" required><?php echo htmlspecialchars($setting['address']); ?></textarea>
                            <label for="address">Alamat <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@mail.com" value="<?php echo htmlspecialchars($setting['email']); ?>" required />
                            <label for="email">Email <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="phone_number_1" name="phone_number_1" placeholder="Phone Number 1" value="<?php echo htmlspecialchars($setting['phone_number_1']); ?>" required />
                            <label for="phone_number_1">Nomor Handphone 1 <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="phone_number_2" name="phone_number_2" placeholder="Phone Number 2" value="<?php echo htmlspecialchars($setting['phone_number_2'] ?? ''); ?>" />
                            <label for="phone_number_2">Nomor Handphone 2</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="agreement_1" name="agreement_1" placeholder="Syarat Lepas Kunci" required><?php echo htmlspecialchars($setting['agreement_1']); ?></textarea>
                            <label for="agreement_1">Syarat Lepas Kunci <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="agreement_2" name="agreement_2" placeholder="Poin Ketentuan" required><?php echo htmlspecialchars($setting['agreement_2']); ?></textarea>
                            <label for="agreement_2">Poin Ketentuan <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="visi" name="visi" placeholder="Visi" required><?php echo htmlspecialchars($setting['visi']); ?></textarea>
                            <label for="visi">Visi <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="misi" name="misi" placeholder="Misi" required><?php echo htmlspecialchars($setting['misi']); ?></textarea>
                            <label for="misi">Misi <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="about_company" name="about_company" placeholder="About Company" required><?php echo htmlspecialchars($setting['about_company']); ?></textarea>
                            <label for="about_company">About Company <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="history_company" name="history_company" placeholder="History Company" required><?php echo htmlspecialchars($setting['history_company']); ?></textarea>
                            <label for="history_company">History Company <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="about_footer" name="about_footer" placeholder="About Footer" required><?php echo htmlspecialchars($setting['about_footer']); ?></textarea>
                            <label for="about_footer">About Footer <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Link Facebook" value="<?php echo htmlspecialchars($setting['facebook'] ?? ''); ?>" />
                            <label for="facebook">Link Facebook</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Link Instagram" value="<?php echo htmlspecialchars($setting['instagram'] ?? ''); ?>" />
                            <label for="instagram">Link Instagram</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Link Twitter" value="<?php echo htmlspecialchars($setting['twitter'] ?? ''); ?>" />
                            <label for="twitter">Link Twitter</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="Link Tiktok" value="<?php echo htmlspecialchars($setting['tiktok'] ?? ''); ?>" />
                            <label for="tiktok">Link Tiktok</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function formatFullName(element) {
        let words = element.value.toLowerCase().split(" ");
        for (let i = 0; i < words.length; i++) {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
        }
        element.value = words.join(" ");
    }

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

    const agreement_2 = document.querySelector('#agreement_2');
    agreement_2.addEventListener('input', function() {
        autoResizeTextarea(this);
    });

    const visi = document.querySelector('#visi');
    visi.addEventListener('input', function() {
        autoResizeTextarea(this);
    });

    const misi = document.querySelector('#misi');
    misi.addEventListener('input', function() {
        autoResizeTextarea(this);
    });

    const about_company = document.querySelector('#about_company');
    about_company.addEventListener('input', function() {
        autoResizeTextarea(this);
    });

    const history_company = document.querySelector('#history_company');
    history_company.addEventListener('input', function() {
        autoResizeTextarea(this);
    });

    const about_footer = document.querySelector('#about_footer');
    about_footer.addEventListener('input', function() {
        autoResizeTextarea(this);
    });
</script>