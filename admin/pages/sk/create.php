<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Syarat & Ketentuan</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=sk_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <form action="../backend/sk/store.php" method="POST">
                        <div class="form-floating form-floating-outline mb-3">
                            <select class="form-select" id="context" name="context" aria-label="Role">
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="before">Before</option>
                                <option value="after">After</option>
                            </select>
                            <label for="context">Role</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <textarea name="content" id="content" class="form-control"></textarea>
                            <label for="content">Content</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>