<?php
require_once '../classes/Setting.php';

$getSetting = new Setting();

$settings = $getSetting->list();

// if (!empty($settings)) {
//     include "./pages/setting/list.php";
// }
?>
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
                    <form action="../backend/setting/store.php" method="POST" enctype="multipart/form-data">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner" onkeyup="formatFullName(this)" required />
                            <label for="owner">Owner <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" placeholder="Photo Owner" required />
                            <label for="photo">Photo Owner <span class="text-danger">*</span></label>
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
                            <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Number" required />
                            <label for="account_name">Nama Rekening <span class="text-danger">*</span></label>
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

                        <div class="form-group mb-3">
                            <label for="agreement_1"><b>Syarat Lepas Kunci</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="agreement_1" name="agreement_1" placeholder="Syarat Lepas Kunci"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="agreement_2"><b>Poin Ketentuan</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="agreement_2" name="agreement_2" placeholder="Poin Ketentuan"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="visi"><b>Visi</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="visi" name="visi" placeholder="Visi"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="misi"><b>Misi</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="misi" name="misi" placeholder="Misi"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="about_company"><b>About Company</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="about_company" name="about_company" placeholder="About Company"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="history_company"><b>History Company</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="history_company" name="history_company" placeholder="History Company"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="about_footer"><b>About Footer</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="about_footer" name="about_footer" placeholder="About Footer"></textarea>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Link Facebook" />
                            <label for="facebook">Link Facebook</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Link Instagram" />
                            <label for="instagram">Link Instagram</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Link Twitter" />
                            <label for="twitter">Link Twitter</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="Link Tiktok" />
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

<!-- Include TinyMCE script -->
<script src="https://cdn.tiny.cloud/1/sz1oi6o8pq1cfgze3fc0htsn882dirr9kgsabr33bapngybz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Initialize TinyMCE -->
<script>
    tinymce.init({
        selector: '#agreement_1, #agreement_2, #visi, #misi, #about_company, #history_company, #about_footer',
        menubar: true,
        plugins: 'lists link image preview',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview'
    });
</script>

<script>
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('about_footer').style.display = 'block';
    });
</script>