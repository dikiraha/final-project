<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create User</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=user_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <form action="../backend/user/store.php" method="POST">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" onkeyup="formatFullName(this)" />
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@mail.com" />
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input
                                type="text"
                                id="phone_number"
                                name="phone_number"
                                class="form-control phone-mask"
                                placeholder="081234567890" />
                            <label for="phone_number">No. Handphone</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="role" name="role" aria-label="Role">
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="admin">Admin</option>
                                <option value="driver">Driver</option>
                                <option value="user">User</option>
                            </select>
                            <label for="role">Role</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="**********" />
                            <label for="password">Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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