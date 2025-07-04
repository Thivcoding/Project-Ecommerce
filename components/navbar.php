<?php
include('./model/db.php');
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
?>
<header class="container-fluid sticky-top top-0 p-0">
    <nav class="navbar navbar-expand-lg bg-light " style="box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <a class="navbar-brand text-dark" href="index.php">E-Comerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link  mx-4  <?= $page == 'index.php' ? "active border-bottom text-danger border-2  fw-bold" : "" ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  mx-4  <?= $page == 'category.php' ? "active border-bottom text-danger border-2  fw-bold" : "" ?>" href="category.php">Category</a>
                    </li>
                    <?php if (isset($_SESSION['auth'])) {
                        $uid = $_SESSION['auth-user']['uerID'];
                        global $conn;
                        $query = "SELECT c.id as cid 
                            , p.id as pid 
                            , p.selling_price as price
                            , c.pro_qty as pqty
                            , p.name as pname
                            , p.image as pimage
                            FROM carts c , products p WHERE c.user_id ='$uid' AND c.pro_id = p.id ORDER BY c.id DESC";
                        $query_run = mysqli_query($conn, $query);
                        $cart_count = mysqli_num_rows($query_run);
                    ?>
                        <li class="nav-item">
                            <a class="nav-link  position-relative mx-4  <?= $page == 'cart.php' ? "active border-bottom text-danger border-2  fw-bold" : "" ?>" href="cart.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                </svg>
                                <?php if ($cart_count > 0) { ?>
                                    <div class="position-absolute bg-danger rounded-circle d-flex justify-content-center align-items-center"
                                        style="top: 4px; right: 0; width: 15px; height: 15px; font-size: 10px; color: white;">
                                        <?= $cart_count ?>
                                    </div>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  mx-4 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['auth-user']['name'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="login.php">Sign In</a></li>
                                <li><a class="dropdown-item" href="signout.php">Sign Out</a></li>
                                <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a class="nav-link text-dark mx-4" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark mx-4" href="login.php">Sign In</a>
                        </li>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>