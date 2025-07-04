<?php
include('./components/header.php');
include('./model/db.php');
include('./func/getProduct.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('./func/authenticate.php');
?>
<div class="container py-5">
    <?php
    if (isset($_SESSION['msg'])) {
    ?>
        <div class="alert <?= $_SESSION['msgType'] ?> alert-dismissible fade show" role="alert">
            <strong>Dear <?= $_SESSION['auth-user']['name'] ?>!</strong> <?= $_SESSION['msg']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    unset($_SESSION['msg']);
    unset($_SESSION['msgType']);
    ?>
    <div class="row">
        <div class="col-12 text-secondary d-flex justify-content-start">
            <a class="text-decoration-none text-secondary" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi text-secondary mb-1 bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg> &gt </a>
            <a class="text-decoration-none text-secondary mx-1" href="cart.php">Cart &gt</a>
            <a class="text-decoration-none text-secondary mx-1" href="checkout.php">Check Out</a>
        </div>
        <div class="col-md-12 mb-3">
            <h1>Check Out</h1>
            <hr>
        </div>
        <?php
        $cartItem = getItemCarts();
        $p = mysqli_fetch_array($cartItem);
        if ($p) {
            $pro_id = $p['pid'];
        } else {
            $pro_id = null;
        }
        $query_stock = "SELECT qty FROM products WHERE id='$pro_id'";
        $query_stock_run = mysqli_query($conn, $query_stock);
        $qty = mysqli_fetch_assoc($query_stock_run);
        $total = 0;
        if (mysqli_num_rows($cartItem) > 0) {
            foreach ($cartItem as $item) {
                $price = isset($item['price']) ? (float) preg_replace('/[^0-9.]/', '', $item['price']) : 0;
                $qty = isset($item['pqty']) ? (int) $item['pqty'] : 0;

                $total += $price * $qty;
            }
        ?>
            <form action="controller/orderController.php" method="post">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-7">
                            <div class="card-header">
                                <h5>Client Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold"> Full Name</label>
                                        <input class="form-control" type="text" name="fullname" placeholder="Your Full Name Here">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold"> E-Mail</label>
                                        <input class="form-control" type="email" name="email" placeholder="Your Email Here">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold"> Phone Number</label>
                                        <input class="form-control" type="text" name="phone" placeholder="Your Phone Number">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold"> Zip Code</label>
                                        <input type="hidden" name="total" value="<?= $total ?>">
                                        <input class="form-control" type="text" name="zip" placeholder="Your Zip Code Here">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold"> Address</label>
                                        <textarea name="address" class="form-control" rows="7" placeholder="Your Address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="card-header">
                                <h5>Orders Information</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                foreach ($cartItem as $item) {
                                ?>
                                    <div class="row  my-2 border py-2 rounded-3">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center">
                                            <img style="height: 10vh; width: 75%; object-fit: cover;" src="./uploads/<?= $item['pimage'] ?>" class="rounded-3" alt="">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <p style="font-size: 12px;" class="text-center"><?= $item['pname'] ?></p>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center justify-content-center">
                                            <h6><?= $item['price'] ?><sup>$</sup></h6>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                                            <h5>x <?= $item['pqty'] ?></h5>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-footer d-flex justify-content-end gap-2 align-items-center">
                                <h5><u>Total Payment: </u></h5>
                                <h5 class="fw-bold text-danger"><?= $total ?> <sup>$</sup></h5>
                            </div>
                            <div class="col-12">
                                <button onclick="ShowDelivery()" class="btn btn-outline-primary w-100 my-3 fw-bold d-flex justify-content-center align-items-center gap-1" name="orderBtn" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                    </svg>
                                    Confirm The Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php
        } else { ?>
            <div class="container text-center text-secondary">
                <p>No Product Order Yet.</p>
            </div>
        <?php
        }
        ?>
    </div>  
</div>
<script>
    function ShowDelivery() {
    Swal.fire({
        title: "Thank you!",
        text: "Your order has been placed.",
        icon: "success",
        timer: 2000,
        showConfirmButton: false
    });
}
</script>
<?php include('./components/footer.php'); ?>