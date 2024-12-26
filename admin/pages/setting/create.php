<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Setting</h5>
                    <small class="text-body float-end">
                        <a href="./index.php?views=setting_list" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                    </small>
                </div>
                <div class="card-body">
                    <form action="../backend/setting/store.php" method="POST">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner" onkeyup="formatFullName(this)" required />
                            <label for="owner">Owner <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank" required />
                            <label for="bank">Nama Bank <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" required />
                            <label for="account_number">Nomor Rekening <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="address" name="address" placeholder="Address" required></textarea>
                            <label for="address">Alamat <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@mail.com" required />
                            <label for="email">Email <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="phone_number_1" name="phone_number_1" placeholder="Phone Number 1" required />
                            <label for="phone_number_1">Nomor Handphone 1 <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="phone_number_2" name="phone_number_2" placeholder="Phone Number 2" />
                            <label for="phone_number_2">Nomor Handphone 2</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="agreement_1" name="agreement_1" placeholder="About Company" required></textarea>
                            <label for="agreement_1">Syarat Lepas Kunci <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="agreement_2" name="agreement_2" placeholder="About Company" required></textarea>
                            <label for="agreement_2">Poin Ketentuan <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="visi" name="visi" placeholder="Vision" required></textarea>
                            <label for="visi">Visi <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="misi" name="misi" placeholder="Mission" required></textarea>
                            <label for="misi">Misi <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="about_company" name="about_company" placeholder="About Company" required></textarea>
                            <label for="about_company">About Company <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="history_company" name="history_company" placeholder="About Company" required></textarea>
                            <label for="history_company">History Company <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <textarea class="form-control" id="about_footer" name="about_footer" placeholder="About Company" required></textarea>
                            <label for="about_footer">About Footer <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Account Number" />
                            <label for="facebook">Link Facebook</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Account Number" />
                            <label for="instagram">Link Instagram</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Account Number" />
                            <label for="twitter">Link Twitter</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="Account Number" />
                            <label for="tiktok">Link Tiktok</label>
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

    const address = document.querySelector('#address');
    address.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    const detail = document.querySelector('#detail');
    detail.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>

<!-- <script src="https://cdn.tiny.cloud/1/sz1oi6o8pq1cfgze3fc0htsn882dirr9kgsabr33bapngybz/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            "See docs to implement AI Assistant")),
    });
</script> -->