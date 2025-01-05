<?php
session_start();
$registerError = isset($_SESSION['register_error']) ? $_SESSION['register_error'] : null;
unset($_SESSION['register_error']);

if (isset($_SESSION['user_role'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Diana Rent Car &mdash; Register</title>

    <meta name="description" content="" />

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href=".././assets/img/drc.jpeg">

    <!-- CSS -->
    <link rel="stylesheet" href=".././assets/fonts/inter/fonts.css">
    <link rel="stylesheet" href=".././assets/vendor/fonts/materialdesignicons.css">
    <link rel="stylesheet" href=".././assets/vendor/libs/node-waves/node-waves.css">
    <link rel="stylesheet" href=".././assets/vendor/css/core.css">
    <link rel="stylesheet" href=".././assets/vendor/css/theme-default.css">
    <link rel="stylesheet" href=".././assets/css/demo.css">
    <link rel="stylesheet" href=".././assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href=".././assets/vendor/css/pages/page-auth.css">

    <style>
        .spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script src=".././assets/vendor/js/helpers.js"></script>
    <script src=".././assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="login.php" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-heading fw-semibold"
                                style="color: #9055fd !important; font-size: 36px;">
                                <img src="../assets/img/drc.jpeg" alt="" class="img-fluid rounded-circle" style="border-radius: 50%;" width="120px">
                            </span>
                        </a>
                    </div>
                    <div class="card-body mt-2">
                        <h4 class="mb-5 text-center">Diana Rent Car</h4>
                        <?php if ($registerError): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($registerError); ?>
                            </div>
                        <?php endif; ?>
                        <form id="formAuthentication" class="mb-3" method="post"
                            action="../backend/auth/register.php">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama Lengkap" autofocus required onkeyup="formatFullName(this)" />
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="email@email.com"
                                    required
                                    oninput="validateEmail(this)" />
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <div id="emailError" class="text-danger" style="display: none;">Email tidak valid.</div>
                            </div>
                            <div class="form-floating form-floating-outline mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone_number"
                                    name="phone_number"
                                    placeholder="08xxxxxxxxxx"
                                    required
                                    oninput="validatePhoneNumber(this)" />
                                <label for="phone_number">No Handphone <span class="text-danger">*</span></label>
                                <div id="phoneError" class="text-danger" style="display: none;">Nomor handphone tidak valid.</div>
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control"
                                                name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password"
                                                required
                                                oninput="validatePassword(this)" />
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                        </div>
                                        <span class="input-group-text cursor-pointer" onclick="togglePasswordVisibility()">
                                            <i id="password-icon" class="mdi mdi-eye-off-outline"></i>
                                        </span>
                                    </div>
                                    <div id="passwordError" class="text-danger mt-1" style="display: none;">
                                        Password harus memiliki minimal 8 karakter, termasuk huruf besar, huruf kecil, dan angka.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" id="loginButton" type="submit">Daftar</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Sudah punya akun?</span>
                            <a href="login.php">
                                <span>Login</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
                <img src=".././assets/img/illustrations/tree-3.png" alt="auth-tree"
                    class="authentication-image-object-left d-none d-lg-block" />
                <img src=".././assets/img/illustrations/auth-basic-mask-light.png"
                    class="authentication-image d-none d-lg-block" alt="triangle-bg"
                    data-app-light-img="illustrations/auth-basic-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
                <img src=".././assets/img/illustrations/tree.png" alt="auth-tree"
                    class="authentication-image-object-right d-none d-lg-block" />
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src=".././assets/vendor/libs/jquery/jquery.js"></script>
    <script src=".././assets/vendor/libs/popper/popper.js"></script>
    <script src=".././assets/vendor/js/bootstrap.js"></script>
    <script src=".././assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src=".././assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src=".././assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src=".././assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src=".././assets/vendor/github/buttons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('formAuthentication');
            var loginButton = document.getElementById('loginButton');
            var spinner = '<i class="mdi mdi-loading spin"></i>';

            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    event.preventDefault();
                } else {
                    loginButton.setAttribute('disabled', 'true');
                    loginButton.innerHTML = spinner;
                }
            });

            form.addEventListener('input', function() {
                if (form.checkValidity()) {
                    loginButton.removeAttribute('disabled');
                }
            });
        });
    </script>

    <script>
        function formatFullName(element) {
            let words = element.value.toLowerCase().split(" ");
            for (let i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
            }
            element.value = words.join(" ");
        }
    </script>

    <script>
        function validateEmail(input) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const emailError = document.getElementById('emailError');

            if (input.value === '' || emailPattern.test(input.value)) {
                emailError.style.display = 'none'; // Email valid atau kosong
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                emailError.style.display = 'block'; // Email tidak valid
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        }
    </script>

    <script>
        function validatePhoneNumber(input) {
            // Regex untuk validasi nomor handphone Indonesia
            const phonePattern = /^08\d{8,11}$/;
            const phoneError = document.getElementById('phoneError');

            if (input.value === '' || phonePattern.test(input.value)) {
                phoneError.style.display = 'none'; // Nomor valid atau kosong
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                phoneError.style.display = 'block'; // Nomor tidak valid
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        }
    </script>

    <script>
        function validatePassword(input) {
            // Regex untuk validasi password
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            const passwordError = document.getElementById('passwordError');

            if (passwordPattern.test(input.value)) {
                passwordError.style.display = 'none'; // Password valid
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                passwordError.style.display = 'block'; // Password tidak valid
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('mdi-eye-off-outline');
                passwordIcon.classList.add('mdi-eye-outline');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('mdi-eye-outline');
                passwordIcon.classList.add('mdi-eye-off-outline');
            }
        }
    </script>
</body>

</html>