<?php include('./components/header.php');
include('./func/getProduct.php');
?>
<?php
if (isset($_SESSION['msg'])) {
?>
    <div class="alert <?= $_SESSION['msgType'] ?> alert-dismissible fade show" role="alert">
        <strong>
            Dear
            <?= isset($_SESSION['auth-user']['name']) ? htmlspecialchars($_SESSION['auth-user']['name']) : 'Guest'; ?>!
        </strong>
        <?= isset($_SESSION['msg']) ? htmlspecialchars($_SESSION['msg']) : ''; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php }
unset($_SESSION['msg']);
unset($_SESSION['msgType']);
?>
<section class="hero-section bg-light ">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false" >
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="./uploads/benner-compoter.jpg" class="img-fluid w-100" style="height: 650px;" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./uploads/benner-iphonedevice.jpg" style="height: 650px; object-fit: cover;" class="d-block w-100 img-fluid  " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./uploads/benner-Headphones.jpg" style="height: 650px; " class="d-block w-100 img-fluid " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <?php $categories_home = getCategory(); ?>

    <div class="container">
        <h2 class="text-center mb-5">Our Categories</h2>

        <?php if ($categories_home && mysqli_num_rows($categories_home) > 0): ?>
            <div class="horizontal-scroll-wrapper mb-4">
                <div class="d-flex flex-nowrap gap-4 px-2">
                    <?php while ($item = mysqli_fetch_assoc($categories_home)): ?>
                        <div class="flex-shrink-0" style="width: 250px;">
                            <div class="card border-0 shadow-lg h-100 d-flex flex-column text-center">
                                <img src="./uploads/<?= ($item['image'] ?? 'https://via.placeholder.com/300x200?text=' . urlencode($item['name'])) ?>"
                                    class="card-img-top"
                                    alt="<?= $item['name'] ?>"
                                    style="height: 200px; object-fit: contain;">
                                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                                    <h5 class="card-title"><?= $item['name'] ?></h5>
                                    <a href="./category.php" class="btn btn-sm btn-outline-primary mt-3">View More</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No categories found.</div>
        <?php endif; ?>
    </div>
</section>

<style>
    .horizontal-scroll-wrapper {
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: x mandatory;
        padding-bottom: 10px;
    }

    .horizontal-scroll-wrapper::-webkit-scrollbar {
        height: 8px;
    }

    .horizontal-scroll-wrapper::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }
</style>
<!--  -->
<section class="py-5 bg-light">
    <?php $getProduct = getProductByCategory(1); // យកតែ category_id = 1 ?>
    <div class="container">
        <h1 class=" mb-5">Mobile Phones</h1>

        <?php if ($getProduct && mysqli_num_rows($getProduct) > 0): ?>
            <div class="horizontal-scroll-wrapper mb-4">
                <div class="d-flex flex-nowrap gap-4 px-2">
                    <?php while ($pro = mysqli_fetch_assoc($getProduct)): ?>
                        <div class="flex-shrink-0" style="width: 280px;">
                            <div class="card border-0 shadow-lg h-100 position-relative d-flex flex-column">
                                <span class="badge bg-success position-absolute" style="top: 10px; right: 10px;">New</span>

                                <img src="./uploads/<?= $pro['image'] ?>" class="card-img-top"
                                    style="height: 200px; object-fit: contain;" alt="<?= $pro['name'] ?>">

                                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                                    <div>
                                        <h5 class="card-title"><?= $pro['name'] ?></h5>
                                        <p class="text-muted"><?= $pro['small_description'] ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-bold text-primary"><?= $pro['selling_price'] ?>$</span>
                                        <a href="category" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-cart-plus"></i> View More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No products found in this category.</div>
        <?php endif; ?>
    </div>
</section>
<!--  -->
<section class="py-5 bg-light">
    <?php $getProduct = getProductByCategory(2); // យកតែ category_id = 1 ?>
    <div class="container">
        <h1 class="mb-5">Computers</h1>

        <?php if ($getProduct && mysqli_num_rows($getProduct) > 0): ?>
            <div class="horizontal-scroll-wrapper mb-4">
                <div class="d-flex flex-nowrap gap-4 px-2">
                    <?php while ($pro = mysqli_fetch_assoc($getProduct)): ?>
                        <div class="flex-shrink-0" style="width: 280px;">
                            <div class="card border-0 shadow-lg h-100 position-relative d-flex flex-column">
                                <span class="badge bg-success position-absolute" style="top: 10px; right: 10px;">New</span>

                                <img src="./uploads/<?= $pro['image'] ?>" class="card-img-top"
                                    style="height: 200px; object-fit: contain;" alt="<?= $pro['name'] ?>">

                                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                                    <div>
                                        <h5 class="card-title"><?= $pro['name'] ?></h5>
                                        <p class="text-muted"><?= $pro['small_description'] ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-bold text-primary"><?= $pro['selling_price'] ?>$</span>
                                        <a href="category" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-cart-plus"></i> View More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No products found in this category.</div>
        <?php endif; ?>
    </div>
</section>

<!--  -->
<section class="py-5 bg-light">
    <?php $getProduct = getProductByCategory(3); // យកតែ category_id = 1 ?>
    <div class="container">
        <h1 class="mb-5">Laptops</h1>

        <?php if ($getProduct && mysqli_num_rows($getProduct) > 0): ?>
            <div class="horizontal-scroll-wrapper mb-4">
                <div class="d-flex flex-nowrap gap-4 px-2">
                    <?php while ($pro = mysqli_fetch_assoc($getProduct)): ?>
                        <div class="flex-shrink-0" style="width: 280px;">
                            <div class="card border-0 shadow-lg h-100 position-relative d-flex flex-column">
                                <span class="badge bg-success position-absolute" style="top: 10px; right: 10px;">New</span>

                                <img src="./uploads/<?= $pro['image'] ?>" class="card-img-top"
                                    style="height: 200px; object-fit: contain;" alt="<?= $pro['name'] ?>">

                                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                                    <div>
                                        <h5 class="card-title"><?= $pro['name'] ?></h5>
                                        <p class="text-muted"><?= $pro['small_description'] ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-bold text-primary"><?= $pro['selling_price'] ?>$</span>
                                        <a href="category" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-cart-plus"></i> View More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No products found in this category.</div>
        <?php endif; ?>
    </div>
</section>

<!--  -->
<section class="py-5 bg-light">
    <?php $getProduct = getProductByCategory(6); // យកតែ category_id = 1 ?>
    <div class="container">
        <h1 class="mb-5">Cameras</h1>

        <?php if ($getProduct && mysqli_num_rows($getProduct) > 0): ?>
            <div class="horizontal-scroll-wrapper mb-4">
                <div class="d-flex flex-nowrap gap-4 px-2">
                    <?php while ($pro = mysqli_fetch_assoc($getProduct)): ?>
                        <div class="flex-shrink-0" style="width: 280px;">
                            <div class="card border-0 shadow-lg h-100 position-relative d-flex flex-column">
                                <span class="badge bg-success position-absolute" style="top: 10px; right: 10px;">New</span>

                                <img src="./uploads/<?= $pro['image'] ?>" class="card-img-top"
                                    style="height: 200px; object-fit: contain;" alt="<?= $pro['name'] ?>">

                                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                                    <div>
                                        <h5 class="card-title"><?= $pro['name'] ?></h5>
                                        <p class="text-muted"><?= $pro['small_description'] ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-bold text-primary"><?= $pro['selling_price'] ?>$</span>
                                        <a href="category" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-cart-plus"></i> View More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No products found in this category.</div>
        <?php endif; ?>
    </div>
</section>




<!-- Special Offer Banner -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold">Summer Sale!</h2>
        <p class="lead">Get 30% off on all signature drinks this weekend</p>
        <a href="#" class="btn btn-light btn-lg px-4">Shop the Sale</a>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">What Our Customers Say</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i>"The DIY cocktail kit was amazing! Everything was included and the instructions were so easy to follow."</i>
                            <i>"Fast delivery and excellent packaging. The signature drinks are my new favorites for summer parties!"</i>
                            <i>"Great variety of teas. I appreciate the organic options and the subscription service is very convenient."</i>
                        </div>
                        <p class="card-text">"The DIY cocktail kit was amazing! Everything was included and the instructions were so easy to follow."</p>
                        <h6 class="card-subtitle mt-3">- Sarah J.</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i>"The DIY cocktail kit was amazing! Everything was included and the instructions were so easy to follow."</i>
                            <i>"Fast delivery and excellent packaging. The signature drinks are my new favorites for summer parties!"</i>
                            <i>"Great variety of teas. I appreciate the organic options and the subscription service is very convenient."</i>
                        </div>
                        <p class="card-text">"Fast delivery and excellent packaging. The signature drinks are my new favorites for summer parties!"</p>
                        <h6 class="card-subtitle mt-3">- Michael T.</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i>"The DIY cocktail kit was amazing! Everything was included and the instructions were so easy to follow."</i>
                            <i>"Fast delivery and excellent packaging. The signature drinks are my new favorites for summer parties!"</i>
                            <i>"Great variety of teas. I appreciate the organic options and the subscription service is very convenient."</i>
                        </div>
                        <p class="card-text">"Great variety of teas. I appreciate the organic options and the subscription service is very convenient."</p>
                        <h6 class="card-subtitle mt-3">- Emily R.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="mb-3">Subscribe to Our Newsletter</h2>
                <p class="mb-4">Get updates on new products and special offers</p>
                <form class="row g-2">
                    <div class="col-8">
                        <input type="email" class="form-control" placeholder="Your email address">
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include('./components/footer.php') ?>