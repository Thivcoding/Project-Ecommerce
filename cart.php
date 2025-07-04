<?php
session_start();
include('./components/header.php');
include('./model/db.php');
include('./func/getProduct.php');
?>
<style>
    .save-btn {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .d-flex.save-btn {
        opacity: 1;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-12 text-secondary d-flex justify-content-start">
            <a class="text-decoration-none text-secondary" href="index.php">
                <!-- ✅ House icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-house mb-1" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0L1 7.793V14.5A1.5 1.5 0 0 0 
                   2.5 16h3a.5.5 0 0 0 .5-.5V11A1.5 1.5 0 0 1 
                   7.5 9.5h1A1.5 1.5 0 0 1 10 11v4.5a.5.5 0 0 
                   0 .5.5h3A1.5 1.5 0 0 0 15 14.5V7.793l-6.646-6.647z" />
                    <path d="M13 2.5V6l1 1V2.5a.5.5 0 0 0-1 0z" />
                </svg> &gt;
            </a>
            <a class="text-decoration-none text-secondary mx-1" href="cart.php">Cart</a>
        </div>

        <div class="col-12">
            <h1>Cart Items</h1>
            <hr>
        </div>

        <div class="col-12 py-2 mb-2 d-flex align-items-center rounded-3 shadow-sm">
            <div class="col-2 text-center">
                <h4>Image</h4>
            </div>
            <div class="col-3 text-center">
                <h4>Info</h4>
            </div>
            <div class="col-4 text-center">
                <h4>QTY</h4>
            </div>
            <div class="col-2 text-center">
                <h4>Action</h4>
            </div>
        </div>

        <?php
        $cartItem = getItemCarts();
        foreach ($cartItem as $item):
            $id = $item['pid'];
            $stockResult = mysqli_query($conn, "SELECT qty FROM products WHERE id = $id");
            $stockRow = mysqli_fetch_assoc($stockResult);
            $stockQty = $stockRow['qty'];
        ?>
            <div class="col-12 mb-2 d-flex align-items-center p-3 rounded-3 shadow-lg">
                <div class="col-2">
                    <img src="./uploads/<?= $item['pimage'] ?>" class="img-fluid rounded-3"
                        style="width:250px; height:150px; object-fit:contain;">
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <h5><?= $item['pname'] ?></h5>
                </div>
                <div class="col-4">
                    <select class="form-select order_qty shadow-none" data-id="<?= $item['pid'] ?>">
                        <?php for ($i = 1; $i <= $stockQty; $i++): ?>
                            <option value="<?= $i ?>" <?= $item['pqty'] == $i ? 'selected' : '' ?>>
                                <?= $i ?> pcs
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-2 d-flex align-items-center justify-content-center gap-2">
                    <button type="button" value="<?= $item['pid'] ?>" class="removeBtn btn btn-danger text-light px-3 shadow-none d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-cart-check me-1" viewBox="0 0 16 16">
                            <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 
                     8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 
                     1.5a.5.5 0 0 0 .708 0z" />
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 
                     1.607 1.498 7.985A.5.5 0 0 0 4 
                     12h1a2 2 0 1 0 0 4 2 2 0 0 0 
                     0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 
                     0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 
                     0 0 0 14.5 3H2.89l-.405-1.621A.5.5 
                     0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 
                     14a1 1 0 1 1-2 0 1 1 0 0 1 2 
                     0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 
                     2 0" />
                        </svg>
                        Remove
                    </button>

                    <!-- ✅ Save Icon -->
                    <button id="update_order" value="<?= $item['pid'] ?>"
                        class="btn btn-success fw-bold px-3 d-none save-btn shadow-none d-flex align-items-center gap-1"
                        data-id="<?= $item['pid'] ?>" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 
                     0 4.923 2 5.166 4.579C14.758 4.804 16 
                     6.137 16 7.773 16 9.569 14.502 11 12.687 
                     11H10a.5.5 0 0 1 0-1h2.688C13.979 
                     10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 
                     2.825 10.328 1 8 1a4.53 4.53 0 0 
                     0-2.941 1.1c-.757.652-1.153 1.438-1.153 
                     2.055v.448l-.445.049C2.064 4.805 1 5.952 
                     1 7.318 1 8.785 2.23 10 3.781 
                     10H6a.5.5 0 0 1 0 1H3.781C1.708 
                     11 0 9.366 0 7.318c0-1.763 1.266-3.223 
                     2.942-3.593.143-.863.698-1.723 
                     1.464-2.383" />
                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 
                     1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 
                     5.707V14.5a.5.5 0 0 1-1 
                     0V5.707L5.354 7.854a.5.5 0 1 
                     1-.708-.708z" />
                        </svg>
                        Save
                    </button>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- ✅ Checkout -->
        <div class="col-12 mt-1 d-flex align-items-center justify-content-end">
            <a  href="./checkout.php" class="btn btn-primary text-light px-3 d-flex align-items-center shadow-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-coin me-1" viewBox="0 0 16 16">
                    <path d="M5.5 9.511c.076.954.83 1.697 
                   2.182 1.785V12h.6v-.709c1.4-.098 
                   2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 
                   1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 
                   1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9z" />
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 
                   1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="M8 13.5a5.5 5.5 0 1 1 0-11 
                   5.5 5.5 0 0 1 0 11m0 
                   .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                </svg>
                Check Out
            </a>
        </div>
    </div>
</div>

<?php include('./components/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.order_qty').each(function() {
            const originalQty = $(this).val();
            const productId = $(this).data('id');

            $(this).on('input', function() {
                const currentQty = $(this).val();
                const saveBtn = $(`.save-btn[data-id='${productId}']`);

                if (currentQty !== originalQty) {
                    saveBtn.removeClass('d-none').addClass('d-flex');
                    saveBtn.off('click').on('click', function() {
                        const newQty = $(`.order_qty[data-id='${productId}']`).val();
                        const proId = $(this).val();

                        $.post('controller/cartController.php', {
                            pro_id: proId,
                            newOrder: newQty,
                            btn: 'saveBtn'
                        }).done(function(response) {
                            if (response === "168") {
                                Swal.fire({
                                    title: "Updated",
                                    text: "Your product order updated.",
                                    icon: "success"
                                }).then(() => location.reload());
                            }
                        });
                    });
                } else {
                    saveBtn.addClass('d-none').removeClass('d-flex');
                }
            });
        });
    });
    $('.removeBtn').click(function() {
        const proId = $(this).val();
        $.ajax({
            method: "POST",
            url: "controller/cartController.php",
            data: {
                pro_id: proId,
                btn: 'removeBtn'
            },
            success: function(response) {
                if (response == "168") {
                    Swal.fire({
                            icon: "success",
                            title:"Product Deleted From Cart",
                            }).then(()=>{
                                window.location.reload();
                            })
                } else if (response == "104") {
                    alert(123)
                }
            },

        });
    })
</script>