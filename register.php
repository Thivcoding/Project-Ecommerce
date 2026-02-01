<?php
session_start();
include("./components/header.php")
?>

<style>
    body {
        background-color: #f5f6fa;
    }

    .register {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bag-card {
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-radius: 15px;
    }

    .form-control {
        transition: all .3s ease;
    }

    .form-control:focus {
        box-shadow: none;
        border-bottom: 2px solid #0d6efd !important;
        background-color: transparent;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: .8;
    }

    .btn-outline-primary {
        transition: all .3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: #fff;
        transform: translateY(-2px);
    }

    .card-header h4 {
        font-weight: 600;
    }
</style>

<main class="register">
    <div class="container col-12 col-md-8 col-lg-5 py-5">

        <?php if (isset($_SESSION['msg'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Dear User!</strong> <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php }
        unset($_SESSION['msg']);
        ?>

        <div class="bag-card card overflow-hidden shadow-sm">
            <div class="card-header text-center pt-5 bg-white border-0">
                <h4>Registration Form</h4>
            </div>

            <div class="card-body pb-5">
                <form method="get" action="./controller/authController.php" class="px-5">

                    <div class="mb-4">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="userName"
                            placeholder="Full Name"
                            class="form-control bg-transparent shadow-none border-0 border-bottom border-primary rounded-0">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phoneNumber"
                            placeholder="Phone Number"
                            class="form-control bg-transparent shadow-none border-0 border-bottom border-primary rounded-0">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email"
                            placeholder="Email Address"
                            class="form-control bg-transparent shadow-none border-0 border-bottom border-primary rounded-0">
                        <div class="form-text">
                            We'll never share your email with anyone else.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                            placeholder="Password"
                            class="form-control bg-transparent shadow-none border-0 border-bottom border-primary rounded-0">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="conpassword"
                            placeholder="Confirm Password"
                            class="form-control bg-transparent shadow-none border-0 border-bottom border-primary rounded-0">
                    </div>

                    <button type="submit" name="subBtn"
                        class="btn btn-outline-primary float-end px-4">
                        Sign Up
                    </button>

                </form>
            </div>
        </div>
    </div>
</main>

<?php include("./components/footer.php") ?>
