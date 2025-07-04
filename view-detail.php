<?php include('./components/header.php');
include('./model/db.php');
include('./func/getProduct.php');
?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-secondary d-flex justify-content-start">
            <a class="text-decoration-none text-secondary" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi text-secondary mb-1 bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg> &gt </a>
            <a class="text-decoration-none text-secondary mx-1" href="myorder.php">Order</a>
        </div>
        <div class="col-md-12 mb-3">
            <h1>My Orders</h1>
            <hr>
        </div>
        <?php
        if (isset($_SESSION['msg'])) {
        ?>
            <div class="alert <?= $_SESSION['msgType'] ?> alert-dismissible fade show" role="alert">
                <strong>Dear <?= $_SESSION['auth-user']['name'] ?>!</strong> <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
        unset($_SESSION['msg']);
        unset($_SESSION['msgType']);
        $orders = getOrder();
        if (mysqli_num_rows($orders)) {
            ?> 
            <div class="col-12">
                <table id="tbl" class="table table-hover table-striped text-center align-middle">
            <thead>
                <tr>
                <th>ID</th>
                <th>Tracking No.</th>
                <th>User Name</th>
                <th>Total</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($orders as $item) {
                ?> 
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><span class="fw-bold">#<?= $item['tracking_no'] ?></span></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['total_price']?> $</td>
                        <td><a class="btn btn-primary" href="view-detail.php">Details</a></td>
                    </tr>
                <?php
            }
            ?> 
                </tbody>
            </table>
            </div>
            <?php
        } else { ?>
            <div class="col-12 ">
                <p class="text-secondary text-center">No Item Order Yet.</p>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include('./components/footer.php') ?>
    <script>
        $(function() {
            $('#tbl').DataTable();
        })
    </script>