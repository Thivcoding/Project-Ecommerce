<?php include('./components/header.php');
include('./model/db.php');
include('./func/getProduct.php');
?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-secondary d-flex justify-content-start">
                <a class="text-decoration-none text-secondary" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi text-secondary mb-1 bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" /></svg> &gt </a> 
                
                <a class="text-decoration-none text-secondary mx-1" href="category.php">Categories </a> 
                
        </div>
        <div class="col-12 mb-3">
            <h1>Collection</h1>
            <hr>
        </div>
        <?php
        $categories = getAllActive('categories');
        if (mysqli_num_rows($categories)) {
            foreach ($categories as $item) {
            
        ?>
            <style>
                .txt-hover{
                    transition: .3s ease-in-out;
                }
                .txt-hover:hover{
                    transform: translateY(5px);
                    transition: .3s ease-in-out;
                }
            </style>
                    <div class="col-md-4 col-lg-3 col-12 mb-4">
                        <a class="text-decoration-none" href="product.php?category=<?= $item['slug'] ?>">
                    <div class="card shadow shadow-blur txt-hover" >
                        <div class="card-body">
                            <img class="w-100 object-fit-cover" style="height: 35vh;" src="./uploads/<?= $item['image'] ?>" alt="">
                            <h4 class="fw-bold text-center mt-3 text-decoration-none text-dark"><?= $item['name'] ?></h4>
                        </div>
                    </div>
                </a>
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
<?php include('./components/footer.php'); ?>