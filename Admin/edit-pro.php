    <?php include('includes/header.php');
    include('../func/getProduct.php');
    ?>
    <div class="container-fluid">
        <div class="row px-4">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = getById('products', $id);
                if (mysqli_num_rows($product) > 0) {
                    $pro = mysqli_fetch_array($product);

            ?>
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h2>Edit-Category</h2>
                        </div>
                        <form action="../controller/productController.php" enctype="multipart/form-data" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="select_cate" class="form-label text-dark">Select Category <span class="text-danger">*</span></label>
                                        <select name="cate-id" class="form-select px-3 border" aria-label="Category">
                                            <option selected>Select Category</option>
                                            <?php
                                            $categories = getAll('categories');
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $data) {
                                            ?>
                                                    <option <?= $pro['category_id'] == $data['id'] ? "selected" : "" ?> value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "No Category Available";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="name" class="form-label text-dark">Input Product Name <span class="text-danger">*</span></label>
                                        <input type="hidden" name="id" value="<?= $pro['id'] ?>">
                                        <input type="text" value="<?= $pro['name'] ?>" name="name" id="name" class="form-control border px-3" placeholder="Name">
                                    </div>
                                    <div class="col-4">
                                        <label for="slugname" class="form-label text-dark">Input Product Slug Name <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $pro['slug'] ?>" name="slugname" id="slugname" class="form-control border px-3" placeholder="Slug Name">
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="small_description" class="form-label text-dark">Input Product Small Description <span class="text-danger">*</span></label>
                                        <textarea name="small_description" rows="8" class="form-control border px-3" id="small_description" placeholder="Product Small  Description"><?= $pro['small_description'] ?></textarea>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="description" class="form-label text-dark">Input Product Description <span class="text-danger">*</span></label>
                                        <textarea name="description" rows="8" class="form-control border px-3" id="description" placeholder="Product Description"><?= $pro['description'] ?></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="oprice" class="form-label text-dark">Input Product Original Price <span class="text-danger">*</span></label>
                                        <input value="<?= $pro['original_price'] ?>" type="text" name="oprice" id="oprice" class="form-control border px-3" placeholder="Original Price">
                                    </div>
                                    <div class="col-6">
                                        <label for="sprice" class="form-label text-dark">Input Product Selling Price <span class="text-danger">*</span></label>
                                        <input value="<?= $pro['selling_price'] ?>" type="text" name="sprice" id="sprice" class="form-control border px-3" placeholder="Selling Price">
                                    </div>
                                    <div class="col-4">
                                        <label for="image" class="form-label text-dark">Choose Product Picture <span class="text-danger">*</span></label>
                                        <input type="file" name="new_image" id="new_image" class="form-control border ps-3">
                                    </div>
                                    <div class="col-2">
                                        <img style="width: 80px; height: 80px; padding: 1px;" class="object-fit-cover mt-2 border" src="../uploads/<?= $pro['image'] ?>" alt="">
                                        <input type="hidden" name="old_image" value="<?= $pro['image'] ?>">
                                    </div>
                                    <div class="col-4">
                                        <label for="qty" class="form-label text-dark">Input Product Quantity <span class="text-danger">*</span></label>
                                        <input type="number" value="<?= $pro['qty'] ?>" name="qty" id="qty" class="form-control border px-3" placeholder="Product Quantity">
                                    </div>
                                    <div class="my-2 col-2 d-flex align-items-center pt-4">
                                        <div class="row">
                                            <div class="px-5 col-6 d-flex align-items-center justify-content-center">
                                                <input <?= $pro['status']==1? "checked":"" ?> type="checkbox" class="form-check border" name="status" id="status">
                                                <label class="form-label mb-1" for="status">Status</label>
                                            </div>
                                            <div class="px-5 col-6 d-flex align-items-center justify-content-center">
                                                <input <?= $pro['trending']==1? "checked":"" ?> type="checkbox" class="form-check border" name="trend" id="trend">
                                                <label class="form-label mb-1" for="trend">Trending</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="meta_title" class="form-label text-dark">Input Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $pro['meta_title'] ?>" name="meta_title" id="meta_title" class="form-control border px-3" placeholder="Meta Title">
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="meta_description" class="form-label text-dark">Input Meta Description <span class="text-danger">*</span></label>
                                        <textarea name="meta_description" rows="8" class="form-control border px-3" id="meta_description" placeholder="Meta Description"><?= $pro['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="meta_keyword" class="form-label text-dark">Input Meta Keyword <span class="text-danger">*</span></label>
                                        <textarea name="meta_keyword" rows="8" class="form-control border px-3" id="meta_description" placeholder="Meta Keyword"><?= $pro['meta_keywords'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer float-end">
                                <button type="reset" class="btn btn-secondary">Clear</button>
                                <button type="submit" name="update-btn-pro" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
            <?php
                } else {
                    echo "Product not found.";
                }
            } else {
                echo "Something Gone Wrong.";
            }
            ?>
        </div>
    </div>
    <?php include('includes/footer.php') ?>