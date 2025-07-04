<?php
session_start();
    if($_SESSION['auth']){
        unset($_SESSION['auth']);
        unset($_SESSION['auth-user']);
        $_SESSION['msg']="User Logged Out Successfully";
        $_SESSION['msgType']="alert-success";
        header('location: ./index.php');
    }
?>