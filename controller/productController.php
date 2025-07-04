<?php
session_start();
include('../func/redirect.php');
include('../model/db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['add-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slugname']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $file_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $file_ext;
    $cate_query = "INSERT INTO categories 
        (name, slug, description, status, popular, image, meta_title, meta_description, meta_keywords) 
        VALUES (
            '$name',
            '$slug',
            '$description',
            '$status',
            '$popular',
            '$file_name',
            '$meta_title',
            '$meta_description',
            '$meta_keyword'
        )";
    $cate_query_run = mysqli_query($conn, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
        $_SESSION['msg'] = "Category Insert Success.";
        header('location: ../Admin/add-cate.php');
    } else {
        $_SESSION['msg'] = "Product Insert Error: " + mysqli_error($conn);
        header('location: ../Admin/add-cate.php');
    }
} else if (isset($_POST['update-btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slugname']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);
    $new_image = $_FILES['image']['name'];

    if ($new_image != "") {
        $file_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_file = time() . '.' . $file_ext;
    } else {
        $update_file = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE categories SET 
    id = '$id',
    name='$name', 
    slug='$slug',
    description='$description',
    status='$status',
    popular='$popular',
    image='$update_file',
    meta_title = '$meta_title',
    meta_description = '$meta_description',
    meta_keywords = '$meta_keyword'
    WHERE id = '$id'
    ";
    $update_query_run = mysqli_query($conn, $update_query);
    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_file);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        reDirect("../Admin/categories.php", "Category Updated Successfully.", "alert-success");
    }
} else if (isset($_POST['btn-delete'])) {
    $del_id = mysqli_real_escape_string($conn, $_POST['del_id']);
    $query_select = "SELECT * FROM categories WHERE id = $del_id";
    $query_select_run = mysqli_query($conn, $query_select);
    $cate_data = mysqli_fetch_assoc($query_select_run);
    $img = $cate_data['image'];
    $delete_query = "DELETE FROM categories WHERE id = $del_id ";
    $delete_query_run = mysqli_query($conn, $delete_query);
    if ($delete_query_run) {
        if (file_exists("../uploads/" . $img)) {
            unlink("../uploads/" . $img);
        }
        reDirect("../Admin/categories.php", "Delete Category Seccessfully.", "alert-success");
    } else {
        reDirect("../Admin/categories.php", "Something gone wrong.", "alert-danger");
    }
} else if (isset($_POST['add-product-btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['cate-id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slugname']);
    $oprice = mysqli_real_escape_string($conn, $_POST['oprice']);
    $sprice = mysqli_real_escape_string($conn, $_POST['sprice']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $small_description = mysqli_real_escape_string($conn, $_POST['small_description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trend = isset($_POST['trend']) ? '1' : '0';
    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $file_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $file_ext;
    if ($name != "" && $slug != "" && $description != "") {
        $query_insert = "INSERT INTO products (
        category_id,
        name,
        slug,
        small_description,
        description,
        original_price,
        selling_price,
        image,
        qty,
        status,
        trending,
        meta_title,
        meta_keywords,
        meta_description) VALUES (
        '$cate_id',
        '$name',
        '$slug',
        '$small_description',
        '$description',
        '$oprice',
        '$sprice',
        '$file_name',
        '$qty',
        '$status',
        '$trend',
        '$meta_title',
        '$meta_keyword',
        '$meta_description')";
        $query_insert_run = mysqli_query($conn, $query_insert);
        if ($query_insert_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
            $_SESSION['msg'] = "Product Insert Success.";
            header('location: ../Admin/add-pro.php');
        } else {
            $_SESSION['msg'] = "Something gone wrong.";
            header('location: ../Admin/add-pro.php');
        }
    } else {
        $_SESSION['msg'] = "Please Fill Out The Fields.";
            header('location: ../Admin/add-pro.php');
    }
} else if (isset($_POST['btn-delete-pro'])) {
    include('../func/getProduct.php');
    $del_id = $_POST['del_id'];
    $product = getById('products',$del_id);
    $data = mysqli_fetch_assoc($product);
    $img = $data['image'];
    $query_delete = "DELETE FROM products WHERE id='$del_id'";
    $query_delete_run = mysqli_query($conn,$query_delete);
    if($query_delete_run){
        if (file_exists("../uploads/" . $img)) {
            unlink("../uploads/" . $img);
        }
        header('location: ../Admin/products.php');
        $_SESSION['msg']="Product Delete Successfully.";
    }else{
        header('location: ../Admin/products.php');
        $_SESSION['msg']="Something gone wrong.";
    }
} else if (isset($_POST['update-btn-pro'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $cate_id = mysqli_real_escape_string($conn, $_POST['cate-id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slugname']);
    $oprice = mysqli_real_escape_string($conn, $_POST['oprice']);
    $sprice = mysqli_real_escape_string($conn, $_POST['sprice']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $small_description = mysqli_real_escape_string($conn, $_POST['small_description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trend = isset($_POST['trend']) ? '1' : '0';
    $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);
    $new_image = $_FILES['new_image']['name'];

    if ($new_image != "") {
        $file_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_file = time() . '.' . $file_ext;
    } else {
        $update_file = $old_image;
    }
    $path = "../uploads";
    $update_query = "UPDATE products SET 
    category_id='$cate_id',
    name='$name',
    slug='$slug',
    small_description='$small_description',
    description='$description',
    original_price='$oprice',
    selling_price='$sprice',
    image='$update_file',
    qty='$qty',
    status='$status',
    trending='$trend',
    meta_title='$meta_title',
    meta_keywords='$meta_keyword',
    meta_description='$meta_description'
    WHERE id = '$id'
    ";
    $update_query_run = mysqli_query($conn, $update_query);
    if ($update_query_run) {
        if ($_FILES['new_image']['name'] != "") {
            move_uploaded_file($_FILES['new_image']['tmp_name'], $path . '/' . $update_file);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        reDirect("../Admin/products.php", "Product Updated Successfully.", "alert-success");
    }
}