<?php include('./components/header.php');
include('./model/db.php');
include('./func/getProduct.php');
$cate_slug = $_GET['category'];
$category_data = getBySlugActive('categories',$cate_slug);
$category = mysqli_fetch_array($category_data);
$cid = $category['id'];
?>
<style>
    .text-container {
        max-height: 55px;
        overflow: hidden;
        position: relative;
        transition: max-height 0.4s ease-in-out;
    }

    .text-container.expanded {
        max-height: 500px;
    }

    .see-more {
        color: #0073e6;
        cursor: pointer;
        display: inline-block;
        margin-top: 8px;
    }

    .gradient-fade {
        position: absolute;
        bottom: 0;
        height: 30px;
        width: 100%;
        background: linear-gradient(to top, white, rgba(255, 255, 255, 0));
        pointer-events: none;
    }

    .text-wrapper {
        position: relative;
    }

    .text-container.expanded .gradient-fade {
        display: none;
    }
</style>
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-secondary d-flex justify-content-start">
                <a class="text-decoration-none text-secondary" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi text-secondary mb-1 bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" /></svg> &gt </a> 
                
                <a class="text-decoration-none text-secondary mx-1" href="category.php">Categories &gt</a> 

                <a class="text-decoration-none text-secondary mx-1" href="product.php?category=<?= $category['slug'] ?>"><?= $category['name'] ?></a> 
                
        </div>
        <div class="col-12 mb-3">
            <h1><?= $category['name'] ?></h1>
            <hr>
        </div>
        <?php
        $products = getProByCID($cid);
        if (mysqli_num_rows($products)) {
            foreach ($products as $item) {
        ?>
                <div class="col-3 mb-4">
                    <div class="card shadow shadow-blur">
                        <div class="card-body">
                                <a class="text-decoration-none" href="product-view.php?cate-slug=<?= $category['slug'] ?>&pro-slug=<?= $item['slug'] ?>">
                                <img class="w-100 card-img object-fit-cover" style="height: 35vh;" src="./uploads/<?= $item['image'] ?>" alt="">
                                 </a>
                                <h6 class="fw-bold text-center mt-3 text-decoration-none text-dark"><?= $item['name'] ?></h6>
                                <div class="text-wrapper">
                                <div class="text-container">
                                    <div class="gradient-fade"></div>
                                    <?= $item['small_description'] ?>
                                </div>
                                <span class="see-more">See More</span>
                            </div>      
                            </div>
                        </div>
                </div>
            <?php
            }
        } else { ?>
            <div class="container text-center text-secondary">
                <p>No Product Visible.</p>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<script>
    document.querySelectorAll('.text-wrapper').forEach(wrapper => {
        const container = wrapper.querySelector('.text-container');
        const button = wrapper.querySelector('.see-more');
        button.addEventListener('click', () => {
            container.classList.toggle('expanded');
            button.textContent = container.classList.contains('expanded') ? 'See Less' : 'See More';
        });
    });
</script>
<?php include('./components/footer.php'); ?>