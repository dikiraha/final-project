<?php
require_once '../classes/User.php';

$getUser = new User();
$uuid = $_GET['uuid'];
$user = $getUser->edit($uuid);
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit User</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=user_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <form action="../backend/user/update.php" method="POST">
                        <input type="hidden" name="uuid" value="<?php echo htmlspecialchars($user['uuid']); ?>">

                        <div class="form-floating form-floating-outline mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Nama Lengkap"
                                value="<?php echo htmlspecialchars($user['name']); ?>"
                                onkeyup="formatFullName(this)"
                                required />
                            <label for="name">Name <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="email@mail.com"
                                value="<?php echo htmlspecialchars($user['email']); ?>"
                                required />
                            <label for="email">Email <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input
                                type="text"
                                id="phone_number"
                                name="phone_number"
                                class="form-control phone-mask"
                                placeholder="081234567890"
                                value="<?php echo htmlspecialchars($user['phone_number']); ?>"
                                required />
                            <label for="phone_number">No. Handphone <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="role" name="role" aria-label="Role" required>
                                <option value="" disabled>-- Pilih --</option>
                                <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="driver" <?php echo ($user['role'] === 'driver') ? 'selected' : ''; ?>>Driver</option>
                                <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                            </select>
                            <label for="role">Role <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="**********" />
                            <label for="password">Password (Kosongkan jika tidak ingin diubah)</label>
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
</script>