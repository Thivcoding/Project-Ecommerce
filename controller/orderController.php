<?php
session_start();
include('../model/db.php');
include('../func/redirect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_SESSION['auth'])) {
    if (isset($_POST['orderBtn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $zip = mysqli_real_escape_string($conn, $_POST['zip']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $total = mysqli_real_escape_string($conn, $_POST['total']);
        $payment_method = "COD";
        if ($name == "" || $email == "" || $phone == "" || $zip == "" || $address == "") {
            reDirect('../checkout.php', 'Your information is not Enought For Us', 'alert-danger');
            exit(0);
        }
        $tracking_no = 'vcommerce' . rand(1000, 9999) . substr($phone, 1, 5);
        $user_name = $_SESSION['auth-user']['name'];
        $payment_id = strtolower($user_name) . rand(111111, 999999);
        $user_id = $_SESSION['auth-user']['uerID'];
        $query = "SELECT c.id as cid, c.pro_qty, c.pro_id, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.pro_id = p.id AND c.user_id = '$user_id' ORDER BY c.id DESC";
        $query_run =  mysqli_query($conn, $query);
        $query_insert = "INSERT INTO orders (tracking_no,user_id,name,address,zipcode,total_price,payment_mode,payment_id) VALUES (
            '$tracking_no',
            '$user_id',
            '$name',
            '$address',
            '$zip',
            '$total',
            '$payment_method',
            '$payment_id'
        )";
        $query_insert_run = mysqli_query($conn, $query_insert);
        if ($query_insert_run) {
            $order_id = mysqli_insert_id($conn);
            foreach ($query_run as $item) {
                $item_id = $item['pro_id'];
                $item_qty = $item['pro_qty'];
                $item_price = $item['selling_price'];
                $query_insert_item = " INSERT INTO order_item (order_id,pro_id,qty,price) VALUES (
                '$order_id',
                '$item_id',
                '$item_qty',
                '$item_price'
                )";
                $query_insert_item_run = mysqli_query($conn, $query_insert_item);
                $query_product = "SELECT * FROM products WHERE id='$item_id'";
                $query_product_run = mysqli_query($conn,$query_product);
                $productData = mysqli_fetch_array($query_product_run);
                $current_qty = $productData['qty'];
                $new_qty = $current_qty - $item_qty;
                $query_update = "UPDATE products SET qty = '$new_qty' WHERE id='$item_id'";
                $query_update_run = mysqli_query($conn,$query_update);
            }
            $query_delete_order = "DELETE FROM carts WHERE user_id = '$user_id'";
            $query_delete_order_run = mysqli_query($conn,$query_delete_order);
                reDirect('../myorder.php', 'Product Order Successfully.', 'alert-success');
        }
    }
} else {
    reDirect('../index.php', 'You are not aligible to reach.', 'alert-warning');
}