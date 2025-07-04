<?php
session_start();
include("./components/header.php") ?>
<style>
    .register {
        background-image: url("https://i.makeagif.com/media/5-13-2023/0UjUAN.gif");
        background-size: cover;
        background-repeat: no-repeat;
    }
    .bag-card{
        box-shadow: 0px 0px 7px white;
        border-radius: 10px;
        backdrop-filter: blur(5px);
    }
    .form-control::placeholder {
        color: white;
        opacity: .8;
    }
</style>
<main class="register" style="height: 100vh;">
    <div class="container col-5 pt-4 "> 
        <?php
        if (isset($_SESSION['msg'])) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Dear User!</strong> <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
        unset($_SESSION['msg']);
        ?>
        <div class="bag-card card  text-white bg-transparent ">
            <div class="card-header border-2 border-white text-center py-3">
                <h4>Registration Form</h4>
            </div>
            <div class="card-body py-3">
                <form method="get" action="./controller/authController.php" class="px-5">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Full Name</label>
                        <div class="container px-4">
                            <input placeholder="Full Name" type="text" name="userName" class="form-control text-white bg-transparent shadow-none border-light border-0 border-bottom rounded-0" id="userName">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <div class="container px-4">
                            <input placeholder="Phone Number" type="text" name="phoneNumber" class="form-control text-white bg-transparent shadow-none border-light border-0 border-bottom rounded-0" id="phoneNumber">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <div class="container px-4"><input type="email" name="email" placeholder="Email Address" class="form-control text-white bg-transparent shadow-none border-light border-0 border-bottom rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text text-white">We'll never share your email with anyone else.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="container px-4">
                            <input placeholder="Password" type="password" name="password" class="form-control text-white bg-transparent shadow-none border-light border-0 border-bottom rounded-0" id="exampleInputPassword1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword" class="form-label">Confirm-Password</label>
                        <div class="container px-4">
                            <input placeholder="Confirm Password" type="password" name="conpassword" class="form-control text-white bg-transparent shadow-none border-light border-0 border-bottom rounded-0" id="exampleInputPassword">
                        </div>
                    </div>
                    <button type="submit" name="subBtn" class="btn float-end btn-outline-primary ">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include("./components/footer.php") ?>