    <?php include('includes/header.php');
    include('../func/getProduct.php')
    ?>
    <div class="container-fluid">
        <div class="row px-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h2>Add-Product</h2>
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
                                            <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
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
                                <input type="text" name="name" id="name" class="form-control border px-3" placeholder="Name">
                            </div>
                            <div class="col-4">
                                <label for="slugname" class="form-label text-dark">Input Product Slug Name <span class="text-danger">*</span></label>
                                <input type="text" name="slugname" id="slugname" class="form-control border px-3" placeholder="Slug Name">
                            </div>
                            <div class="col-12 my-2">
                                <label for="small_description" class="form-label text-dark">Input Product Small Description <span class="text-danger">*</span></label>
                                <textarea name="small_description" rows="8" class="form-control border px-3" id="small_description" placeholder="Product Small  Description"></textarea>
                            </div>
                            <div class="col-12 my-2">
                                <label for="description" class="form-label text-dark">Input Product Description <span class="text-danger">*</span></label>
                                <textarea name="description" rows="8" class="form-control border px-3" id="description" placeholder="Product Description"></textarea>
                            </div>
                            <div class="col-6">
                                <label for="oprice" class="form-label text-dark">Input Product Original Price <span class="text-danger">*</span></label>
                                <input type="text" name="oprice" id="oprice" class="form-control border px-3" placeholder="Original Price">
                            </div>
                            <div class="col-6">
                                <label for="sprice" class="form-label text-dark">Input Product Selling Price <span class="text-danger">*</span></label>
                                <input type="text" name="sprice" id="sprice" class="form-control border px-3" placeholder="Selling Price">
                            </div>
                            <div class="col-4">
                                <label for="image" class="form-label text-dark">Choose Product Picture <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control border ps-3">
                            </div>
                            <div class="col-4">
                                <label for="qty" class="form-label text-dark">Input Product Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="qty" id="qty" class="form-control border px-3" placeholder="Product Quantity">
                            </div>
                            <div class="my-2 col-4 d-flex align-items-center pt-4">
                                <div class="row">
                                    <div class="px-5 col-6 d-flex align-items-center justify-content-center">
                                        <input type="checkbox" class="form-check border" name="status" id="status">
                                        <label class="form-label mb-1" for="status">Status</label>
                                    </div>
                                    <div class="px-5 col-6 d-flex align-items-center justify-content-center">
                                        <input type="checkbox" class="form-check border" name="trend" id="trend">
                                        <label class="form-label mb-1" for="trend">Trending</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <label for="meta_title" class="form-label text-dark">Input Meta Title <span class="text-danger">*</span></label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control border px-3" placeholder="Meta Title">
                            </div>
                            <div class="col-12 my-2">
                                <label for="meta_description" class="form-label text-dark">Input Product Description <span class="text-danger">*</span></label>
                                <textarea name="meta_description" rows="8" class="form-control border px-3" id="meta_description" placeholder="Meta Description"></textarea>
                            </div>
                            <div class="col-12 my-2">
                                <label for="meta_keyword" class="form-label text-dark">Input Meta Keyword <span class="text-danger">*</span></label>
                                <textarea name="meta_keyword" rows="8" class="form-control border px-3" id="meta_description" placeholder="Meta Keyword"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer float-end">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" name="add-product-btn" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php') ?>