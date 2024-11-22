<?php
$home = false;
$about = false;
$contact = false;

if (isset($_GET['views'])) {
    $views = $_GET['views'];
    switch ($views) {
        case 'home':
            $home = true;
            break;
        case 'about':
            $about = true;
            break;
        case 'contact':
            $contact = true;
            break;
        default:
            $home = false;
            $about = false;
            $contact = false;
    }
} else {
    $home = false;
    $about = false;
    $contact = false;
}
?>

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="" class="navbar-brand p-0">
                <h1 class="display-6 text-primary"><i class="fas fa-car-alt me-3"></i></i>DRC</h1>
                <!-- <img src="assets/img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="?views=home" class="nav-item nav-link <?= $home ? 'active' : '' ?>">Home</a>
                    <a href="?views=about" class="nav-item nav-link <?= $about ? 'active' : '' ?>">About</a>
                    <!-- <a href="service.html" class="nav-item nav-link">Service</a>
                    <a href="blog.html" class="nav-item nav-link">Blog</a> -->

                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="feature.html" class="dropdown-item">Our Feature</a>
                            <a href="cars.html" class="dropdown-item">Our Cars</a>
                            <a href="team.html" class="dropdown-item">Our Team</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div> -->
                    <a href="?views=contact" class="nav-item nav-link <?= $contact ? 'active' : '' ?>">Contact</a>
                </div>
                <a href="#" class="btn btn-primary rounded-pill py-2 px-4">LOGIN</a>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar & Hero End -->