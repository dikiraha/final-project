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
    $home = true;
    $about = false;
    $contact = false;
}
?>

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="index.php" class="navbar-brand p-0">
                <h1 class="display-6 text-primary"><i class="fas fa-car-alt me-3"></i>DRC</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="?views=home" class="nav-item nav-link <?= $home ? 'active' : '' ?>">Home</a>
                    <a href="?views=about" class="nav-item nav-link <?= $about ? 'active' : '' ?>">About</a>
                    <a href="?views=contact" class="nav-item nav-link <?= $contact ? 'active' : '' ?>">Contact</a>
                </div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle rounded-pill py-2 px-4" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                <li>
                                    <a class="dropdown-item text-danger" href="admin/index.php">Admin Page</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item text-danger" href="?views=booking">Pesanan Saya</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="?views=edit_profile">Edit Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="backend/auth/logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="auth/login.php" class="btn btn-primary rounded-pill py-2 px-4">LOGIN</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar & Hero End -->