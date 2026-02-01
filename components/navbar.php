<?php
include('./model/db.php');
$page = basename($_SERVER['SCRIPT_NAME']);
?>

<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-danger" href="index.php">
                E-Commerce
            </a>

            <!-- Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link px-3 <?= $page == 'index.php' ? 'active fw-bold text-danger' : '' ?>" href="index.php">
                            Home
                        </a>
                    </li>

                    <!-- Category -->
                    <li class="nav-item">
                        <a class="nav-link px-3 <?= $page == 'category.php' ? 'active fw-bold text-danger' : '' ?>" href="category.php">
                            Category
                        </a>
                    </li>

                    <?php if (isset($_SESSION['auth'])) { 
                        $uid = $_SESSION['auth-user']['uerID'];
                        global $conn;

                        $query = "SELECT c.id 
                                  FROM carts c 
                                  WHERE c.user_id ='$uid'";
                        $cart_count = mysqli_num_rows(mysqli_query($conn, $query));
                    ?>

                    <!-- Cart -->
                    <li class="nav-item position-relative">
                        <a class="nav-link px-3 <?= $page == 'cart.php' ? 'text-danger fw-bold' : '' ?>" href="cart.php">
                            <i class="bi bi-cart3 fs-5"></i>

                            <?php if ($cart_count > 0) { ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= $cart_count ?>
                                </span>
                            <?php } ?>
                        </a>
                    </li>

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5"></i>
                            <?= $_SESSION['auth-user']['name'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="signout.php">Sign Out</a></li>
                        </ul>
                    </li>

                    <?php } else { ?>

                    <!-- Guest -->
                    <li class="nav-item my-3 ms-3  my-lg-0 ms-lg-3">
                        <a class="btn btn-outline-danger px-3 me-2" href="login.php">Sign In</a>
                    </li>
                    <li class="nav-item ms-3 ms-lg-3">
                        <a class="btn btn-danger px-3" href="register.php">Register</a>
                    </li>

                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</header>
