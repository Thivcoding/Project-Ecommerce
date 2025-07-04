<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);          
include('../model/db.php');
if (isset($_SESSION['auth'])) {
    $user_id = $_SESSION['auth-user']['uerID'];
    $pro_id = $_POST['pro_id'];
    $pro_qty = $_POST['pro_qty'];
    $scope = $_POST['scope'];
    $query_check_validate = "
        SELECT * FROM carts WHERE user_id = '$user_id' AND pro_id = '$pro_id' 
    ";
    $query_check_validate_run = mysqli_query($conn, $query_check_validate);
    if (mysqli_num_rows($query_check_validate_run) > 0) {
        echo 102;
    } else {
        $query_add = "INSERT INTO carts (user_id,pro_id,pro_qty) VALUES (
            '$user_id',
            '$pro_id',
            '$pro_qty'
        )";
        $query_add_run = mysqli_query($conn, $query_add);
        if ($query_add_run) {
            echo 168;
        }
    }
} else {
    echo 101;
}
