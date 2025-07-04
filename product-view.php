<?php
session_start();
include('./components/header.php');
include('./model/db.php');
include('./func/getProduct.php');
$cate_slug = $_GET['cate-slug'];
$category_data = getBySlugActive('categories', $cate_slug);
$category = mysqli_fetch_array($category_data);
$pro_slug = $_GET['pro-slug'];
$pro_data = getBySlugActive('products', $pro_slug);
$pro = mysqli_fetch_array($pro_data);
?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-secondary d-flex justify-content-start">
            <a class="text-decoration-none text-secondary" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi text-secondary mb-1 bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg> &gt </a>

            <a class="text-decoration-none text-secondary mx-1" href="category.php">Categories &gt</a>

            <a class="text-decoration-none text-secondary mx-1" href="product.php?category=<?= $category['slug'] ?>"><?= $category['name'] ?>&gt</a>
            <a class="text-decoration-none text-secondary mx-1" href="product-view.php?cate-slug=<?= $category['slug'] ?>&pro-slug=<?= $pro['slug'] ?>"><?= $pro['name'] ?></a>

        </div>
        <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
            <h1><?= $pro['name'] ?></h1>
            <?php if ($pro['trending'] == '1') { ?>
                <h6 style="clip-path: polygon(12% 0, 100% 0%, 88% 100%, 0% 100%);" class="py-2 px-4 bg-danger fw-bold text-light">Trending</h6>
            <?php } ?>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img class="w-100" style="object-fit: cover;" src="./uploads/<?= $pro['image'] ?>" alt="">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <h4><?= $pro['meta_title'] ?></h4>
                    <p>
                        <?= $pro['description'] ?>
                    </p>
                </div>
                <div class="col-3">
                    <span class="py-1 px-4 border border-dark border-1">
                        Instock:
                        <b>
                            <?= $pro['qty'] ?>
                        </b>
                    </span>
                    <br><br>
                    <span class="py-1 fw-bold  px-4 text-danger border border-danger border-1">
                        OPrice <del><?= $pro["original_price"] ?>$</del>
                    </span>
                </div>
                <?php
                // បំលែងតម្លៃទៅជា ចំនួន (float) និងលុបអក្សរដែលមិនមែនជាចំនួន
                $original = isset($pro['original_price']) ? (float) preg_replace('/[^0-9.]/', '', $pro['original_price']) : 0;
                $selling = isset($pro['selling_price']) ? (float) preg_replace('/[^0-9.]/', '', $pro['selling_price']) : 0;

                if ($original > 0 && $original > $selling) {
                    $dis = 100 - ($selling * 100 / $original);
                ?>
                    <?php  ?>
                    <div class="col-3">
                        <span class="py-1 fw-bold  px-4 text-danger border border-danger border-1">
                            <?= round($dis, 2); ?>% Off
                        </span><br><br>
                        <span class="py-1 fw-bold  px-4 text-danger border border-danger border-1">
                            SPrice <?= $pro["selling_price"] ?>$
                        </span>
                    </div>
                    <div class="col-6">
                        <select name="order_qty" class="form-select">
                            <?php
                            for ($i = 1; $i <= $pro['qty']; $i++) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?>pcs</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                <?php
                } else { ?>
                    <div class="col-3"></div>
                    <div class="col-6">
                        <select class="form-select order_qty">
                            <?php
                            for ($i = 1; $i <= $pro['qty']; $i++) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?>pcs</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                <?php
                } ?>
                <div class="col-6 my-3 mt-4">
                    <button type="button" value="<?= $pro['id'] ?>" class="btn btn-outline-dark w-100 btn_add_cart">Add To Cart</button>
                </div>
                <div class="col-6 my-3 mt-4">
                    <button type="button" class="btn btn-outline-danger w-100 ">Add To Favorites</button>
                </div>
                <hr>
                <div class="col-12">
                    <p><?= $pro['meta_description'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./assets/js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        let add_cart = $('.btn_add_cart');
        add_cart.click(function() {
            let pro_id = $(this).val();
            let pro_qty = $('.form-select').val();

            $.ajax({
                method: "POST",
                url: "controller/requestProduct.php",
                data: {
                    'pro_id': pro_id,
                    'pro_qty': pro_qty,
                    'scope': 'add-cart-btn'
                },
                success: function(response) {
                    if (response == '101') {
                        Swal.fire({
                            icon: "warning",
                            title: "Non-User",
                            text: "Login to continue",
                            footer: '<a class="nav-link fs-5 fw-bold"  href="./login.php">Log In</a>'
                        });
                    } else if (response == '168') {
                        Swal.fire({
                            icon: "success",
                            title: "Product Added To Cart",
                        }).then(() => {
                            window.location.reload();
                        })
                    } else if (response == '102') {
                        Swal.fire({
                            icon: "warning",
                            title: "Already Added",
                            text: "If you want to buy more , go to update qty.",
                        });
                    }
                }
            });
        })
    })
</script>
<?php include('./components/footer.php'); ?>