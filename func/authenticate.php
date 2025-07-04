<?php 
include('redirect.php');
if(!isset($_SESSION['auth'])){
    reDirect('./login.php',"Please Sign In or Register","alert-warning");
}
?>