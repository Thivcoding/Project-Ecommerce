<?php 
include('../model/db.php');
session_start();
    if($_POST['btn'] == 'removeBtn'){
        $id = $_POST['pro_id'];
        $uid = $_SESSION['auth-user']['uerID'];
        $query_remove = "DELETE FROM carts WHERE user_id = '$uid' AND pro_id = '$id'";
        $query_run = mysqli_query($conn,$query_remove);
        if($query_run){
            echo 168;
        }else{
            echo 104;
        }
    }elseif(isset($_POST['btn']) && $_POST['btn'] == "saveBtn"){
        $newOrder = $_POST['newOrder'];
        $pro_id = $_POST['pro_id'];
        $query_update = "UPDATE carts SET pro_qty = '$newOrder' WHERE pro_id = '$pro_id'";
        $query_update_run = mysqli_query($conn,$query_update);
        if($query_update_run){
            echo 168;
        }
    }   
        
?>