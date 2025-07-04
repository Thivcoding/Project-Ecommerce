    <?php include('includes/header.php'); 
        include('../func/getProduct.php');
    ?>
    <div class="container-fluid">
        <div class="row px-4">
            <?php  
                if(isset($_GET['id'])){
                $id = $_GET['id'];
                $category = getById('categories',$id);
                if(mysqli_num_rows($category)>0){
                $data = mysqli_fetch_array($category);

            ?>
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h2>Edit-Category</h2>
                </div>
                <form action="../controller/productController.php" enctype="multipart/form-data" method="post">
                <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="form-label text-dark">Input Product Name <span class="text-danger">*</span></label>
                                <input type="hidden" value="<?= $data['id'] ?>" name="id" id="id" class="form-control border px-3">
                                <input type="text" value="<?= $data['name'] ?>" name="name" id="name" class="form-control border px-3" placeholder="Name">
                            </div>
                            <div class="col-6">
                                <label for="slugname" class="form-label text-dark">Input Product Slug Name <span class="text-danger">*</span></label>
                                <input type="text" value="<?= $data['slug'] ?>" name="slugname" id="slugname" class="form-control border px-3" placeholder="Slug Name">
                            </div>
                            <div class="col-12 my-2">
                                <label for="description" class="form-label text-dark">Input Product Description <span class="text-danger">*</span></label>
                                <textarea name="description" rows="8" class="form-control border px-3" id="description" placeholder="Product Description"><?= $data['description'] ?>
                                </textarea>
                            </div>
                            <div class="col-6">
                                <label for="image" class="form-label text-dark">Choose Product Picture <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control border ps-3">
                            </div> 
                            <div class="col-2">
                                <img style="width: 80px; height: 80px; padding: 1px;" class="object-fit-cover mt-2 border" src="../uploads/<?= $data['image'] ?>" alt="">
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                            </div>
                            <div class="my-2 col-4 d-flex align-items-center pt-4">
                                <div class="row">
                                    <div class="px-5 col-6 d-flex align-items-center justify-content-center">
                                        <input type="checkbox" <?= $data['status'] ? "checked" : "" ?> class="form-check border" name="status" id="status">
                                        <label class="form-label mb-1" for="status">Status</label>
                                    </div>
                                    <div class="px-5 col-6 d-flex align-items-center justify-content-center">
                                        <input type="checkbox" <?= $data['popular'] ? "checked" : "" ?> class="form-check border" name="popular" id="popular">
                                        <label class="form-label mb-1" for="popular">Popular</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <label for="meta_title" class="form-label text-dark">Input Meta Title <span class="text-danger">*</span></label>
                                <input type="text" name="meta_title" id="meta_title" value="<?= $data['meta_title'] ?>" class="form-control border px-3" placeholder="Meta Title">
                            </div>
                            <div class="col-12 my-2">
                                <label for="meta_description" class="form-label text-dark">Input Product Description <span class="text-danger">*</span></label>
                                <textarea name="meta_description" rows="8" class="form-control border px-3" id="meta_description" placeholder="Meta Description"><?= $data['meta_description'] ?>
                                </textarea>
                            </div>
                            <div class="col-12 my-2">
                                <label for="meta_keyword" class="form-label text-dark">Input Meta Keyword <span class="text-danger">*</span></label>
                                <textarea name="meta_keyword" rows="8" class="form-control border px-3" id="meta_description" placeholder="Meta Keyword"><?= $data['meta_keywords'] ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer float-end">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="update-btn" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <?php 
                }else{
                    echo "Category not found.";
                }
                } else {
                    echo "Something Gone Wrong";
                }
            ?>
        </div>
    </div>
    <?php include('includes/footer.php') ?>