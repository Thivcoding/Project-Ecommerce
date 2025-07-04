<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ecomerce";
try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} catch (mysqli_sql_exception $e) {
    echo "Error on" . $e->getMessage();
}
function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getById($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getByIdActive($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='1'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getBySlugActive($table, $slug)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='1' LIMIT 1";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getProByCID($cate_id)
{
    global $conn;
    $query = "SELECT * FROM products WHERE category_id='$cate_id' AND status='1'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status = '1' ";
    return mysqli_query($conn, $query);
}
function getItemCarts()
{
    $uid = $_SESSION['auth-user']['uerID'];
    global $conn;
    $query = "SELECT c.id as cid 
        , p.id as pid 
        , p.selling_price as price
        , c.pro_qty as pqty
        , p.name as pname
        , p.image as pimage
         FROM carts c , products p WHERE c.user_id ='$uid' AND c.pro_id = p.id ORDER BY c.id DESC";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getCategory()
{
    global $conn;
    $getCategory = "SELECT * FROM categories ";
    $getCategory_run = mysqli_query($conn, $getCategory);
    return $getCategory_run;
}
function getProductByCategory($category_id)
{
    global $conn; // ត្រូវមាន $conn ដើម្បីប្រើ mysqli
    $category_id = mysqli_real_escape_string($conn, $category_id);
    $sql = "SELECT * FROM products WHERE category_id = $category_id AND status = 1";
    return mysqli_query($conn, $sql);
}
function getOrder()
{
    global $conn;
    $userId = $_SESSION['auth-user']['uerID'];
    $query = "SELECT * FROM orders WHERE user_id = '$userId'";
    return mysqli_query($conn, $query);
}
